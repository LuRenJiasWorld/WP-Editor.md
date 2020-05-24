<?php

namespace EditormdUtils;

class Ajax {
	public static function editormd_return_json($url, $error="", $detail="") {
        // 格式化detail数据类型为字符串
        if (is_array($detail)) {
            $detail = json_encode($detail);
        }

        $result = [
            "url"       =>    $url,
            "error"     =>    $error,
            "detail"    =>    $detail
        ];

        echo json_encode($result, JSON_UNESCAPED_UNICODE);

        die();
    }
}