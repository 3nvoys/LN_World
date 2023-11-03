<?php  
session_start();

# If the admin is logged in
if (isset($_SESSION['login_admin'])) {

	# Database Connection File
	include "koneksi_novel.php";


    /** 
	  check if category 
	  name is submitted
	**/
	if (isset($_POST['category_name'])) {
		/** 
		Get data from POST request 
		and store it in var
		**/
		$name = $_POST['category_name'];

		#simple form Validation
		if (empty($name)) {
			$em = "The category name is required";
			header("Location: tambah_category.php error=$em");
            exit;
		}else {
			# Insert Into Database
			$sql  = "INSERT INTO categories (name)
			         VALUES (?)";
			$stmt = $koneksi->prepare($sql);
			$res  = $stmt->execute([$name]);
			$sql1 = "SELECT "

			/**
		      If there is no error while 
		      inserting the data
		    **/
		     if ($res) {
		     	# success message
		     	$sm = "Successfully created!";
				header("Location: tambah_category?success=$sm");
	            exit;
		     }else{
		     	# Error message
		     	$em = "Unknown Error Occurred!";
				header("Location: tambah_category?error=$em");
	            exit;
		     }
		}
	}else {
      header("Location: page_admin.php");
      exit;
	}

}else{
  header("Location: login_admin.php");
  exit;
}