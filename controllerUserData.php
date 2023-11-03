<?php 
include 'koneksi.php';

session_start();
// require "koneksi.php";
$email = "";
$name = "";
$errors = array();

//if user signup button
// if(isset($_POST['signup'])){

//     $name = mysqli_real_escape_string($koneksi, $_POST['name']);
//     $email = mysqli_real_escape_string($koneksi, $_POST['email']);
//     $pass = mysqli_real_escape_string($koneksi, md5($_POST['password']));
//     $cpass = mysqli_real_escape_string($koneksi, md5($_POST['cpassword']));
//     // $user_type = $_POST['user_type'];
 
//     $select_users = mysqli_query($koneksi, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');
 
//     if(mysqli_num_rows($select_users) > 0){
//        $message[] = 'user already exist!';
//     }else{
//        if($pass != $cpass){
//           $message[] = 'koneksifirm password not matched!';
//        }else{
//           mysqli_query($koneksi, "INSERT INTO `users`(name, email, password) VALUES('$name', '$email', '$cpass')") or die('query failed');
//           $message[] = 'registered successfully!';
//           header('location:login.php');
//        }
//     }
 
//  }
 if(isset($_POST['signup'])){
    $name = mysqli_real_escape_string($koneksi, $_POST['name']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);
    $cpassword = mysqli_real_escape_string($koneksi, $_POST['cpassword']);

    if($password !== $cpassword){
        $errors['password'] = "confirm password not matched!";
    }
    $email_check = "SELECT * FROM users WHERE email = '$email'";
    $res = mysqli_query($koneksi, $email_check);
    if(mysqli_num_rows($res) > 0){
        $errors['email'] = "Email that you have entered is already exist!";
        echo "<meta http-equiv='refresh' content='on-click;url=register.php'>";
    }
    if(count($errors) === 0){
        $encpass = md5($password);
        $insert_data = "INSERT INTO users (name, email, password)
                        values('$name', '$email', '$encpass')";
        $message[] = 'registered successfully!';
        header('location:login.php');
        $data_check = mysqli_query($koneksi, $insert_data);
    }
    }
// if(isset($_POST['signup'])){
//     $name = mysqli_real_escape_string($koneksi, $_POST['name']);
//     $email = mysqli_real_escape_string($koneksi, $_POST['email']);
//     $password = mysqli_real_escape_string($koneksi, $_POST['password']);
//     $cpassword = mysqli_real_escape_string($koneksi, $_POST['cpassword']);
//     if($password !== $cpassword){
//         $errors['password'] = "koneksifirm password not matched!";
//     }
//     $email_check = "SELECT * FROM users WHERE email = '$email'";
//     $res = mysqli_query($koneksi, $email_check);
//     if(mysqli_num_rows($res) > 0){
//         $errors['email'] = "Email that you have entered is already exist!";
//     }
//     if(count($errors) === 0){
//         $encpass = password_hash($password, PASSWORD_BCRYPT);
//         $insert_data = "INSERT INTO users (name, email, password)
//                         values('$name', '$email', '$encpass')";
//     }

// }
    //if user click verification code submit button
    // if(isset($_POST['check'])){
    //     $_SESSION['info'] = "";
    //     $otp_code = mysqli_real_escape_string($koneksi, $_POST['otp']);
    //     $check_code = "SELECT * FROM usertable WHERE code = $otp_code";
    //     $code_res = mysqli_query($koneksi, $check_code);
    //     if(mysqli_num_rows($code_res) > 0){
    //         $fetch_data = mysqli_fetch_assoc($code_res);
    //         $fetch_code = $fetch_data['code'];
    //         $email = $fetch_data['email'];
    //         $code = 0;
    //         $status = 'verified';
    //         $update_otp = "UPDATE usertable SET code = $code, status = '$status' WHERE code = $fetch_code";
    //         $update_res = mysqli_query($koneksi, $update_otp);
    //         if($update_res){
    //             $_SESSION['name'] = $name;
    //             $_SESSION['email'] = $email;
    //             header('location: home.php');
    //             exit();
    //         }else{
    //             $errors['otp-error'] = "Failed while updating code!";
    //         }
    //     }else{
    //         $errors['otp-error'] = "You've entered incorrect code!";
    //     }
    // }

    //if user click login button
    // if(isset($_POST['login'])){

    //     $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    //     $pass = mysqli_real_escape_string($koneksi, md5($_POST['password']));
     
    //     $select_users = mysqli_query($koneksi, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');
     
    //     if(mysqli_num_rows($select_users) > 0){
    //           $_SESSION['name'] = $row['name'];
    //           $_SESSION['email'] = $row['email'];
    //         //   $_SESSION['user_id'] = $row['id'];
    //           header('location:register.php');
    //        }else{
    //             $errors['email'] = 'incorrect email or password!';
    //     }
    // }
    if(isset($_POST['login'])){
        if(empty($_POST["email"]) || empty($_POST["password"])){
            $message = "<div class='alert-danger'>Email dan Password Harus diisi!!</div>";
        }else{
            // $email = mysqli_real_escape_string($koneksi, $_POST['email']);
            // $pass = mysqli_real_escape_string($koneksi, $_POST['password']);
            $select_password = mysqli_query($koneksi, "SELECT * FROM `users` WHERE password = '$password'");
            $select_email = mysqli_query($koneksi, "SELECT * FROM `users` WHERE email = '$email'");

            if($select_password == $_POST["password"]){
                if($select_email == $_POST["email"]){
                    $_SESSION["login"] = true;
                    header('location:register.php');
                }
            }
        }
    }

    //if user click koneksitinue button in forgot password form
    // if(isset($_POST['check-email'])){
    //     $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    //     $check_email = "SELECT * FROM usertable WHERE email='$email'";
    //     $run_sql = mysqli_query($koneksi, $check_email);
    //     if(mysqli_num_rows($run_sql) > 0){
    //         $code = rand(999999, 111111);
    //         $insert_code = "UPDATE usertable SET code = $code WHERE email = '$email'";
    //         $run_query =  mysqli_query($koneksi, $insert_code);
    //         if($run_query){
    //             $subject = "Password Reset Code";
    //             $message = "Your password reset code is $code";
    //             $sender = "From: shahiprem7890@gmail.com";
    //             if(mail($email, $subject, $message, $sender)){
    //                 $info = "We've sent a passwrod reset otp to your email - $email";
    //                 $_SESSION['info'] = $info;
    //                 $_SESSION['email'] = $email;
    //                 header('location: reset-code.php');
    //                 exit();
    //             }else{
    //                 $errors['otp-error'] = "Failed while sending code!";
    //             }
    //         }else{
    //             $errors['db-error'] = "Something went wrong!";
    //         }
    //     }else{
    //         $errors['email'] = "This email address does not exist!";
    //     }
    // }

    //if user click check reset otp button
    // if(isset($_POST['check-reset-otp'])){
    //     $_SESSION['info'] = "";
    //     $otp_code = mysqli_real_escape_string($koneksi, $_POST['otp']);
    //     $check_code = "SELECT * FROM usertable WHERE code = $otp_code";
    //     $code_res = mysqli_query($koneksi, $check_code);
    //     if(mysqli_num_rows($code_res) > 0){
    //         $fetch_data = mysqli_fetch_assoc($code_res);
    //         $email = $fetch_data['email'];
    //         $_SESSION['email'] = $email;
    //         $info = "Please create a new password that you don't use on any other site.";
    //         $_SESSION['info'] = $info;
    //         header('location: new-password.php');
    //         exit();
    //     }else{
    //         $errors['otp-error'] = "You've entered incorrect code!";
    //     }
    // }

    //if user click change password button
    // if(isset($_POST['change-password'])){
    //     $_SESSION['info'] = "";
    //     $password = mysqli_real_escape_string($koneksi, $_POST['password']);
    //     $cpassword = mysqli_real_escape_string($koneksi, $_POST['cpassword']);
    //     if($password !== $cpassword){
    //         $errors['password'] = "koneksifirm password not matched!";
    //     }else{
    //         $code = 0;
    //         $email = $_SESSION['email']; //getting this email using session
    //         $encpass = password_hash($password, PASSWORD_BCRYPT);
    //         $update_pass = "UPDATE usertable SET code = $code, password = '$encpass' WHERE email = '$email'";
    //         $run_query = mysqli_query($koneksi, $update_pass);
    //         if($run_query){
    //             $info = "Your password changed. Now you can login with your new password.";
    //             $_SESSION['info'] = $info;
    //             header('Location: password-changed.php');
    //         }else{
    //             $errors['db-error'] = "Failed to change your password!";
    //         }
    //     }
    // }
    
   //if login now button click
    // if(isset($_POST['login-now'])){
    //     header('Location: login-user.php');
    // }
?>