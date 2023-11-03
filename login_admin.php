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
$username   = "";
$ingataku   = "";

// if(isset($_COOKIE['cookie_username'])){
//     $cookie_username = $_COOKIE['cookie_username'];
//     $cookie_password = $_COOKIE['cookie_password'];

//     $sql1 = "select * from admin where username = '$cookie_username'";
//     $q1   = mysqli_query($koneksi,$sql1);
//     $r1   = mysqli_fetch_array($q1);
//     if($r1['password'] == $cookie_password){
//         $_SESSION['session_username'] = $cookie_username;
//         $_SESSION['session_password'] = $cookie_password;
//         header("location:member.php");
//         exit();
//     }
// }

if(isset($_POST['login_admin'])){
    $username   = $_POST['username'];
    $password   = $_POST['password'];
    // $ingataku   = $_POST['ingataku'];

    if($username == '' or $password == ''){
        $err .= "<li>Silakan masukkan username dan juga password.</li>";
    }else{
        $sql1 = "select * from admin where username = '$username'";
        $q1   = mysqli_query($koneksi,$sql1);
        $r1   = mysqli_fetch_array($q1);

        if($r1['username'] == ''){
            $err .= "<li>username <b>$username</b> tidak tersedia.</li>";
        }elseif($r1['password'] != $password){
            $err .= "<li>Password yang dimasukkan tidak sesuai.</li>";
        }       
        
        if(empty($err)){
            $_SESSION['login_admin'] = true;
            $_SESSION['session_username'] = $username; //server
            $_SESSION['session_password'] = $password;
            header("location:page_admin.php");
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

    <title>Admin</title>
    <!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
    <link rel="stylesheet" href="login_admin.css">


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
            <h2 class="card-title text-center mb-5 fw-bold fs-10">Login Admin</h2>
            <h2 class="card-title text-center mb-1 fw-light fs-5">Light Novel World</h2>
            <div style="padding-top:30px" class="panel-body" >
                <?php if($err){ ?>
                    <div id="login-alert" class="alert alert-danger col-sm-12">
                        <ul><?php echo $err ?></ul>
                    </div>
                <?php } ?>
          
            <form id="loginform" action="" method="post" role="form">

              <div class="form-floating mb-3">
                <input id="floatingInputusername" type="text" class="form-control" name="username" value="<?php echo $username ?>" placeholder="username">
                <label for="floatingInputusername">username</label>
              </div>

              <div class="form-floating mb-3">
                <input id="floatingPassword" type="password" class="form-control" name="password" placeholder="password">
                <label for="floatingPassword">Password</label>
              </div>

              <!-- <div class="form-check mb-3">
                    <input class="form-check-input" id="login-remember" type="checkbox" name="ingataku" value="1" 
                    <label class="form-check-label" for="login-remember">Remember password</label>
                </div> -->
                    <!-- <div style="margin-top:10px" class="form-group">
                        <div class="col-sm-12 controls">
                            <input type="submit" name="login" class="btn btn-success" value="Login"/>
                        </div>
                </div> -->
                <div class="d-grid">
                  <button type="submit" name="login_admin" class="btn btn-lg btn-primary btn-login text-uppercase fw-bold mb-4" value="Login_admin">Sign in</button>
                  <div class="text-center">
                    <a class="d-block text-center mt-2 medium" href="login.php">I Am User</a>
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