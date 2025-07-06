<?php
include 'dbconnect.php';
// fetch files
$sql = "select id,filename from tbl_files";
$result = mysqli_query($con, $sql);
if ( isset( $_GET['id'] ) && !empty( $_GET['id'] ) )
{
  $no= $_GET['id'];
  if($_GET['xmode']=='delete')
   {
    
      $xQry = "DELETE FROM tbl_files WHERE id= $no";
      echo $xQry;
      mysqli_query($con, $xQry);
    //  mysqli_query ( $xQry );
      header('Location: index.php'); 	
   }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>File Management System</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" >
    <link rel="stylesheet" href="bootstrap.css" type="text/css" />
</head>
<body>
<br/>
<div class="container">
    <div class="row">
        <div class="col-xs-8 col-xs-offset-2 well">
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <h1>File Management System</h1>
            <legend>Select File to Upload:</legend>
            <div class="form-group">
                <input type="file" name="file1" />
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Upload" class="btn btn-info"/>
            </div>
            <?php if(isset($_GET['st'])) { ?>
                <div class="alert alert-danger text-center">
                <?php if ($_GET['st'] == 'success') {
                        echo "File Uploaded Successfully!";
                    }
                    else
                    {
                        echo 'Invalid File Extension!';
                    } ?>
                </div>
            <?php } ?>
        </form>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-8 col-xs-offset-2">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>File Name</th>
                        <th>View</th>
                        <th>Download</th>
                          <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $i = 1;
                while($row = mysqli_fetch_array($result)) { ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                       <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['filename']; ?></td>
                    <td><a href="uploads/<?php echo $row['filename']; ?>" target="_blank">View</a></td>
                    <td><a href="uploads/<?php echo $row['filename']; ?>" download>Download</td>
     
<td><a href="index.php<?php echo '?id='.$row['id']. '&xmode=delete';  ?>"  onclick="return confirm_delete()">
  <img src="../images/delete.png" alt="" style="width:30px;height:30px;border:0">
</a>
</td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
 <script type="text/javascript">     
function RefreshPage() {
    location.reload();
}
function confirm_edit() {
  return confirm('Would you Like to Edit ?');
}
function confirm_confirm() {
  return confirm('Would you Like to Confirm?');
}
function confirm_delete() {
  return confirm('Would you Like to Delete ?');
}


</script>
</body>
</html>