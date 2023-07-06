<?php include 'include/init.php'; ?>

<?php
     if (!isset($_SESSION['id'])) {
         redirect_to("../");
     }
     $booking_id = $_GET['booking_id'];
     $user_id = $_GET['user_id'];
     $links='booking_id='.$booking_id.'&user_id='.$user_id;
     $booking =  Booking::find_by_booking_id($booking_id);
     $guest_count =  Guest::count_guest($booking_id);
     $account_details = Account_Details::find_by_user_id($user_id);
     $category_details = Category::find_by_id($booking->wedding_type);
     $credit= Liquidation::getCreditValue($booking_id);
     $cash = Liquidation::getCash($booking_id);
    

    
?>
<?php $users_profile = Users::find_by_id($_SESSION['id']); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard - Administrator</title>
    <link href='calendar/all.css' rel='stylesheet'>
    <link href='calendar/fullcalendar.min.css' rel='stylesheet' />
    <link href='calendar/fullcalendar.print.min.css' rel='stylesheet' media='print' />
    <script src='calendar/moment.min.js'></script>
    <script src='calendar/jquery.min.js'></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/dashboard.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
          href="https://cdn.materialdesignicons.com/2.1.19/css/materialdesignicons.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
    <script src='calendar/fullcalendar.min.js'></script>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <style>
        #calendar {
            max-width:100%;
            margin: 0px auto;
            padding: 20px 20px;
            background: white;

        }
        .col-centered{
            float: none;
            margin: 0 auto;
        }
         .fc-content {
            background: white;
            color: black;
            padding:3px;

        }

        .fc-title {
            text-transform: capitalize;
        }

        /* .btn-primary {
            background-color: #17B4BC;
            border-color: #17B4BC;
        }

        .btn-primary.disabled, .btn-primary:disabled {
            background-color: #17B4BC;
            border-color: #17B4BC;
        } */

        .list-group-item.active{
            border-color:#ff000000;
        }

    </style>
</head>

<body>

<?php include_once 'include/sidebar.php'; ?>


<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h6 class="h6 mt-4 text-uppercase">OVERVIEW  </h6>

    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">

            <a class="btn btn-sm btn-primary mr-2 " style="font-size: 12px;" href="client_manage_account_details.php?<?= $links; ?>"><i class="mdi mdi-buffer mr-2"></i> Overview</a>

            <a class="btn btn-sm btn-info mr-2 " style="font-size: 12px;" href="guest_list.php?<?= $links; ?>"><i class="mdi mdi-account-network mr-2"></i> Master List Guest</a>

            <a class="btn btn-sm btn-success mr-2 " style="font-size: 12px;" href="budget.php?<?= $links; ?>"><i class="mdi mdi-currency-usd mr-2"></i> Budget</a>

        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-3">
                <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                    <div class="card-header">Total Guest</div>
                    <div class="card-body">
                        <h5 class="card-title"><span class="count"><?= $guest_count; ?></span></h5>
                        <p class="card-text"></p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                    <!-- <div class="card-header">Amount Paid To Date</div> -->
                    <div class="card-header">Amount Paid To Date</div>
                    <div class="card-body">
                        <h5 class="card-title">$ <?= number_format($cash,2); ?></h5>
                        <p class="card-text"></p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                    <div class="card-header"> Amount Advanced</div>
                    <div class="card-body">
                        <h5 class="card-title">$ <?= number_format($account_details->cash_advanced, 2); ?></h5>
                        <p class="card-text"></p>
                    </div>
                </div>
            </div>

            

            <div class="col-md-3">
                <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                    <div class="card-header">Balance Due</div>
                    <div class="card-body">
                        <h5 class="card-title">$ <?= @number_format($credit, 2); ?></h5>
                        <p class="card-text"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</main>
</div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<!-- <script src="js/jquery-3.2.1.slim.min.js"></script> -->
<script src="js/popper.min.js"></script>
<!-- <script src="../js/jquery.min.js"></script> -->
<script src="js/bootstrap.min.js"></script>
<script>
  
    $(document).ready(function() {
        $('.count').each(function () {
            $(this).prop('Counter',0).animate({
                Counter: $(this).text()
            }, {
                duration: 4000,
                easing: 'swing',
                step: function (now) {
                    $(this).text(Math.ceil(now));
                }
            });
        });

        // $('#wedding_date').datepicker();
        $('[data-toggle="tooltip"]').tooltip();
    });
    
</script>


</body>
</html>