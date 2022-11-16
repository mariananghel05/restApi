<?php
$uploaddir = "uploads/";
$uploadfile = $uploaddir . basename( $_FILES['file']['name']);
echo json_encode($_FILES);
if(move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile))
{
  echo "The file has been uploaded successfully";
}
else
{
  echo "There was an error uploading the file";
}
?>