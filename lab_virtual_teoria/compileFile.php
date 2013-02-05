<?
/*
	This file is a handler between the front-end and the
	back-end. Basically, we get the filename and the text
	from the file, with these we can compile or execute.
*/

 //Getting the variables from request	
 $fileName = $_POST['fileName'];
 $text = $_POST['text'];
 $login = $_POST['login'];
 $area = $_POST['area'];
 $tape = $_POST['tape'];


 $loginFolderArea = "./students/$login/$area/";
 $loginFolderTemp = "./students/$login/temp/";
 $binFolder = "./bin/$area/";
 $binFolderElements = "./bin/$area/*";

 $format = split("\.", $fileName,2);

 $fileExtension = $format[1];

 $tempFile = $fileName;

/* File .mt */
if($fileExtension == "mt"){

 	$tempFile = $fileName;

 	//Executing and putting the output in a file
 	//exec("./smt ./students/$login/$area/$tempFile ".$tape.">&  output");
 	exec("java -jar turing_simulator.jar ./students/$login/$area/$tempFile ".$tape.">&  output");
	
	//if (file_exists('smt')){
		
		include('output');
		//echo "./students/$login/$area/output";
	//}

	//system("rm -f output");

	/*  Python */
 }elseif($fileExtension == "py"){
 
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

 	//Copy the bin files
 	exec("cp $binFolderElements $loginFolderTemp");

 	$filePath = $loginFolderArea.$fileName;
	//Copy the bin files
 	exec("cp $filePath $loginFolderTemp"); 	

 	//Compiling
 	exec("cd $loginFolderTemp && gcc $fileName -o compilado 2>  output_error");

 	//Executing and putting the output in a file
 	exec("cd $loginFolderTemp && ./compilado >>  output");
	
	if (file_exists("./students/".$login."/temp/compilado")){
		include("./students/".$login."/temp/output");	
	}

	system("rm -f output");

	$outputErrorFile = $loginFolderTemp."output_error";
	$output_error = file_get_contents($outputErrorFile);
	echo $output_error;

	system("rm -f output_error");

 }elseif($fileExtension == "cpp"){

 	//Copy the bin files
 	exec("cp $binFolderElements $loginFolderTemp");

 	$filePath = $loginFolderArea.$fileName;
	//Copy the bin files
 	exec("cp $filePath $loginFolderTemp"); 	

 	//Compiling
 	exec("cd $loginFolderTemp && g++ $fileName -o compilado 2>  output_error");

 	//Executing and putting the output in a file
 	exec("cd $loginFolderTemp && ./compilado >>  output");
	
	if (file_exists("./students/".$login."/temp/compilado")){
		include("./students/".$login."/temp/output");	
	}

	system("rm -f output");

	$outputErrorFile = $loginFolderTemp."output_error";
	$output_error = file_get_contents($outputErrorFile);
	echo $output_error;

	system("rm -f output_error");

 }//It's possible to add more type of languages to be compiled