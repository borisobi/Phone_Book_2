<?php
// Database class to handle database connections and operations
class Database {
    private $conn;

    // Constructor to establish database connection
    public function __construct($servername, $username, $password, $dbname) {
        $this->conn = new mysqli($servername, $username, $password, $dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Method to insert a new contact into the database
    public function insertContact($name, $email, $phone, $category, $image) {
        $sql = "INSERT INTO contacts(name, email, phone, category, image) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssss", $name, $email, $phone, $category, $image);
        return $stmt->execute();
    }
}

// ContactForm class to handle form submission and validation
class ContactForm {
    private $name = "";
    private $email = "";
    private $phone = "";
    private $category = "";
    private $image = "";
    private $errorMessage = "";
    private $successMessage = "";

    // Method to handle form submission
    public function handleSubmission($db) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize and store form inputs
            $this->name = $this->sanitizeInput($_POST["name"]);
            $this->email = $this->sanitizeInput($_POST["email"]);
            $this->phone = $this->sanitizeInput($_POST["phone"]);
            $this->category = $this->sanitizeInput($_POST["category"]);

            // Validate input and handle image upload
            if ($this->validateInput()) {
                $this->handleImageUpload();
                if (empty($this->errorMessage)) {
                    // Insert contact into database
                    if ($db->insertContact($this->name, $this->email, $this->phone, $this->category, $this->image)) {
                        $this->successMessage = "New contact created successfully!";
                        $this->resetForm();
                        header("location: /Phone_book_2/index.php");
                        exit;
                    } else {
                        $this->errorMessage = "Error inserting contact into database.";
                    }
                }
            }
        }
    }

    // Method to sanitize input data
    private function sanitizeInput($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    // Method to validate input data
    private function validateInput() {
        if (empty($this->name) || empty($this->email) || empty($this->phone) || empty($this->category)) {
            $this->errorMessage = "All fields are required.";
            return false;
        }
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->errorMessage = "Please enter a valid email address.";
            return false;
        }
        return true;
    }

    // Method to handle image upload
    private function handleImageUpload() {
        if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
            $filename = $_FILES["image"]["name"];
            $filetype = $_FILES["image"]["type"];
            $filesize = $_FILES["image"]["size"];

        // Check if file extension is allowed
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            
            if(!array_key_exists($ext, $allowed)) {
                $this->errorMessage = "Error: Please select a valid file format.";
                return;
            }
        
            // Check file size (max 5MB)
            $maxsize = 5 * 500 * 500;
            if($filesize > $maxsize) {
                $this->errorMessage = "Error: File size is larger than the allowed limit.";
                return;
            }
        
            // Upload file if it's valid
            if(in_array($filetype, $allowed)) {
                if(file_exists("uploads/" . $filename)) {
                    $this->errorMessage = $filename . " already exists.";
                } else {
                    move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/" . $filename);
                    $this->image = "uploads/" . $filename;
                } 
            } else {
                $this->errorMessage = "Error: There was a problem uploading your file. Please try again."; 
            }
        }
    }

    // Method to reset form fields
    private function resetForm() {
        $this->name = $this->email = $this->phone = $this->category = $this->image = "";
    }

    // Getter methods for class properties
    public function getName() { return $this->name; }
    public function getEmail() { return $this->email; }
    public function getPhone() { return $this->phone; }
    public function getCategory() { return $this->category; }
    public function getErrorMessage() { return $this->errorMessage; }
    public function getSuccessMessage() { return $this->successMessage; }
}

// Create database and form objects
$db = new Database("localhost", "root", "", "phonebookapp");
$form = new ContactForm();
$form->handleSubmission($db);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phone Book App</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" ></script>
</head>
<body>
    <div class="container my-5">
        <h2>New Contact</h2>

        <?php if (!empty($form->getErrorMessage())) : ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong><?= $form->getErrorMessage() ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (!empty($form->getSuccessMessage())) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><?= $form->getSuccessMessage() ?></strong>
            </div>
        <?php endif; ?>

        <form method="post" enctype="multipart/form-data" onsubmit="return alert('New contact has been created')" >
            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="colFormLabel" name="name" value="<?= $form->getName() ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="colFormLabel" name="email" value="<?= $form->getEmail() ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Phone</label>
                <div class="col-sm-10">
                    <input type="tel" class="form-control" id="colFormLabel" name="phone" required value="<?= $form->getPhone() ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Category</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="colFormLabel" required name="category" value="<?= $form->getCategory() ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Image</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="colFormLabel" name="image">
                </div>
            </div>

            <div class="row mb-3">
                <div class="d-grid gap-2 d-md-block">
                    <button class="btn btn-primary" type="submit">Create contact</button>
                </div>
                <br>
                <br>
                <div class="d-grid gap-2 d-md-block">
                    <a role="button" class="btn btn-outline-primary" href="/Phone_book_2/index.php">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>