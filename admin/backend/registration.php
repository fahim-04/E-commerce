<?php
// Include the database connection file
$filepath = realpath(dirname(__FILE__));
include $filepath . "/db-conn.php"; // Ensure this path is correct

function validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$error = [];
$data = [];
if (isset($_POST['register'])) {
    $user_name = validate($_POST['user_name']);
    $user_password = validate($_POST['user_password']);
    $user_phone = $_POST['user_phone'];
    $user_email = $_POST['user_email'];

    // Validate name
    if (empty($user_name)) {
        $error['user_name'] = "Name is required";
    } else {
        $data['user_name'] = $user_name;
    }

    // Validate phone
    if (empty($user_phone)) {
        $error['user_phone'] = "Phone is required";
    } elseif (!is_numeric($user_phone)) {
        $error['user_phone'] = "Invalid phone number";
    } elseif (strlen($user_phone) < 10 || strlen($user_phone) > 12) {
        $error['user_phone'] = "Phone number must be between 10 and 12 digits";
    } else {
        $data['user_phone'] = $user_phone;
    }

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
    } elseif (strlen($user_password) < 6) {
        $error['user_password'] = "Password must be at least 6 characters";
    } else {
        $data['user_password'] = $user_password;
    }

    // Proceed only if there are no errors
    if (count($error) === 0) {
        // Insert data into the database
        $sql = "INSERT INTO users (user_name, user_phone, user_email, user_password) VALUES (?, ?, ?, ?)";

        // Prepare the statement
        if ($stmt = $conn->prepare($sql)) {
            $hashedPassword = password_hash($user_password, PASSWORD_BCRYPT); // Hash the password

            // Bind the parameters
            $stmt->bind_param("ssss", $user_name, $user_phone, $user_email, $hashedPassword);

            // Execute the statement
            if ($stmt->execute()) {
                header("Location: index.php"); // Redirect to login page after successful registration
                exit();
            } else {
                echo "Error executing query: " . $stmt->error;
            }
            $stmt->close(); // Close the statement
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <?php include 'links.php'; ?>
    <style>
        body {
            background: #fcfcfc;
        }

        .style {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            max-width: 600px;
            margin: 10px;
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
                    <div class="justify-content-center text-center bg">
                        <h4 class="modal-title text_white mt-3 mb-3">Sign Up</h4>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                            <div class="form-group">
                                <label for="user_name">Full Name</label>
                                <input type="text" name="user_name" class="form-control" placeholder="Enter Full Name" value="<?php echo htmlspecialchars($data['user_name'] ?? ''); ?>">
                                <span class="text-danger"><?php echo $error['user_name'] ?? ''; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="user_phone">Phone</label>
                                <input type="tel" name="user_phone" class="form-control" placeholder="Enter Phone Number" value="<?php echo htmlspecialchars($data['user_phone'] ?? ''); ?>">
                                <span class="text-danger"><?php echo $error['user_phone'] ?? ''; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="user_email">Email</label>
                                <input type="email" name="user_email" class="form-control" placeholder="Enter Email" value="<?php echo htmlspecialchars($data['user_email'] ?? ''); ?>">
                                <span class="text-danger"><?php echo $error['user_email'] ?? ''; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="user_password">Password</label>
                                <input type="password" name="user_password" class="form-control" placeholder="Enter Password">
                                <span class="text-danger"><?php echo $error['user_password'] ?? ''; ?></span>
                            </div>
                            <button type="submit" class="btn_1 full_width text-center fs-6" name="register">Sign Up</button>
                            <p>Already have an account? <a href="index.php">Log In</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>