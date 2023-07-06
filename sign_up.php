<?php include 'admin/include/init.php'; ?>
<?php
$count = 0;
$error = '';
$user_firstname = $user_lastname = $user_password = $user_email = $wedding_date = '';

$account_details = new Account_Details();
$accounts = new Accounts();
$booking = new Booking();
$category = Category::find_all();

if (isset($_POST['register'])) {

    $user_firstname = clean($_POST['user_firstname']);
    $user_lastname = clean($_POST['user_lastname']);
    $user_email = clean($_POST['user_email']);
    $user_phone = clean($_POST['user_phone']);
    $wedding_date = clean($_POST['wedding_date']);

    $checkdate = $booking->check_wedding_date($wedding_date);

    
    if (empty($user_firstname) ||
        empty($user_phone) ||
        empty($user_email) ||
        empty($user_lastname) ||
        empty($wedding_date)) {
            echo "<script>alert('Please fill the required feilds!');</script>";
            echo "<script>window.location.href = 'sign_up.php';</script>";
        die();
        
    }

    if ($checkdate) {
        echo "<script>alert('The wedding you enter is already booked. Please try another set of date!');</script>";
        echo "<script>window.location.href = 'sign_up.php';</script>";
        die();
    }
    

    if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)){
        echo "<script>alert('The email you provided is uncorrect, please enter a valid email format!');</script>";
        echo "<script>window.location.href = 'sign_up.php';</script>";
    die();

    }

    $check_email = $accounts->email_exists($user_email);

    if ($check_email) {
        echo "<script>alert('The email you provided already exits, please enter another email!');</script>";
        echo "<script>window.location.href = 'sign_up.php';</script>";
    die();
    } else {
        if ($error == '') {
            $count = $count + 1;
            $account_details->firstname = $user_firstname;
            $account_details->lastname = $user_lastname;
            $account_details->status = 'pending';
            $account_details->datetime_created  = date("y-m-d h:m:i");
            $account_details->phone= $user_phone;
            if ($account_details->save()) {
                $account_details->user_id = mysqli_insert_id($db->connection);

                if($account_details->update()) {
                    $accounts->user_id = $account_details->user_id;
                    $accounts->user_email= $user_email;

                    if($accounts->save()) {
                        $booking->user_id = $accounts->user_id;
                        $booking->user_email = $user_email;
                        $booking->wedding_date =  $wedding_date;
                        $booking->save();
                        redirect_to("thank_you.php");
                    }
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Register - WP</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
</head>

<body class="bg-gradient-primary" style="background: url(&quot;assets/img/bg-1.jpg&quot;);">

<div>
<nav class="navbar navbar-light navbar-expand-md sticky-top navigation-clean-button" style="height: 80px;background-color: #37434d;color: #ffffff;margin-top: -11px;margin-bottom: -13px;">
            <div class="container-fluid"><a class="navbar-brand" href="#" style="color: var(--bs-warning);margin-top: -6px;padding-bottom: 0px;">WP<img src="assets/img/iconArtboard%201.png" width="37" height="37"></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" style="color: #ffffff;font-family: Raleway, sans-serif;" href="menu.html"><i class="fa fa-home"></i>HOME</a></li>
                        <li class="nav-item"><a class="nav-link" style="color: #ffffff;font-family: Raleway, sans-serif;" href="products.php"><i class="fa fa-money"></i>OFFERS</a></li>
                        
                        <li class="nav-item"><a class="nav-link" data-bss-hover-animate="bounce" style="color: #ffffff;font-family: Raleway, sans-serif;" href="sign_up.php"><i class="fa fa-sign-in"></i>SIGNIN</a></li>
                    </ul>
                </div><a href="admin/login.php"><button class="btn btn-primary" type="button" style="font-family: Raleway, sans-serif;border-radius: 5px;"><i class="fa fa-star"></i>ADMIN</button></a>
            </div>
        </nav>
    </div>   

    <div class="container">
        <div class="card shadow-lg o-hidden border-0 my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-flex">
                        <div class="flex-grow-1 bg-register-image" style="background-image: url(&quot;assets/img/wed2.jpg&quot;);"></div>
                    </div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h2 class="text-center hero-lead">Wedding Planning Starts Here</h2>
                                <p class="lead text-center" style="color:rgb(0, 0, 0);">START BY FILLING UP THE FORM</p>
                            </div>
                            <form class="bgact" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                <div class="row mb-3">
                                    <div class="col-sm-6"><input class="form-control" type="text" id="user_firstname" placeholder="First Name" name="user_firstname"></div>
                                    <div class="col-sm-6"><input class="form-control" type="text" id="user_lastname" placeholder="Last Name" name="user_lastname"></div>
                                </div>
                                <div class="mb-3">
                                    <input class="form-control" type="email" id="user_email" aria-describedby="emailHelp" placeholder="Email Address" name="user_email"></div>
                                    <input type="text" aria-describedby="phoneHelpBlock" class="form-control" name="user_phone" id="user_phone" placeholder="Contact Number" style="margin-bottom: 20px;">
                                    <input type="text" class="form-control" name="wedding_date" data-provide="datepicker" id="wedding_date"
                                           placeholder="Wedding Date">
                                    <hr>
                                    <button type="submit" name="register" class="btn btn-primary d-block btn-user w-100 text-uppercase fb"
                                        style="margin-top: -5px;">Sign Up
                                </button>
                                
                                   
                                <hr>
                            </form>
                            <div class="text-center"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="assets/js/savy.js"></script>
    <script src="assets/js/bootstrap-datepicker.min.js"></script>

    <script>

        $(document).ready(function () {
            
            <?php
            if($count == 0) {
            ?>
            $('#user_firstname').savy('load');
            $('#user_lastname').savy('load');
            $('#user_email').savy('load');
            $('#user_phone').savy('load');
            $('#wedding_date').savy('load');
            <?php } else { ?>
            $('#user_firstname').savy('destroy');
            $('#user_email').savy('destroy');
            $('#user_lastname').savy('destroy');
            $('#user_phone').savy('destroy');
            $('#wedding_date').savy('destroy');
            <?php } ?>
        });
    </script>
    <script>

$(document).ready(function () {
    $('#wedding_date').datepicker();
    <?php
    if($count == 0) {
    ?>
    $('#user_firstname').savy('load');
    $('#user_lastname').savy('load');
    $('#user_email').savy('load');
    $('#user_phone').savy('load');
    $('#wedding_date').savy('load');
    <?php } else { ?>
    $('#user_firstname').savy('destroy');
    $('#user_email').savy('destroy');
    $('#user_lastname').savy('destroy');
    $('#user_phone').savy('destroy');
    $('#wedding_date').savy('destroy');
    <?php } ?>
});
</script>
</body>

</html>