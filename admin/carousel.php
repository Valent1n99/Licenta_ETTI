<?php
require('/Applications/XAMPP/xamppfiles/htdocs/Licenta/admin/inc/essentials.php');
adminLogin();
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel - Carousel</title>
  <?php require('inc/links.php'); ?>

  <style>
    <?php require('css/common.css'); ?>
  </style>
</head>

<body class="bg-light">
  <?php require('inc/header.php'); ?>

<!-- Carousel section-->
  <div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h5 class="card-title m-0">Images</h5>
            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#carousel-s">
                <i class="bi bi-plus-square"></i> Add
            </button>
        </div>
        <div class="row" id="carousel-data"></div>
    </div>
  </div>
<!-- Carousel modal-->
<div class="modal fade" id="carousel-s" tabindex="-1" aria-labelledby="staticBackdrop" aria-hidden="true">
              <div class="modal-dialog">
                <form id="carousel_s_form">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">General Settings</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="mb-3">
                      <label class="form-label">Site Title</label>
                      <input type="text" name="site_title" id="site_title_inp" class="form-control shadow-none">
                    </div>
                    <div class="mb-3">
                      <label class="form-label">About</label>
                      <textarea name="site_about" id="site_about_inp" class="form-control shadow-none" rows="5"></textarea>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" onclick="resetFields()" class="btn btn-secondary shadow-none" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn custom-bg text-white shadow-none" onclick="upd_general(site_title_inp.value,site_about_inp.value)">Submit</button>
                  </div>
                </div>
                </form>
                
              </div>
            </div>













  <?php require('inc/scripts.php'); ?>
  <script src="scripts/settings.js"></script>









</body>

</html>
