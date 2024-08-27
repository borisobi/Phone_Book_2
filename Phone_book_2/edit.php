<?php
// Connecting to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "phonebookapp";

// Create connection to database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = isset($_GET["id"]) ? $_GET["id"] : null;
$name = "";
$email = "";
$phone = ""; // Added missing $phone variable
$category = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // The GET method shows the data of the contact
    // Request received using the GET method 

    if (!isset($_GET['id'])) {
        header("location: /Phone_book_2/index.php");
        exit;
    }

    $id = $_GET["id"];

    // Reading the data of the contact from the database
    $sql = "SELECT * FROM contacts WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: /Phone_book_2/index.php");
        exit;
    } 

    // Storing the data from the database in the variables
    $name = $row["name"];
    $email = $row["email"];
    $phone = $row["phone"];
    $category = $row["category"];
} 
else {
    // POST method updates the data of the contact
    // $id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $category = $_POST["category"];

    // Checking that we don't have any empty field
    do {
        if (empty($id) || empty($name) || empty($email) || empty($phone) || empty($category)) {
            $errorMessage = "All the fields are required";
            break;
        }

        // SQL query that allows us to update the data of the contacts in the database
        $sql = "UPDATE contacts SET name = ?, email = ?, phone = ?, category = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $name, $email, $phone, $category, $id);
        $result = $stmt->execute();

        // Checking if the query has been executed correctly
        if (!$result) {
            $errorMessage = "Invalid query: " . $conn->error;
            break;
        }

        $successMessage = "Contact updated successfully";

        header("location: /Phone_book_2/index.php");
        exit;

    } while (false);
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
            <input type="hidden" value="<?php echo $id; ?> " >

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
                <label for="colFormLabel" class="col-sm-2 col-form-label">Image</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="colFormLabel" name="image">
                </div>
            </div>

            <div class="row mb-3">
                <div class="d-grid gap-2 d-md-block">
                    <button class="btn btn-primary" type="submit">Save Changes</button>
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