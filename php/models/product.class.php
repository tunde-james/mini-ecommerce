<?php

abstract class Product extends Dbh
{
  protected $sku;
  protected $name;
  protected $price;
  protected $type;

  public function __construct($product)
  {
    $this->sku = $product->sku;
    $this->name = $product->name;
    $this->price = $product->price;
    $this->type = $product->type;
  }

  public function getProductSku()
  {
    return $this->sku;
  }

  public function setProductSku($sku)
  {
    $this->sku = $sku;
  }

  public function getProductName()
  {
    return $this->name;
  }

  public function setProductName($name)
  {
    $this->name = $name;
  }

  public function getProductPrice()
  {
    return $this->price;
  }

  public function setProductPrice($price)
  {
    $this->price = $price;
  }

  public function getProductType()
  {
    return $this->type;
  }

  public function setProducType($type)
  {
    $this->type = $type;
  }
  
}