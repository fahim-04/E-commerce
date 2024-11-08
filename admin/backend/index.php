<?php
session_start();


$filepath = realpath(dirname(__FILE__));
include $filepath . "/connection.php";

//check if th user is already logged in
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
    header('location: dashboard.php');
    exit;
}

function validate($data)
{
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$error = [];
$data = [];
if (isset($_POST['login'])) {
    $user_password = validate($_POST['user_password']);
    $user_email = validate($_POST['user_email']);
    // Validate email   
    if (empty($user_email)) {
        $error['user_email'] = "Email is required";
    } elseif (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
        $error['user_email'] = "Invalid email format";
    } else {
        $data['user_email'] = $user_email;
    }

    // Validate password
    if (empty($user_password)) {
        $error['user_password'] = "Password is required";
    }

    // Only proceed if there are no errors
    if (count($error) === 0) {
        $sql = "SELECT * FROM users WHERE user_email = :user_email AND user_type IN ('admin', 'editor', 'user')";

        $dsn = "mysql:host=localhost;dbname=ecom;charset=utf8";
        $user = "root";
        $pass = "";
        $pdo = new PDO($dsn, $user, $pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user_email', $user_email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if user exists and verify password
        if ($user && password_verify($user_password, $user['user_password'])) {
            $_SESSION['logged_in'] = true;
            $_SESSION['user'] = $user;
            $_SESSION['user_type'] = $user['user_type'];
            $_SESSION['user_name'] = $user['user_name'];
            $_SESSION['user_email'] = $user['user_email'];

            // Redirect based on user type
            if ($_SESSION['user_type'] == 'admin' || $_SESSION['user_type'] == 'editor') {
                header("Location: dashboard.php");
                exit();
            } elseif ($_SESSION['user_type'] == 'user') {
<<<<<<< HEAD
                header("Location: ../web/index.php");
=======
                header("Location: ../../../../web/frontend_page.php");
>>>>>>> 474d610e0fc02c0d53d5505cb0e6ac3b91824fe8
                exit();
            }
        } else {
            $error['login'] = "Invalid email or password";
        }
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <?php include 'links.php'; ?>
    <style>
        .style {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            max-width: 600px;
            margin-left: 10px;
            margin-right: 10px;
        }

        .bg {
            background-color: #64C5B1;
        }

        .text_white {
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="white_box mb_30">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="modal-content cs_modal style">
                    <div class=" justify-content-center text-center bg">
                        <h4 class="modal-title text_white mt-3 mb-3">Login</h4>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                            <div class="form-group">
                                <label for="user_email">Email</label>
                                <input type="email" name="user_email" class="form-control" placeholder="Enter Email"
                                    value="<?php echo htmlspecialchars($data['user_email'] ?? ''); ?>">
                                <span class="text-danger"><?php echo $error['user_email'] ?? ''; ?></span>
                            </div>

                            <div class="form-group">
                                <label for="user_password">Password</label>
                                <input type="password" name="user_password" class="form-control"
                                    placeholder="Enter Password">
                                <span class="text-danger"><?php echo $error['user_password'] ?? ''; ?></span>
                            </div>

                            <button type="submit" class="btn_1 full_width text-center fs-6" name="login">Login</button>

                            <p>Need an account? <a data-bs-toggle="modal" data-bs-target="#sing_up"
                                    data-bs-dismiss="modal" href="registration.php"> Sign Up</a></p>
                            <div class="text-center">
                                <!-- <a href="#" data-bs-toggle="modal" data-bs-target="#forgot_password" data-bs-dismiss="modal" class="pass_forget_btn">Forget Password?</a> -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>