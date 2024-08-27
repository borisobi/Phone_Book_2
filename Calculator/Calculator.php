<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
            <?php include "css/style.css"; ?>
            <?php include "css/calculator.css"; ?>
    </style>

    <title>Calculator</title>
     
</head>
<body>
    <form action=" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ;  ?> " method="post" >
    <h1>BASIC CALCULATOR</h1> <br>
     <input type="number" name="num1" placeholder="Number one"> <br> <br>
     <select name="operator" id="operator">
        <option value="add">+</option>
        <option value="subtraction">-</option>
        <option value="multiply">*</option>
        <option value="divide">/</option>
     </select>
     <br> <br>
     <input type="number" name="num2" placeholder="Number two">
      <br>
     <button>Calculate</button>

    </form>

    <?php 
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $num1 =  (int) filter_input(INPUT_POST,"num1", FILTER_SANITIZE_NUMBER_FLOAT);
        $num2 =  (int) filter_input(INPUT_POST,"num2", FILTER_SANITIZE_NUMBER_FLOAT);
        $operator = htmlspecialchars($_POST["operator"]);

        //Error handling

        $errors = false;

        if(empty($num1) || empty($num2) || empty($operator)){
            echo "<p class = 'calc-error'>Fill in all the fields!</p>";
            $errors = true;
    }   

    if(!is_numeric($num1)  || !is_numeric($num2)){
        echo "<p class = 'calc-error'>Only write numbers!</p>";
        $errors = true;
    }

    //Calculating the numbers if there are no erriors

    if($errors){
        $value = 0;
        switch($operator){
            case "add":
                $value = $num1 + $num2;
                break;
             case "subtraction":
                $value = $num1 - $num2;
                break;
             case "multiply":
                 $value = $num1 * $num2;
                    break;
              case "divide":
                        $value = $num1 / $num2;
                        break;
            default;
            echo "<p class = 'calc-error'>Something went Horribly wrong!</p>";
              
          }

          echo "<p class = 'calc-result'>Result = " . $value . "</p>" ; 

      }

 }

    ?>


    
</body>
</html>