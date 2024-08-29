<?php
class Database {
  private $conn;

  public function __construct($servername, $username, $password, $dbname) {
    $this->conn = new mysqli($servername, $username, $password, $dbname);
    if ($this->conn->connect_error) {
      die("Connection failed: " . $this->conn->connect_error);
    }
  }

  public function getContacts() {
    $sql = "SELECT * FROM contacts";
    $result = $this->conn->query($sql);
    if (!$result) {
      die("Invalid query: " . $this->conn->error);
    }
    return $result;
  }
}

class ContactView {
  public function renderContactRow($row) {
    $image_width = "50px"; 
    return "
      <tr>
        <td>{$row['id']}</td>
        <td>{$row['name']}</td>
        <td>{$row['email']}</td>
        <td>{$row['phone']}</td>
        <td>{$row['category']}</td>
        <td><img src='{$row["image"]}' alt='{$row["name"]}' style='width: {$image_width};'></td>
        <td class='text-right'>  <a class='btn btn-primary' href='/Phone_book_2/edit.php?id={$row['id']}'>Edit</a> 
          <a class='btn btn-danger' href='/Phone_book_2/Delete.php?id={$row['id']}'>Delete</a>
        </td>
      </tr>
    ";
  }
}

$db = new Database("localhost", "root", "", "phonebookapp");
$view = new ContactView();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Phone Book App</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <style>


    /* CSS for table layout  */
    table {
      width: 100%;  
    th, td {
      padding: 10px; 
    }
  </style>
</head>
<body>
  <div class="container my-5">
    <nav class="navbar bg-primary" data-bs-theme="dark">
      </nav>

      
    <h1>MY PHONEBOOK APP</h1> <br>
    <br>
    
    <h2>List of Contacts</h2>
    <br>
    <a class='btn btn-primary' href='/Phone_book_2/create.php'>Add new contact</a>
    <br> <br><br>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Phone</th>
          <th scope="col">Category</th>
          <th scope="col">Image</th>
          <th scope="col" class="text-right">Action</th> </tr>
      </thead>
      <tbody>
        <?php
        $contacts = $db->getContacts();
        while ($row = $contacts->fetch_assoc()) {
          echo $view->renderContactRow($row);
        }
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>