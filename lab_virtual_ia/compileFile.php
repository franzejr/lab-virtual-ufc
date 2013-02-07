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

 $loginFolderArea = "./students/$login/$area/";
 $loginFolderTemp = "./students/$login/$area/temp/";
 $binFolder = "./bin/$area/";
 $binFolderElements = "./bin/$area/*";

 $format = split("\.", $fileName,2);

 $fileExtension = $format[1];

 $tempFile = $fileName;
 
 $timeInfiniteLoop = 45;
	
 if($fileExtension == "py"){
 
 	//Limpando os outputs anteriores
	system("cd $loginFolderTemp && rm -f *");
	
 	//Copy the bin files
 	exec("cp $binFolderElements $loginFolderTemp");

 	$filePath = $loginFolderArea.$fileName;
	//Copy the bin files
 	exec("cp $filePath $loginFolderTemp"); 	
 
 	$time1 = time();
 	exec("cd $loginFolderTemp && python ".$fileName." 1>  output 2>&1 &");
 	
 	//Pegando o pid
	exec("pgrep python",$pids);
	
	while( !(empty($pids)) ){
		system("rm pid");
		//Verifica atraves de um arquivo se o pid do processo ainda esta rodando
		exec("pgrep python >> pid",$pids);
		$pid = file_get_contents("pid");
		if($pid == "") break;

		$time2 = time();

		//Fazendo verificacao se o programa esta rodando mais que 15s
		if(($time2 - $time1) > $timeInfiniteLoop){ 
			echo "A execucao do seu programa durou mais que 45s"; 
			exec("killall python"); break; 
		}
	}
 	//load the file
 	include("./students/".$login."/$area/temp/output");

}elseif($fileExtension == "m"){
 
 	//Limpando os outputs anteriores
	system("cd $loginFolderTemp && rm -f *");
	
 	//Copy the bin files
 	exec("cp $binFolderElements $loginFolderTemp");

 	$filePath = $loginFolderArea.$fileName;
	//Copy the bin files
 	exec("cp $filePath $loginFolderTemp"); 	
 
 	$time1 = time();
 	exec("cd $loginFolderTemp && octave -q ".$fileName." 1>  output 2>&1 &");
 	
 	//Pegando o pid
	exec("pgrep octave",$pids);
	
	while( !(empty($pids)) ){
		system("rm pid");
		//Verifica atraves de um arquivo se o pid do processo ainda esta rodando
		exec("pgrep octave >> pid",$pids);
		$pid = file_get_contents("pid");
		if($pid == "") break;

		$time2 = time();

		//Fazendo verificacao se o programa esta rodando mais que 15s
		if(($time2 - $time1) > $timeInfiniteLoop){ 
			echo "A execucao do seu programa durou mais que 45s"; 
			exec("killall octave"); break; 
		}
	}
 	//load the file
 	exec("cd $loginFolderTemp && cp *.jpg *png ../");
 	include("./students/".$login."/$area/temp/output");

}elseif ($fileExtension == "java") {

 	$className = $format[0]; 	

 	//Limpando os outputs anteriores
	system("cd $loginFolderTemp && rm -f *");
	
 	//Copy the bin files
 	exec("cp $binFolderElements $loginFolderTemp");

 	$filePath = $loginFolderArea.$fileName;
	//Copy the bin files
 	exec("cp $filePath $loginFolderTemp"); 	

 	//Compiling
 	exec("cd $loginFolderTemp && javac *.java  2> output_error");
 	
 	$time1 = time();
	//Executing and putting the output in a file
 	exec("cd $loginFolderTemp && java $className  >>  output &");
	
	//Pegando o pid
	exec("pgrep java",$pids);
	
	while( !(empty($pids)) ){
		system("rm pid");
		//Verifica atraves de um arquivo se o pid do processo ainda esta rodando
		exec("pgrep java >> pid",$pids);
		$pid = file_get_contents("pid");
		if($pid == "") break;

		$time2 = time();

		//Fazendo verificacao se o programa esta rodando mais que 15s
		if(($time2 - $time1) > $timeInfiniteLoop){ 
			echo "A execucao do seu programa durou mais que 45s"; 
			exec("killall java"); break; 
		}
	}
	
	//Showing output from code	
	include("./students/".$login."/$area/temp/output");	
	
	$outputErrorFile = $loginFolderTemp."output_error";
	$output_error = file_get_contents($outputErrorFile);
	echo $output_error;

 }elseif($fileExtension == "c"){

 	//Limpando os outputs anteriores
	system("cd $loginFolderTemp && rm -f *");
	
 	//Copy the bin files
 	exec("cp $binFolderElements $loginFolderTemp");

 	$filePath = $loginFolderArea.$fileName;
	//Copy the bin files
 	exec("cp $filePath $loginFolderTemp"); 	

 	//Compiling
 	exec("cd $loginFolderTemp && gcc *.cpp -o compilado 2> output_error");
 	
 	$time1 = time();
	//Executing and putting the output in a file
 	exec("cd $loginFolderTemp && ./compilado >>  output &");
	
	//Pegando o pid
	exec("pgrep compilado",$pids);
	
	while( !(empty($pids)) ){
		system("rm pid");
		//Verifica atraves de um arquivo se o pid do processo ainda esta rodando
		exec("pgrep compilado >> pid",$pids);
		$pid = file_get_contents("pid");
		if($pid == "") break;

		$time2 = time();

		//Fazendo verificacao se o programa esta rodando mais que 15s
		if(($time2 - $time1) > $timeInfiniteLoop){ 
			echo "A execucao do seu programa durou mais que 45s"; 
			exec("killall compilado"); break; 
		}
	}

	if (file_exists("./students/".$login."/$area/temp/compilado")){
		//echo "Arquivo existe...";
		include("./students/".$login."/$area/temp/output");	
	}

	$outputErrorFile = $loginFolderTemp."output_error";
	$output_error = file_get_contents($outputErrorFile);
	echo $output_error;

 }elseif($fileExtension == "cpp"){
	
	//Limpando os outputs anteriores
	system("cd $loginFolderTemp && rm -f *");
	
 	//Copy the bin files
 	exec("cp $binFolderElements $loginFolderTemp");

 	$filePath = $loginFolderArea.$fileName;
	//Copy the bin files
 	exec("cp $filePath $loginFolderTemp"); 	

 	//Compiling
 	exec("cd $loginFolderTemp && g++ *.cpp -o compilado 2> output_error");
 	
 	$time1 = time();
	//Executing and putting the output in a file
 	exec("cd $loginFolderTemp && ./compilado >>  output &");
	
	//Pegando o pid
	exec("pgrep compilado",$pids);
	
	while( !(empty($pids)) ){
		system("rm pid");
		//Verifica atraves de um arquivo se o pid do processo ainda esta rodando
		exec("pgrep compilado >> pid",$pids);
		$pid = file_get_contents("pid");
		if($pid == "") break;

		$time2 = time();

		//Fazendo verificacao se o programa esta rodando mais que 15s
		if(($time2 - $time1) > $timeInfiniteLoop){ 
			echo "A execucao do seu programa durou mais que 45s"; 
			exec("killall compilado"); break; 
		}
	}

	if (file_exists("./students/".$login."/$area/temp/compilado")){
		//echo "Arquivo existe...";
		include("./students/".$login."/$area/temp/output");	
	}

	$outputErrorFile = $loginFolderTemp."output_error";
	$output_error = file_get_contents($outputErrorFile);
	echo $output_error;


 }//It's possible to add more type of languages to be compiled
