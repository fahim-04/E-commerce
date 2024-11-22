<?php
$filepath = realpath(dirname(__FILE__));
include $filepath . '../backend/db-conn.php';

function getSmartPhones($conn)
{
    // Query to fetch the last 7 items
    $sql = "SELECT pro_name, pro_image, slug_url FROM ec_product WHERE pro_cate = 1 ORDER BY added_on DESC LIMIT 7";
    $result = $conn->query($sql);

    // Check if products exist
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            echo '<div class="slide">';
            echo '<div class="mt-product1">';
            echo '<div class="box">';
            echo '<div class="b1">';
            echo '<div class="b2">';
            echo '<div class="card" style="width: 18rem;">';
            echo '<img src="' . htmlspecialchars($row['pro_image']) . '" class="card-img-top" alt="' . htmlspecialchars($row['pro_name']) . '">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . htmlspecialchars($row['pro_name']) . '</h5>';
            echo '<a href="' . htmlspecialchars($row['slug_url']) . '" class="btn btn-primary">See more..</a>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
		
        }
    } else {
        echo "No products found.";
    }
}


?>

<div class="card" style="width: 18rem;">
    <img src="..." class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title"></h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
</div>