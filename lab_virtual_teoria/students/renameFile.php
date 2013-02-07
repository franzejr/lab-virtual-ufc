<?
	$login = $_GET["login"];
	$area = $_GET["area"];
	$oldName = $_GET["oldName"];
	$newName = $_GET["newName"];

	system("cd $login && cd $area && mv $oldName $newName");
?>