<?php
session_start();
include 'functions.php';
include 'search_sub_categories.php';

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 20;
        $search = isset($_GET['search']) ? $_GET['search'] : "";

// Get filters from POST
$data = json_decode(file_get_contents('php: //input'), true);
$filters = [];

if ($data['smartphone'] ?? false) {
    $filters[] = "'Smartphone'";
}
if ($data['smartwatch'] ?? false) {
    $filters[] = "'Smartwatch'";
}
if ($data['tab'] ?? false) {
    $filters[] = "'Tab'";
}

// Build query
$filterQuery = '';
if (!empty($filters)) {
    $filterQuery = "WHERE category IN (" . implode(',', $filters) . ")";
}

$query = "SELECT * FROM products $filterQuery";
$result = $conn->query($query);

// Generate HTML for table rows
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                   <td>" . $sno++ . "</td>
                   <td><b>" . ($row['category_name'] ?? 'N/A') . "</b></td>
                   <td>" . ($row['subcategory_name'] ?? 'N/A') . "</td>
                   <td>" . $row['pro_id'] . "</td>
                   <td><h6>" . $row['pro_name'] . "</h6></td> 
                   <td>$" . $row['selling_price'] . "</td> 
                   <td><img src='" . $row['pro_image'] . "' alt='Product Image' style='width: 100px; height: auto;'></td>
                   <td><p style='color: $status_color;'>" . $status_text . "</p></td> 
                    <td>
                    <a href='edit-product.php?id=" . $row['pro_id'] . "' class='btn btn-primary btn-sm'>Edit</a>
                    <a href='delete-product.php?id=" . $row['pro_id'] . "' class='btn btn-danger btn-sm' onclick='return confirm('Are you sure?')'>Delete</a>
                </td>
                </tr>";
    }
} else {
    echo "<tr><td colspan='3'>No products found</td></tr>";
}
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

                                            <div class="form-check form-switch filterBy">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault filterBySM">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Smart Phone</label>
                                                </div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault filterBySW">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Smart Watch</label>
                                                </div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault filterByTab">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Tab</label>
                                                </div>
                                            </div>

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
        <script>
            document.querySelectorAll('.filterBy input').forEach((checkbox) => {
                checkbox.addEventListener('change', () => {
                    // Collect filter states
                    const filters = {
                        smartphone: document.getElementById('filterBySM').checked,
                        smartwatch: document.getElementById('filterBySW').checked,
                        tab: document.getElementById('filterByTab').checked,
                    };

                    // Make an AJAX request
                    fetch('view_products.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify(filters),
                        })
                        .then((response) => response.text())
                        .then((data) => {
                            document.getElementById('productTable').innerHTML = data; // Replace table content
                        })
                        .catch((error) => console.error('Error:', error));
                });
            });
        </script>