<?php  
session_start();

# If the admin is logged in
if (isset($_SESSION['login_admin'])) {

	# Database Connection File
	include "koneksi_novel.php";


    /** 
	  check if the category 
	  id set
	**/
	if (isset($_GET['id'])) {
		/** 
		Get data from GET request 
		and store it in var
		**/
		$id = $_GET['id'];

		#simple form Validation
		if (empty($id)) {
			$em = "Error Occurred!";
			header("Location: page_admin.php?error=$em");
            exit;
		}else {
            # DELETE the category from Database
			$sql  = "DELETE FROM categories
			         WHERE id=?";
			$stmt = $conn->prepare($sql);
			$res  = $stmt->execute([$id]);

			/**
		      If there is no error while 
		      Deleting the data
		    **/
		     if ($res) {
		     	# success message
		     	$sm = "Successfully removed!";
				header("Location: page_admin.php?success=$sm");
	            exit;
			 }else {
			 	$em = "Error Occurred!";
			    header("Location: page_admin.php?error=$em");
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