<?php
// Activați afișarea erorilor pentru depanare
error_reporting(E_ALL);
ini_set('display_errors', 1);

require('/Applications/XAMPP/xamppfiles/htdocs/Licenta/admin/inc/db_config.php');
require('/Applications/XAMPP/xamppfiles/htdocs/Licenta/admin/inc/essentials.php');



// Setează antetele pentru răspunsul JSON

session_start();
$ORDER_ID = 'ORD_'.$_SESSION['uId'].random_int(11111,9999999);    
$CUST_ID = $_SESSION['uId'];
///$INDUSTRY_TYPE_ID = INDUSTRY_TYPE_ID;
///$CHANNEL_ID = CHANNEL_ID;
$TXN_AMOUNT = $_SESSION['room']['payment'];

//print_r($ORDER_ID);

header('Content-Type: application/json');
// Preia datele JSON trimise de la client
$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
      

    // Extrage datele din obiectul JSON
    $name = $data['name'] ?? '';
    $phonenum = $data['phonenum'] ?? '';
    $address = $data['address'] ?? '';

    $checkin = $data['checkin'] ?? '';
    $checkout = $data['checkout'] ?? '';
    $transId = $data['orderId'] ?? '';
    $payerId = $data['payerId'] ?? '';
    $payerName = $data['payerName'] ?? '';
    $payerEmail = $data['payerEmail'] ?? '';
    $status = $data['status'] ?? '';
    $booking_status = ($status == "COMPLETED") ? "booked" : "payment failed";




    $query1 = "INSERT INTO `booking_order`(`user_id`, `room_id`, `check_in`, `check_out`,`order_id`, `trans_amt`,`booking_status`,`trans_id`, `trans_status`) VALUES (?,?,?,?,?,?,?,?,?)";

    insert($query1,[$CUST_ID,$_SESSION['room']['id'],$checkin,
    $checkout,$ORDER_ID,$TXN_AMOUNT,$booking_status,$transId,$status],'issssssss');

    $booking_id = mysqli_insert_id($con);

    $query2 = "INSERT INTO `booking_details`(`booking_id`, `room_name`, `price`, `total_pay`,
      `user_name`, `phonenum`, `address`) VALUES (?,?,?,?,?,?,?)";

    insert($query2,[$booking_id,$_SESSION['room']['name'],$_SESSION['room']['price'],
      $TXN_AMOUNT,$name,$phonenum,$address],'issssss');
    
    echo json_encode(['success' => true]);  
} 
else {
    // Răspunde cu un mesaj de eroare dacă nu s-au primit date
    echo json_encode(['success' => false, 'error' => 'No data received']);
}
?>
