<?php  
session_start();

# If the admin is logged in
if (isset($_SESSION['login_admin'])) {

	# Database Connection File
	include "koneksi_novel.php";

    # Category helper function
	include "func-category.php";
    $categories = get_all_categories($koneksi);

    # author helper function
	// include "php/func-author.php";
    // $authors = get_all_author($koneksi);

    if (isset($_GET['title'])) {
    	$title = $_GET['title'];
    }else $title = '';

    if (isset($_GET['desc'])) {
    	$desc = $_GET['desc'];
    }else $desc = '';

    if (isset($_GET['category_id'])) {
    	$category_id = $_GET['category_id'];
    }else $category_id = 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Add novel</title>

    <!-- bootstrap 5 CDN-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <!-- bootstrap 5 Js bundle CDN-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

</head>
<body class="cover" style="background-image:url(img/Rimuru\ Slime\ Version\ by\ Kamisora.png);
    background-size: cover;">
	<div class="container-fluid">
        <nav class="navbar navbar-light bg-light fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="home.php">Light Novel World</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
                </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="home.php">Home</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="tambah_novel.php">Add Novel</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="tambah_category.php">Add Category</a>
                    </li>
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Account
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="choice_login.php">New Login</a></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
                    </li>
                </ul>
                <form class="d-flex" action="search.php" method="get">
                    <input class="form-control me-2" type="text" name="key" placeholder="Search Novel..." aria-label="Search Novel...">
                    <button class="btn btn-outline-primary" type="submit">Search</button>
                </form>
                </div>
            </div>
        </nav>
        <br></br>
     <form action="add-novel.php"
           method="post"
           enctype="multipart/form-data" 
           class="bg-light text-dark shadow p-4 rounded mt-5"
           style="width: 90%; max-width: 50rem;">

     	<h1 class="text-center pb-5 display-4 fw-bold fs-3">
     		Add New Novel
     	</h1>
     	<?php if (isset($_GET['error'])) { ?>
          <div class="alert alert-danger" role="alert">
			  <?=htmlspecialchars($_GET['error']); ?>
		  </div>
		<?php } ?>
		<?php if (isset($_GET['success'])) { ?>
          <div class="alert alert-success" role="alert">
			  <?=htmlspecialchars($_GET['success']); ?>
		  </div>
		<?php } ?>
     	<div class="mb-3">
		    <label class="form-label">
		           Novel Title
		           </label>
		    <input type="text" 
		           class="form-control"
		           value="<?=$title?>" 
		           name="novel_title">
		</div>

		<div class="mb-3">
		    <label class="form-label">
		           Novel Description
		           </label>
		    <input type="text" 
		           class="form-control" 
		           value="<?=$desc?>"
		           name="novel_description">
		</div>

		<div class="mb-3">
		    <label class="form-label">
		           Novel Category
		           </label>
		    <select name="novel_category"
		            class="form-control">
		    	    <option value="0">
		    	    	Select category
		    	    </option>
		    	    <?php 
                    if ($categories == 0) {
                    	# Do nothing!
                    }else{
		    	    foreach ($categories as $category) { 
		    	    	if ($category_id == $category['id']) { ?>
		    	    	<option 
		    	    	  selected
		    	    	  value="<?=$category['id']?>">
		    	    	  <?=$category['name']?>
		    	        </option>
		    	        <?php }else{ ?>
						<option 
							value="<?=$category['id']?>">
							<?=$category['name']?>
						</option>
		    	   <?php }} } ?>
		    </select>
		</div>

		<div class="mb-3">
		    <label class="form-label">
		           Novel Cover
		           </label>
		    <input type="file" 
		           class="form-control" 
		           name="novel_cover">
		</div>

		<div class="mb-3">
		    <label class="form-label">
		           File
		           </label>
		    <input type="file" 
		           class="form-control" 
		           name="file">
		</div>

	    <button type="submit" 
	            class="btn btn-primary">
	            Add Novel</button>
     </form>
	</div>
</body>
</html>

<?php }else{
  header("Location: login_admin.php");
  exit;
} ?>