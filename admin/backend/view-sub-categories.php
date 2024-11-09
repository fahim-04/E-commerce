<?php
session_start();
include 'functions.php';
include 'search_sub_categories.php';

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10;
$search = isset($_GET['search']) ? $_GET['search'] : "";
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>View Sub Category</title>
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
                                        <h4>Sub Category Table</h4>
                                        <div class="box_right d-flex lms_block">
                                            <div class="add_button ms-2">
                                                <a href="add-sub-categories.php" data-bs-toggle="modal" data-bs-target="#addcategory" class="btn_1">Add New</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="QA_table mb_30">
                                        <div class="search-bar mb-3">
                                            <input type="text" id="searchInput" class="form-control" style="max-width: 300px;" placeholder="Search...">
                                        </div>
                                        <table class="table lms_table_active">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Sub Category ID</th>
                                                    <th scope="col">Parent Category</th>
                                                    <th scope="col">Sub Category Name</th>
                                                    <th scope="col">Slug URL</th>
                                                    <th scope="col">Added On</th>
                                                    <th scope="col">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tableBody">
                                                <?php echo get_sub_Categories($conn, $page, $limit, $search); ?>
                                                
                                            </tbody>
                                        </table>
                                        <!-- Pagination links -->
                                        <div class="pagination d-flex justify-content-center mt-4">
                                            <?php
                                            $totalPages = getTotalSubCategoriesPages($conn, $limit, $search);

                                            if ($page > 1) {
                                                echo '<a href="?page=' . ($page - 1) . '&search=' . $search . '" class="btn btn-secondary mr-1">Previous</a>';
                                            }

                                            for ($i = 1; $i <= $totalPages; $i++) {
                                                echo '<a href="?page=' . $i . '&search=' . $search . '" class="btn ' . ($i === $page ? 'btn-primary' : 'btn-default') . ' mr-1">' . $i . '</a>';
                                            }

                                            if ($page < $totalPages) {
                                                echo '<a href="?page=' . ($page + 1) . '&search=' . $search . '" class="btn btn-secondary">Next</a>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include 'footer.php'; ?>
        <script>
            document.getElementById("searchInput").addEventListener("keyup", function() {
                var query = this.value.trim();
                var xhr = new XMLHttpRequest();
                xhr.open("GET", "search_sub_categories.php?query=" + encodeURIComponent(query), true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        document.getElementById("tableBody").innerHTML = xhr.responseText;
                    }
                }
                xhr.send();
                // window.location.href = "demo.php?search=" + encodeURIComponent(query);
            });
        </script>