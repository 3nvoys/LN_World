<?php 

# server name
$servername = "localhost";
# user name
$username = "root";
# password
$password = "";

# database name
$db_name = "ln_db";


try {
    $koneksi = new PDO("mysql:host=$servername;dbname=$db_name", 
                    $username, $password);
    $koneksi->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $error){
  echo "Connection failed : ". $error->getMessage();
}