<?php
// include 'koneksi.php';
include 'controllerUserData.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Registration</title>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta name="robots" content="noindex, nofollow">
  <meta name="googlebot" content="noindex, nofollow">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <meta http-equiv='register.php'> -->
  <link rel="stylesheet" href="style.css">


  <script type="text/javascript" src="/js/lib/dummy.js"></script>

    <link rel="stylesheet" type="text/css" href="/css/result-light.css">

      <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
      <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
      <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>

  <script id="insert"></script>
  <script src="/js/stringify.js?67dd239ea46c4fe66f782c02980889cc54362b0d" charset="utf-8"></script>
</head>
<body data-new-gr-c-s-check-loaded="14.1087.0" data-gr-ext-installed="">
    <!-- This snippet uses Font Awesome 5 Free as a dependency. You can download it at fontawesome.io! -->


  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-xl-9 mx-auto">
        <div class="card flex-row my-5 border-0 shadow rounded-3 overflow-hidden">
          <div class="card-img-left d-none d-md-flex">
            <!-- Background image for card set in CSS! -->
          </div>
          <div class="card-body p-4 p-sm-5">
            <h2 class="card-title text-center mb-5 fw-bold fs-10">Register</h2>
            <?php
                    if(count($errors) == 1){
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                        
                    }elseif(count($errors) > 1){
                        ?>
                        <div class="alert alert-danger">
                            <?php
                            foreach($errors as $showerror){
                                ?>
                                <li><?php echo $showerror; ?></li>
                                <?php
                            }
                            ?>
                        </div>
                        
                        <?php
                        
                    }
                    ?>
          
            <form action="register.php" method="POST" autocomplete="">

              <div class="form-floating mb-3">
                <input type="text" class="form-control" name="name" id="floatingInputUsername" placeholder="Full Name" required value="">
                <label for="floatingInputUsername">Name</label>
              </div>

              <div class="form-floating mb-3">
                <input type="email" class="form-control" name="email" id="floatingInputEmail" placeholder="Email Address" required value="">
                <label for="floatingInputEmail">Email address</label>
              </div>

              <div class="form-floating mb-3">
                <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password" required>
                <label for="floatingPassword">Password</label>
              </div>

              <div class="form-floating mb-3">
                <input type="password" class="form-control" name="cpassword" id="floatingPasswordConfirm" placeholder="Confirm Password" required>
                <label for="floatingPasswordConfirm">Confirm Password</label>
              </div>

              <div class="d-grid">
                  <button class="btn btn-lg btn-primary btn-login text-uppercase fw-bold mb-3" type="signup" name="signup" value="Signup">Sign up</button>
              </div>
              
              <div class="link login-link text-center mt-2">Already a member? <a href="login.php">Login here</a></div>
              <div class="link login-link text-center mt-2">Im an Admin <a href="login_admin.php">Login here</a></div>
              

              <!-- <a class="d-block text-center mt-2 small" href="login.php">Have an account? Sign In</a> -->

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>



    <script type="text/javascript"></script>



</body>
<!-- <grammarly-desktop-integration data-grammarly-shadow-root="true"></grammarly-desktop-integration> -->
</html>


