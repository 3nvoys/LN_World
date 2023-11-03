<?php  
session_start();

# If the admin is logged in
if (isset($_SESSION['username'])) {

	# Database Connection File
	include "koneksi_novel.php";


    /** 
	  check if category 
	  name is submitted
	**/
	if (isset($_POST['category_name']) &&
        isset($_POST['category_id'])) {
		/** 
		Get data from POST request 
		and store them in var
		**/
		$name = $_POST['category_name'];
		$id = $_POST['category_id'];

		#simple form Validation
		if (empty($name)) {
			$em = "The category name is required";
			header("Location: ubah-category.php?error=$em&id=$id");
            exit;
		}else {
			# UPDATE the Database
			$sql  = "UPDATE categories 
			         SET name=?
			         WHERE id=?";
			$stmt = $conn->prepare($sql);
			$res  = $stmt->execute([$name, $id]);

			/**
		      If there is no error while 
		      updating the data
		    **/
		     if ($res) {
		     	# success message
		     	$sm = "Successfully updated!";
				header("Location: ubah-category.php?success=$sm&id=$id");
	            exit;
		     }else{
		     	# Error message
		     	$em = "Unknown Error Occurred!";
				header("Location: ubah-category.php?error=$em&id=$id");
	            exit;
		     }
		}
	}else {
      header("Location: ubah-category.php");
      exit;
	}

}else{
  header("Location: login_admin.php");
  exit;
}