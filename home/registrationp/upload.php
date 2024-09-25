<?php
if (isset($_POST['submit']))
{
$file = $_FILES['file'];


$fileName = $file['name'];
$fileTmpName = $file['tmp_name'];
$fileSize = $file['size'];
$fileError = $file['error'];
$fileType = $file['type'];

$fileExt = explode('.',$fileName);
$fileActualExt = strtolower(end($fileExt));

$allowed = array('jpg','jpeg','png');


if(in_array($fileActualExt,$allowed)){
if($fileError === 0){

    if ($fileSize < 1000000)
    {
        $fileNameNew = uniqid('',true) . "." .$fileActualExt;
        $fileDestination = 'uploads/' . $fileNameNew;

        move_uploaded_file($fileTmpName,$fileDestination);
        header ("Location : item.php?uploadsuccess")

    }
    else{
        echo "your file is to big!";
    }
    }
}
else{
   echo "There was an error uploading your file!";
}
}
else 
{
  echo  "you cannot upload files of this type!";
}

