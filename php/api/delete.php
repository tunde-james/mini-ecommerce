<?php

require_once './models/dbh.class.php';
require_once './models/product.class.php';
require_once './models/book.class.php';
require_once './models/dvd.class.php';

$objDb = new Dbh;
$conn = $objDb->connect();

$data = json_decode(file_get_contents('php://input'));

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'DELETE') {
  
  $path = explode('/', $_SERVER['REQUEST_URI']);
  $action = $path[2];
  // die($action);
  // die(json_encode($data));
  if ( $action ==  'delete') {
    foreach($data->id AS $pid) {
      $id = (int) $pid;
      $objDb->delete($id);
    }
      
    $products = $objDb->getAll();
    die(json_encode($products));
  }
}
