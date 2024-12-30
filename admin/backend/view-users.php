<?php
session_start();
include 'search_users.php';

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10;
$offset = ($page - 1) * $limit;
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Users</title>
    <link rel="icon" href="assets/img/logo.png" type="image/png">
    <link rel="stylesheet" href="assets/css/bootstrap1.min.css" />
    <link rel="icon" href="assets/img/st_white.png" type="image/png">
    <?php include 'links.php'; ?>
</head>

<body class="crm_body_bg">
    <?php include 'header.php'; ?>
    <?php include 'functions.php'; ?>

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
                                        <h4>USERS</h4>
                                        <div class="box_right d-flex lms_block">

                                            <div class="add_button ms-2">
                                                <a
                                                    href="add-user.php"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#addcategory"
                                                    class="btn_1">Add New</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="QA_table mb_30">
                                        <table class="table lms_table_active">
                                            <div class="search-bar mb-3">
                                                <input type="text" id="searchInput" class="form-control" style="max-width: 300px;" placeholder="Search...">
                                            </div>
                                            <thead>
                                                <tr>

                                                    <th scope="col"> ID</th>
                                                    <th scope="col"> Name</th>
                                                    <th scope="col"> Email</th>
                                                    <th scope="col"> Phone</th>
                                                    <th scope="col"> Type</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php echo get_UsersInfo($conn, $page, $limit); ?>

                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- Pagination links -->
                                    <div class="pagination d-flex justify-content-center mt-4">
                                        <?php
                                        $totalPages = getTotalPages($conn, $limit);

                                        // Display the "Previous" button if not on the first page
                                        if ($page > 1) {
                                            echo '<a href="?page=' . ($page - 1) . '" class="btn btn-secondary mr-1">Previous</a>';
                                        }

                                        // Display the page numbers
                                        for ($i = 1; $i <= $totalPages; $i++) {
                                            echo '<a href="?page=' . $i . '" class="btn ' . ($i === $page ? 'btn-primary' : 'btn-default') . ' mr-1">' . $i . '</a>';
                                        }

                                        // Display the "Next" button if not on the last page
                                        if ($page < $totalPages) {
                                            echo '<a href="?page=' . ($page + 1) . '" class="btn btn-secondary">Next</a>';
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


        <?php include 'footer.php'; ?>
        <script>
            document.getElementById("searchInput").addEventListener("keyup", function() {
                var query = this.value.trim();
                var xhr = new XMLHttpRequest();
                xhr.open("GET", "search_users.php?query=" + encodeURIComponent(query), true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        document.querySelector(".QA_table tbody").innerHTML = xhr.responseText;
                    }
                };
                xhr.send();
            });
        </script>