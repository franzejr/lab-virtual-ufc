<?
	$login = $_GET["login"];
	$area = $_GET["area"];

	exec("cd $login && zip arquivos.zip temp/*")

?>