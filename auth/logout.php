<?php
<?php
require_once "../config/koneksi.php";
require_once "UserController.php";

$userController = new UserController($koneksi);
$userController->logout();