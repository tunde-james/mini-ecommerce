<?php

class Furniture extends Product
{
  private $height;
  private $width;
  private $length;

  public function getFurnitureHeight()
  {
    return $this->height;
  }

  public function setFurnitureHeight($height)
  {
    
    $this->height = $height;
  }

  public function getFurnitureWidth()
  {
    return $this->width;
  }

  public function setFurnitureWidth($width)
  {
    
    $this->width = $width;
  }

  public function getFurnitureLength()
  {
    return $this->length;
  }

  public function setFurnitureLength($length)
  {
    
    $this->length = $length;
  }

  public function insertFurnitureData()
  {
    $conn = $this->connect();

    $sql = "INSERT INTO products(sku, name, price, type, height, width, length) VALUES (:sku, :name, :price, :type, :height, :width, :length)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':sku', $this->sku);
    $stmt->bindParam(':name', $this->name);
    $stmt->bindParam(':price', $this->price);
    $stmt->bindParam(':type', $this->type);
    $stmt->bindParam(':height', $this->height);
    $stmt->bindParam(':width', $this->width);
    $stmt->bindParam(':length', $this->length);

    $MYSQL_DUPLICATE_CODES= array(1062,23000);
    try {
      if ($stmt->execute()) {
        $response = ['status' => 1, 'message' => 'Record created successfully.'];
      } else {
        $response = ['status' => 0, 'message' => 'Failed to create record.'];
      }
      return $response;
    } catch (PDOException $e) {
      if (in_array($e->getCode(), $MYSQL_DUPLICATE_CODES)) {
        die(json_encode(['status'=>"error", "payload"=>"Sku value already exists"]));
      }
    }
  }
}