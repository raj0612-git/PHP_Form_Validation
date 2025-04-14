<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PHP Form Validation</title>
        <style>
            .error {
                color: #FF0000;
                font-size: 14px;
            }
            body {
                font-family: Arial, sans-serif;
                background-color: #f2f2f2f2;
                margin: 0;
                padding: 20px;
            }
            form {
                background: #fff;
                padding: 20px;
                border-radius: 5px;
                max-width: 400px;
                margin: auto;
                /* box-shadow: 0px 0px 10xp rgba(0, 0, 0, 0.1); */
            }
            input[type="text"], [type="email"], textarea {
                width: 90%;
                padding: 8px;
                margin: 5px 0 10px;
                border: 1px solid #ccc;
                border-radius: 4px;
            }
            .gender-label {
                font-weight: bold;
            }
            input[type="radio"] {
                margin: 10px;
            }
            input[type="submit"] {
                background-color: #4CAF50;
                color: white;
                padding: 10px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                width: 100%;
            }
            .header {
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div>
            <?php
                $name = $email = $website = $comment = $gender = "";
                $nameErr = $emailErr = $websiteErr = $commentErr = $genderErr = "";

                if($_SERVER["REQUEST_METHOD"] == "POST") {
                    if(empty($_POST["name"])) {
                        $nameErr = "Name is required";
                    } else{
                        $name = test_input($_POST["name"]);
                        if(!preg_match("/^[a-zA-Z-` ]*$/", $name)) {
                            $nameErr = "Only letters and white space allowed";
                        }
                    }
                    if (empty($_POST["email"])) {
                        $emailErr = "Email is required";
                      } else {
                        $email = test_input($_POST["email"]);
                        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                          $emailErr = "Invalid email format";
                        }
                    }
                    if(empty($_POST["website"])) {
                        $websiteErr = "";
                    } else{
                        $website = test_input($_POST["website"]);
                        if(!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/", $website)) {
                            $websiteErr = "Invalid URL";
                        }
                    }
                    if(empty($_POST["comment"])) {
                        $commentErr = "";
                    } else{
                        $comment = test_input($_POST["comment"]);
                    }
                    if(empty($_POST["gender"])) {
                        $nameErr = "Gender is required";
                    } else{
                        $gender = test_input($_POST["gender"]);
                    }
                }

                function test_input($data) {
                    $data = trim($data);
                    $data = stripslashes($data);
                    $data = htmlspecialchars($data);
                    return $data;
                }
            ?>    

            <Form method="post" action=" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> ">
                <h1 class="header">PHP Form Validation</h1>
                <p><span class="error">* required field</span></p>
                <label>Name: </label><input type="text" name="name" placeholder="Enter your name" />
                <span class="error">* <?php echo $nameErr; ?></span>
                <br><br>
                <label>E-maile: </label><br>
                <input type="email" name="email" placeholder="Enter your email" />
                <span class="error">* <?php echo $emailErr; ?></span>
                <br><br>
                <label>Website: </label><input type="text" name="website" placeholder="Enter your website" />
                <span class="error">* <?php echo $websiteErr; ?></span>
                <br><br>
                <label>Comment: </label><textarea name="comment" row="5" col="4" placeholder="Enter your opinion"></textarea>
                <span class="error">* <?php echo $commentErr; ?></span>
                <br><br>
                <div class="gender-lebal"><label>Gender:</label>
                    <input type="radio" name="gender" value="female">Female</inpt>
                    <?php if(isset($gender) && $gender == "female") echo "checked"; ?>
                    <input type="radio" name="gender" value="male">Male</inpt>
                    <?php if(isset($gender) && $gender == "male") echo "checked"; ?>
                    <input type="radio" name="gender" value="male">Other</inpt>
                    <?php if(isset($gender) && $gender == "other") echo "checked"; ?>
                    <span class="error">* <?php echo $genderErr; ?></span>
                    <br><br>
                    <input type="submit" name="submit" value="Submit" class="sub" />
                </div>

                <?php
                    echo "<h1>Your Input</h1>";
                    echo $name;
                    echo "<br>";
                    echo $email;
                    echo "<br>";
                    echo $website;
                    echo "<br>";
                    echo $gender;
                    echo "<br>";
                    echo $comment;
                    echo "<br>";
                ?>
            </form>
        </div>
    </body>
</html>