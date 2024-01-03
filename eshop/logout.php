<?php
include('../admin/include/connect.php');
session_start();
if (!empty($_SESSION['uemail'])) {
    session_destroy();
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
