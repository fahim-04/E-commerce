<?php
session_start();
include 'db-conn.php';
// Get all categories
$sql = "SELECT * FROM ec_categories ORDER BY id DESC";
$check = mysqli_query($conn, $sql);
// Initialize an empty array to store validation errors
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];
    // Validate Category
    if (empty($_POST['pro_cate'])) {
        $errors['pro_cate'] = "Category is required.";
    } else {
        $pro_cate = mysqli_real_escape_string($conn, trim($_POST['pro_cate']));
    }
    // Validate Subcategory
    if (empty($_POST['pro_sub_cate'])) {
        $errors['pro_sub_cate'] = "Subcategory is required.";
    } else {
        $pro_sub_cate = mysqli_real_escape_string($conn, trim($_POST['pro_sub_cate']));
    }
    // Validate Product Name
    if (empty($_POST['pro_name'])) {
        $errors['pro_name'] = "Product Name is required.";
    } else {
        $pro_name = mysqli_real_escape_string($conn, trim($_POST['pro_name']));
    }
    // Validate Product Description
    if (empty($_POST['pro_desc'])) {
        $errors['pro_desc'] = "Product Description is required.";
    } else {
        $pro_desc = mysqli_real_escape_string($conn, trim($_POST['pro_desc']));
    }
    // Validate  Product Short Description
    if (empty($_POST['pro_short_desc'])) {
        $errors['pro_short_desc'] = "Product Description is required.";
    } else {
        $pro_short_desc = mysqli_real_escape_string($conn, trim($_POST['pro_short_desc']));
    }
    // Validate Stocks
    if (empty($_POST['stocks'])) {
        $errors['stocks'] = "Stocks is required.";
    } elseif (!is_numeric($_POST['stocks']) || $_POST['stocks'] < 0) {
        $errors['stocks'] = "Stocks must be a non-negative number.";
    } else {
        $stocks = mysqli_real_escape_string($conn, trim($_POST['stocks']));
    }
    // Validate MRP
    if (empty($_POST['mrp'])) {
        $errors['mrp'] = "MRP is required.";
    } elseif (!is_numeric($_POST['mrp']) || $_POST['mrp'] <= 0) {
        $errors['mrp'] = "MRP must be a positive number.";
    } else {
        $mrp = mysqli_real_escape_string($conn, trim($_POST['mrp']));
    }
    // Validate Selling Price
    if (empty($_POST['selling_price'])) {
        $errors['selling_price'] = "Selling Price is required.";
    } elseif (!is_numeric($_POST['selling_price']) || $_POST['selling_price'] <= 0) {
        $errors['selling_price'] = "Selling Price must be a positive number.";
    } else {
        $selling_price = mysqli_real_escape_string($conn, trim($_POST['selling_price']));
    }
    // Validate Product Image
    if (isset($_FILES['pro_image']) && $_FILES['pro_image']['error'] === UPLOAD_ERR_OK) {
        // Check if the uploaded file is a valid image 
        $image_info = getimagesize($_FILES['pro_image']['tmp_name']);
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        $file_extension = strtolower(pathinfo($_FILES['pro_image']['name'], PATHINFO_EXTENSION));
        if ($image_info === false) {
            $errors['pro_image'] = "The file is not a valid image.";
        } elseif (!in_array($file_extension, $allowed_extensions)) {
            $errors['pro_image'] = "Only image files (JPG, JPEG, PNG, GIF) are allowed.";
        } else {
            // Generate a unique name for the image
            $filename = time() . '_' . uniqid() . '_' . $_FILES['pro_image']['name'];
            $tmpname = $_FILES['pro_image']['tmp_name'];
            $destination = './assets/img/uploade_prod_img/' . $filename;
            //  move the uploaded file to the designated directory
            if (move_uploaded_file($tmpname, $destination)) {
                $pro_image = $filename; // Use this new file name for the database entry
            } else {
                $errors['pro_image'] = "Failed to upload the image.";
            }
        }
    } else {
        $errors['pro_image'] = "Product Image is required.";
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
        $pro_id = mt_rand(10000, 99999);
        $added_on = date('M d, Y');
        $slug_url = SlugUrl($pro_cate . ' ' . $pro_sub_cate . ' ' . $pro_name);
        // $filename = time() . '_' . uniqid() . '_' . $_FILES['pro_image']['name'];
        // $tmpname = $_FILES['pro_image']['tmp_name'];
        // $destination = './assets/img/uploade_prod_img/' . $filename;
        // move_uploaded_file($tmpname, $destination);
        // '$',
        $sql = "INSERT INTO ec_product (pro_id, pro_name, pro_cate, pro_sub_cate, pro_desc, pro_short_desc, stock, mrp, selling_price, pro_image, meta_title, meta_desc, meta_key, status, slug_url, added_on)
                VALUES('$pro_id', '$pro_name', '$pro_cate', '$pro_sub_cate', '$pro_desc','$pro_short_desc', '$stocks', '$mrp', '$selling_price', '$destination', '$meta_title', '$meta_desc', '$meta_key', 1, '$slug_url',  '$added_on')";
        $check = mysqli_query($conn, $sql);
        if ($check) {
            echo "<script type='text/javascript'>alert('Product Added Successfully'); window.location='view-products.php';</script>";

        } else {
            // Display the SQL error
            echo "<p style='color: red;'>Failed to add product. " . mysqli_error($conn) . "</p>";
            echo "<p style='color: red;'>SQL Query: $sql</p>";
        }
    }
}
// Function to generate slug URL
function SlugUrl($string)
{
    $slug = preg_replace('~[^\pL\d]+~u', '-', $string);
    $slug = iconv('utf-8', 'us-ascii//TRANSLIT', $slug);
    $slug = preg_replace('~[^-\w]+~', '', $slug);
    $slug = trim($slug, '-');
    $slug = preg_replace('~-+~', '-', $slug);
    $slug = strtolower($slug);
    return $slug;
}
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Add product</title>
    <link rel="icon" href="assets/img/logo.png" type="image/png">
    <link rel="stylesheet" href="assets/css/bootstrap1.min.css" />
    <?php include 'links.php'; ?>
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
                            <div class="white_card_header">
                                <div class="box_header m-0">
                                    <div class="main-title">
                                        <h3 class="m-0"> </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="white_card_body">
                                <div class="card-body">
                                    <h4 class="card-title mb-5">Fill Product Details</h4>
                                    <!-- form -->
                                    <form action="add-product.php" method="POST" enctype="multipart/form-data">
                                        <div class="row mb-3">
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="pro_cate">Parent Category</label>
                                                <select class="form-control" id="parent-id" name="pro_cate" onchange="get_subcategory(this.value);">
                                                    <option value="">--Select Category--</option>
                                                    <?php foreach ($check as $val) { ?>
                                                        <option value="<?php echo $val['cate_id']; ?>"><?php echo $val['cate_name']; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <?php if (isset($errors['pro_cate'])): ?>
                                                    <span class="error-message" style="color:red;"><?php $errors['pro_cate'] ?></span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="subcat_id">Sub Category </label>
                                                <Select class="form-control" id="subcat_id" name="pro_sub_cate">
                                                    <option value="">--Select Sub Category--</option>
                                                </Select>
                                                <?php if (isset($errors['cate_name'])): ?>
                                                    <span class="error-message"
                                                        style="color:red;"><?php $errors['cate_name'] ?></span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="pro_name">Product Name</label>
                                                <input type="text" name="pro_name" class="form-control" id="pro_name"
                                                    value="<?php isset($_POST['pro_name']) ? $_POST['pro_name'] : '' ?>">
                                                <?php if (isset($errors['pro_name'])): ?>
                                                    <span class="error-message"
                                                        style="color:red;"><?php $errors['pro_name'] ?></span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="form-group  col-md-6 mb-3">
                                                <label for="pro_desc">Product Description</label>
                                                <textarea type="text" name="pro_desc" class="form-control" id="pro_desc"
                                                    value="<?php isset($_POST['pro_desc']) ? $_POST['pro_desc'] : '' ?>"></textarea>
                                                <?php if (isset($errors['pro_desc'])): ?>
                                                    <span class="error-message"
                                                        style="color:red;"><?php $errors['pro_desc'] ?></span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="form-group  col-md-6 mb-3">
                                                <label for="pro_short_desc">Product Short Description</label>
                                                <textarea type="text" name="pro_short_desc" class="form-control" id="pro_short_desc"
                                                    value="<?php isset($_POST['pro_desc']) ? $_POST['pro_short_desc'] : '' ?>"></textarea>
                                                <?php if (isset($errors['pro_short_desc'])): ?>
                                                    <span class="error-message"
                                                        style="color:red;"><?php $errors['pro_short_desc'] ?></span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="form-group  col-md-6 mb-3">
                                                <label for="stocks">Stocks</label>
                                                <input type="text" name="stocks" class="form-control" id="stocks"
                                                    value="<?php isset($_POST['stocks']) ? $_POST['stocks'] : '' ?>">
                                                <?php if (isset($errors['stocks'])): ?>
                                                    <span class="error-message"
                                                        style="color:red;"><?php $errors['stocks'] ?></span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="form-group  col-md-6 mb-3">
                                                <!-- MRP = maximum Retail Price -->
                                                <label for="pro_mrp">MRP</label>
                                                <input type="text" name="mrp" class="form-control" id="mrp"
                                                    value="<?php isset($_POST['mrp']) ? $_POST['mrp'] : '' ?>">
                                                <?php if (isset($errors['mrp'])): ?>
                                                    <span class="error-message"
                                                        style="color:red;"><?php $errors['mrp'] ?></span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="form-group  col-md-6 mb-3">
                                                <label for="selling_price">Selling Price</label>
                                                <input type="text" name="selling_price" class="form-control" id="selling_price"
                                                    value="<?php isset($_POST['selling_price']) ? $_POST['selling_price'] : '' ?>">
                                                <?php if (isset($errors['selling_price'])): ?>
                                                    <span class="error-message"
                                                        style="color:red;"><?php $errors['selling_price'] ?></span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="form-group  col-md-6 mb-3">
                                                <label for="pro_image">Product Image</label>
                                                <input type="file" name="pro_image" class="form-control" id="pro_image"
                                                    value="<?php isset($_POST['pro_image']) ? $_POST['pro_image'] : '' ?>">
                                                <?php if (isset($errors['pro_image'])): ?>
                                                    <span class="error-message"
                                                        style="color:red;"><?php $errors['pro_image'] ?></span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="form-group  col-md-6 mb-3">
                                                <label for="meta_title">Meta Title</label>
                                                <input type="text" name="meta_title" class="form-control" id="meta_title"
                                                    value="<?php isset($_POST['meta_title']) ? $_POST['meta_title'] : '' ?>">
                                                <?php if (isset($errors['meta_title'])): ?>
                                                    <span class="error-message"
                                                        style="color:red;"><?php $errors['meta_title'] ?></span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="meta_key">Meta Keywords</label>
                                                <input type="text" name="meta_key" class="form-control" id="meta_key"
                                                    value="<?php isset($_POST['meta_key']) ? $_POST['meta_key'] : '' ?>">
                                                <?php if (isset($errors['meta_key'])): ?>
                                                    <span class="error-message"
                                                        style="color:red;"><?php $errors['meta_key'] ?></span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="form-group col-md-6 mb-3 ">
                                                <label for="inputstatus">Status</label>
                                                <select name="status" class="form-control" id="inputstatus">
                                                    <option selected>Choose...</option>
                                                    <option value="1"
                                                        <?php (isset($_POST['status']) && $_POST['status'] == 1) ? 'selected' : '' ?>>
                                                        Active</option>
                                                    <option value="0"
                                                        <?php (isset($_POST['status']) && $_POST['status'] == 0) ? 'selected' : '' ?>>
                                                        Deactive</option>
                                                </select>
                                                <?php if (isset($errors['status'])): ?>
                                                    <span class="error-message"
                                                        style="color:red;"><?php $errors['status'] ?></span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="form-group col-md-6 mb-4">
                                                <label for="meta_desc">Meta Description</label>
                                                <input type="text" name="meta_desc" class="form-control" id="meta_desc"
                                                    value="<?php isset($_POST['meta_desc']) ? $_POST['meta_desc'] : '' ?>"> </>
                                                <?php if (isset($errors['meta_desc'])): ?>
                                                    <span class="error-message"
                                                        style="color:red;"><?php $errors['meta_desc'] ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Add Product</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'footer.php' ?>
        <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
        <!-- <script src="https://cdn.jsdelivr.net/gh/ckeditor/ckeditor4@4.25.0/standard/ckeditor.js"></script> -->
        <script>
            CKEDITOR.replace('pro_desc');
        </script>
        <!-- ajax function to get subcategory -->
        <script type="text/javascript">
            function get_subcategory(cate_id) {
                var cate_id = cate_id;
                $.ajax({
                    url: 'functions.php',
                    method: 'POST',
                    data: {
                        cate_id: cate_id
                    },
                    error: function() {
                        alert("Something went wrong");
                    },
                    success: function(data) {
                        $("#subcat_id").html(data);
                    }
                });
            }
        </script>