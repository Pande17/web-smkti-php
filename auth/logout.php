<?php
require_once "../config/koneksi.php";
require_once "../controller/UserController.php";

$userController = new UserController($koneksi);
$userController->logout();
exit;
?>