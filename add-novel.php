<?php  
session_start();


if (isset($_SESSION['usename'])) {


	include "koneksi_novel.php";


    include "func-validation.php";


    include "func-file-upload.php";

	if (isset($_POST['novel_title'])       &&
        isset($_POST['novel_description']) &&
        isset($_POST['novel_category'])    &&
        isset($_FILES['novel_cover'])      &&
        isset($_FILES['file'])) {
		/** 
		Get data from POST request 
		and store them in var
		**/
		$title       = $_POST['novel_title'];
		$description = $_POST['novel_description'];
		$category    = $_POST['novel_category'];

		# making URL data format
		$user_input = 'title='.$title.'&category_id='.$category.'&desc='.$description;

		#simple form Validation

        $text = "novel title";
        $location = "tambah_novel.php";
        $ms = "error";
		is_empty($title, $text, $location, $ms, $user_input);

		$text = "novel description";
        $location = "tambah_novel.php";
        $ms = "error";
		is_empty($description, $text, $location, $ms, $user_input);

		$text = "novel category";
        $location = "tambah_novel.php";
        $ms = "error";
		is_empty($category, $text, $location, $ms, $user_input);
        
        # novel cover Uploading
        $allowed_image_exs = array("jpg", "jpeg", "png", "webp");
        $path = "cover";
        $novel_cover = upload_file($_FILES['novel_cover'], $allowed_image_exs, $path);

	    if ($novel_cover['status'] == "error") {
	    	$em = $novel_cover['data'];

	    	header("Location: tambah_novel.php?error=$em&$user_input");
	    	exit;
	    }else {
	    	# file Uploading
            $allowed_file_exs = array("pdf", "docx", "pptx");
            $path = "files";
            $file = upload_file($_FILES['file'], $allowed_file_exs, $path);

		    if ($file['status'] == "error") {
		    	$em = $file['data'];

		    	header("Location: tambah_novel.php?error=$em&$user_input");
		    	exit;
		    }else {

		        $file_URL = $file['data'];
		        $novel_cover_URL = $novel_cover['data'];
                
                # Insert the data into database
                $sql  = "INSERT INTO novels (title,
                                            description,
                                            category_id,
                                            cover,
                                            file)
                         VALUES (?,?,?,?,?,?)";
                $stmt = $conn->prepare($sql);
			    $res  = $stmt->execute([$title, $description, $category, $novel_cover_URL, $file_URL]);

		     if ($res) {
		     	# success message
		     	$sm = "The novel successfully created!";
				header("Location: tambah_novel.php?success=$sm");
	            exit;
		     }else{
		     	# Error message
		     	$em = "Unknown Error Occurred!";
				header("Location: tambah_novel.php?error=$em");
	            exit;
		     }

		    }
	    }

		
	}else {
      header("Location: admin.php");
      exit;
	}

}else{
  header("Location: login_admin.php");
  exit;
}