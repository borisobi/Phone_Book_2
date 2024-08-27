<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phone Book App</title>

    <link rel="stylesheet" href="../Phone Book app/css/style.css">
    <style>
            <?php include "css/style.css"; ?>
    </style>
</head>
<body>
<div class="login-form">
    <form action="">
        

        <h1>MY PHONEBOOK</h1> <br>
        <a href="../Phone Book app/create contact.php" class="new_contact">Add new contact</a>
        <a href="../Phone Book app/delete.php?id" class="delete_contact">Delete contact</a> <br> <br>
        <?php include 'C:\xampp\htdocs\Phone Book app\includes\form handler.php'; ?>
        <ul>
            
        </ul>
       
     </form>
</div>


</body>
</html>