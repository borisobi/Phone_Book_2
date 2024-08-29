<?php
// Will use the GET method
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Check if the user has confirmed the deletion
    if (isset($_POST["confirm_delete"]) && $_POST["confirm_delete"] == "yes") {
        // Connecting to the database to delete the contact
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "phonebookapp";

        // Establish connection with the database phonebookapp
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check if the connection was successful
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare the SQL statement to delete the contact
        $sql = "DELETE FROM contacts WHERE id=?";
        $stmt = $conn->prepare($sql);

        // Bind the parameter
        $stmt->bind_param("i", $id);

        // Execute the statement
        if ($stmt->execute()) {
            // Contact deleted successfully
            header("location: /Phone_book_2/index.php?deleted=true");
            exit;
        } else {
            // Error deleting contact
            echo "Error deleting contact: " . $stmt->error;
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    } else {
        // Display a confirmation prompt
        echo '
        
       <form method="POST" action="">
  <div class="alert alert-danger">
    <p>Are you sure you want to delete this contact?</p>
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <button type="submit" name="confirm_delete" value="yes" class="btn btn-danger">Yes</button>
    <button type="submit" href="Phone_book_2/index.php" name="confirm_delete" value="no" class="btn btn-secondary">No</button>
  </div>
</form>
        ';
    }
}
?>

