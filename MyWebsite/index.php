<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
            <?php include "css/style.css"; ?>
    </style>

</head>
<body>
    
    <main>
        <form action="includes/formhandler.php" method="post">
            <label for="firstname">Firstname?</label> <br>
            <input required accept id="firstname" type="text" name="firstname" placeholder="firstname...">
            <br>  <br>
            <label for="lastname">Lastname?</label> <br>
            <input required id="lastname" type="text" name="lastname" placeholder="Lastname...">
             <br> <br>
            <label for="favouritepet">Favouritte Pet?</label> <br>
            <select name="favouritepet" id="favouritepet">
                <option value="none">None</option>
                <option value="dog">Dog</option>
                <option value="cat">Cat</option>
                <option value="bird">Bird</option>

            </select> 
            <br>
            
            <button type="submit">Submit</button>
        </form>
    </main>
    
</body>
</html>