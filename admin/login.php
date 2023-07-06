<?php include_once 'include/init.php';?>
<?php
 if (isset($_POST['login'])) {
     $input_email = clean($_POST['input_email']);
     $input_password= clean($_POST['input_password']);
     $logged = Users::user_account_login($input_email, $input_password);

     if($logged) {
         $session->login($logged);
         redirect_to("dashboard.php");
     } else {
        echo "<script>alert('YOU ARE NOT AN ADMIN!');</script>";
        echo "<script>window.location.href = 'login.php';</script>";
     }
 }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login - WP</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-all.min.css">
    <style>
        
        </style>

    


    

    
    
    
</head>



<body class="bg-gradient-primary" style="background-image: url(&quot;../assets/img/bg-1.jpg&quot;);">

    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-12 col-xl-10">
                <div class="card shadow-lg o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-flex">
                                <div class="flex-grow-1 bg-login-image" style="background-image: url(&quot;../assets/img/iconArtboard 2.png&quot;);  background-repeat: no-repeat;"></div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h4 class="text-dark mb-4" style="margin-top:50px;">Welcome Back!</h4>
                                    </div>
                                    
                                    <form class="user" method="post" style="margin-top:50px;">
                                        <div class="mb-3"><input class="form-control" type="text" id="inputEmail" name="input_email" class="form-control" placeholder="Email Address" required autofocus></div>
                                        <div class="mb-3"><input class="form-control" type="password" id="inputPassword" name="input_password" class="form-control" placeholder="Password" required style="margin-top:20px;"></div>
                                        <div class="mb-3">
                                            <hr style="margin-top:50px;">
                
                                        </div>
                                        <button class="btn btn-primary d-block btn-user w-100" type="submit" name="login" >Login</button>
                                        <hr style="margin-bottom:50px;">
                                        
                                    </form>
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/js/theme.js"></script>
    <script src="js/jquery-3.2.1.slim.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
    $('.your-checkbox').prop('indeterminate', true);
    </script>   
</body>

</html>
