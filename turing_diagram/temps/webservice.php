<?

/*
	This file is a handler between the front-end and the
	back-end. Basically, we get the filename and the text
	from the file, with these we can compile or execute.
*/

 //Getting the variables from request	
 $fileName = $_POST['fileName'];
 $text = $_POST['text'];
 $tape = $_POST['tape'];

 $format = split("\.", $fileName,2);


 $tempFile = $fileName;
	
 	$text = stripslashes($text);
 	$Handle = fopen($tempFile, 'w') or die("can't open file");
 	fwrite($Handle, $text);
 	fclose($Handle);

 	//Executing and putting the output in a file
 	exec("./smt ".$tempFile. " ".$tape." >&  output");
	
	if (file_exists('smt')){
		include('output');	
	}

	system("rm -f output");

?>