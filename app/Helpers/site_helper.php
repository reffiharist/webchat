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

function uri_segment($segment = NULL)
{
    $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

    return isset($uriSegments[$segment]) ? $uriSegments[$segment] : FALSE;
}

/*
 * $value = uri_segment(n)
 * $param = module / controller
 */
function activeMenu($value, $param, $cetak = 'active')
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

function sendEmail($to, $subject, $message)
{
    $email = \Config\Services::email();

    $config['protocol'] = 'smtp';
    $config['SMTPHost'] = 'mail.webchat.id';
    $config['SMTPPort'] = 465;
    $config['SMTPUser'] = 'noreply@webchat.id';
    $config['SMTPPass'] = 'noreply#2023';
    $config['SMTPCrypto'] = 'tls';
    $config['mailType'] = 'html';

    $email->initialize($config);
    $email->setTo($to);
    $email->setFrom('noreply@webchat.id', 'WebChat ID');
    $email->setSubject($subject);
    $email->setMessage($message);

    if ($email->send()) {
        return TRUE;
    } else {
        return $email->printDebugger(['headers']);
    }
}

function dateTimeZoneToDatetime($param, $isOrder = TRUE)
{
    if($isOrder) {
        $date = $param->format('Y-m-d H:i:s');
    } else {
        $dateTime = DateTime::createFromFormat('Y-m-d\TH:i:s.u\Z', $param);
        $date = $dateTime->format('Y-m-d H:i:s');
    }

    return $date;
}

function badge($status = NULL)
{
    if($status == 'pending') {
        $color = 'warning';
    }else if($status == 'processing') {
        $color = 'primary';
    }else if($status == 'completed') {
        $color = 'success';
    }else {
        $color = "danger";
    }

    return "<div class='badge badge-light-".$color." fw-bold'>".$status."</div>";
}

function packageName($id = NULL, $addon = FALSE)
{
    $packageModel = new \App\Models\PackageModel;
    $addonModel = new \App\Models\AddonModel;

    if(!$id) {
        return FALSE;
    }

    $data = !$addon ? $packageModel->find($id) : $addonModel->find($id);

    if(!$data) {
        return FALSE;
    }

    return !$addon ? $data->package_name : $data->addon_name;
}