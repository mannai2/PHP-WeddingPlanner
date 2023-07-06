<?php include 'admin/include/init.php'; ?>
<?php 
$category = Category::find_all();
?>


<!DOCTYPE html>
<html lang="en" style="padding-top: 0px;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Products - Brand</title>
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
    <link rel="stylesheet" href="assets/css/categoryC.css">
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
                <h1>FEATURED PLANS</h1>
                <h5>Our featured wedding plans</h5>
            </div>
        </div>

        <div class="container" style="width: 70%;">

   

    <?php foreach ($category as $category_row) : ?>
     <div class="row">
        <div class="col-md-12 p-0" style="margin-bottom: 20px;"> <!-- border:1px solid rgba(0,0,0,.125) -->

            <div class="float-right">
                <img src="DATA BASE/<?= $category_row->preview_image_picture(); ?>" style="width: 500px; float-right" alt="">
            </div>
            
            <div class="float-left" style="width: 47%;"> 
                <ul class="list-group">
                    <li class="list-group-item bg-danger active" style="padding-top: 12px;"><h6 class="h6 text-center"><?= $category_row->wedding_type; ?> Package Wedding - Price: $ <?= number_format($category_row->price,2); ?></h6></li>
                    <li class="list-group-item  list-group-item-light "><b>THIS PACKAGE INCLUDES:</b></li>
                    <?php $feature = Features::find_by_feature_all($category_row->id); ?>
                    <?php foreach ($feature as $feature_item) : ?>
                        <li class="list-group-item"><?= $feature_item->title; ?></li>
                    <?php endforeach; ?>
                </ul>
                 <div class="float-right">
                <a href="sign_up.php?id=<?= $category_row->id; ?>" class="btn btn-sm btn-success active" style="border-radius: 3px;margin-top: 9px;">Book Now</a>
                <a href="package_detail.php?id=<?= $category_row->id; ?>" class="btn btn-sm btn-primary active" style="border-radius: 3px;margin-top: 9px;">More Detail</a>
            </div>
            </div>
            </div><!-- end of col-md-8 p-0 pl-3 -->
        </div>
        <?php endforeach; ?>

</div><!-- end of container -->
    </section>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/Advanced-Pricing-Cards-main.js"></script>
    <script src="assets/js/current-day.js"></script>
    
</body>

</html>