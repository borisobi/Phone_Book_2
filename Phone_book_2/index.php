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
        <!-- <button class="btn btn-primary" href="/Phone_book_2/create.php?id=$row[id]" role="button" >New Contact</button> -->
        <a  class='btn btn-primary' href='/Phone_book_2/create.php?id=$row[id]'>Add new contact</a>
        <br> <br><br>
        <table class="table">
            <thead>
                <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Cateory</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>

            <?php

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "phonebookapp"; 
            
            //connecting to database
            $conn = new mysqli($servername, $username, $password, $dbname);

            //if theres a connection error
            if ($conn->connect_error) {
                die("Connection failed". $conn->connect_error);
            }

            //reading rows from the database
            $sql = "SELECT * FROM contacts";
            $result = $conn->query($sql);

            if (!$result) {
               die("Invalid query: " . $conn ->error );
            }

            //reading the data from each row 

            while ($row = $result->fetch_assoc()) {
                echo "
                    <tr>
                        <td>$row[id]</td>
                        <td>$row[name]</td>
                        <td>$row[email]</td>
                        <td>$row[phone]</td>
                        <td>$row[category]</td>
                        <td>

                            <a  class='btn btn-primary' href='/Phone_book_2/edit.php?id=$row[id]'>Edit</a>
                            <a  class='btn btn-danger' href='/Phone_book_2/Delete.php?id=$row[id]'>Delete</a>
                        </td>
                    </tr>
                ";
            }
        
            ?> 
            
                
            </tbody>  
        </table>
    </div>
    

</body>
</html>