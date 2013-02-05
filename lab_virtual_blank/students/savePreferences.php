<?
	$login = $_POST['login'];
	$area = $_POST['area'];
	$background = $_POST['background'];
	$background_editor = $_POST['background_editor'];
	$font_color_editor = $_POST['font_color_editor'];

	// echo ini_get('background');
	// ini_set('display_errors', '1');

	//$ini_array = parse_ini_file("demo/preferences.ini");
	
	$ini_array=array("background"=>$background,"backgrond_editor"=>$backgrond_editor,"font_color_editor"=>$font_color_editor);
	print_r($ini_array);
	$file = fopen("demo/preferences.ini", 'w') or die("can't open file");

	write_php_ini($ini_array,$file);
	
	function write_php_ini($array, $file)
	{
	    $res = array();
	    foreach($array as $key => $val)
	    {
	        if(is_array($val))
	        {
	            $res[] = "[$key]";
	            foreach($val as $skey => $sval) $res[] = "$skey = ".(is_numeric($sval) ? $sval : '"'.$sval.'"');
	        }
	        else $res[] = "$key = ".(is_numeric($val) ? $val : '"'.$val.'"');
	    }
	    fwrite($file, implode("\r\n", $res));
	}
?>