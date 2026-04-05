<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_nama   = "Jadwalguru";

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_nama);

if(mysqli_connect_error()){
     echo "gagal melakukan koneksi ke database :" . mysqli_connect_error();
   }
 ?>