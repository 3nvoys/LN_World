<?php  
session_start();

# If the admin is logged in
if (isset($_SESSION['login_admin'])) {

	# Database Connection File
	include "koneksi_novel.php";


    /** 
	  check if the novel 
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
             # GET novel from Database
			 $sql2  = "SELECT * FROM novels
			          WHERE id=?";
			 $stmt2 = $koneksi->prepare($sql2);
			 $stmt2->execute([$id]);
			 $the_novel = $stmt2->fetch();

			 if($stmt2->rowCount() > 0){
                # DELETE the novel from Database
				$sql  = "DELETE FROM novels
				         WHERE id=?";
				$stmt = $koneksi->prepare($sql);
				$res  = $stmt->execute([$id]);

				/**
			      If there is no error while 
			      Deleting the data
			    **/
			     if ($res) {
			     	# delete the current novel_cover and the file
                    $cover = $the_novel['cover'];
                    $file  = $the_novel['file'];
                    $c_b_c = "../uploads/cover/$cover";
                    $c_f = "../uploads/files/$cover";
                    
                    unlink($c_b_c);
                    unlink($c_f);


			     	# success message
			     	$sm = "Successfully removed!";
					header("Location: page_admin.php?success=$sm");
		            exit;
			     }else{
			     	# Error message
			     	$em = "Unknown Error Occurred!";
					header("Location: page_admin.php?error=$em");
		            exit;
			     }
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