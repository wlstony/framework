<?php
require './system/view.php';

$p = $_GET['p'];
var_dump($p);
View::show('index');
