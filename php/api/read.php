<?php

require_once './models/dbh.class.php';
require_once './models/product.class.php';
require_once './models/book.class.php';
require_once './models/dvd.class.php';

$objDb = new Dbh;
$conn = $objDb->connect();

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'GET') {
  $path = explode('/', $_SERVER['REQUEST_URI']);
  if (isset($path[2]) && is_numeric($path[2])) {
    die(json_encode($objDb->getSingle($path[2])));
  } else {
    echo json_encode($objDb->getAll());
  }
}
