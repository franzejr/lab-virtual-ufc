<?

/*
	This file is a handler between the front-end and the
	back-end. Basically, we get the filename and the text
	from the file, with these we can compile or execute.
*/

 //Getting the variables from request	
 $fileName = $_POST['fileName'];
 $text = $_POST['text'];

 $format = split("\.", $fileName,2);

 $fileExtension = $format[1];

 $tempFile = $fileName;
	
 if($fileExtension == "py"){
 
 	$text = stripslashes($text);
 	$Handle = fopen($tempFile, 'w') or die("can't open file");
 	fwrite($Handle, $text);
 	fclose($Handle);
 	
 	exec("python ".$tempFile." >&  output");
 	//load the file
 	include("output");
 	system("rm -f output");

 }elseif ($fileExtension == "java") {

 	$className = $format[0]; 	

 	$text = stripslashes($text);
 	$Handle = fopen($tempFile, 'w') or die("can't open file");
 	fwrite($Handle, $text);
 	fclose($Handle);
 	//Compiling
 	exec("javac ".$tempFile." >&  output_error");

 	//Executing and putting the output in a file
 	exec("java ".$className." >&  output");

 	if (file_exists($className.".class") ){
		include('output');	
	}

 	//load the file
 	include('output');
 	system("rm -f output");

	$output_error = file_get_contents('output_error');
	echo $output_error;

	system("rm -f output_error");

 }elseif($fileExtension == "c"){

 	$text = stripslashes($text);
 	$Handle = fopen($tempFile, 'w') or die("can't open file");
 	fwrite($Handle, $text);
 	fclose($Handle);

 	//Compiling
 	exec("gcc ".$tempFile." -o compilado >&  output_error");

 	//Executing and putting the output in a file
 	exec("./compilado >&  output");
	
	if (file_exists('compilado')){
		include('output');	
	}

	system("rm -f output");

	$output_error = file_get_contents('output_error');
	echo $output_error;

	system("rm -f output_error");

 }elseif($fileExtension == "cpp"){

 	$text = stripslashes($text);
 	$Handle = fopen($tempFile, 'w') or die("can't open file");
 	fwrite($Handle, $text);
 	fclose($Handle);

 	//Compiling
 	exec("g++ ".$fileName." -o compilado >&  output_error");

 	//Executing and putting the output in a file
 	exec("./compilado >&  output");
	
	if (file_exists('compilado')){
		include('output');	
	}

	system("rm -f output");

	$output_error = file_get_contents('output_error');
	echo $output_error;

	system("rm -f output_error");

 }//It's possible to add more type of languages to be compiled


?>