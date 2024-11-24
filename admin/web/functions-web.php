<?php
$filepath = realpath(dirname(__FILE__));
include $filepath . '/../backend/connection.php';

/**
 * Fetch products for a specific category
 * 
 * @param PDO $conn Database connection
 * @param int $categoryId Category ID for the products
 * @param int $limit Number of products to fetch
 * @return array List of products or an error message
 */
function getProductsByCategory($conn, $categoryId, $limit = 6)
{
    $sql = "SELECT pro_name, pro_image, slug_url 
            FROM ec_product 
            WHERE pro_cate = :category 
            ORDER BY id DESC 
            LIMIT :limit";

    try {
        // Prepare and execute the query
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':category', $categoryId, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        // Fetch and return results
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Database query error: " . $e->getMessage());
        return ["error" => "Error in SQL: " . $e->getMessage()];
    }
}

/**
 * Fetch smartphones
 * 
 * @param PDO $conn Database connection
 * @param int $categoryId Category ID for smartphones
 * @param int $limit Number of smartphones to fetch
 * @return array List of smartphones or an error message
 */
function getSPhones($conn, $categoryId = 1, $limit = 8)
{
    return getProductsByCategory($conn, $categoryId, $limit);
}

/**
 * Fetch tabs
 * 
 * @param PDO $conn Database connection
 * @param int $categoryId Category ID for tabs
 * @param int $limit Number of tabs to fetch
 * @return array List of tabs or an error message
 */
function getTabs($conn, $categoryId = 14747, $limit = 6)
{
    return getProductsByCategory($conn, $categoryId, $limit);
}

/**
 * Fetch smartwatches
 * 
 * @param PDO $conn Database connection
 * @param int $categoryId Category ID for smartwatches
 * @param int $limit Number of smartwatches to fetch
 * @return array List of smartwatches or an error message
 */
function getSmartWatches($conn, $categoryId = 74040, $limit = 6)
{
    return getProductsByCategory($conn, $categoryId, $limit);
}
?>