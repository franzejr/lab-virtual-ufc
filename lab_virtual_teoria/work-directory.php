<?
function getFilesFromUser($username){

  // open the current directory

  $dhandle = opendir('./students/'.$username);
  // define an array to hold the files
  $files = array();

  if ($dhandle) {
     // loop through all of the files
     while (false !== ($fname = readdir($dhandle))) {
        // if the file is not this file, and does not start with a '.' or '..',
        // then store it for later display
        if (($fname != '.') && ($fname != '..') &&
            ($fname != basename($_SERVER['PHP_SELF']))) {
            // store the filename
            $files[] = (is_dir( "./$fname" )) ? "(Dir) {$fname}" : $fname;
        }
     }
     // close the directory
     closedir($dhandle);
  }

  return $files;
}

function getAreasName(){
  $area_alias = file_get_contents("areas.txt");
  $areas = array();
 
  //Lendo linha por linha para pegar os usuarios
  foreach(preg_split("/((\r?\n)|(\r\n?))/", $area_alias) as $line){
      //echo $line."<br/>";
      $line_it = explode(":", $line);
      $areas[$line_it[0]] = $line_it[1];
  }
  return $areas;
}

function getAreas(){

  // open the current directory

  $dhandle = opendir('./examples/');
  // define an array to hold the files
  $files = array();

  if ($dhandle) {
     // loop through all of the files
     while (false !== ($fname = readdir($dhandle))) {
        // if the file is not this file, and does not start with a '.' or '..',
        // then store it for later display
        if (($fname != '.') && ($fname != '..') &&
            ($fname != basename($_SERVER['PHP_SELF']))) {
            // store the filename
            $files[] = (is_dir( "./$fname" )) ? "(Dir) {$fname}" : $fname;
        }
     }
     // close the directory
     closedir($dhandle);
  }

  return $files;
}

function getFilesFromUserArea($username,$area){

  // open the current directory

  $dhandle = opendir('./students/'.$username.'/'.$area);
  // define an array to hold the files
  $files = array();

  if ($dhandle) {
     // loop through all of the files
     while (false !== ($fname = readdir($dhandle))) {
        // if the file is not this file, and does not start with a '.' or '..',
        // then store it for later display
        if (($fname != '.') && ($fname != '..') &&
            ($fname != basename($_SERVER['PHP_SELF']))) {
            // store the filename
            $files[] = (is_dir( "./$fname" )) ? "(Dir) {$fname}" : $fname;
        }
     }
     // close the directory
     closedir($dhandle);
  }

  return $files;
}
?>
