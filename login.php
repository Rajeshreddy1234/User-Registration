<?php
	include("includes/config.php");
	ini_set("display_errors","0");
	include("includes/login_queries.php");
	
	if($_SESSION['id'])
		header("Location:index.php");
	else if($_POST["username"] && $_POST["password"])
	{
		$username = $_POST["username"];
		$password = $_POST["password"];
		
		$userData = login($username, $password);
		
		if (mysqli_num_rows($userData) > 0)
		{
			$user = mysqli_fetch_assoc($userData);
			
			$_SESSION['id'] = $user['id'];
			/*$_SESSION['first_name'] = $user['first_name'];*/
			$_SESSION['user_type_id'] = $user['user_type_id'];
			$_SESSION['token'] = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 32);
            header("Location:index.php?page=view_profile");
		}
		else
			$error = "Please enter Proper credentials.";
	}
	else
		$error = "Please enter Proper credentials.";
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="Nex Title Tracker" name="description" />
        <meta content="" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/hcms.png">
        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/jquery-ui.min.css" rel="stylesheet">
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/metisMenu.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
        <style>
        .form-auth {
            width: 32px;
            height: 32px;
            text-align: center;
            line-height: 34px;
            border-radius: 50%;
            position: absolute;
            right: 3px;
            z-index: 100;
            top: 3px;
        }
        </style>
    </head>
    <body class="account-body" style="background-image:linear-gradient(to right ,#e1fbec, #fcf2f2,#fcfeec,#f0f8ff)">
        <!-- Log In page -->
        <div class="container">
            <div class="row vh-100 ">
                <div class="col-12 align-self-center">
                    <div class="auth-page">
                        <div class="card auth-card shadow-lg">
                            <div class="card-body">
                                <div class="px-3">
                                    <div class="auth-logo-box">
                                        <a href="login.php" class="logo logo-admin">
					<!-- <img src="assets/images/logo.png" height="65" alt="logo" style="border-radius:5px;" class="auth-logo"> -->
                       
					</a>
                                    </div><!--end auth-logo-box-->
                                    <div class="text-center auth-logo-text">
                                        <h4 class="mt-0 mb-3 mt-5">myHCMS</h4>
                                        <p class="text-muted mb-0">Sign in to continue</p>  
                                        <p class="mb-0" style="color:red"><?php if($_POST["username"] && $_POST["password"]) echo $error;?></p>  
                                    </div> <!--end auth-logo-text-->  
                                    <form class="form-horizontal auth-form my-4" method="POST" action="login.php">
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <div class="input-group mb-3">
                                                <span class="auth-form-icon">
                                                    <i class="dripicons-user"></i> 
                                                </span>
                                                &nbsp; <input type="text" class="form-control" name="username" id="username" placeholder="Enter username">
                                            </div>                                    
                                        </div><!--end form-group--> 
                                        <div class="form-group">
                                            <label for="userpassword">Password</label>                                            
                                            <div class="input-group mb-3"> 
                                            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password form-auth"></span>
                                                <span class="auth-form-icon">
                                                    <i class="dripicons-lock"></i> 
                                                </span>  
                                               &nbsp;  <input type="password" class="form-control" name="password" id="password" placeholder="Enter password"> 
                                            </div>                               
                                        </div><!--end form-group-->
                                        <div class="form-group mb-0 row">
                                            <div class="col-12 mt-2">
                                                <button class="btn btn-gradient-primary btn-round btn-block waves-effect waves-light" type="submit">Log In <i class="fas fa-sign-in-alt ml-1"></i></button>
                                            </div><!--end col--> 
                                        </div> <!--end form-group-->                           
                                    </form><!--end form-->
                                </div><!--end /div-->
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!--end auth-page-->
                </div><!--end col-->           
            </div><!--end row-->
        </div><!--end container-->
        <!-- End Log In page -->
        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/jquery-ui.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/metismenu.min.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/feather.min.js"></script>
        <script src="assets/js/jquery.slimscroll.min.js"></script>        
        <!-- App js -->
        <script src="assets/js/app.js"></script>
    </body>
</html>