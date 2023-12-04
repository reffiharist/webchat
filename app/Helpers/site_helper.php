<?php

function svgIcon($path, $class = "") {
    // $rootPath = "www/site/";
    $rootPath = ROOTPATH . "/public/assets/admin/media/";

    $full_path = $rootPath . $path;

    if ( !file_exists($full_path) ) {
        return "<!--SVG file not found: $path-->\n";
    }

    $cls = array("svg-icon");

    if ( !empty($class) ) {
        $cls = array_merge($cls, explode(" ", $class));
    }

    $svg_content = file_get_contents($full_path);

    $output = "<!--begin::Svg Icon | path: $path-->\n";
    $output .= "<span class=\"".implode(" ", $cls) . "\">" . $svg_content . "</span>";
    $output .= "\n<!--end::Svg Icon-->";

    return $output;
}

function url_slug($string) {
    
    return url_title($string, '-', TRUE);
}

function encrypt($text) {
    $encrypter = \Config\Services::encrypter();

    return bin2hex($encrypter->encrypt($text));
}

function decrypt($text) {
    $encrypter = \Config\Services::encrypter();

    return $encrypter->decrypt(hex2bin($text));
}

function bCrypt($pass,$cost)
{
    $chars = './ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    
    // Build the beginning of the salt
    $salt = sprintf('$2a$%02d$',$cost);
    
    // Seed the random generator
    mt_srand();
    
    // Generate a random salt
    for($i=0;$i<22;$i++) $salt.=$chars[mt_rand(0,63)];
    
    // return the hash
    return crypt($pass,$salt);
}

function active_menu($value, $param, $cetak = 'active')
{
    if(is_array($param)) {
        if(in_array($value, $param)){
            return $cetak;
        } else {
            return "";
        }
    } else {
        if($value == $param) {
            return $cetak;
        } else {
            return "";
        }
    }
}

function angka($x = 0)
{
    return number_format($x, 0, ",", ".");
}