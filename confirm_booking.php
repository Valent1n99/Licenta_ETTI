<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hotel - Confirm Booking</title>

  <?php
     session_start();
      // Includerea unui fișier PHP folosind require
      require('/Applications/XAMPP/xamppfiles/htdocs/Licenta/inc/links.php');
      ?>
  <style>
    <?php require('css/common.css') ?>
  </style>
    <script src="https://www.paypal.com/sdk/js?client-id=Affjhan8N_RRJ7LLaRrzr12GZXW18rOxY9waootOVgTOkN9uZL5Cu3dUCPzmIYRpOcYyGzM_v6Q0W6Sb"></script>

</head>



<body class="bg-light">

    <?php 
      // Includerea unui fișier PHP folosind require
      require('inc/header.php');
    ?>

<?php


    if(!isset($_GET['id']) || $Settings_r['shutdown']==true){
      redirect('rooms.php');
    }
    else if(!(isset($_SESSION['login']) && $_SESSION['login']==true)){
        redirect('rooms.php');
      }

    $data = filteration($_GET);

    $room_res = select("SELECT * FROM `rooms` WHERE `id`=? AND `status`=? AND `removed`=?",[$data['id'],1,0],'iii');

    if(mysqli_num_rows($room_res)==0){
      redirect('rooms.php');
    }

    $room_data = mysqli_fetch_assoc($room_res);
    $_SESSION['room'] = [
        "id" => $room_data['id'],
        "name" => $room_data['name'],
        "price" => $room_data['price'],
        "payment" => null,
        "available" => false,
      ];
      ///print_r($_SESSION['room']);
      
      $user_res = select("SELECT * FROM `user_crew` WHERE `id`=? LIMIT 1", [$_SESSION['uId']], "i");
      $user_data = mysqli_fetch_assoc($user_res);

    

    
  ?>





  <div class="container">
    <div class="row">

      <div class="col-12 my-5 mb-4 px-4">
        <h2 class="fw-bold"><?php echo $room_data['name']?></h2>
        <div style="font-size: 14px;">
          <a href="index.php" class="text-secondary text-decoration-none">HOME</a>
         <span class="text-secondary"> > </span>
          <a href="rooms.php" class="text-secondary text-decoration-none">ROOMS</a>
          <span class="text-secondary"> > </span>
          <a href="#" class="text-secondary text-decoration-none">CONFIRM</a>
        </div> 
      </div>

      <div class="col-lg-7 col-md-12 px-4">
        <?php 

          $room_thumb = ROOMS_IMG_PATH."thumbnail.jpg";
          $thumb_q = mysqli_query($con,"SELECT * FROM `room_images` 
            WHERE `room_id`='$room_data[id]' 
            AND `thumb`='1'");

          if(mysqli_num_rows($thumb_q)>0){
            $thumb_res = mysqli_fetch_assoc($thumb_q);
            $room_thumb = ROOMS_IMG_PATH.$thumb_res['image'];
          }

          echo<<<data
            <div class="card p-3 shadow-sm rounded">
              <img src="$room_thumb" class="img-fluid rounded mb-3">
              <h5>$room_data[name]</h5>
              <h6>$$room_data[price] per night</h6>
            </div>
          data;

        ?>
      </div>

      <div class="col-lg-5 col-md-12 px-4">
        <div class="card mb-4 border-0 shadow-sm rounded-3">
          <div class="card-body">
            <form action="pay_now.php" method="POST" id="booking_form">
              <h6 class="mb-3">BOOKING DETAILS</h6>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label">Name</label>
                  <input name="name" id="name" type="text" value="<?php echo $user_data['name'] ?>" class="form-control shadow-none" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">Phone Number</label>
                  <input name="phonenum" id="phonenum" type="number" value="<?php echo $user_data['phonenum'] ?>" class="form-control shadow-none" required>
                </div>
                <div class="col-md-12 mb-3">
                  <label class="form-label">Address</label>
                  <textarea name="address" id="address" class="form-control shadow-none" rows="1" required><?php echo $user_data['address'] ?></textarea>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">Check-in</label>
                  <input name="checkin" id="checkin" onchange="check_availability()" type="date" class="form-control shadow-none" required>
                </div>
                <div class="col-md-6 mb-4">
                  <label class="form-label">Check-out</label>
                  <input name="checkout" id="checkout" onchange="check_availability()" type="date" class="form-control shadow-none" required>
                </div>
                
                <div class="col-12">
                  <div class="spinner-border text-info mb-3 d-none" id="info_loader" role="status">
                    <span class="visually-hidden">Loading...</span>
                  </div>

                  <h6 class="mb-3 text-danger" id="pay_info">Provide check-in & check-out date !</h6>

                  <button name="pay_now" class="btn w-100 text-white custom-bg shadow-none mb-1" disabled>Pay Now</button>
                  <div id="paypal-button-container"  class="mt-2"></div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="col-12 mt-4 px-4">
        <div class="mb-5">
          <h5>Description</h5>
          <p>
            <?php echo $room_data['description'] ?>
          </p>
        </div>

        
      </div>

    </div>
  </div>


    <?php
      // Includerea unui fișier PHP folosind require
      require('/Applications/XAMPP/xamppfiles/htdocs/Licenta/inc/footer.php');
      ?>









<script>


let booking_form = document.getElementById('booking_form');
let info_loader = document.getElementById('info_loader');
let pay_info = document.getElementById('pay_info');

function check_availability()
{
  let checkin_val = booking_form.elements['checkin'].value;
  let checkout_val = booking_form.elements['checkout'].value;

  booking_form.elements['pay_now'].setAttribute('disabled',true);

  if(checkin_val!='' && checkout_val!='')
  {
    pay_info.classList.add('d-none');
    pay_info.classList.replace('text-dark','text-danger');
    info_loader.classList.remove('d-none');

    let data = new FormData();

    data.append('check_availability','');
    data.append('check_in',checkin_val);
    data.append('check_out',checkout_val);

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/confirm_booking.php",true);

    xhr.onload = function()
    {
      let data = JSON.parse(this.responseText);

      if(data.status == 'check_in_out_equal'){
        pay_info.innerText = "You cannot check-out on the same day!";
      }
      else if(data.status == 'check_out_earlier'){
        pay_info.innerText = "Check-out date is earlier than check-in date!";
      }
      else if(data.status == 'check_in_earlier'){
        pay_info.innerText = "Check-in date is earlier than today's date!";
      }
      else if(data.status == 'unavailable'){
        pay_info.innerText = "Room not available for this check-in date!";
      }
      else{
        pay_info.innerHTML = "No. of Days: "+data.days+"<br>Total Amount to Pay: $"+data.payment;
        pay_info.classList.replace('text-danger','text-dark');
        booking_form.elements['pay_now'].removeAttribute('disabled');
      }

      pay_info.classList.remove('d-none');
      info_loader.classList.add('d-none');
    }

    xhr.send(data);
  }

}

</script>

<script>
        paypal.Buttons({
          createOrder: function(data, actions) {
                // Setează suma totală de plată (prețul calculat anterior în PHP)
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            currency_code: 'USD', // Schimbă cu moneda ta, dacă este necesar
                        value: document.getElementById('pay_info').innerText.split('$')[1].replace(',', '').trim()
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                // Captura comanda după ce a fost aprobată
                return actions.order.capture().then(function(details) {
                    alert('Transaction completed by ' + details.payer.name.given_name);
                    
                    var transactionData = {
                        name: document.getElementById('name').value,
                        checkin: document.getElementById('checkin').value,
                        checkout: document.getElementById('checkout').value,
                        phonenum: document.getElementById('phonenum').value,
                        address: document.getElementById('address').value,
                        orderId: data.orderID,
                        payerId: data.payerID,
                        payerName: details.payer.name.given_name + ' ' + details.payer.name.surname,
                        payerEmail: details.payer.email_address,
                        status: details.status
                    };

                    // Trimite datele tranzacției către server
                    return fetch('pay_now1.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(transactionData)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log('Transaction data saved successfully');
                            alert('success','Transaction data saved!');
                        } else {
                            console.error('Failed to save transaction data');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                });
            },
            onError: function(err) {
                console.error(err);
                alert('An error occurred during the transaction. Please try again.');
            }
        }).render('#paypal-button-container');
    </script>




  
</body>

</html>