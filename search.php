<?php 
session_start();

# If search key is not set or empty
if (!isset($_GET['key']) || empty($_GET['key'])) {
	header("Location: home.php");
	exit;
}
$key = $_GET['key'];

# Database Connection File
include "koneksi_novel.php";

# Book helper function
include "func-novel.php";
$novels = search_novels($koneksi, $key);

# author helper function
// include "php/func-author.php";
// $authors = get_all_author($koneksi);

# Category helper function
include "php/func-category.php";
$categories = get_all_categories($koneksi);

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Light Novel World</title>

    <!-- bootstrap 5 CDN-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <!-- bootstrap 5 Js bundle CDN-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/style.css">

</head>
<body>
	<div class="container">
		<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
            <div class="container-fluid">
                <a class="navbar-brand" href="home.php">Light Novel World</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="home.php">Home</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="category.php">Category</a>
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
        </nav><br>
		Search result for <b><?=$key?></b>

		<div class="d-flex pt-3">
			<?php if ($novels == 0){ ?>
				<div class="alert alert-warning 
        	            text-center p-5 pdf-list" 
        	     role="alert">
        	     <img src="img/empty-search.png" 
        	          width="100">
        	     <br>
				  The key <b>"<?=$key?>"</b> didn't match to any record
		           in the database
			  </div>
			<?php }else{ ?>
			<div class="pdf-list d-flex flex-wrap">
				<?php foreach ($novels as $novel) { ?>
				<div class="card m-1">
					<img src="uploads/cover/<?=$novel['cover']?>"
					     class="card-img-top">
					<div class="card-body">
						<h5 class="card-title">
							<?=$novel['title']?>
						</h5>
							<br></b></i>
							<?=$novel['description']?>
							<br><i><b>Category:
								<?php foreach($categories as $category){ 
									if ($category['id'] == $novel['category_id']) {
										echo $category['name'];
										break;
									}
								?>

								<?php } ?>
							<br></b></i>
						</p>
                       <a href="uploads/files/<?=$novel['file']?>"
                          class="btn btn-success">Open</a>

                        <a href="uploads/files/<?=$novel['file']?>"
                          class="btn btn-primary"
                          download="<?=$novel['title']?>">Download</a>
					</div>
				</div>
				<?php } ?>
			</div>
		<?php } ?>
		</div>
	</div>
</body>
</html>