<?php  
session_start();

# If the admin is logged in
if (isset($_SESSION['login_admin'])) {

	# Database Connection File
	include "koneksi_novel.php";

    # Validation helper function
    include "func-validation.php";

    # File Upload helper function
    include "func-file-upload.php";


    /** 
	  If all Input field
	  are filled
	**/
	if (isset($_POST['novel_id'])          &&
        isset($_POST['novel_title'])       &&
        isset($_POST['novel_description']) &&
        isset($_POST['novel_category'])    &&
        isset($_FILES['novel_cover'])      &&
        isset($_FILES['file'])            &&
        isset($_POST['current_cover'])    &&
        isset($_POST['current_file'])) {

		/** 
		Get data from POST request 
		and store them in var
		**/
		$id          = $_POST['novel_id'];
		$title       = $_POST['novel_title'];
		$description = $_POST['novel_description'];
		$category    = $_POST['novel_category'];
        
         /** 
	      Get current cover & current file 
	      from POST request and store them in var
	    **/

        $current_cover = $_POST['current_cover'];
        $current_file  = $_POST['current_file'];

        #simple form Validation
        $text = "novel title";
        $location = "edit-novel.php";
        $ms = "id=$id&error";
		is_empty($title, $text, $location, $ms, "");

		$text = "novel description";
        $location = "edit-novel.php";
        $ms = "id=$id&error";
		is_empty($description, $text, $location, $ms, "");

		$text = "novel category";
        $location = "edit-novel.php";
        $ms = "id=$id&error";
		is_empty($category, $text, $location, $ms, "");

        /**
          if the admin try to 
          update the novel cover
        **/
          if (!empty($_FILES['novel_cover']['name'])) {
          	  /**
		          if the admin try to 
		          update both 
		      **/
		      if (!empty($_FILES['file']['name'])) {
		      	# update both here

		      	# novel cover Uploading
		        $allowed_image_exs = array("jpg", "jpeg", "png", "webp");
		        $path = "cover";
		        $novel_cover = upload_file($_FILES['novel_cover'], $allowed_image_exs, $path);

		        # novel cover Uploading
		        $allowed_file_exs = array("pdf", "docx", "pptx");
		        $path = "files";
		        $file = upload_file($_FILES['file'], $allowed_file_exs, $path);
                
                /**
				    If error occurred while 
				    uploading
				**/
		        if ($novel_cover['status'] == "error" || 
		            $file['status'] == "error") {

			    	$em = $novel_cover['data'];

			    	/**
			    	  Redirect to '../edit-novel.php' 
			    	  and passing error message & the id
			    	**/
			    	header("Location: edit-novel.php?error=$em&id=$id");
			    	exit;
			    }else {
                  # current novel cover path
			      $c_p_novel_cover = "../uploads/cover/$current_cover";

			      # current file path
			      $c_p_file = "../uploads/files/$current_file";

			      # Delete from the server
			      unlink($c_p_novel_cover);
			      unlink($c_p_file);

			      /**
		              Getting the new file name 
		              and the new novel cover name 
		          **/
		           $file_URL = $file['data'];
		           $novel_cover_URL = $novel_cover['data'];

		            # update just the data
		          	$sql = "UPDATE novels
		          	        SET title=?,
		          	            description=?,
		          	            category_id=?,
		          	            cover=?,
		          	            file=?
		          	        WHERE id=?";
		          	$stmt = $koneksi->prepare($sql);
					$res  = $stmt->execute([$title, $description, $category,$novel_cover_URL, $file_URL, $id]);

				    /**
				      If there is no error while 
				      updating the data
				    **/
				     if ($res) {
				     	# success message
				     	$sm = "Successfully updated!";
						header("Location: edit-novel.php?success=$sm&id=$id");
			            exit;
				     }else{
				     	# Error message
				     	$em = "Unknown Error Occurred!";
						header("Location: edit-novel.php?error=$em&id=$id");
			            exit;
				     }


			    }
		      }else {
		      	# update just the novel cover

		      	# novel cover Uploading
		        $allowed_image_exs = array("jpg", "jpeg", "png", "webp");
		        $path = "cover";
		        $novel_cover = upload_file($_FILES['novel_cover'], $allowed_image_exs, $path);
                
                /**
				    If error occurred while 
				    uploading
				**/
		        if ($novel_cover['status'] == "error") {

			    	$em = $novel_cover['data'];

			    	/**
			    	  Redirect to '../edit-novel.php' 
			    	  and passing error message & the id
			    	**/
			    	header("Location: edit-novel.php?error=$em&id=$id");
			    	exit;
			    }else {
                  # current novel cover path
			      $c_p_novel_cover = "../uploads/cover/$current_cover";

			      # Delete from the server
			      unlink($c_p_novel_cover);

			      /**
		              Getting the new file name 
		              and the new novel cover name 
		          **/
		           $novel_cover_URL = $novel_cover['data'];

		            # update just the data
		          	$sql = "UPDATE novels
		          	        SET title=?,
		          	            description=?,
		          	            category_id=?,
		          	            cover=?
		          	        WHERE id=?";
		          	$stmt = $koneksi->prepare($sql);
					$res  = $stmt->execute([$title, $description, $category,$novel_cover_URL, $id]);

				    /**
				      If there is no error while 
				      updating the data
				    **/
				     if ($res) {
				     	# success message
				     	$sm = "Successfully updated!";
						header("Location: edit-novel.php?success=$sm&id=$id");
			            exit;
				     }else{
				     	# Error message
				     	$em = "Unknown Error Occurred!";
						header("Location: edit-novel.php?error=$em&id=$id");
			            exit;
				     }


			    }
		      }
          }
          /**
          if the admin try to 
          update just the file

          **/
          else if(!empty($_FILES['file']['name'])){
          	# update just the file
            
            # novel cover Uploading
	        $allowed_file_exs = array("pdf", "docx", "pptx");
	        $path = "files";
	        $file = upload_file($_FILES['file'], $allowed_file_exs, $path);
            
            /**
			    If error occurred while 
			    uploading
			**/
	        if ($file['status'] == "error") {

		    	$em = $file['data'];

		    	/**
		    	  Redirect to '../edit-novel.php' 
		    	  and passing error message & the id
		    	**/
		    	header("Location: edit-novel.php?error=$em&id=$id");
		    	exit;
		    }else {
              # current novel cover path
		      $c_p_file = "../uploads/files/$current_file";

		      # Delete from the server
		      unlink($c_p_file);

		      /**
	              Getting the new file name 
	              and the new file name 
	          **/
	           $file_URL = $file['data'];

	            # update just the data
	          	$sql = "UPDATE novels
	          	        SET title=?,
	          	            description=?,
	          	            category_id=?,
	          	            file=?
	          	        WHERE id=?";
	          	$stmt = $koneksi->prepare($sql);
				$res  = $stmt->execute([$title, $description, $category, $file_URL, $id]);

			    /**
			      If there is no error while 
			      updating the data
			    **/
			     if ($res) {
			     	# success message
			     	$sm = "Successfully updated!";
					header("Location: edit-novel.php?success=$sm&id=$id");
		            exit;
			     }else{
			     	# Error message
			     	$em = "Unknown Error Occurred!";
					header("Location: edit-novel.php?error=$em&id=$id");
		            exit;
			     }


		    }
	      
          }else {
          	# update just the data
          	$sql = "UPDATE novels
          	        SET title=?,
          	            description=?,
          	            category_id=?
          	        WHERE id=?";
          	$stmt = $koneksi->prepare($sql);
			$res  = $stmt->execute([$title, $description, $category, $id]);

		    /**
		      If there is no error while 
		      updating the data
		    **/
		     if ($res) {
		     	# success message
		     	$sm = "Successfully updated!";
				header("Location: edit-novel.php?success=$sm&id=$id");
	            exit;
		     }else{
		     	# Error message
		     	$em = "Unknown Error Occurred!";
				header("Location: edit-novel.php?error=$em&id=$id");
	            exit;
		     }
          } 
	}else {
      header("Location: page_admin.php");
      exit;
	}

}else{
  header("Location: choice_login.php");
  exit;
}