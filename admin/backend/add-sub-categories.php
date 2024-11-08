<?php

session_start();

include 'db-conn.php';

$sql = "SELECT * FROM ec_categories ORDER BY id DESC";
$check = mysqli_query($conn, $sql);




// Initialize an empty array to store validation errors
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate Parent Category
    if (empty($_POST['parent-id'])) {
        $errors['parent-id'] = "Parent Category is required.";
    } else {
        $parent_id = mysqli_real_escape_string($conn, $_POST['parent-id']);
    }


    // Validate Category Name
    if (empty($_POST['cate_name'])) {
        $errors['cate_name'] = "Category Name is required.";
    } else {
        $cate_name = mysqli_real_escape_string($conn, trim($_POST['cate_name']));
    }

    // Validate Meta Title
    if (empty($_POST['meta_title'])) {
        $errors['meta_title'] = "Meta Title is required.";
    } else {
        $meta_title = mysqli_real_escape_string($conn, trim($_POST['meta_title']));
    }

    // Validate Meta Keywords
    if (empty($_POST['meta_key'])) {
        $errors['meta_key'] = "Meta Keywords are required.";
    } else {
        $meta_key = mysqli_real_escape_string($conn, trim($_POST['meta_key']));
    }

    // Validate Meta Description
    if (empty($_POST['meta_desc'])) {
        $errors['meta_desc'] = "Meta Description is required.";
    } else {
        $meta_desc = mysqli_real_escape_string($conn, trim($_POST['meta_desc']));
    }

    // Validate Status
    if (!isset($_POST['status']) || $_POST['status'] === 'Choose...') {
        $errors['status'] = "Status is required.";
    } else {
        $status = mysqli_real_escape_string($conn, $_POST['status']);
    }


    // Check if no validation errors
    if (empty($errors)) {
        // Proceed with inserting the category if no errors
        $cate_id = mt_rand(00001, 99999);
        $added_on = date('M d, Y');
        $slug_url = SlugUrl($cate_name);
        // $parent_id = $_POST['parent-id'];

        $sql = "INSERT INTO ec_sub_categories (cate_id, parent_id, cate_name, meta_title, meta_desc, meta_key, slug_url, status, added_on)
            VALUES ('$cate_id', '$parent_id', '$cate_name', '$meta_title', '$meta_desc', '$meta_key', '$slug_url', '$status', '$added_on')";
        $check = mysqli_query($conn, $sql);

        if ($check) {
            echo "<script type='text/javascript'>alert('Category Added Successfully'); window.location='view-sub-categories.php';</script>";
        } else {
            echo "<p style='color: red;'>Failed to add category. " . mysqli_error($conn) . "</p>";
        }
    }
}

function SlugUrl($string)
{
    // Replace non-letter or digits by '-'
    $slug = preg_replace('~[^\pL\d]+~u', '-', $string);

    // Transliterate (convert characters to ASCII)
    $slug = iconv('utf-8', 'us-ascii//TRANSLIT', $slug);

    // Remove unwanted characters
    $slug = preg_replace('~[^-\w]+~', '', $slug);

    // Trim leading and trailing hyphens
    $slug = trim($slug, '-');

    // Remove duplicate hyphens
    $slug = preg_replace('~-+~', '-', $slug);

    // Convert to lowercase
    $slug = strtolower($slug);

    return $slug;
}

?>


<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Add Sub Category</title>
    <link rel="icon" href="assets/img/logo.png" type="image/png">
    <link rel="stylesheet" href="assets/css/bootstrap1.min.css" /> <?php include 'links.php'; ?>
</head>

<body class="crm_body_bg">
    <?php include 'header.php'; ?>
    <?php include 'functions.php'; ?>
    <section class="main_content dashboard_part large_header_bg">
        <?php include 'header_nav.php'; ?>

        <div class="main_content_iner ">
            <div class="container-fluid p-0 sm_padding_15px">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="white_card card_height_100 mb_30">

                            <div class="white_card_body pt-5">
                                <div class="card-body">
                                    <h4 class="card-title mb-5">Fill Sub Category Details</h4>
                                    <!-- form -->
                                    <form action="add-sub-categories.php" method="POST">

                                        <div class="row mb-3">
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="parent-id">Parent Category </label>
                                                <Select class="form-control" id="parent-id" name="parent-id">
                                                    <option value="">--Select Category--</option>
                                                    <?php foreach ($check as $val) {  ?>
                                                        <option value="<?php echo $val['cate_id'] ?>"><?php echo $val['cate_name'] ?></option>
                                                    <?php    } ?>
                                                </Select>
                                                <?php if (isset($errors['cate_name'])): ?>
                                                    <span class="error-message"
                                                        style="color:red;"><?= $errors['cate_name'] ?></span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="cate_name">Sub Category Name</label>
                                                <input type="text" name="cate_name" class="form-control" id="cate_name"
                                                    value="<?= isset($_POST['cate_name']) ? $_POST['cate_name'] : '' ?>">
                                                <?php if (isset($errors['cate_name'])): ?>
                                                    <span class="error-message"
                                                        style="color:red;"><?= $errors['cate_name'] ?></span>
                                                <?php endif; ?>
                                            </div>

                                            <div class="form-group  col-md-6 mb-3">
                                                <label for="meta_title">Meta Title</label>
                                                <input type="text" name="meta_title" class="form-control" id="meta_title"
                                                    value="<?= isset($_POST['meta_title']) ? $_POST['meta_title'] : '' ?>">
                                                <?php if (isset($errors['meta_title'])): ?>
                                                    <span class="error-message"
                                                        style="color:red;"><?= $errors['meta_title'] ?></span>
                                                <?php endif; ?>
                                            </div>

                                            <div class="form-group col-md-6 mb-3">
                                                <label for="meta_key">Meta Keywords</label>
                                                <input type="text" name="meta_key" class="form-control" id="meta_key"
                                                    value="<?= isset($_POST['meta_key']) ? $_POST['meta_key'] : '' ?>">
                                                <?php if (isset($errors['meta_key'])): ?>
                                                    <span class="error-message"
                                                        style="color:red;"><?= $errors['meta_key'] ?></span>
                                                <?php endif; ?>
                                            </div>

                                            <div class="form-group col-md-6 mb-3">
                                                <label for="meta_desc">Meta Description</label>
                                                <input type="text" name="meta_desc" class="form-control" id="meta_desc"
                                                    value="<?= isset($_POST['meta_desc']) ? $_POST['meta_desc'] : '' ?>"> </>
                                                <?php if (isset($errors['meta_desc'])): ?>
                                                    <span class="error-message"
                                                        style="color:red;"><?= $errors['meta_desc'] ?></span>
                                                <?php endif; ?>
                                            </div>

                                            <div class="form-group col-md-6 mb-3 ">
                                                <label for="inputstatus">Status</label>
                                                <select name="status" class="form-control" id="inputstatus">
                                                    <option selected>Choose...</option>
                                                    <option value="1"
                                                        <?= (isset($_POST['status']) && $_POST['status'] == 1) ? 'selected' : '' ?>>
                                                        Active</option>
                                                    <option value="0"
                                                        <?= (isset($_POST['status']) && $_POST['status'] == 0) ? 'selected' : '' ?>>
                                                        Deactive</option>
                                                </select>
                                                <?php if (isset($errors['status'])): ?>
                                                    <span class="error-message"
                                                        style="color:red;"><?= $errors['status'] ?></span>
                                                <?php endif; ?>
                                            </div>




                                        </div>
                                        <button type="submit" class="btn btn-primary">Add Sub Category</button>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>









        <?php include 'footer.php' ?>