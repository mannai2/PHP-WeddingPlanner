<?php include 'admin/include/init.php'; ?>
<?php 
    $id = $_GET['id'];
    $category = Category::find_by_id($id);

    $count = 0;
    $error =$user_firstname = $user_lastname = $user_password = $user_email = $wedding_date = '';

    $account_details = new Account_Details();
    $accounts = new Accounts();
    $booking = new Booking();

    if (isset($_POST['register'])) {

        $user_firstname = clean($_POST['user_firstname']);
        $user_lastname  = clean($_POST['user_lastname']);
        $user_email     = clean($_POST['user_email']);
        $user_password  = clean($_POST['user_password']);
        $wedding_date   = clean($_POST['wedding_date']);
        $user_phone     = clean($_POST['user_phone']);
        $bid = clean($_POST['booking_id']);

        $checkdate = $booking->check_wedding_date($wedding_date);

        if ($checkdate) {
            redirect_to("package_detail.php?id=$bid");
            $session->message("
            <div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">
              <strong><i class='mdi mdi-alert'></i></strong>  The wedding you enter is already booked. Please Try another set of date!
              <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
              </button>
            </div>");
            die();
        }
        if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)){
            redirect_to("package_detail.php?id=$bid");
            $session->message("
            <div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">
              <strong><i class='mdi mdi-alert'></i></strong>  Incorrect email format.
              <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
              </button>
            </div>");
            die();

        }

        $check_email = $accounts->email_exists($user_email);

        if ($check_email) {
            redirect_to("package_detail.php?id=$bid");
            $session->message("
            <div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">
              <strong><i class='mdi mdi-alert'></i></strong>  Email is already Exists.
              <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
              </button>
            </div>");
            die();
        } else {
            if ($error == '') {
                $count = $count + 1;
                $account_details->firstname = $user_firstname;
                $account_details->lastname = $user_lastname;
                $account_details->status = 'pending';
                $account_details->phone = $user_phone;
                $account_details->datetime_created  = date("y-m-d h:m:i");

                if ($account_details->save()) {
                    $account_details->user_id = mysqli_insert_id($db->connection);

                    if($account_details->update()) {
                        $accounts->user_id = $account_details->user_id;
                        $accounts->user_email= $user_email;

                         if($accounts->save()) {
                             $booking->user_id = $accounts->user_id;
                             $booking->wedding_type = $bid;
                             $booking->user_email = $user_email;
                             $booking->wedding_date =  $wedding_date;
                             $booking->save();
                             redirect_to("package_detail.php?id=".$bid);
                         }
                    }
                }
            }
        }
    }
?>


<!DOCTYPE html>
<html lang="en" style="padding-top: 0px;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>wedding planner</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oranienbaum">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400|Roboto:300,400,700">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/Advanced-Pricing-Cards.css">
    <link rel="stylesheet" href="assets/css/Black-Navbar.css">
    <link rel="stylesheet" href="assets/css/cards-0.css">
    <link rel="stylesheet" href="assets/css/Dark-NavBar-Navigation-with-Button.css">
    <link rel="stylesheet" href="assets/css/Dark-NavBar-Navigation-with-Search.css">
    <link rel="stylesheet" href="assets/css/Dark-NavBar.css">
    <link rel="stylesheet" href="assets/css/bootstrap-datepicker.css">
    
    
   
</head>

<body>
    
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



    <section id="featured-models" style="margin-bottom: -154px;padding-bottom: 153px;">
        <div class="text-center">
            <div class="bordered-headline">
                <h1><?= $category->wedding_type; ?> Package Wedding</h1>
                <h5>Price: $ <?= number_format($category->price,2); ?></h5>
            </div>
        </div>
  
    
    <div class="container">
    
    <div class="row">
       <div class="col-md-8 p-0" style="margin-bottom: 20px;"> <!-- border:1px solid rgba(0,0,0,.125) -->
          
           <div class="float-left bg-white">
               
               <img src="DATA BASE/<?= $category->preview_image_picture(); ?>" style="width: 700px;" alt="">

               <ul class="list-group">
                       <li class="list-group-item list-group-item-action bg-danger flex-column align-items-start active">
                           <div class="d-flex w-100 justify-content-between">
                               <h5 class="mb-1 pt-2 pb-2">FUNCTIONS AND SERVICES</h5>
                           </div>
                       </li>
                   <?php $feature = Features::find_by_feature_all($category->id); ?>
                       <?php foreach ($feature as $feature_item) : ?>
                           <li class="list-group-item list-group-item-action flex-column align-items-start">
                               <div class="d-flex w-100 justify-content-between">
                                   <h5 class="mb-1"><i class="mdi mdi-check mr-3"></i><?= $feature_item->title; ?></h5>
                               </div>
                               <p class="mb-1 ml-3 text-capitalize"><?= $feature_item->description; ?></p>
                           </li>
                       <?php endforeach; ?>
                   </ul>
               </div>
           </div><!-- end of col-md-8 p-0 pl-3 -->

           <div class="col-md-4" style="margin-bottom: 20px;">
              
           <a href="sign_up.php">
                            <button class="btn btn-success btn-sm text-uppercase font-weight-bold" style="margin-top: 100px;margin-left : 20px ; font-size : 80px; border-radius : 10px">
                            Book Now
                           </button>
            </a>    
                   
           </div>
       </div>
      

</div>

</section>

    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/Advanced-Pricing-Cards-main.js"></script>
    <script src="assets/js/current-day.js"></script>
    <script src="assets/js/bootstrap-datepicker.min.js"></script>
    <script>

    $(document).ready(function () {
        $('#wedding_date').datepicker();
    });

</script>
</body>

</html>