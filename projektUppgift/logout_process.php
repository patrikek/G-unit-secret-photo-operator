<?php
require_once 'include/init.php';

$store = new Store();
$store->logout();

Redirect::to('index.php');
?>