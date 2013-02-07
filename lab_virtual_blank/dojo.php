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
    <script src="assets/cookies.js" type="text/javascript"></script>
    <script src="assets/acessibilidade.js" type="text/javascript"></script>
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
        UFC
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
  <table>
    <!-- Parte do cabecalho -->
    <tr class="row">
          <div id="tip" align="right"
             style="font-size:0.7em;">
              Hello,
               <a href="profile.php" id="changeUserPass"> <?=$_SESSION["username"]?></a> |
               <a href="listagem.php">Back</a>|
               <a href="logoff.php">Logoff</a><br/>
               <a href="#" onClick="increaseFontSize(1)" >A+</a>
               <a href="#" onClick="increaseFontSize(-1)" ><small>A-</small></a>
               <a href="#" onClick="mudarContraste()" >Contraste</a>
        </div>  
          Inteligência Artificial

        <!--<td valign="top">

        </td>-->

            
      <td>
        <div>
        <div id="tip"
             style="font-size:0.8em;">
               <!--Dojo de IA-->
        </div>
      </div>
      </td>      
    </tr>      
  </table>

</div>


      </td>
    </tr>    
    <tr valign="top">
      <td>
        <div class="panel" style="width: 165px;">


<table align="center">
  <tr>
    <td>
      
<div class="spinner">
  <img src="images/spinner.gif"          
       width="20" 
       height="20"/>
</div>

    </td>
    <td>
      <input type="submit"
             class="button"
             id="run"
             value="RUN!"
             title="Execute the code" />
    </td>
    <td>
      
<div class="spinner">
  <img src="images/spinner.gif"          
       width="20" 
       height="20"/>
</div>

    </td>
  </tr>


</table>

          <br/>
          


<div id="filename_list">
</div>



          <br/>
          
<script language="javascript" type="text/javascript"><!--

function getLogin(){
  return "<?=$_SESSION["login"]?>";
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
          data: {text: getFileChanged(),fileName: getFileName(),area : getArea(), login: getLogin()},
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
    $.get("students/deleteFile.php", { fileName: getFileName(),area : getArea(), login: getLogin() } );

  });

});

//--></script>

<div id="file_operations">
  <table>
    <tr>
      <td class="button" id="new">new</td>
      <td class="button" id="rename">rename</td>
      <td class="button" id="delete">delete</td>
    </tr>
  </table>
</div>

        </div>        
        <div class="panel">          
          
<input type="button"
       class="button"
       title="Show help"
       id="help"
       value="?"/>

<input type="button"
       class="button"
       title="Show credits"
       id="credits"
       value="Credits"/>

<input type="button"
       class="button"
       title="Download Source Code"
       id="source_code"
       value="Source"/>


       <br/>


          <br/>
        

          <br/>

        </div>
      </td>
      <td>
        
<div id="visible_files_container"
     class="edgeless panel">
         
<?

  //Carregando arquivos da pasta arquivos
  $urlsImages = array();
  
  //incluindo a parte de abrir a pasta do arquivo
  include("work-directory.php");
  $login = $_SESSION["login"];
  $area = $_GET["area"];

  $files = getFilesFromUserArea($login,$area);

  // Now loop through the files, echoing out a new select option for each one
  foreach( $files as $fname )
  {
    $fNameSemExtensao = explode(".",$fname);
    $extensao = $fNameSemExtensao[1];
    $fNameSemExtensao = $fNameSemExtensao[0];

    $id = $fname."_div";


  if($fNameSemExtensao == "readme"){

    // echo "<div class='filename_div' style='visibility:hidden;' ";
    //        echo "name='$fname' ";
    //        echo "id='$id'><table style='visibility:hidden;' cellspacing='0' cellpadding='0'><tr><td><textarea style='visibility:hidden;' class='line_numbers' ";
    //                     echo " id='".$fname."_line_numbers'> ";
    //           echo "</textarea>";
    //         echo "</td>";
    //         echo "<td>";
    //           echo "<textarea style='visibility:hidden;' class='file_content'";
    //             echo "name='$fNameSemExtensao'";
    //             echo "id='file_content_for_$fname' ";
    //             echo "wrap='on'>";
    //             $fileText = "students/$login/$area/$fname";
    //             include($fileText);
    //           echo "</textarea>";
    //         echo "</td>";
    //       echo "</tr>";
    //     echo "</table>";
    //   echo "</div>";

  }if($extensao == "txt" || $extensao == "mt" || $extensao == "java" 
              || $extensao == "py"|| $extensao == "c" ||  $extensao == "cpp"){
      echo "<div class='filename_div' ";
           echo "name='$fname' ";
           echo "id='$id'><table cellspacing='0' cellpadding='0'><tr><td><textarea class='line_numbers' ";
                        echo "id='".$fname."_line_numbers'> ";
              echo "</textarea>";
            echo "</td>";
            echo "<td>";
              echo "<textarea class='file_content'";
                echo "name='$fNameSemExtensao'";
                echo "id='file_content_for_$fname' ";
                echo "wrap='on'>";
                $fileText = "students/$login/$area/$fname";
                include($fileText);
              echo "</textarea>";
            echo "</td>";
          echo "</tr>";
        echo "</table>";
      echo "</div>";
  }if($extensao == "jpg" || $extensao == "jpeg" || $extensao == "png" || $extensao == "gif"){
    echo "<div class='filename_div' ";
           echo "name='$fname' ";
           echo "id='$id'><table cellspacing='0' cellpadding='0'><tr><td>";
            echo "</td>";
            echo "<td>";
            echo "<div  style='width:950px;'>";
            echo "<textarea id='file_content_for_$fname' style='display:none;'></textarea>";
            echo "</div>";
              //echo "<textarea class='file_content'";
                //echo "name='$fNameSemExtensao'";
                //echo "id='file_content_for_$fname' ";
                //echo "wrap='on'>";
                $imageFile = "students/$login/$area/$fname";
                $urlsImages.array_push($urlsImages, $imageFile);
                echo "<img style='margin:5px;' src='$imageFile' />";
                //include($fileText);
              //echo "</textarea>";
            //echo "</td>";
          //echo "</tr>";
        echo "</table>";
      echo "</div>";
  }if($extensao == "pdf" || $extensao == "doc" || $extensao == "odt" || $extensao == "ppt"){
    echo "<div class='filename_div' ";
           echo "name='$fname' ";
           echo "id='$id'><table cellspacing='0' cellpadding='0'><tr><td>";
            echo "</td>";
            echo "<td>";
            echo "<div  style='width:950px;'>";
            echo "<textarea id='file_content_for_$fname' style='display:none;'></textarea>";
            echo "</div>";

                $documentFile = "students/$login/$area/$fname";
                echo "<div style='margin:15px;'>";
                echo "Clique no Link para baixar o documento:<br/>";
                echo "<a href='$documentFile' target='_blank'><h2>$fNameSemExtensao</h2></a>";
                echo "</div>";
          
        echo "</table>";
      echo "</div>";
  }if($extensao == "ytb"){
     echo "<div class='filename_div' ";
           echo "name='$fname' ";
           echo "id='$id'><table cellspacing='0' cellpadding='0'><tr><td>";
            echo "</td>";
            echo "<td>";
            echo "<div  style='width:950px;'>";
            echo "<textarea id='file_content_for_$fname' style='display:none;'></textarea>";
            echo "</div>";
                
                $videoURL = "students/$login/$area/$fname";
                $youtubeCode = file_get_contents($videoURL);
                //echo $youtubeCode;
                echo "<div style='margin:15px;'>";
                  echo $youtubeCode;
                  echo "<br/>Ver video no <a target='_blank' href='$url'>YouTube</a>";
                echo "</div>";
          
        echo "</table>";
      echo "</div>";
  }

  } ?>

  <script type="text/javascript">
      var urlsImages = ['<?=implode(",", $urlsImages)?>']
  </script>

   <!-- Div for output file -->      
   <!-- To create other "fake file" you must to copy all this code -->     
    <div class="filename_div"
         
         id="output_div">
      <table cellspacing="0" cellpadding="0">
        <tr>
          <td>
            <textarea class="line_numbers"
                      id="output_line_numbers">
            </textarea>
          </td>
          <td>
              
<div id="output">
  <textarea class="file_content"
            name="output"
            id="file_content_for_output"
            readonly="readonly"
            wrap="on">Output File Here</textarea>
</div>
   
          </td>
        </tr>
      </table>
    </div>
      <!-- End div output file -->


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
        data: {text: textFromFile,fileName: getFileName(), area : getArea() , login: getLogin()},
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
    <? $url ="students/$login/$area/readme"; ?>
     $.get('<?=$url?>', function(data) {
           cd.dialog(data,400,"Help");
       });
  });

  $('#credits').click(function() {
    cd.dialog("Developers <ul>\
              <li>Franzé Jr.</li>\
              </ul>",400,"Credits");
  });

  $('#source_code').click(function() {
    $.get("students/zipFiles.php", {login : getLogin(), area: getArea()});
    window.location.href = "students/"+getLogin() +"/arquivos.zip"
  });


});

//--></script>
  </body>
</html>