<?php
session_start();

require_once './models/dbh.class.php';
require_once './models/product.class.php';
require_once './models/book.class.php';
require_once './models/dvd.class.php';
require_once './models/furniture.class.php';

$objDb = new Dbh;

$data = json_decode(file_get_contents('php://input'));

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'POST') {
  if (empty($data->sku)) {
    die(json_encode(['status'=>"error", "payload"=>"Please enter the product sku"]));
  }

  if (empty($data->name)) {
    die(json_encode(['status'=>"error", "payload"=>"Please enter a product name"]));
  }

  if (empty($data->price)) {
    die(json_encode(['status'=>"error", "payload"=>"Please enter a product price"]));
  }

  if (!is_numeric($data->price)) {
    die(json_encode(['status'=>"error", "payload"=>"Product price must be a valid numeric amount"]));
  }

  if (empty($data->type)) {
    die(json_encode(['status'=>"error", "payload"=>"Please select a product type"]));
  }
    
  if ($data->type == 'book') {
    $product = new Book($data);

    $product->setProductSku($data->sku);
    $product->setProductName($data->name);
    $product->setProductPrice($data->price);
    $product->setProducType($data->type);
    $product->setBookWeight($data->weight);

    if (empty($data->weight)) {
      die(json_encode(['status'=>"error", "payload"=>"Please enter the book weight"]));
    } 

    if (!is_numeric($data->weight)) {
      die(json_encode(['status'=>"error", "payload"=>"Book weight must be a valid numeric value"]));
    } 

    echo json_encode($product->insertBookData());
  } else if ($data->type == 'dvd') {
    $product = new Dvd($data);

    $product->setProductSku($data->sku);
    $product->setProductName($data->name);
    $product->setProductPrice($data->price);
    $product->setProducType($data->type);
    $product->setDvdSize($data->size);

    if (empty($data->size)) {
      die(json_encode(['status'=>"error", "payload"=>"Please enter the dvd size"]));
    } 

    if (!is_numeric($data->size)) {
      die(json_encode(['status'=>"error", "payload"=>"Dvd size must be a valid numeric value"]));
    } 

    echo json_encode($product->insertDvdData());
  } else if ($data->type == 'furniture') {
    $product = new Furniture($data);

    $product->setProductSku($data->sku);
    $product->setProductName($data->name);
    $product->setProductPrice($data->price);
    $product->setProducType($data->type);
    $product->setFurnitureHeight($data->height);
    $product->setFurnitureWidth($data->width);
    $product->setFurnitureLength($data->length);

    if (empty($data->height)) die(json_encode(['status'=>"error", "payload"=>"Please enter the furniture height"]));

    if (!is_numeric($data->height)) die(json_encode(['status'=>"error", "payload"=>"Furniture height must be a valid numeric value"]));

    if  (empty($data->width)) die(json_encode(['status'=>"error", "payload"=>"Please enter the furniture width"]));

    if  (!is_numeric($data->width)) die(json_encode(['status'=>"error", "payload"=>"Furniture width must be a valid numeric value"]));

    if  (empty($data->length)) die(json_encode(['status'=>"error", "payload"=>"Please enter the furniture length"]));

    if  (!is_numeric($data->length)) die(json_encode(['status'=>"error", "payload"=>"Furniture length must be a valid numeric value"]));
    
    echo json_encode($product->insertFurnitureData());
  }
} else {
  null;
}