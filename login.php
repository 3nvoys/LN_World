<?php 
session_start();

//atur koneksi ke database
$host_db    = "localhost";
$user_db    = "root";
$pass_db    = "";
$nama_db    = "ln_db";
$koneksi    = mysqli_connect($host_db,$user_db,$pass_db,$nama_db);
//atur variabel
$err        = "";
$email   = "";
$ingataku   = "";

if(isset($_COOKIE['cookie_email'])){
    $cookie_email = $_COOKIE['cookie_email'];
    $cookie_password = $_COOKIE['cookie_password'];

    $sql1 = "select * from users where email = '$cookie_email'";
    $q1   = mysqli_query($koneksi,$sql1);
    $r1   = mysqli_fetch_array($q1);
    if($r1['password'] == $cookie_password){
        $_SESSION['session_email'] = $cookie_email;
        $_SESSION['session_password'] = $cookie_password;
        header("location:home.php");
        exit();
    }
}

if(isset($_POST['login'])){
    $email   = $_POST['email'];
    $password   = $_POST['password'];

    if($email == '' or $password == ''){
        $err .= "Silakan masukkan email dan juga password.";
    }else{
        $sql1 = "select * from users where email = '$email'";
        $q1   = mysqli_query($koneksi,$sql1);
        $r1   = mysqli_fetch_array($q1);

        if(empty($r1['email'])){
            $err .= "email <b>$email</b> tidak tersedia.";
        }elseif($r1['password'] != md5($password)){
            $err .= "Password yang dimasukkan tidak sesuai.";
        }       
        
        if(empty($err)){
            $_SESSION['login'] = true;
            $_SESSION['session_email'] = $email; //server
            $_SESSION['session_password'] = md5($password);
            $ingataku   = $_POST['ingataku'];

            if($ingataku == 1){
                $cookie_name = "cookie_email";
                $cookie_value = $email;
                $cookie_time = time() + (60 * 60 * 24 * 30);
                setcookie($cookie_name,$cookie_value,$cookie_time,"/");

                $cookie_name = "cookie_password";
                $cookie_value = md5($password);
                $cookie_time = time() + (60 * 60 * 24 * 30);
                setcookie($cookie_name,$cookie_value,$cookie_time,"/");
            }
            header("location:home.php");
        }
    }
}
?>
<!DOCTYPE html>
<html><head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <!-- <title>Bootstrap Registration Page with Floating Labels</title> -->
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta name="robots" content="noindex, nofollow">
  <meta name="googlebot" content="noindex, nofollow">
  <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login</title>
    <!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
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
<div class="container">
    <div class="row">
      <div class="col-lg-10 col-xl-9 mx-auto">
        <div class="card flex-row my-5 border-0 shadow rounded-3 overflow-hidden">
          <div class="card-img-left d-none d-md-flex">
            <!-- Background image for card set in CSS! -->
          </div>
          <div class="card-body p-4 p-sm-5">
            <h2 class="card-title text-center mb-5 fw-bold fs-10">Login User</h2>
            <h2 class="card-title text-center mb-1 fw-light fs-5">Light Novel World</h2>
            <div style="padding-top:30px" class="panel-body" >
                <?php if($err){ ?>
                    <div id="login-alert" class="alert alert-danger col-sm-12">
                        <ul><?php echo $err ?></ul>
                    </div>
                <?php } ?>
          
            <form id="loginform" action="" method="post" role="form">

              <div class="form-floating mb-3">
                <input id="floatingInputEmail" type="text" class="form-control" name="email" value="<?php echo $email ?>" placeholder="email">
                <label for="floatingInputEmail">Email</label>
              </div>

              <div class="form-floating mb-3">
                <input id="floatingPassword" type="password" class="form-control" name="password" placeholder="password">
                <label for="floatingPassword">Password</label>
              </div>

              <div class="form-check mb-3">
                    <input class="form-check-input" id="login-remember" type="checkbox" name="ingataku" value="1" <?php if($ingataku == '1') echo "checked"?>>
                    <label class="form-check-label" for="login-remember">Remember password</label>
                </div>
                    <!-- <div style="margin-top:10px" class="form-group">
                        <div class="col-sm-12 controls">
                            <input type="submit" name="login" class="btn btn-success" value="Login"/>
                        </div>
                </div> -->
                <div class="d-grid">
                  <button type="submit" name="login" class="btn btn-lg btn-primary btn-login text-uppercase fw-bold mb-4" value="Login">Sign in</button>
                  <div class="text-center">
                    <div class="link login-link text-center">dont have any account? <a href="register.php">Sign up here</a></div>
                    <!-- <a class="small" href="register.php">dont have any account?</a>
                    <a class="small" href="login_admin.php">are you an admin?</a> -->
                  </div>
                </div>
              
              <!-- <div class="link login-link text-center">Already a member? <a href="login.php">Login here</a></div> -->
              

              <!-- <a class="d-block text-center mt-2 small" href="login.php">Have an account? Sign In</a> -->

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>
</html>