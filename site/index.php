<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Nume");

$uploaddir = "uploads/";


$headers = getallheaders();
if(empty($headers["Nume"]))
  exit();
if(empty($_FILES))
  exit();
mkdir($uploaddir . $headers["Nume"]);
$uploaddir = $uploaddir . $headers["Nume"]."/";

$keys = array_keys($_FILES);


foreach($keys as $key){
  $uploadfile = $uploaddir . basename( $_FILES[$key]['name']);

  if(move_uploaded_file($_FILES[$key]['tmp_name'], $uploadfile))
  {
    echo "The file has been uploaded successfully";
  }
  else
  {
    echo "There was an error uploading the file";
  }
}
?>