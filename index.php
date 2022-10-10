<?php
require_once 'includes/init.php';
$conn = require 'includes/db.php';
$test = new Test();
$categories = $test->getCategoriesTree($conn);
echo '<pre>';
print_r($categories);
