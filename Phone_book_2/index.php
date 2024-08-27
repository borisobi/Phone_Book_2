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
        return "
            <tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['email']}</td>
                <td>{$row['phone']}</td>
                <td>{$row['category']}</td>
                <td><img src='{$row["image"]}' class='mw-10' style='width: 10%;'></td>
                <td>
                    <a class='btn btn-primary' href='/Phone_book_2/edit.php?id={$row['id']}'>Edit</a> 
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
</head>
<body>
    <div class="container my-5">
        <h1>MY PHONEBOOK APP</h1> <br>
        <h2>List of Contacts</h2>
        <br>
        <a class='btn btn-primary' href='/Phone_book_2/create.php'>Add new contact</a>
        <br> <br><br>
        <table class="table">
            <thead>
                <tr>
                    <img src="" alt="">
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
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