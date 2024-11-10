<?php
session_start();
include 'functions.php';
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>View Category</title>
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
                                        <h4>Category Table</h4>
                                        <div class="box_right d-flex lms_block">

                                            <div class="add_button ms-2">
                                                <a
                                                    href="add-categories.php"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#addcategory"
                                                    class="btn_1">Add New</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="QA_table mb_30">
                                        <table class="table lms_table_active">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Category ID</th>
                                                    <th scope="col">Category Name</th>
                                                    <th scope="col">Slug URL</th>
                                                    <th scope="col">Added On</th>
                                                    <th scope="col">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php echo get_Categories($conn); ?>

                                            </tbody>
                                        </table>
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