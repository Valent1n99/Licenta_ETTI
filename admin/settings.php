<?php
require('/Applications/XAMPP/xamppfiles/htdocs/Licenta/admin/inc/db_config.php');
require('/Applications/XAMPP/xamppfiles/htdocs/Licenta/admin/inc/essentials.php');
adminLogin();
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel - Settings</title>
  <?php require('inc/links.php'); ?>


  <style>
    <?php 
     require('css/common.css')
    ?>
  </style>

</head>

<body class="bg-light">

  <?php require('inc/header.php'); ?>

  <div class="container-fluid" id="main-content">
  <div class="row">
          <div class="col-lg-10 ms-auto p-4 overflow-hidden">
            <h3 class="mb-4">SETTINGS</h3>

            <!-- General settings section -->

            <div class="card border-0 shadow-sm mb-4">
              <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3">
                  <h5 class="card-title m-0">General Settings</h5>
                  <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal"
                    data-bs-target="#general-s">
                    <i class="bi bi-pencil-square"></i> Edit
                  </button>
                </div>
                <h6 class="card-subtitle mb-1 fw-bold">Site Title</h6>
                <p class="card-text" id="site_title"></p>
                <h6 class="card-subtitle mb-1 fw-bold">About us</h6>
                <p class="card-text" id="site_about"></p>
              </div>
            </div>

            <!-- General settings modal -->

            <div class="modal fade" id="general-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
              aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog">
                <form id="general_s_form">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">General Settings</h5>
                    </div>
                    <div class="modal-body">
                      <div class="mb-3">
                        <label class="form-label fw-bold">Site Title</label>
                        <input type="text" name="site_title" id="site_title_inp" class="form-control shadow-none"
                          required>
                      </div>
                      <div class="mb-3">
                        <label class="form-label fw-bold">About us</label>
                        <textarea name="site_about" id="site_about_inp" class="form-control shadow-none" rows="6"
                          required></textarea>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button"
                        onclick="site_title.value = general_data.site_title, site_about.value = general_data.site_about"
                        class="btn text-secondary shadow-none" data-bs-dismiss="modal">CANCEL</button>
                      <button type="submit" class="btn custom-bg text-white shadow-none">SUBMIT</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>

            <!-- Shutdown section -->
            <div class="card border-0 shadow-sm mb-4">
              <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3">
                  <h5 class="card-title m-0">Shutdown Website</h5>
                  <div class="form-check form-switch">
                    <form>
                      <input onchange="upd_shutdown(this.value)" class="form-check-input" type="checkbox"
                        id="shutdown-toggle">
                    </form>
                  </div>
                </div>
                <p class="card-text">
                  No customers will be allowed to book hotel room, when shutdown mode is turned on.
                </p>
              </div>
            </div>


          </div>
</div>

  </div>
        
        
        <?php require('inc/scripts.php');?>
        <script src="scripts/settings.js"></script>









</body>

</html>