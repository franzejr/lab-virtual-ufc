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
    <!-- Color Picker -->
    
    <link rel="stylesheet" href="assets/colorpicker.css" type="text/css" />
    <link rel="stylesheet" media="screen" type="text/css" href="assets/layout.css" />
    <script type="text/javascript" src="assets/colorpicker.js"></script>
    <script type="text/javascript" src="assets/eye.js"></script>
    <script type="text/javascript" src="assets/utils.js"></script>
    <script type="text/javascript" src="assets/layout.js"></script>

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
            
<script language="javascript" type="text/javascript"><!--

$(document).ready(function() {
  
  cd.tabExpansion = function() {
    return "    ";
  };
  
  cd.supportFilenames = function() {
    return $.parseJSON('[]');
  };
  
  cd.hiddenFilenames = function() {
    return $.parseJSON('[]');
  };  

});

//--></script>

<input type="hidden"      
       name="current_filename"      
       id="current_filename"
       value=""/>

  
  <table cellpadding="0" cellspacing="0">
    <tr valign="top">
      <td class="panel">
        
<div>
  <table>
    <tr>
      <td align="center">
        

        <br/>
        

      </td>
      <td align="center">
      

        
<div>
  Lab. Virtual
</div>

      </td>
      <td>
      </td>
      <td valign="center">
        
<div id="current_traffic_light_count">
      <span class="tag_count amber">
        IA
      </span>
    </td>        
</div>


      </td>      
    </tr>
  </table>
</div>


      </td>
      <td class="panel">
        
<div id="traffic_lights">
  <table width="700">
    <!-- Parte do cabecalho -->
    <tr class="row">
            
        <td valign="top">
          
        </td>
            
      <td>
      </td>      
        <div id="tip" align="right"
             style="font-size:0.7em;">
              Hello,
               <a href="#" id="changeUserPass"> <?=$_SESSION["username"]?></a> |
               <a href="listagem.php">Back</a>|
               <a href="logoff.php">Logoff</a>
        </div>  
    </tr>      
  </table>

</div>


      </td>
    </tr>    
    <tr valign="top">
      <td>



          <br/>
          
<script language="javascript" type="text/javascript"><!--

function getUser(){
  return "<?=$_SESSION["user"]?>";
}

function getNewFileName(){
  return $("#renamer").val();
}

function getArea(){
  return  "<?=$_GET["area"]?>";
}

function getOutputTextArea(){
  return $("#output_div textarea")[1];
}

function getFileName(){
    var file = $(".selected input");
    var fileName = file.val();
    return fileName;
}

function isReadOnly(){
  var fileName = getFileName();
  fileName = fileName.split(".");
  fileName = fileName[0];
  if($("[name="+fileName+"]").attr("readonly") == "readonly") return true;
  return false;
}

function isDocumentFile(){
  var fileName = getFileName();
  fileName = fileName.split(".");
  fileName = fileName[1];

  if(fileName == "pdf" || fileName == "docx" || fileName == "doc" || fileName == "ppt" || fileName == "odt" ||
    fileName == "jpg" ||  fileName == "jpeg" || fileName == "gif" || fileName == "png"  ){
    return true;
  }
  return false;
}

function saveFile(){ 

  if(!isReadOnly() && !isDocumentFile() ){
    spinners.show();
      $.ajax({
          url: "students/saveFile.php",
          type: "post",
          data: {text: getFileChanged(),fileName: getFileName(),area : getArea(), user: getUser()},
          // callback handler that will be called on success
          success: function(response, textStatus, jqXHR){
              // log a message to the console
              console.log(response);
          },
          // callback handler that will be called on error
          error: function(jqXHR, textStatus, errorThrown){
              // log the error to the console
              console.log(
                  "The following error occured: "+
                  textStatus, errorThrown
              );
              cd.dialog("There was an error... Sorry.",200,"Saved ;)");
          },
          // callback handler that will be called on completion
          // which means, either on success or error
          complete: function(){
              // enable the inputs
              cd.loadFile("output");
              spinners.hide();
          }
        });
        spinners.hide();
  }
}

$(document).ready(function() {

  var fileButtons =  $('#file_operations');
  fileButtons.find('#new').click(function() {
    cd.newFile(); 
  });
  fileButtons.find('#rename').click(function() {
    cd.renameFile();
  });

  fileButtons.find('#save').click(function() {
    saveFile();
  });
  
  fileButtons.find('#delete').click(function() {
    cd.deleteFile();
    $.get("students/deleteFile.php", { fileName: getFileName(),area : getArea(), user: getUser() } );

  });

});

//--></script>
<?
  function getPassword(){
      $login = $_SESSION["login"];
      $password = file_get_contents("./students/$login/.password");
      return trim($password);
    }
?>
        </div>          
      </td>
      <td>
        
<div id="visible_files_container" width="800"
     class="edgeless panel">
        
     <h2>Profile</h2>
       <form method="post" action="changeUserPassword.php" >
         Username: <input type="text" name="username" id="username" value="<?=$_SESSION['username']?>" />
         Password: <input type="password" name="password" id="password" value="<?=getPassword()?>" />
         <input type="hidden" name="login" id="login" value="<?=$_SESSION['login']?>" />
         <input type="submit" value="Update" />
       </form>



       <h2>Color Scheme</h2>

        <p>Background:<input type="text" maxlength="6" size="6" id="background" value="00ff00" /></p>
        <h3>Code Editor </h3>
        <p>Background:<input type="text" maxlength="6" size="6" id="background_editor" value="0000ff" /></p>
        <p>Font Color:<input type="text" maxlength="6" size="6" id="font_color_editor" value="ff0000" /></p>



</div>
      </td>
    </tr>
  </table>
  
</form>
          </div>
        </td>
      </tr>
    </table>

    <script language="javascript" type="text/javascript">

    var spinners = $('.spinner');
    var run = $('#run');

    function putReadmeTextArea(){
      $("[name='"+getFileName()+"'] textarea")[1].value = "heuahea";
    }

    function hideSelectedTextArea(){
      $("[name="+getFileName()+"]").hide();
    }

    function getFileChanged(){
      var file = $(".selected input");
      var fileName = file.val();
      var fileContentName = "file_content_for_"+fileName;
      return document.getElementById(fileContentName).value;
    }

    //Pegando o retorno do compilador/interpretador
    function getOutputValue(){
      var textFromFile = getFileChanged();
      var file = $(".selected input");
      var fileName = file.val();
      var outputTextArea = getOutputTextArea();

      //var tape = $("#tape textarea").val();

      saveFile();
      spinners.show();
      $.ajax({
        url: "compileFile.php",
        type: "post",
        data: {text: textFromFile,fileName: getFileName(), area : getArea() , user: getUser()},
        // callback handler that will be called on success
        success: function(response, textStatus, jqXHR){
            // log a message to the console
            console.log(response);
            outputTextArea.innerHTML = response;
        },
        // callback handler that will be called on error
        error: function(jqXHR, textStatus, errorThrown){
            // log the error to the console
            console.log(
                "The following error occured: "+
                textStatus, errorThrown
            );
        },
        // callback handler that will be called on completion
        // which means, either on success or error
        complete: function(){
            // enable the inputs
            cd.loadFile("output");
            spinners.hide();
        }
      });
      
    }

    $(document).ready(function() {




      $('#background, #background_editor, #font_color_editor').ColorPicker({
          onSubmit: function(hsb, hex, rgb, el) {
            $(el).val(hex);
            $(el).ColorPickerHide();
          },
          onBeforeShow: function () {
            $(this).ColorPickerSetColor(this.value);
          }
        })
        .bind('keyup', function(){
          $(this).ColorPickerSetColor(this.value);
      });



      
      spinners.hide();

      run.click(function() {
        getOutputValue();
      });
      
    });

//--></script>

    <script language="javascript" type="text/javascript"><!--

$(document).ready(function() {

  var filenames = cd.filenames();
  var filename, file, i, max;
  
  for (i = 0, max = filenames.length; i < max; i += 1) {
    filename = filenames[i];
    file = cd.fileContentFor(filename);
    cd.bindHotKeys(file);
    if (filename !== 'output') {
      cd.tabber(file);
    }
  }
  cd.bindAllLineNumbers();
  cd.rebuildFilenameList();
  cd.loadFile(filenames[cd.rand(max)]);

});

//--></script>


    <script language="javascript" type="text/javascript"><!--

$(document).ready(function() {

  $('#help').click(function() {
    <? $url ="students/$user/$area/readme"; ?>

     $.get('<?=$url?>', function(data) {
           cd.dialog(data,400,"Help");
       });
  });

  $('#credits').click(function() {
    cd.dialog("Developers <ul>\
              <li>Franzé Jr.</li>\
              </ul>",400,"Credits");
  });

  $('#changeUserPass').click(function(){
    var username = "<?=trim($_SESSION["username"]);?>";
    var login = "<?=$_SESSION["login"]?>";

    $.post("profile.php", {username: username, login : login});
  });

});

//--></script>
  </body>
</html>


