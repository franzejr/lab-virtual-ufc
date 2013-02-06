<?
	$login = $_GET["login"];
	$area = $_GET["area"];

	exec("cd $login/ && rm arquivos.zip")
	exec("cd $login/ && zip arquivos.zip $area/temp/*")

?>