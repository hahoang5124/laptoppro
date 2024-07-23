<?php
include_once "../model/m_admin.php";
session_start();
update_quantity_by_cart($_POST['id'],$_POST['quantity']);
?>