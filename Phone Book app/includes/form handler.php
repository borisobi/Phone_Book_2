<?php

class Contact {
    public $id;
    public $name;
    public $phone;
    public $email;
    public $category;
    public $address;
    
    function __construct($id, $name, $phone, $email, $category, $address) {
        $this->id = $id;
        $this->name = $name;
        $this->phone = $phone;
        $this->email = $email;
        $this->address = $address;
        $this->category = $category;
    }

    //deleting a record 
    public function deleteContact($id, &$contacts) {
        foreach ($contacts as $key => $contact) {
            if ($contact->id == $id) {
                unset($contacts[$key]);
                break; 
            }
        }
    }
      
}

// contact data
$contacts = [
    new Contact(1,"Ashu Boris", "654-47-12-51", "borisashu5@gmail.com", "Friends", "Buea"),
    new Contact(2,"Kims", "682-43-67-60", "kims@gmail.com", "Family", "Yaounde"),
    new Contact(3,"Job", "681-43-72-14","jobjanes@gmail.com", "Friend","Douala"),
    new Contact(4,"Parkson","674-12-85-73", "parkson@gmail.com", "Friend" , "Bamenda"),
    new Contact(5,"Parkson","674-12-85-73", "parkson@gmail.com", "Friend" , "Bamenda"),
    new Contact(6,"Parkson","674-12-85-73", "parkson@gmail.com", "Friend" , "Bamenda"),
    new Contact(7,"Parkson","674-12-85-73", "parkson@gmail.com", "Friend" , "Bamenda")
];

// Displaying the contact names
function displayContactList($contacts) {
    echo "<ul>";
    foreach ($contacts as $contact) {
        echo "<li><a href='contact_details.php?id=" . $contact->id . "'>" . $contact->name . "</a></li>";
    }
    echo "</ul>";

}



// To display contact details
function displayDetails($contacts, $id) {
    foreach ($contacts as $contact) {
        if ($contact->id == $id) {
            echo "<h2>" . $contact->name . "</h2>";
            echo "<p>Phone: " . $contact->phone . "</p>";
            echo "<p>Email: " . $contact->email . "</p>";
            echo "<p>Address:" . $contact->address . "</p>";
            echo "<p>Category: " . $contact->category . "</p>";
            break;
        }
    }
}

function displayContactDetails($contacts, $id) {
    foreach ($contacts as $contact) {
        if ($contact->id == $id) {
            echo "<table>";
            echo "<tr>";
            echo "<td><h2>" . $contact->name . "</h2></td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td><p>Phone: " . $contact->phone . "</p></td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td><p>Email: " . $contact->email . "</p></td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td><p>Address: " . $contact->address . "</p></td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td><p>Category: " . $contact->category . "</p></td>";
            echo "</tr>";
            echo "</table>";
            break;
        }
    }
}



//contact details
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    displayContactDetails($contacts, $id);
} else {
    displayContactList($contacts);
}

//storing contacts from the form

// $contacts = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $category = $_POST['category'];

    // create new object
    $newContact = new Contact(count($contacts) + 1,$name, $phone, $email, $address, $category);

    array_push($contacts, $newContact);



//new array to store form information

$newContact = [
    'name' => $name,
    'phone' => $phone,
    'email' => $email,
    'address' => $address,
    'category' => $category
];

$contacts [] = $newContact;

$contacts[] = $newContact;
echo "Contact has successfully been added! ";

}



?>

