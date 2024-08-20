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
    <form action="" method="post">
        

        <h1>Create New Contact</h1> <br>
        <div class="input-icons">
        <br>
        <input type="image" src="../" alt="">
        <input type="name" class="box" id="name" name="name" placeholder="Name" required>
         <br>
         <input type="phone" class="box" id="number" name="number"  placeholder="Phone">
         <br>
         <input type="email" class="box" id="email" placeholder="Email" name="email" required>
         <br>
         <br>
         <input type="address" class="box" placeholder="Address" name="address" required>
         <br>
         <select name="category" id="category" name required >
            <option value="None">None</option>
            <option value="Family">Family</option>
            <option value="Friend">Friend</option>
            <option value="Co-worker">Co-worker</option>
         </select>
         <br>

         <input type="submit" value="Create Contact" class="submit">
         <br>
         <input type="submit" value="Cancel" class="cancel">
         
     </form>
</div>


<?php
 //Error handling 
 

?>
</body>
</html>