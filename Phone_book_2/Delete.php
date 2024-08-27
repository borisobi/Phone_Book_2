<?php 
 //will use the GET method
 if(isset($_GET["id"])){
    $id = $_GET["id"];

    //connecting to database to delete contact
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "phonebookapp";

    //extablish connection with database phonebookapp
    $conn = new mysqli($servername, $username, $password, $dbname);

    $sql = "DELETE FROM contacts where id=$id";
    $conn ->query($sql);
 }

 //redirecting back to the index page

 header("location: /Phone_book_2/index.php");
 exit;
?>