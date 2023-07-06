<?php

class Liquidation extends DB_Object
{
    protected static $db_table = "tbl_liquidation";
    protected static $db_table_fields = array(
        'id',
        'booking_id',
        'user_id',
        'payment',
        'cash_advanced',
        'credit',
        'date_modified',
        'cash',
    );

    public $id;
    public $booking_id;
    public $user_id;
    public $payment;
    public $cash_advanced;
    public $credit;
    public $date_modified;
    public $cash;


    public static function find_by_liquadate_all($id) {
        return static::find_by_query("SELECT * FROM " . static::$db_table . " WHERE booking_id = $id ORDER BY booking_id DESC");
    }
    
    public static function getTotalAmountCash_new($booking_id, $payment) {
        global $db;
        $sql = "SELECT cash FROM " . static::$db_table . " WHERE booking_id = $booking_id ORDER BY id DESC LIMIT 1";
        $result_count = $db->query($sql);
        $row = mysqli_fetch_array($result_count);
    
        $previousCash = $row['cash'];
        $newCash = $previousCash + $payment;
    
        return $newCash;
    }
public static function getCash($booking_id){
    global $db;
        $sql = "SELECT cash FROM " . static::$db_table . " WHERE booking_id = $booking_id ORDER BY id DESC LIMIT 1";
        $result_count = $db->query($sql);
        $row = mysqli_fetch_array($result_count);
        return $row['cash'];
}    

   

public static function getAllLiquidationsByBookingID($booking_id)
{
    $the_result_array = static::find_by_query("SELECT * FROM tbl_liquidation WHERE booking_id = $booking_id");
    return $the_result_array;
}

    
    public static function getCreditValue($booking_id) {
        global $db; 
    
        
        $sql = "SELECT credit
                FROM tbl_liquidation
                WHERE booking_id = $booking_id
                ORDER BY id DESC
                LIMIT 1";
    
        
        $result = $db->query($sql);
    
        
        if ($result && $result->num_rows > 0) {
            
            $row = $result->fetch_assoc();
            $credit = $row['credit'];
    
            
            $result->free_result();
    
            
            return $credit;
        }
    
       
        return null;
    }
    public static function getCashAdValue($booking_id) {
        global $db; 
    
        
        $sql = "SELECT cash_advanced
                FROM tbl_liquidation
                WHERE booking_id = $booking_id
                ORDER BY id DESC
                LIMIT 1";
    
        
        $result = $db->query($sql);
    
        
        if ($result && $result->num_rows > 0) {
            
            $row = $result->fetch_assoc();
            $cash_advanced = $row['cash_advanced'];
    
            
            $result->free_result();
    
            
            return $cash_advanced ;
        }
    
       
        return null;
    }
    
   
  
}

?>


