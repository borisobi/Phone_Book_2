
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact details</title>

    <link rel="stylesheet" href="../Phone Book app/css/style.css">
    <style>
            <?php include "css/style.css"; ?>
    </style>
</head>
<body>
<div class="login-form">
    <form action="">

        <h1>MY PHONEBOOK</h1> <br>
        <a href="../Phone Book app/phonebook.php" class="goback">Go back</a> <br>
        <?php include 'C:\xampp\htdocs\Phone Book app\includes\form handler.php'; ?>
        <br><br><br>
         
        <h1>Contact List</h1>
  <ul>
    <?php foreach ($contacts as $contact) : ?>
      <li>
        <?= $contact->name ?>
        <a href="delete.php?id=<?= $contact->id ?>">Delete</a>
      </li>
    <?php endforeach; ?>
  </ul>
     </form>
</div>


</body>
</html>