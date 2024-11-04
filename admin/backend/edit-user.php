<?php
session_start();
include 'connection.php'; // Database connection
include 'functions.php';  // Functions file


 
// Define the validate function here, outside of any conditional blocks
function validate($data) {
    // Trim whitespace from the beginning and end of the input
    $data = trim($data);
    // Remove any slashes
    $data = stripslashes($data);
    // Convert special characters to HTML entities to prevent XSS attacks
    $data = htmlspecialchars($data);
    return $data;
}

// Fetch user data by ID
$user_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$user = [];
if ($user_id) {
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    if (!$user) {
        die("User not found!");
    }
}

$error = [];
if (isset($_POST['update'])) {
    // Retrieve form data and sanitize
    $user_name = validate($_POST['user_name']);
    $user_status = isset($_POST['user_status']) ? (int)$_POST['user_status'] : 1;
    $user_type = isset($_POST['user_type']) ? $_POST['user_type'] : 'user';

    // Validate name
    if (empty($user_name)) {
        $error['user_name'] = "Name is required";
    }

    // If no errors, proceed with update
    if (empty($error)) {
        $update_sql = "UPDATE users SET user_name = ?, user_status = ?, user_type = ? WHERE id = ?";
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param("sisi", $user_name, $user_status, $user_type, $user_id);

        if ($stmt->execute()) {
            $_SESSION['success'] = "User updated successfully!";
            header("Location: view-users.php"); // Redirect after update
            exit();
        } else {
            echo "Error updating user: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Edit User</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <?php include 'links.php'; ?>
</head>

<body class="crm_body_bg">
    <?php include 'header.php'; ?>
    <section class="main_content dashboard_part large_header_bg">
        <?php include 'header_nav.php'; ?>

        <div class="white_box mb_30">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="modal-content cs_modal">
                        <div class="justify-content-center text-center bg">
                            <h4 class="modal-title text_white mt-3 mb-3">Edit User</h4>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="user_name">Full Name</label>
                                    <input type="text" name="user_name" class="form-control" value="<?php echo htmlspecialchars($user['user_name'] ?? ''); ?>">
                                    <span class="text-danger"><?php echo $error['user_name'] ?? ''; ?></span>
                                </div>

                                <div class="form-group">
                                    <label for="user_email">Email</label>
                                    <input type="email" name="user_email" class="form-control" value="<?php echo htmlspecialchars($user['user_email'] ?? ''); ?>" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="user_phone">Phone</label>
                                    <input type="text" name="user_phone" class="form-control" value="<?php echo htmlspecialchars($user['user_phone'] ?? ''); ?>" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="user_type">User Type</label>
                                    <select name="user_type" class="form-control">
                                        <option value="admin" <?php echo ($user['user_type'] ?? '') == 'admin' ? 'selected' : ''; ?>>Admin</option>
                                        <option value="editor" <?php echo ($user['user_type'] ?? '') == 'editor' ? 'selected' : ''; ?>>Editor</option>
                                        <option value="user" <?php echo ($user['user_type'] ?? '') == 'user' ? 'selected' : ''; ?>>User</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="user_status">Status</label>
                                    <select name="user_status" class="form-control">
                                        <option value="1" <?php echo ($user['user_status'] ?? '') == 1 ? 'selected' : ''; ?>>Active</option>
                                        <option value="0" <?php echo ($user['user_status'] ?? '') == 0 ? 'selected' : ''; ?>>Inactive</option>
                                    </select>
                                </div>

                                <button type="submit" name="update" class="btn btn-primary full_width text-center">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'footer.php'; ?>
