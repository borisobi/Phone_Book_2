<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

     <?php 

    $bool = true; 
    $a = 1; 
    $b = 4;

    $result = match ($a) {
        1, 3, 5 => "Variable a is equal to one!",
        2 => "Variable a is equal to 2!",
        default => "none were a match"
    };

    echo $result;

    
    /*
    switch ($a){
        case 1:
            echo "First condition is true";
            break;
        case 2: 
            echo "Second condition is true";
            break;
        default: 
        echo "None of the conditions is true";

    }


if($a < $b && !$bool){
        echo "First condition is true";
    }
    else if($a < $b && $bool){
        echo " Second condition is true";
    }
    else{
        echo "None of the conditions were true";
    }

    */ 
    
     
     ?>
    
</body>
</html>