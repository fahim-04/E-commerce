<?php
$filepath = realpath(dirname(__FILE__));
include $filepath . "/connection.php";

function validate($data)
{
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


$error = [];
$data = [];
if (isset($_POST['adduser'])) {
    $user_name = validate($_POST['user_name']);
    $user_password = validate($_POST['user_password']);
    $user_phone = $_POST['user_phone'];
    $user_email = $_POST['user_email'];
    $user_type = $_POST['user_type'];

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
        $error['user_phone'] = "Phone number must be 11 digits";
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


    // else {
    // $data['user_password'] = password_hash($user_password, PASSWORD_DEFAULT); // Hash password for security
    // }

    // will only proceed if there are no errors
    if (count($error) === 0) {
        // Insert data into database
        $sql = "INSERT INTO users (user_name, user_phone, user_email, user_password, user_type) VALUES (:user_name, :user_phone, :user_email, :user_password, :user_type)";

        // Prepared statement
        if ($stmt = $conn->prepare($sql)) {
            $hashedPassword = password_hash($user_password, PASSWORD_BCRYPT);
            $stmt->bindParam(':user_name', $user_name, PDO::PARAM_STR);
            $stmt->bindParam(':user_phone', $user_phone, PDO::PARAM_STR);
            $stmt->bindParam(':user_email', $user_email, PDO::PARAM_STR);
            $stmt->bindParam(':user_password', $hashedPassword, PDO::PARAM_STR);
            $stmt->bindParam(':user_type', $user_type, PDO::PARAM_STR);


            if ($stmt->execute()) {
                header("Location: index.php"); // Redirect to login page after successful registration
                exit();
            } else {
                echo "Error: " . $stmt->errorInfo()[2];
            }
        } else {
            echo "Error preparing statement.";
        }
    }
}
?>






?>


<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Add Category</title>
    <link rel="icon" href="assets/img/logo.png" type="image/png">
    <link rel="stylesheet" href="assets/css/bootstrap1.min.css" />
    <?php include 'links.php'; ?>
</head>

<body class="crm_body_bg">
    <?php include 'header.php'; ?>

    <section class="main_content dashboard_part large_header_bg">
        <?php include 'header_nav.php'; ?>
        <div class="main_content_iner ">
            <div class="container-fluid p-0 sm_padding_15px">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="white_card card_height_100 mb_30">
                            <div class="">
                                <div class="box_header m-0">
                                    <div class="main-title">
                                        <h3 class="m-0"> </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="white_card_body">
                                <div class="card-body">
                                    <h4 class="card-title mb-5">Users details</h4>
                                    <!-- form -->
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                        <div class="form-group col-md-6 mb-4">
                                            <label for="user_name">Full Name</label>
                                            <input type="text" name="user_name" class="form-control" placeholder="Enter Full Name" value="<?php echo htmlspecialchars($data['user_name'] ?? ''); ?>">
                                            <span class="text-danger"><?php echo $error['user_name'] ?? ''; ?></span>
                                        </div>
                                        <div class="form-group col-md-6 mb-4">
                                            <label for="user_phone">Phone</label>
                                            <input type="tel" name="user_phone" class="form-control" placeholder="Enter Phone Number" value="<?php echo htmlspecialchars($data['user_phone'] ?? ''); ?>">
                                            <span class="text-danger"><?php echo $error['user_phone'] ?? ''; ?></span>
                                        </div>
                                        <div class="form-group col-md-6 mb-4">
                                            <label for="user_email">Email</label>
                                            <input type="email" name="user_email" class="form-control" placeholder="Enter Email" value="<?php echo htmlspecialchars($data['user_email'] ?? ''); ?>">
                                            <span class="text-danger"><?php echo $error['user_email'] ?? ''; ?></span>
                                        </div>

                                        <div class="form-group col-md-6 mb-4">
                                            <label for="user_password">Password</label>
                                            <input type="password" name="user_password" class="form-control" placeholder="Enter Password">
                                            <span class="text-danger"><?php echo $error['user_password'] ?? ''; ?></span>
                                        </div>

                                        <div class="form-group col-md-6 mb-4">
                                            <label for="user_type">User Type</label>
                                            <select name="user_type" class="form-control">
                                                <option value="user" <?php echo (isset($data['user_type']) && $data['user_type'] == 'user') ? 'selected' : ''; ?>>User</option>
                                                <option value="admin" <?php echo (isset($data['user_type']) && $data['user_type'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                                                <option value="editor" <?php echo (isset($data['user_type']) && $data['user_type'] == 'editor') ? 'selected' : ''; ?>>Editor</option>
                                            </select>
                                            <span class="text-danger"><?php echo $error['user_type'] ?? ''; ?></span>
                                        </div>

                                        <button type="submit" class="btn_1 full_width text-center fs-6" name="adduser">Add user</button>


                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'footer.php'; ?>