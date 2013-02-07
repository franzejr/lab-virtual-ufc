<form action="compileFile.php" method="post">
	<input type="text" id="fileName" name="fileName" />
	<textarea  name="text" id="text" /></textarea>
	<input type="submit" value="Submit">
</form>

<?

exec("g++ hello.cpp -o compilado 2> output_error");

exec("./compilado >> retornado",$retorno);

echo var_dump($retorno);
?>
