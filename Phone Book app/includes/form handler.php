<?php

class Contact {
    public $name;
    public $phone;
    public $email;
    public $category;
    public $address;

    function __construct($name, $phone, $email, $category, $address) {
        $this->name = $name;
        $this->phone = $phone;
        $this->email = $email;
        $this->address = $address;
        $this->category = $category;
    }
}

// contact data
$contacts = [
    new Contact("Ashu Boris", "654-47-12-51", "borisashu5@gmail.com", "Friends", "Buea"),
    new Contact("Kims", "682-43-67-60", "kims@gmail.com", "Family", "Yaounde"),
    new Contact("Job", "681-43-72-14","jobjanes@gmail.com", "Friend","Douala"),
    new Contact("Parkson","674-12-85-73", "parkson@gmail.com", "Friend" , "Bamenda")
];

// Displaying the contact names
function displayContactList($contacts) {
    echo "<ul>";
    foreach ($contacts as $contact) {
        echo "<li><a href='contact_details.php?id=" . $contact->name . "'>" . $contact->name . "</a></li>";
    }
    echo "</ul>";
}

// To display contact details
function displayContactDetails($contacts, $name) {
    foreach ($contacts as $contact) {
        if ($contact->name == $name) {
            echo "<h2>" . $contact->name . "</h2>";
            echo "<p>Phone: " . $contact->phone . "</p>";
            echo "<p>Email: " . $contact->email . "</p>";
            echo "<p>Address:" . $contact->address . "</p>";
            echo "<p>Category: " . $contact->category . "</p>";
            break;
        }
    }
}


//contact details
if (isset($_GET['id'])) {
    $name = $_GET['id'];
    displayContactDetails($contacts, $name);
} else {
    displayContactList($contacts);
}

//storing contacts

$contacts[];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $category = $_POST['category'];
}





?>

