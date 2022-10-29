<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <?php include 'Header.php'; ?>

    <?php

    session_start();

    $msg='';

    if (isset($_POST['email']) && isset($_POST['password'])) {
        $data = file_get_contents("Customer_Data.json");
        $data = json_decode($data, true);
        foreach ($data as $row) {
            if ($row["email"] == $_POST['email'] && $row["password"] == $_POST['password']) {
                $_SESSION['email'] = $row["email"];
                $_SESSION['password'] = $row["password"];

                if (!isset($_SESSION['name'])) {
                    $_SESSION['name'] = $row["name"];
                }

                if (!isset($_SESSION['phoneNo'])) {
                    $_SESSION['phoneNo'] = $row["phoneNo"];
                }

                if (!isset($_SESSION['gender'])) {
                    $_SESSION['gender'] = $row["gender"];
                }

                if (!isset($_SESSION['dateOfBirth'])) {
                    $_SESSION['dateOfBirth'] = $row["dateOfBirth"];
                }

                if (!isset($_SESSION['profilePic'])) {
                    $_SESSION['profilePic'] = $row["profilePic"];
                }

                if (!empty($_POST['rememberMe'])) {
                    setcookie("email", $_POST['email'], time() + 60);
                    setcookie("password", $_POST['password'], time() + 60);
                    echo "Cookie set successfully";
                } else {
                    setcookie("email", "");
                    setcookie("password", "");
                    echo "Cookie not set";
                }

                header("location:Customer_Home.php");
            } else {
                $msg = "Username or password invalid";
            }
            // }
        }
    }

    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <fieldset>
            <legend><b>LOGIN</b></legend>
            Email: <input type="text" name="email" value="<?php if (isset($_COOKIE['email'])) {
                                                                echo $_COOKIE['email'];
                                                            } ?>"><br><br>

            Password: <input type="password" name="password" id="pass" value="<?php if (isset($_COOKIE['password'])) {
                                                                                    echo $_COOKIE['password'];
                                                                                } ?>"><br><br>
            <input type="checkbox" onclick="showPass()"> Show password <br>

            <span class="error"> <?php echo $msg; ?></span><br>
            <hr>

            <input type="checkbox" name="rememberMe" value="rememberMe">
            <label>Remember me for a mintute</label><br><br>

            <input type="submit" name="submit" value="Submit">
            <a href="Forget_Password.php">Forgot password?</a>
        </fieldset>
        <script>
            function showPass() {
                var x = document.getElementById("pass");
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }
            }
        </script>
    </form>

    <?php include 'Footer.php'; ?>

</body>

</html>