<?php
// sm.ms图片管理页面

function display_page($text_domain, $config) {
    return file_get_contents(__DIR__ . "/html/index.html");
}

/**
 * wp_editormd_entry_sm_ms_proxy()
 * 由于sm.ms只允许后端请求，不允许前端请求，因此需要此代理
 * 允许sm-ms-management前端在授权情况下post到此接口，并携带如下参数：
 * - url: 代理地址
 * - method: 代理方法(post, get)
 * - header: 请求头(数组，不是字典)
 * - body: 请求体(字典)
 */
function wp_editormd_entry_sm_ms_proxy() {
    $postData = json_decode(file_get_contents('php://input'), true);

    $url    = $postData["url"];
    $method = $postData["method"];
    $header = $postData["header"];
    $body   = $postData["body"];

    $ch     = curl_init();
    curl_setopt($ch, CURLOPT_URL,            $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST,           $method == "post" ? 1 : 0);
    curl_setopt($ch, CURLOPT_USERAGENT,      $user_agent);
    curl_setopt($ch, CURLOPT_HTTPHEADER,     $header); 

    if ($method == "post") {
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
    }

    $result  = curl_exec($ch);

    $reqCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    header("Content-Type: application/json");
    http_response_code($reqCode);
    return $result;
}