<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="">
    <title>PHP Calculator</title>
</head>

<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="number" name="num01" placeholder="First number" required>
        <select name="operator">
            <option value="add">+</option>
            <option value="subtract">-</option>
            <option value="multiply">*</option>
            <option value="divide">/</option>
        </select>
        <input type="number" name="num02" placeholder="Second number" required>
        <button>Calculate</button>
    </form>

    <?php
        // check if user submitted data correctly
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // fetch and sanitize the input 
            $num01 = filter_input(INPUT_POST, "num01", FILTER_SANITIZE_NUMBER_FLOAT);
            $num02 = filter_input(INPUT_POST, "num02", FILTER_SANITIZE_NUMBER_FLOAT);
            $operator = htmlspecialchars($_POST["operator"]);

            // error handling: empty params
            $errors = false;
            if (empty($num01) || empty($num02) || empty($operator)) {
                echo "<p class='calc-error'>All fields must be filled in.</p>";
                $errors = true;
            }

            // error handling: wrong chars submitted by user
            if (!is_numeric($num01) || !is_numeric($num02)) {
                echo "<p class='calc-error'>Numbers must be made up of digits from 0-9 and cannot contain characters.</p>";
                $errors = true;
            }

            // IF NO ERROR = calculate the number
            if (!$errors) {
                $value = 0;

                switch($operator) {
                    case "add":
                        $value = $num01 + $num02;
                        break;
                    case "subtract":
                        $value = $num01 - $num02;
                        break;
                    case "multiply":
                        $value = $num01 * $num02;
                        break;
                    case "divide":
                        $value = $num01 / $num02;
                        break;
                    default:
                        echo "<p class='calc-error'>Something went wrong!</p>";
                }
                echo "<p class='calc-results'>Result = " . $value . "</p>";
            }
        }
    ?>
</body>

</html>