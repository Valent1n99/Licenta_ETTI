<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hotel - About</title>
  <?php
 
// Includerea unui fișier PHP folosind require
require('inc/links.php');
?>
   <style>
    .pop:hover{
      border-top-color: var(--teal) !important;
      transform: scale(1.03);
      transition: all 0.3s;

    }
    

   </style>
</head>


  <?php
// Includerea unui fișier PHP folosind require
require('inc/header.php');
?>
 

  <div class="my-5 px-4">
    <h2 class="fw-bold h-font text-center">ABOUT US</h2>
    <div class="h-line bg-dark"></div>
        <?php 
              $res = selectAll('Settings');
                  

              while ($row = mysqli_fetch_assoc($res)) {
                echo <<<HTML
                <div class="container align-center ">
                    <div class="content">
                        <p>{$row['site_about']}</p>              
                    </div>
                </div>
                HTML;
            }
        ?>
 </div>

<div class="container">
  <div class="row">
    <div class="col-lg-6 col-md-5 mb-5 mb-4 order-lg-1 order-md-1 order-2">    
      <h3 class="mb-3">Lorem ipsum dolor sit</h3>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. 
        Beatae aut corrupti quae? Explicabo ducimus quo laudantium.
      </p>
    </div>
   

  </div>
</div>
<div class="container mt-5">
  <div class="row">
    <div class="col-lg-3 col-md-6 mb-4 px-4">
      <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
        <img src="images/about/hotel.svg" width="70px">
        <h4 class="mt-3">100+ ROOMS</h4>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-4 px-4">
      <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
        <img src="images/about/customers.svg" width="70px">
        <h4 class="mt-3">200+ CUSTOMERS</h4>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-4 px-4">
      <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
        <img src="images/about/rating.svg" width="70px">
        <h4 class="mt-3">150+ REVIEWS</h4>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-4 px-4">
      <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
        <img src="images/about/staff.svg" width="70px">
        <h4 class="mt-3">200+ STAFF</h4>
      </div>
    </div>
  </div>
</div>
 


<?php
// Includerea unui fișier PHP folosind require
require('inc/footer.php');
?>


    





</body>

</html>