
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
  Templates
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
    <tr class="row">
            
        <td valign="top">
          Olhe
        </td>
        <td valign="top">
          Aprenda
        </td>
            
      <td>
        <div id="tip"
             style="font-size:0.8em;">
               Escolha algum template já existente e comece a programar!
        </div>
      </td>      
            
    </tr>      
  </table>
</div>


      </td>
    </tr>    
    <tr valign="top">
      <td>
        <div class="panel">
          


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
             id="test"
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

$(document).ready(function() {

  var fileButtons =  $('#file_operations');
  fileButtons.find('#new').click(function() {
    cd.newFile(); 
  });
  fileButtons.find('#rename').click(function() {
    cd.renameFile("wolf");
  });
  fileButtons.find('#delete').click(function() {
    cd.deleteFile("wolf");
  });

});

//--></script>

<div id="file_operations">
  <table>
    <tr>
      <td class="button" id="new">new</td>
    </tr>
    <tr>
      <td class="button" id="rename">rename</td>
    </tr>
    <tr>
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

          <br/>
          

<input type="button"
       class="button"
       title="Make donation to buy Raspberry Pi'es for schools"
       id="donate"
       value="donate"/>

          <br/>
          


<input type="button"
       class="button"
       title="Give feedback"
       id="feedback"
       value="feedback"/>

        </div>
      </td>
      <td>
        
<div id="visible_files_container"
     class="edgeless panel">
  
    
        
<?
//Carregando arquivos da pasta arquivos

load();

function load(){
  //incluindo a parte de abrir a pasta do arquivo
  include("work-directory.php");

  // Now loop through the files, echoing out a new select option for each one
  foreach( $files as $fname )
  {
    $id = $fname."_div";
      echo "<div class='filename_div' ";
           echo "name='$fname' ";
           echo "id='$id'><table cellspacing='0' cellpadding='0'><tr><td><textarea class='line_numbers' ";
                        echo "id='".$fname."_line_numbers'> ";
              echo "</textarea>";
            echo "</td>";
            echo "<td>";
                echo "<textarea class='file_content'";
                          echo "name='file_content['$fname']' ";
                          echo "id='file_content_for_$fname' ";
                          echo "wrap='on'>";
     $string = "arquivos/".$fname;
     include($string);
  echo "</textarea>";
            echo "</td>";
          echo "</tr>";
        echo "</table>";
      echo "</div>";
}

}?>        
        
        
    <div class="filename_div"
         name="output"
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
            name="file_content['output']"
            id="file_content_for_output"
            readonly="readonly"
            wrap="on">Output File Here</textarea>
</div>


        
          </td>
        </tr>
      </table>
    </div>
        
        
  
</div>
      </td>
    </tr>
  </table>
  
</form>
          </div>
        </td>
      </tr>
    </table>


    <script language="javascript" type="text/javascript"><!--

    var spinners = $('.spinner');
    var test = $('#test');

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
      var outputTextArea = $("#output_div textarea")[1];

      $.ajax({
        url: "temps/webservice.php",
        type: "post",
        data: {"text": textFromFile,"fileName":fileName},
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
            cd.loadFile("output")
        }
      });
      
    }

    $(document).ready(function() {
      
      spinners.hide();

      test.click(function() {
        getOutputValue();
      });

      $('form').bind('ajax:before', function(evt, data, status, xhr) {
        test.attr('disabled', true);
        spinners.show();    
      });
      
      $('form').bind('ajax:complete', function(evt, data, status, xhr) {
        spinners.hide();    
        test.attr('disabled', false);
        $('#tip').hide();
        // when the ajax replaces output the shortcuts
        // are lost so need rebinding
        var output = cd.fileContentFor('output');
        cd.bindHotKeys(output);        
        cd.loadFile('output');    
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

  $('#feedback').click(function() {
    cd.dialog_feedback();
  });

});

//--></script>
  </body>
</html>


