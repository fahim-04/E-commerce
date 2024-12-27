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
function getProductsByCategory($conn, $categoryId, $limit = 10)
{
    $sql = "SELECT pro_name, pro_image, slug_url, selling_price, pro_id
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
 * Fetch products
 * 
 * @param PDO $conn Database connection
 * @param int $categoryId Category ID for smartphones
 * @param int $limit Number of smartphones to fetch
 * @return array List of smartphones or an error message
 */
function getSPhones($conn, $categoryId = 1, $limit = 10)
{
    return getProductsByCategory($conn, $categoryId, $limit);
}


function getTabs($conn, $categoryId = 14747, $limit = 10)
{
    return getProductsByCategory($conn, $categoryId, $limit);
}


function getSmartWatches($conn, $categoryId = 74040, $limit = 7)
{
    return getProductsByCategory($conn, $categoryId, $limit);
}

// product page start


function getAllProducts($conn, $limit = 20, $offset = 0)
{
    $sql = "
        SELECT *
        FROM ec_product
        WHERE status = 1
        ORDER BY pro_id ASC
        LIMIT :limit OFFSET :offset
    ";

    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Database query error: " . $e->getMessage());
        return ["error" => "Error in SQL: " . $e->getMessage()];
    }
}

function searchProducts($conn, $searchTerm, $limit = 20, $offset = 0)
{
    // Split search term into keywords
    $keywords = preg_split('/\s+/', $searchTerm);

    $conditions = [];
    $params = [];
    foreach ($keywords as $index => $keyword) {
        // Escape special characters for MySQL REGEXP
        $escapedKeyword = addslashes($keyword); // Use addslashes for MySQL compatibility

        $paramName = "keyword$index";
        $conditions[] = "(
            LOWER(pro_name) LIKE LOWER(CONCAT('%', :$paramName, '%')) OR 
            LOWER(meta_key) LIKE LOWER(CONCAT('%', :$paramName, '%'))
        )"; // Changed REGEXP to LIKE for compatibility and simplicity
        $params[$paramName] = $escapedKeyword;
    }

    $whereClause = implode(' AND ', $conditions);

    $sql = "
        SELECT *
        FROM ec_product
        WHERE status = 1 AND ($whereClause)
        ORDER BY pro_name ASC
        LIMIT :limit OFFSET :offset
    ";

    try {
        $stmt = $conn->prepare($sql);
        foreach ($params as $paramName => $value) {
            $stmt->bindValue(":$paramName", $value, PDO::PARAM_STR);
        }
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Database query error: " . $e->getMessage());
        return ["error" => "Error in SQL: " . $e->getMessage()];
    }
}
// product page filter end


// product page end
?>