<?
	/*
	Verifica se um dado processo ainda nao tem output.
	*/

	$t1 = time();
	//sleep(15);
	$t2 = time();
	
	echo ($t2 - $t1);
	exec("killall cheese");
	exec("ps aux | grep -i 'nautilus' | grep -v grep &",$pids);
	echo var_dump($pids);
	
	if(empty($pids)){ echo "Vazio"; }
	else echo "Nao vazio";
	/*exec("ps aux | grep -i 'compilado' | grep -v grep",$pids);
	echo var_dump($pids);
	if(!empty($pids)){
		echo "Nao ta vazio";
	}else{
		echo "Ta vazio";
	}*/
	//echo "TESTE".file_exists("./students/demo/temp/output");
?>
