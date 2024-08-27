<?php
//adding the new contact to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "phonebookapp";

//connecting to mysql
$conn = new mysqli($servername, $username, $password,$dbname);


// Reading submitted data
$name = "";
$email = "";
$phone = "";
$category = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phone"]);
    $category = trim($_POST["category"]); 

    // Validation
    if (empty($name) || empty($email) || empty($phone) || empty($category)) {
        $errorMessage = "All fields are required.";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // Validate email format
        $errorMessage = "Please enter a valid email address.";
    } else {

        // Creating new contact 
        $sql = "INSERT INTO contacts(name, email, phone, category)" . 
        "VALUES ('$name', '$email' , '$phone', '$category' )";
        $result = $conn->query($sql);

        if (! $result) {
          $errorMessage = "invalid query: " . $conn->error;
        } 
    
        $successMessage = "New contact created successfully!";
      
        $name = "";
        $email = "";
        $phone = "";
        $category = ""; 
        
        //redirects user to the index page
        header("location: /Phone_book_2/index.php ");
        exit;

    }while (false);
}

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

        <?php if (!empty($errorMessage)) : ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong><?= $errorMessage ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (!empty($successMessage)) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><?= $successMessage ?></strong></button>
            </div>
        <?php endif; ?>

        <form method="post">
            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="colFormLabel" name="name" value="<?= $name ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="colFormLabel" name="email" value="<?= $email ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Phone</label>
                <div class="col-sm-10">
                    <input type="tel" class="form-control" id="colFormLabel" name="phone" required value="<?= $phone ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Category</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="colFormLabel" required name="category" value="<?= $category ?>">
                </div>
            </div>

            <div class="row mb-3">
                <div class="d-grid gap-2 d-md-block">
                    <button class="btn btn-primary" type="submit">Create contact</button>
                </div>
                <br>
                <br>
                <div class="d-grid gap-2 d-md-block">
                    <button role="button" class="btn btn-outline-primary" href="/Phone_book_2/index.php">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>