<?  session_start(); ?>
<!DOCTYPE 
  html PUBLIC 
  "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 
  <head>
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta http-equiv="content-type"  content="text/html;charset=UTF-8" />
    <title>Make your Code</title>  
    
    <link href="/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />
    <link href="assets/application-4995ac829e6b91db29c926cd5d3e12d6.css" media="screen" rel="stylesheet" type="text/css" />
    <script src="assets/application-2f9b2b9f16b3388be257e8ce7d0635f1.js" type="text/javascript"></script>
    <script type="text/javascript">var cd = cyberDojo;</script>

    <style>
    .tape_input{
      background:#F6F0B9;
      color:#595959;
      font-weight: 500;
      width: 40em;
      font-family: monospace;
      font-size: 15pt;
    }
    </style>
  </head>
  
  <body>
    <table valign="top" align="center">
      <tr>
        <td>
          <div id="cyber_dojo_page">
            

    <tr valign="top">
      <td>
        <div class="panel" style="width: 700px;">

      <h2>Laboratório Virtual de Teoria da Computação</h2>
<div class="spinner">
  
        <? $user = $_SESSION["user"]; ?>
      <? if( ($_SESSION["status"] == "logado") || ($_SESSION["status"] == "demo") ){ ?>
          <h3>Simuladores</h3>
          <ul>         
              <li><a href="dojo.php?area=maquinas_turing">Máquinas de Turing</a></li>
              <li>Diagramas de Turing</li>
              <li>Linguagem L</li>
              <li>Funções Recursivas Primitivas</li>
          </ul>
   
<? }else {
  echo "<script language='javascript'> window.location = 'index.php'</script>";
  echo "nao gravou";
  } ?>

  <br/>
  <div align="right"><a href="logoff.php">Logoff</a></div>
</div>
    </td>
  </tr>
</table>

          <br/>

    <script language="javascript" type="text/javascript"><!--

$(document).ready(function() {

  $('#register').click(function() {
    cd.dialog("The purpose of this system is to any student use and learn with it. For Starting to use, please send an e-mail to Prof. Carlos (carlosbritobr@gmail.com) and then He will send an username and password",420,"Register");
  });

  $('#demo').click(function() {
    $("#user").val("demo");
    $("#password").val("demo");
    $("#formLogin").submit();
  });

});

//--></script>
  </body>
</html>


