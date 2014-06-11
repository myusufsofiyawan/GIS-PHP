<?php
include "koneksi.php";

//function getExtension($str) {$i=strrpos($str,".");if(!$i){return"";}$l=strlen($str)-$i;$ext=substr($str,$i+1,$l);return $ext;}
//$formats = array("jpg", "png", "gif", "bmp", "jpeg", "PNG", "JPG", "JPEG", "GIF", "BMP");

//buat upload foto
//if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
//{
$fileName = $_FILES['foto']['name']; //namafile
$fileSize = $_FILES['foto']['size']; //size
$fileError= $_FILES['foto']['tmp_name']; //eror
$uploaddir= './images/Foto/';
$lokasi=$uploaddir.$fileName;

//cek jika eror
if($fileSize>0||$fileError==0)
{
	$move = move_uploaded_file($_FILES['foto']['tmp_name'],$lokasi); //kopi ke folder
}


/*
 if(strlen($name)){
  $ext = getExtension($name);
  if(in_array($ext,$formats)){
   if($size<(1024*1024)){
    $imgn = time().".".$ext;
	 if(move_uploaded_file($tmp, "./images/Foto/".$imgn)){
     echo "File Name : ".$_FILES['foto']['name'];
     echo "<br/>File Temporary Location : ".$_FILES['foto']['tmp_name'];
     echo "<br/>File Size : ".$_FILES['foto']['size'];
     echo "<br/>File Type : ".$_FILES['foto']['type'];
     echo "<br/>Image : <img style='margin-left:10px;' src='images/Foto/".$imgn."'>";
    }else{
     echo "Uploading Failed.";
    }
   }else{
    echo "Image File Size Max 1 MB";
   }
  }else{
   echo "Invalid Image file format.";
  }
 }else{
  echo "Please select an image.";
  exit;
 }
}
*/
$x = $_GET['x'];
$y = $_GET['y'];
$nama = $_GET['nama'];
$alamat  = $_GET['alamat'];
$jumlah  = $_GET['jumlah'];
$sudah  = $_GET['sudah'];
$kec  = $_GET['kec'];
$daerah  = $_GET['daerah'];


$masuk = mysql_query("insert into layanan values(null,'$nama','$alamat','$kec','$daerah','$jumlah','$sudah',$x,$y,'images/Foto/$imgn')");
if($masuk){
    echo "berhasil";
}else{
    echo "Foto berhasil tersimpan ke dalam repository, Tapi belum tersimpan ke database<br/> Silahkan Simpan Data dulu dengan mengklik [Simpan Data] di form sebelumnya.";
}
?>
