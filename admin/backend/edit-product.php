<?php
session_start();
include 'db-conn.php';

// Check if product ID is set in GET request
if (!isset($_GET['id'])) {
    echo "No product ID provided!";
    exit;
}

$product_id = $_GET['id'];

// Query to fetch the product details by pro_id
$sql = "SELECT pro_id, pro_name, pro_desc, pro_short_desc, stock, mrp, selling_price, pro_image, meta_title, meta_desc, meta_key, slug_url, status
        FROM ec_product 
        WHERE pro_id = '$product_id'";

$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $product = mysqli_fetch_assoc($result);
} else {
    echo "Product not found!";
    exit;
}

// Define SlugUrl function if not already defined
if (!function_exists('SlugUrl')) {
    function SlugUrl($string)
    {
        $slug = strtolower(trim($string));
        $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
        $slug = preg_replace('/-+/', '-', $slug);
        return rtrim($slug, '-');
    }
}

// Update product details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];

    // Form validation and sanitization
    $pro_name = mysqli_real_escape_string($conn, trim($_POST['pro_name'] ?? ''));
    $pro_desc = mysqli_real_escape_string($conn, trim($_POST['pro_desc'] ?? ''));
    $pro_short_desc = mysqli_real_escape_string($conn, trim($_POST['pro_short_desc'] ?? ''));
    $stocks = mysqli_real_escape_string($conn, trim($_POST['stocks'] ?? ''));
    $mrp = mysqli_real_escape_string($conn, trim($_POST['mrp'] ?? ''));
    $selling_price = mysqli_real_escape_string($conn, trim($_POST['selling_price'] ?? ''));
    $meta_title = mysqli_real_escape_string($conn, trim($_POST['meta_title'] ?? ''));
    $meta_key = mysqli_real_escape_string($conn, trim($_POST['meta_key'] ?? ''));
    $meta_desc = mysqli_real_escape_string($conn, trim($_POST['meta_desc'] ?? ''));
    $status = mysqli_real_escape_string($conn, $_POST['status'] ?? '1'); // Default to '1' if not provided
    $slug_url = SlugUrl($pro_name);

    // Handle image upload
    if (isset($_FILES['pro_image']) && $_FILES['pro_image']['error'] === UPLOAD_ERR_OK) {
        $filename = time() . '_' . uniqid() . '_' . $_FILES['pro_image']['name'];
        $tmpname = $_FILES['pro_image']['tmp_name'];
        $destination = './assets/img/uploade_prod_img/' . $filename;

        if (move_uploaded_file($tmpname, $destination)) {
            $pro_image = $filename;
        } else {
            $errors['pro_image'] = "Failed to upload the image.";
        }
    } else {
        $pro_image = $product['pro_image'] ?? '';
    }

    if (empty($errors)) {
        // Update query
        $sql = "UPDATE ec_product SET 
                    pro_name = '$pro_name',
                    pro_desc = '$pro_desc',
                    pro_short_desc = '$pro_short_desc',
                    stock = '$stocks',
                    mrp = '$mrp',
                    selling_price = '$selling_price',
                    pro_image = '$pro_image',
                    meta_title = '$meta_title',
                    meta_key = '$meta_key',
                    meta_desc = '$meta_desc',
                    status = '$status',
                    slug_url = '$slug_url'
                WHERE pro_id = '$product_id'";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Product Updated Successfully'); window.location='view-products.php';</script>";
        } else {
            echo "<p style='color: red;'>Failed to update product. " . mysqli_error($conn) . "</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Edit Product</title>
    <link rel="stylesheet" href="assets/css/bootstrap1.min.css" />
    <?php include 'links.php'; ?>
</head>

<body class="crm_body_bg">
    <?php include 'header.php'; ?>
    <section class="main_content dashboard_part large_header_bg">
        <?php include 'header_nav.php'; ?>
        <div class="main_content_iner">
            <div class="container-fluid p-0 sm_padding_15px">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="white_card card_height_100 mb_30">
                            <div class="white_card_body pt-5">
                                <div class="card-body">
                                    <h4 class="card-title mb-5">Edit Product</h4>
                                    <form action="" method="POST" class="row" enctype="multipart/form-data">
                                        <div class="form-group col-md-6 mb-3">
                                            <label for="pro_name">Product Name</label>
                                            <input type="text" name="pro_name" class="form-control" id="pro_name" value="<?= htmlspecialchars($product['pro_name'] ?? '') ?>">
                                        </div>
                                        <div class="form-group col-md-6 mb-3">
                                            <label for="pro_desc">Product Description</label>
                                            <textarea name="pro_desc" class="form-control" id="pro_desc"><?= htmlspecialchars($product['pro_desc'] ?? '') ?></textarea>
                                        </div>
                                        <div class="form-group col-md-6 mb-3">
                                            <label for="pro_short_desc">Product Short Description</label>
                                            <textarea name="pro_short_desc" class="form-control" id="pro_short_desc"><?= htmlspecialchars($product['pro_short_desc'] ?? '') ?></textarea>
                                        </div>
                                        <div class="form-group col-md-6 mb-3">
                                            <label for="stocks">Stocks</label>
                                            <input type="text" name="stocks" class="form-control" id="stocks" value="<?= htmlspecialchars($product['stock'] ?? '') ?>">
                                        </div>
                                        <div class="form-group col-md-6 mb-3">
                                            <label for="mrp">MRP</label>
                                            <input type="text" name="mrp" class="form-control" id="mrp" value="<?= htmlspecialchars($product['mrp'] ?? '') ?>">
                                        </div>
                                        <div class="form-group col-md-6 mb-3">
                                            <label for="selling_price">Selling Price</label>
                                            <input type="text" name="selling_price" class="form-control" id="selling_price" value="<?= htmlspecialchars($product['selling_price'] ?? '') ?>">
                                        </div>
                                        <div class="form-group col-md-6 mb-3">
                                            <label for="pro_image">Product Image</label>
                                            <input type="file" name="pro_image" class="form-control" id="pro_image">
                                            <p>Current Image: <?= htmlspecialchars($product['pro_image'] ?? 'No image available') ?></p>
                                        </div>
                                        <div class="form-group col-md-6 mb-3">
                                            <label for="meta_title">Meta Title</label>
                                            <input type="text" name="meta_title" class="form-control" id="meta_title" value="<?= htmlspecialchars($product['meta_title'] ?? '') ?>">
                                        </div>
                                        <div class="form-group col-md-6 mb-3">
                                            <label for="meta_key">Meta Keywords</label>
                                            <input type="text" name="meta_key" class="form-control" id="meta_key" value="<?= htmlspecialchars($product['meta_key'] ?? '') ?>">
                                        </div>
                                        <div class="form-group col-md-6 mb-3">
                                            <label for="meta_desc">Meta Description</label>
                                            <input type="text" name="meta_desc" class="form-control" id="meta_desc" value="<?= htmlspecialchars($product['meta_desc'] ?? '') ?>">
                                        </div>
                                        <div class="form-group col-md-6 mb-3">
                                            <label for="status">Status</label>
                                            <select name="status" class="form-control" id="status">
                                                <option value="1" <?= ($product['status'] ?? '1') == '1' ? 'selected' : '' ?>>Active</option>
                                                <option value="0" <?= ($product['status'] ?? '0') == '0' ? 'selected' : '' ?>>Deactive</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update Product</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'footer.php'; ?>
        <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
        <script>
            CKEDITOR.replace('pro_desc');
        </script>