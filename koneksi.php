<?php
$host   = "localhost";
$user   = "root";
$pass   = "";
$db     = "ln_db";

$koneksi = mysqli_connect($host, $user, $pass, $db);
if(!$koneksi){
    die("Gagal terkoneksi");
}