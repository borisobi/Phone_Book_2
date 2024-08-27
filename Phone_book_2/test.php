<?php

class Database {
  private $servername;
  private $username;
  private $password;
  private $dbname;
  private $conn;

  public function __construct($servername, $username, $password, $dbname) {
    $this->servername = $servername;
    $this->username = $username;
    $this->password = $password;
    $this->dbname = $dbname;
  }

  public function connect() {
    $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
    if ($this->conn->connect_error) {
      die("Connection failed: " . $this->conn->connect_error);
    }
  }

  public function query($sql) {
    return $this->conn->query($sql);
  }
}

class Contact {
  private $id;
  private $name;
  private $email;
  private $phone;
  private $category;

  public function __construct($id, $name, $email, $phone, $category) {
    $this->id = $id;
    $this->name = $name;
    $this->email = $email;
    $this->phone = $phone;
    $this->category = $category;
  }

  public function getId() {
    return $this->id;
  }

  public function getName() {
    return $this->name;
  }

  public function getEmail() {
    return $this->email;
  }

  public function getPhone() {
    return $this->phone;
  }

  public function getCategory() {
    return $this->category;
  }
}

class ContactManager {
  private $database;

  public function __construct(Database $database) {
    $this->database = $database;
  }

  public function getAllContacts() {
    $sql = "SELECT * FROM contacts";
    $result = $this->database->query($sql);
    $contacts = [];
    while ($row = $result->fetch_assoc()) {
      $contacts[] = new Contact($row['id'], $row['name'], $row['email'], $row['phone'], $row['category']);
    }
    return $contacts;
  }
}

class View {
  public function displayContacts(array $contacts) {
    // ... HTML code to display contacts ...
  }
}

// Usage:
$database = new Database("localhost", "root", "", "phonebookapp");
$database->connect();

$contactManager = new ContactManager($database);
$contacts = $contactManager->getAllContacts();

$view = new View();
$view->displayContacts($contacts);