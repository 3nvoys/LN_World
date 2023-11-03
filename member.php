<?php 
include 'koneksi.php';
session_start();
if(!isset($_SESSION['session_email'])){
    header("location:login.php");
    exit();
}
print_r($_SESSION);
print_r($_COOKIE);