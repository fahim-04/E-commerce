<?php
session_start();
include 'functions.php';
// Initialize the page parameter and set a default value
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Initialize the search parameter if it's provided
$search = isset($_GET['search']) ? $_GET['search'] : '';
$results_per_page = $results_per_page ?? 10;

// Calculate the total number of pages
$total_pages = getProductPagesCount($conn, $search, $results_per_page);

?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>View Products</title>
    <link rel="icon" href="assets/img/logo.png" type="image/png">
    <link rel="stylesheet" href="assets/css/bootstrap1.min.css" />
    <?php include 'links.php'; ?>
</head>

<body class="crm_body_bg">
    <?php include 'header.php'; ?>

    <section class="main_content dashboard_part large_header_bg">
        <?php include 'header_nav.php'; ?>

        <div class="main_content_iner">
            <div class="container-fluid p-0">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="white_card card_height_100 mb_30">

                            <div class="white_card_body pt-5">
                                <div class="QA_section">
                                    <div class="white_box_tittle list_header">
                                        <h4>Products</h4>
                                        <div class="box_right d-flex lms_block">

                                            <div class="add_button ms-2">
                                                <a
                                                    href="add-product.php"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#addcategory"
                                                    class="btn_1">Add New</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="QA_table mb_30">
                                        <form method="get" action="view-products.php" class="mb-3">
                                            <input type="text" name="search" class="form-control" style="max-width: 300px;" placeholder="Search Products" value="<?php echo htmlspecialchars($search); ?>">
                                            <!-- <button type="submit" class="btn btn-primary ">Search</button> -->
                                        </form>
                                        <table class="table lms_table_active">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Category</th>
                                                    <th scope="col">Sub Category</th>
                                                    <th scope="col">Product ID</th>
                                                    <th scope="col">Products Name</th>
                                                    <th scope="col">Price</th>
                                                    <th scope="col">Product Image</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php echo get_Products($conn, $search, $page); ?>

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="pagination d-flex justify-content-center mt-4">
                                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                            <a href="view-products.php?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>">
                                                
                                            </a>
                                        <?php endfor;
                                              if ($page > 1) {
                                                echo '<a href="?page=' . ($page - 1) . '" class="btn btn-secondary mr-1">Previous</a>';
                                             }

                                            // Display the page numbers
                                            for ($i = 1; $i <= $total_pages; $i++) {
                                                echo '<a href="?page=' . $i . '" class="btn ' . ($i === $page ? 'btn-primary' : 'btn-default') . ' mr-1">' . $i . '</a>';
                                            }

                                                        // Display the "Next" button if not on the last page
                                            if ($page < $total_pages) {
                                              echo '<a href="?page=' . ($page + 1) . '" class="btn btn-secondary">Next</a>';
                                             }

                                        
                                        ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12"></div>
                </div>
            </div>
        </div>


        <?php include 'footer.php'; ?>

        <script>
            document.getElementById("searchInput").addEventListener("keyup", function() {
                var query = this.value.trim();
                var xhr = new XMLHttpRequest();
                xhr.open("GET", "view-products.php?query=" + encodeURIComponent(query), true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        document.querySelector(".QA_table tbody").innerHTML = xhr.responseText;
                    }
                };
                xhr.send();
            });
        </script>