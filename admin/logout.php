<?php
require('/Applications/XAMPP/xamppfiles/htdocs/Licenta/admin/inc/essentials.php');

session_start();
session_destroy();
redirect('index.php');

?>