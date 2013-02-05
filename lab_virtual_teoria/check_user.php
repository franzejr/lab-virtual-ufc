<?
	session_start();
	$login = $_POST["login"];
	$password = $_POST["password"];


	$usuario_arquivo = file_get_contents("users.txt");
	$usuarios = array();

	//Lendo linha por linha para pegar os usuarios
	foreach(preg_split("/((\r?\n)|(\r\n?))/", $usuario_arquivo) as $line){
    	//echo $line."<br/>";
    	$usuario_iterado = $line;
    		if(strlen($usuario_iterado) != 0){
	    		if( file_exists("./students/$usuario_iterado/.password") ){
	    		$senha = file_get_contents("./students/$usuario_iterado/.password");
	    		$senha = explode("\n", $senha);
	    		$usuarios[$usuario_iterado] = $senha[0];
    		}
    	}
	}
	//var_dump($usuarios);
	foreach ($usuarios as $key => $value) {
		if(($key == $login) && ($value == $password)){
			/* Getting username  */
			$username = file_get_contents("./students/$login/.username");
			$_SESSION["status"] = "logado";
			$_SESSION["login"] = $login;
			$_SESSION["username"] = $username;
			echo "<script language='javascript'> window.location = 'listagem.php'</script>";
		}
	}

	if(($login == "demo") && ($password == "demo")){
			/* Getting username  */
			$username = file_get_contents("./students/$login/.username");
			$_SESSION["status"] = "demo";
			$_SESSION["login"] = $login;
			$_SESSION["username"] = $username;
			//echo "<script language='javascript'> window.location = 'listagem.php'</script>";
	}else{
		echo "Usuario nao cadastrado";	
	}	

?>