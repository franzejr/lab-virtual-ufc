<?
/*
	This file is a handler between the front-end and the
	back-end. Basically, we get the filename and the text
	from the file, so we can save the file.
*/

//Getting the variables from request	
$fileName = $_POST['fileName'];
$text = $_POST['text'];
$login = $_POST['login'];
$area = $_POST['area'];

$format = split("\.", $fileName,2);

echo $text;

$tempFile = $fileName;

//$text = stripslashes($text);
$Handle = fopen("./$login/$area/$tempFile", 'w') or die("can't open file");
fwrite($Handle, $text);
fclose($Handle);

?>