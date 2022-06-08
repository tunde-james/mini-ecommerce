<?php

class Dbh
{
  private $host = 'localhost';
  private $user = 'root';
  private $pwd = '';
  private $dbname = 'mini_ecommerce';
  private $model = 'products';

  public function connect()
  {
    $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
    $pdo = new PDO($dsn, $this->user, $this->pwd);
    return $pdo;
  }

  public function getSingle($id)
  {
    $conn = $this->connect();
    $sql = "SELECT * FROM " . $this->model . "WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    return $product;
  }

  public function getAll()
  {
    $conn = $this->connect();
    $sql = "SELECT * FROM " . $this->model;
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $products;
  }
  
  public function delete($id) 
  {
    $conn = $this->connect();
    $sql = "DELETE FROM " . $this->model . " WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
  }
} 