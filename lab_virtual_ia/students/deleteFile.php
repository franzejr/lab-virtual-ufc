<?
	$login = $_GET["login"];
	$area = $_GET["area"];
	$file = $_GET["fileName"];

	system("cd $login && cd $area && rm $file");
?>