<?php
    require('/Applications/XAMPP/xamppfiles/htdocs/Licenta/admin/inc/db_config.php');
    require('/Applications/XAMPP/xamppfiles/htdocs/Licenta/admin/inc/essentials.php');
    adminLogin();



    if(isset ($_POST ['get_general']))
    {
    $q = "SELECT * FROM `Settings` WHERE `crt_no`=?";
    $values = [1];
    $res = select ($q, $values, "i");
    $data = mysqli_fetch_assoc($res);
    $json_data = json_encode ($data);
    echo $json_data;
    }

    
    if(isset($_POST['upd_general']))
    {
    $frm_data = filteration($_POST);
    $q = "UPDATE `Settings` SET `site_title`=?, `site_about`=? WHERE `crt_no`=?";
    $values = [$frm_data['site_title'], $frm_data['site_about'], 1];
    $res = update($q, $values, 'ssi');
    echo $res;
    }
    

    if(isset($_POST['upd_shutdown']))
    {
      $frm_data = ($_POST['upd_shutdown']==0) ? 1 : 0;
  
      $q = "UPDATE `Settings` SET `shutdown`=? WHERE `crt_no`=?";
      $values = [$frm_data,1];
      $res = update($q,$values,'ii');
      echo $res;
    }
  
 
  
   
?>