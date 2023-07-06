<?php include 'include/init.php'; ?>
<?php


    if (!isset($_SESSION['id'])) { redirect_to("../"); }
    
    $booking_id = $_GET['booking_id'];
    $user_id = $_GET['user_id'];
    $links='booking_id='.$booking_id.'&user_id='.$user_id;
    $account_details = Account_Details::find_by_user_id($user_id);
    $booking_details = Booking::find_by_booking_id($booking_id);
    $category_details = Category::find_by_id($booking_details->wedding_type);
    $groom = Booking::getGroom($booking_id);
    
    

   
    $liquidate = new Liquidation();

    if (isset($_POST['submit'])) {

      
        $payment = clean($_POST['payment']);
        

         if (empty($payment)) {
            redirect_to("budget_add.php?$links");
            $session->message("
            <div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
              <strong><i class='mdi mdi-account-alert'></i></strong> Please Fill up all the information.
              <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
              </button>
            </div>");
            die();
        }

        $cash = Liquidation::getTotalAmountCash_new($booking_id,$payment);
        $cash_advanced = Liquidation::getCashAdValue($booking_id);
        $credit = Liquidation::getCreditValue($booking_id);
        $liquidate->cash = $cash;
        $liquidate->payment = $payment;
        $liquidate->cash_advanced = $cash_advanced;
        $liquidate->credit = $credit - $payment;
        $liquidate->booking_id = $booking_id;
        $liquidate->user_id = $user_id;
        $liquidate->date_modified = date("F j, Y, g:i a");
        $liquidate->save();
        redirect_to("budget.php?$links");
        $session->message("
            <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
              <strong><i class='mdi mdi-check'></i></strong> Successfully added.
              <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
              </button>
            </div>");
    }


?>
<?php $users_profile = Users::find_by_id($_SESSION['id']); ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Add New Events - Administrator</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/dashboard.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://cdn.materialdesignicons.com/2.1.19/css/materialdesignicons.min.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
        <link rel="stylesheet" href="../css/bootstrap-datepicker.css">
        <style>
            body {
                margin-bottom: 2%;
            }
            .box-shadow {
                box-shadow: 0 0 2px 2px rgba(0, 0, 0, 0.3);
                font-size: 12px;
            }
            .form-control {
                font-size: 12px;
            }
            
        </style>
    </head>

<body>

<?php include_once 'include/sidebar.php'; ?>

    <div class="container">
  
        <div class="row">

            <div class="col-lg-8 offset-2 pl-3 pb-3 box-shadow mt-4">
            
                <form method="post" action="">

                    <h4 class="h4 mt-4 pb-2" style="border-bottom: 1px solid #dee2e6!important;">Add Budget </h4>

                    <?= ($session->message()) ? $session->message() : ''; ?>

                     <div class="form-group">
                        <label for="event_id">Event To Related: <?= $groom ?></label>
                        
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="payment">Payment:</label>
                        <input type="text" name="payment" class="form-control" id="payment"  placeholder="Payment">
                    </div>

                    


                    <a href="budget.php?<?=$links; ?>" class="btn btn-sm btn-danger float-right" style="font-size: 12px;">Cancel</a>
                    <button type="submit" name="submit" class="btn btn-sm btn-success float-right mr-2" style="font-size: 12px;">Save</button>

                </form><!-- end of input form -->
            </div>
        </div>
    </div>



<?php include_once 'include/footer.php';?>
