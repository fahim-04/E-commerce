<?php
session_start();
include 'functions.php';

// Initialize page parameters
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$search = isset($_GET['search']) ? $_GET['search'] : '';
$results_per_page = 15;


// Calculate total pages
$total_pages = getOrderPagesCount($conn, $search, $results_per_page);
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>View Orders</title>
    <link rel="icon" href="assets/img/st_white.png" type="image/png">
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
                                        <h4>Orders</h4>

                                    </div>

                                    <div class="QA_table mb_30">
                                        <form method="get" action="">
                                            <input type="text" name="search" placeholder="Search orders..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                                            <button type="submit">Search</button>
                                        </form>

                                        <table class="table lms_table_active">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Item Name</th>
                                                    <th scope="col">Item ID</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Number</th>
                                                    <th scope="col">Qty</th>
                                                    <th scope="col">Total Price</th>
                                                    <th scope="col">Ordered On</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php echo get_Orders($conn, $search, $page); ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="pagination d-flex justify-content-center mt-4">
                                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                            <a href="orders.php?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>" class="btn <?php echo ($i === $page ? 'btn-primary' : 'btn-default'); ?>"><?php echo $i; ?></a>
                                        <?php endfor; ?>
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
    </section>
</body>

</html>