<?php
include "globalfile.php";
if (isset ( $_POST ['upload'] )){
  if (is_uploaded_file($_FILES['my-file']['tmp_name']) && $_FILES['my-file']['error']==0) {
    $path = 'uploads/' . $_FILES['my-file']['name'];
    if (!file_exists($path)) {
      if (move_uploaded_file($_FILES['my-file']['tmp_name'], $path)) {
        echo "The file was uploaded successfully.";
      } else {
        echo "The file was not uploaded successfully.";
      }
    } else {
      echo "File already exists. Please upload another file.";
    }
  } else {
    echo "The file was not uploaded successfully.";
    echo "(Error Code:" . $_FILES['my-file']['error'] . ")";
  }
}
?>


<?php
function getFileList($dir, $recurse=false)
  {
    $retval = array();

    // add trailing slash if missing
    if(substr($dir, -1) != "/") $dir .= "/";

    // open pointer to directory and read list of files
    $d = @dir($dir) or die("getFileList: Failed opening directory $dir for reading");
    while(false !== ($entry = $d->read())) {
      // skip hidden files
      if($entry[0] == ".") continue;
      if(is_dir("$dir$entry")) {
        $retval[] = array(
          "name" => "$dir$entry/",
          "type" => filetype("$dir$entry"),
          "size" => 0,
          "lastmod" => filemtime("$dir$entry")
        );
        if($recurse && is_readable("$dir$entry/")) {
          $retval = array_merge($retval, getFileList("$dir$entry/", true));
        }
      } elseif(is_readable("$dir$entry")) {
        $retval[] = array(
          "name" => "$dir$entry",
          "type" => mime_content_type("$dir$entry"),
          "size" => filesize("$dir$entry"),
          "lastmod" => filemtime("$dir$entry")
        );
      }
    }
    $d->close();

    return $retval;
  }
  // single directory
  $dirlist = getFileList("uploads/");
?>
   <form action=uploads.php method=post enctype=multipart/form-data>

</head>
<div class="panel panel-info">
  <!-- Default panel contents -->
<div class="panel-heading text-center">HOSPITAL NECESSARY FILE COLLECTIONS</div>
  <?php  
   echo "<table class=table>";
   echo "<thead>\n";
   echo "<tr><th>Name</th><th>Type</th><th>Size</th><th>Last Modified</th><th>DOWNLOAD</th></tr>\n";
   echo "</thead>\n";
   echo " <tr><td>    <input type=file name=my-file  class=btn btn-default></td><td> 
                      <input type=submit name=upload value=Upload class=btn btn-primary></td>
                      <!--<td colspan=2><progress id=progressBar value=0 max=100  style=width:400px;>
         </td> !--> </tr>"; 
  ?>

</form>

<?php
  
  echo "<tbody>\n";
  foreach($dirlist as $file) {
    echo "<tr>\n";
    echo "<td>{$file['name']}</td>\n";
    echo "<td>{$file['type']}</td>\n";
    echo "<td>{$file['size']}</td>\n";
    echo "<td>",date('r', $file['lastmod']),"</td>\n";
    echo "<td><a href={$file['name']} >CLICK</a></td>\n";
    echo "</tr>\n";
  }

  echo "</tbody>\n";
  echo "</table>\n\n";

?>