<?php

class Dvd extends Product
{
  private $size;

  public function getDvdSize()
  {
    return $this->size;
  }

  public function setDvdSize($size)
  {
    $this->size = $size;
  }

  public function insertDvdData()
  {
    $conn = $this->connect();

    $sql = "INSERT INTO products(sku, name, price, type, size) VALUES (:sku, :name, :price, :type, :size)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':sku', $this->sku);
    $stmt->bindParam(':name', $this->name);
    $stmt->bindParam(':price', $this->price);
    $stmt->bindParam(':type', $this->type);
    $stmt->bindParam(':size', $this->size);

    
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