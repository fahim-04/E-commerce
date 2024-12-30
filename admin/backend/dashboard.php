<?php
session_start();
$filepath = realpath(dirname(__FILE__));
include $filepath . '/connection.php';
include $filepath . '/functions.php';
// Restrict access to logged-in users
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false) {
    header('Location: index.php');
    exit;
}
// Retrieve user data from the session
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
// Check if user data is available
if ($user) {
    // Check if the user type is 'user' and redirect if true
    if ($user['user_type'] == "user") {
        header("Location: ../web/index.php");
        exit;
    }
    // Use $user data in this page
    $user_name = $user['user_name'];
    $user_email = $user['user_email'];
} else {
    // If no user data, redirect to login
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Dashboard</title>
    <link rel="icon" href="assets/img/logo.png" type="image/png">
    <!-- <link rel="stylesheet" href="assets/css/bootstrap1.min.css" /> -->
    <?php include 'links.php'; ?>
</head>

<body class="crm_body_bg">

    <section class="main_content dashboard_part large_header_bg">
        <?php include 'header.php'; ?>
        <?php include 'header_nav.php'; ?>
        <div class="container mt-5" style="z-index: 9999;">
            <div id="welcomeAlert" class="alert alert-success alert-dismissible fade show" role="alert"
                style="position: fixed; top: 20px; left: 70% ; transform: translateX(-50%); z-index: 9999;">
                Hello, <?php echo $_SESSION['user_name']; ?>! <br>
                Welcome to the dashboard.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>

        <div class="main_content_iner overly_inner">

            <div class="container-fluid p-0 ">

                <div class="row">
                    <div class="col-12">
                        <div class="page_title_box d-flex align-items-center justify-content-between">
                            <div class="page_title_left">
                                <h3 class="f_s_30 f_w_700 text_white">Dashboard</h3>
                            </div>
                            <a href="#" class="white_btn3">Create Report</a>
                        </div>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-lg-12 card_height_100">
                        <div class="white_card mb_20">
                            <div class="white_card_header">
                                <div class="box_header m-0">
                                    <div class="main-title">
                                        <h3 class="m-0">Revenue</h3>
                                    </div>
                                    <div class="float-lg-right float-none sales_renew_btns justify-content-end">
                                        <ul class="nav">
                                            <li class="nav-item">
                                                <a class="nav-link active" href="#">This Week</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#">Last Week</a>
                                            </li>
                                            <li class="nav-item"><a class="nav-link" href="#">Last Month</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="white_card_body" style="height: 286px;">
                                <canvas id="bar"></canvas>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-4">
                        <div class="white_card card_height_100 mb_20">
                            <div class="white_card_header">
                                <div class="box_header m-0">
                                    <div class="main-title">
                                        <h3 class="m-0">Daily Sales</h3>
                                    </div>
                                    <div class="header_more_tool">
                                        <div class="dropdown">
                                            <span class="dropdown-toggle" id="dropdownMenuButton"
                                                data-bs-toggle="dropdown">
                                                <i class="ti-more-alt"></i>
                                            </span>
                                            <div class="dropdown-menu dropdown-menu-right"
                                                aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="#"> <i class="ti-eye"></i> Action</a>
                                                <a class="dropdown-item" href="#"> <i class="ti-trash"></i> Delete</a>
                                                <a class="dropdown-item" href="#"> <i class="fas fa-edit"></i> Edit</a>
                                                <a class="dropdown-item" href="#"> <i class="ti-printer"></i> Print</a>
                                                <a class="dropdown-item" href="#"> <i class="fa fa-download"></i>
                                                    Download</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="white_card_body">
                                <div id="chart-currently"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="white_card card_height_100 mb_20">
                            <div class="white_card_header">
                                <div class="box_header m-0">
                                    <div class="main-title">
                                        <h3 class="m-0">Summary</h3>
                                    </div>
                                    <div class="header_more_tool">
                                        <div class="dropdown">
                                            <span class="dropdown-toggle" id="dropdownMenuButton"
                                                data-bs-toggle="dropdown">
                                                <i class="ti-more-alt"></i>
                                            </span>
                                            <div class="dropdown-menu dropdown-menu-right"
                                                aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="#"> <i class="ti-eye"></i> Action</a>
                                                <a class="dropdown-item" href="#"> <i class="ti-trash"></i> Delete</a>
                                                <a class="dropdown-item" href="#"> <i class="fas fa-edit"></i> Edit</a>
                                                <a class="dropdown-item" href="#"> <i class="ti-printer"></i> Print</a>
                                                <a class="dropdown-item" href="#"> <i class="fa fa-download"></i>
                                                    Download</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="white_card_body mt_30">
                                <div id="bar1" class="barfiller">
                                    <div class="tipWrap">
                                        <span class="tip"></span>
                                    </div>
                                    <span class="fill" data-percentage="25"></span>
                                </div>
                                <div id="bar2" class="barfiller">
                                    <div class="tipWrap">
                                        <span class="tip"></span>
                                    </div>
                                    <span class="fill" data-percentage="75"></span>
                                </div>
                                <div id="bar3" class="barfiller mb-0">
                                    <div class="tipWrap">
                                        <span class="tip"></span>
                                    </div>
                                    <span class="fill" data-percentage="34"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="white_card card_height_100 mb_20">
                            <div class="white_card_header">
                                <div class="box_header m-0">
                                    <div class="main-title">
                                        <h3 class="m-0">Total Traffic</h3>
                                    </div>
                                    <div class="float-lg-right float-none sales_renew_btns justify-content-end">
                                        <ul class="nav">
                                            <li class="nav-item">
                                                <a class="nav-link active" href="#">Today</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#">This week</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="white_card_body d-flex align-items-center" style="height:140px">
                                <h4 class="f_w_900 f_s_60 mb-0 me-2">1643</h4>
                                <div class="w-100" style="height:100px">
                                    <canvas width="100%" id="page_views"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="white_card card_height_100  mb_20">
                            <div class="white_card_header">
                                <div class="box_header m-0">
                                    <div class="main-title">
                                        <h3 class="m-0">News & Update</h3>
                                    </div>
                                    <div class="single_wrap_input">
                                        <select class="nice_Select2 wide" name id>
                                            <option value="1">Today</option>
                                            <option value="1">Tomorrow</option>
                                            <option value="1">Yesterday</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="white_card_body">
                                <div class="single_update_news">
                                    <h5 class="byer_name f_s_16 f_w_600 color_theme2">Mobile: Latest Smartphone Deals</h5>
                                    <p class="color_gray f_s_12 f_w_700">Get up to 36% off on the latest Pixel lights technology.</p>
                                </div>
                                <div class="single_update_news">
                                    <h5 class="byer_name f_s_16 f_w_600 color_theme2">Tablet: New Generation Tablets Launched</h5>
                                    <p class="color_gray f_s_12 f_w_700">Introducing cutting-edge tablets for productivity and entertainment.</p>
                                </div>
                                <div class="single_update_news">
                                    <h5 class="byer_name f_s_16 f_w_600 color_theme2">Smartwatch: Exclusive 50% Discount</h5>
                                    <p class="color_gray f_s_12 f_w_700">Grab the latest smartwatches with advanced health tracking features.</p>
                                </div>
                                <div class="load_more_button text-center mt_30">
                                    <a class="theme_text_btn d-flex align-items-center justify-content-center" href="#">
                                        Load more <i class="ti-angle-down f_s_12 ms-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="white_card card_height_100  mb_20">
                            <div class="white_card_header">
                                <div class="box_header m-0">
                                    <div class="main-title">
                                        <h3 class="m-0">Expences</h3>
                                    </div>
                                    <div class="header_more_tool">
                                        <div class="dropdown">
                                            <span class="dropdown-toggle" id="dropdownMenuButton"
                                                data-bs-toggle="dropdown">
                                                <i class="ti-more-alt"></i>
                                            </span>
                                            <div class="dropdown-menu dropdown-menu-right"
                                                aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="#"> <i class="ti-eye"></i> Action</a>
                                                <a class="dropdown-item" href="#"> <i class="ti-trash"></i> Delete</a>
                                                <a class="dropdown-item" href="#"> <i class="fas fa-edit"></i> Edit</a>
                                                <a class="dropdown-item" href="#"> <i class="ti-printer"></i> Print</a>
                                                <a class="dropdown-item" href="#"> <i class="fa fa-download"></i>
                                                    Download</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="white_card_body">
                                <div class="monthly_plan_wraper">
                                    <div class="single_plan d-flex align-items-center justify-content-between">
                                        <h5 class="color_theme2 f_s_14 f_w_700 mb-0">Rent</h5>
                                        <span class="color_gray2 f_s_16 f_w_700">$500</span>
                                    </div>
                                    <div class="single_plan d-flex align-items-center justify-content-between">
                                        <h5 class="color_theme2 f_s_14 f_w_700 mb-0">Internet</h5>
                                        <span class="color_gray2 f_s_16 f_w_700">$50</span>
                                    </div>
                                    <div class="single_plan d-flex align-items-start justify-content-between">
                                        <div>
                                            <h5 class="color_theme2 f_s_14 f_w_700 mb-0">Extera</h5>
                                            <p class="f_s_13 f_w_700">Sofa, Confarence table</p>
                                        </div>
                                        <span class="color_gray2 f_s_16 f_w_700">$2370</span>
                                    </div>
                                    <div class="total_blance mt_20 mb_10">
                                        <span class="f_s_13 f_w_700 color_gray ">Total </span>
                                        <div
                                            class="total_blance_inner d-flex align-items-center flex-wrap justify-content-between">
                                            <div>
                                                <span class="f_s_40 f_w_700 color_text_3 d-block">$2920</span>
                                                <!-- <a class="badge_btn_5" href="#">+1235</a> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="white_card card_height_100 mb_20">
                            <div class="date_picker_wrapper">
                                <div class="default-datepicker">
                                    <div class="datepicker-here" data-language="en"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <?php include 'footer.php'; ?>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                setTimeout(function() {
                    const welcomeAlert = document.getElementById('welcomeAlert');
                    if (welcomeAlert) {
                        welcomeAlert.classList.remove('show');
                        welcomeAlert.addEventListener('transitionend', function() {
                            welcomeAlert.remove();
                        });
                    }
                }, 10000); // 10 seconds
            });
        </script>