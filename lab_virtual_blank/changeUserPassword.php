<?
	$login = $_POST["login"];
	$username = $_POST["username"];
	$password = $_POST["password"];

	/* Updating password */

	$Handle = fopen("./students/$login/.password", 'w') or die("can't open file");
	fwrite($Handle, $password);
	fclose($Handle);

	/* Updating username */

	$Handle = fopen("./students/$login/.username", 'w') or die("can't open file");
	fwrite($Handle, $username);
	fclose($Handle);

	session_start();
	session_destroy();
	echo "<script language='javascript'> window.location = 'index.php'</script>";

?>