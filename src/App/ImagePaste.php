<?php
/**
 * 图片上传接口
 */

namespace EditormdApp;

use EditormdUtils\Config;
use EditormdUtils\Ajax;

/**
 * json数据结构：
 * - url    : 返回的图片地址，如果存在error可以为空
 * 
 * - error  : 返回的错误信息，可能值如下：
 *  1. file_extension_error: 文件扩展名错误，无论图片本身是什么格式，传递上来都应为image/png，致命错误，不返回图片地址
 *  2. file_too_large: 文件过大，常见于第三方图床，不返回图片地址
 *  3. file_repeated: 文件重复，常见于第三方图床，返回正确的图片地址
 *  4. unknown_error: 未知错误，详见detail
 * 
 * - detail : 其他信息，可能为以下几种格式：
 *  1. 在第三方图床请求正常的情况下，返回第三方图床返回的raw数据
 *  2. 在出现未知错误时，返回错误内容
 */
class ImagePaste {
    /*
     * WordPress预置常量
     */
    private $uploadUrl;
    private $uploadDir;
    private $tempDir;

    /*
     * 与图片相关的变量
     */
    private $extension;             // 保存的文件扩展名，一般为png
    private $name;                  // 文件名，是所传递base64的md5值
    private $content;               // 文件二进制数据

    public function __construct() {
        add_action("wp_ajax_wp_editormd_imagepaste", array($this, "editormd_imagepaste_action_callback"));
    }

    // 入口方法，根据配置进行下一步路由
    public function editormd_imagepaste_action_callback() {
        // 1. 采集用户上传的数据信息
        try {
            $this->result = array("error" => "");
            $this->uploadUrl = wp_upload_dir()["url"];
            $this->uploadDir = wp_upload_dir()["path"];
            $this->tempDir   = get_temp_dir();
    
            list($data, $image) = explode(";", $_REQUEST["dataurl"]);
            list($field, $type) = explode(":", $data);
            list($encoding, $this->content) = explode(",", $image);
            if ($type == "image/png") {
                $this->extension = "png";
            } else {
                Ajax::editormd_return_json("", "file_extension_error");
            }
            $this->name = "wp_editor_md_" . md5($_REQUEST["dataurl"]);
        } catch (Exception $e) {
            Ajax::editormd_return_json("", "unknown_error", "Exception occurred when parsing requests:" . $e->getMessage());
        }
        

        // 2. 选择上传目的地
        try {
            switch(Config::get_option("imagepaste_sm", "editor_basics")) {
                case "on":
                    $this->editormd_imagepaste_smms();
                    break;
                default:
                    $this->editormd_imagepaste_save();
                    break;
            }
        } catch (Exception $e) {
            Ajax::editormd_return_json("", "unknown_error", "Exception occurred when uploading:" . $e->getMessage());
        }
        
    }

    // 存储图片到本地
    private function editormd_imagepaste_save() {
        // 保存后进行转换
        $file    = $this->uploadDir . "/" . $this->name . "." . $this->extension;
        file_put_contents($file, base64_decode($this->content));
        $this->editormd_png2jpg($file);

        $this->extension = "jpg";
        $fileUrl = $this->uploadUrl . "/" . $this->name . "." . $this->extension;

        Ajax::editormd_return_json($fileUrl);
    }

    // 上传图片到sm.ms
    private function editormd_imagepaste_smms() {
        $header = array(
            "Content-type: multipart/form-data",
        );

        // 保存到临时目录
        $tempFile = $this->editormd_save_to_temp_dir();

        // 获取用户配置中的图床校验码
        $authToken = Config::get_option("imagepaste_sm_token", "editor_basics");

        if ($authToken !== "") {
            $header = array_merge($header, array(
                "Authorization: " . $authToken
            ));
        }

        list($result, $reqCode) = $this->editormd_curl_post_file(
            "https://sm.ms/api/v2/upload", 
            array(
                "smfile" => new \CURLFile(realpath($tempFile)),
                "format" => "json"
            ), 
            $header
        );

        switch($reqCode) {
            case 200:
                $data = json_decode($result, true);
                // 对图片重复的情况进行特殊处理
                if ($data["code"] == "image_repeated") {
                    $imageUrl = $data["images"];
                } else {
                    $imageUrl = $data["data"]["url"];
                }
                Ajax::editormd_return_json($imageUrl, "", $result);
                break;
            case 413:
                Ajax::editormd_return_json("", "file_too_large", "");
                break;
            default:
                Ajax::editormd_return_json("", "unknown_error", $reqCode . $result);
                break;
        }
    }

    // 将当前读取的数据保存到临时目录
    private function editormd_save_to_temp_dir() {
        $tempFile = $this->tempDir . $this->name . "." . $this->extension;
        file_put_contents($tempFile, base64_decode($this->content));
        $tempFile = $this->editormd_png2jpg($tempFile);

        return $tempFile;
    }

    // 将Base64生成的PNG保存为JPG以减小体积，加快上传和访问的速度
    private function editormd_png2jpg($filePath, $deleteOldFile=true) {
        $quality = 50;
        $newFilename = str_replace(".png", ".jpg", $filePath);

        $image = imagecreatefrompng($filePath);
        $bg = imagecreatetruecolor(imagesx($image), imagesy($image));

        imagefill($bg, 0, 0, imagecolorallocate($bg, 255, 255, 255));
        imagealphablending($bg, TRUE);
        imagecopy($bg, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
        imagedestroy($image);
        
        imagejpeg($bg, $newFilename, $quality);
        imagedestroy($bg);

        if ($deleteOldFile) {
            unlink($filePath);
        }

        return $newFilename;
    }

    // 使用curl发送post请求，可用于多种图床
    private function editormd_curl_post_file($url, $postField, $header) {
        $user_agent = "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.1750.146 Safari/537.36";

        $ch      = curl_init();
        curl_setopt($ch, CURLOPT_URL,            $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST,           1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,     $postField);
        curl_setopt($ch, CURLOPT_USERAGENT,      $user_agent);
        curl_setopt($ch, CURLOPT_HTTPHEADER,     $header); 

        $result  = curl_exec($ch);

        $reqCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        return array($result, $reqCode);
    }
}