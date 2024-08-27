<?php
class contact
{
    public $id;
    public $name;
    public $email;
    public $phone;
    public $category;

    public function __construct($id, $name, $email, $phone, $category)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->category = $category;
    }

    public function getDetails()
    {
        return "ID: " . $this->id . "<br>" .
               "Name: " . $this->name . "<br>" .
               "Email: " . $this->email . "<br>" .
               "Phone: " . $this->phone . "<br>" .
               "Category: " . $this->category;
    }
}

?>