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


function getAllProducts($conn)
{
    
    $sql = "SELECT * FROM ec_product WHERE status = 1 ORDER BY pro_id ASC";

    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Database query error: " . $e->getMessage());
        return [];
    }
}


// Function to search products by name and meta_keys
function searchProducts($conn, $searchTerm)
{
    $sql = "
        SELECT 
            ec_product.pro_id, 
            ec_product.pro_name, 
            ec_product.selling_price, 
            ec_product.pro_image, 
            ec_product.status,
            ec_product.meta_key,
            ec_categories.cate_name AS category_name, 
            ec_sub_categories.subcate_name AS subcategory_name
        FROM 
            ec_product
        JOIN 
            ec_categories ON ec_product.pro_cate = ec_categories.cate_id
        JOIN 
            ec_sub_categories ON ec_product.pro_sub_cate = ec_sub_categories.subcate_id
        WHERE 
            (
                LOWER(ec_product.pro_name) LIKE LOWER(:searchTermExact) OR
                LOWER(ec_product.pro_name) LIKE LOWER(:searchTermPartial) OR
                LOWER(ec_product.meta_key) LIKE LOWER(:searchTermExact) OR
                LOWER(ec_product.meta_key) LIKE LOWER(:searchTermPartial)
            )
            OR LOWER(ec_categories.cate_name) LIKE LOWER(:searchTermPartial)
            OR LOWER(ec_sub_categories.subcate_name) LIKE LOWER(:searchTermPartial)
        ORDER BY 
            ec_product.pro_id ASC";

    try {
        $stmt = $conn->prepare($sql);

        // Prepare search terms
        $exactMatch = '%' . str_replace(' ', '%', $searchTerm) . '%';
        $partialMatch = '%' . $searchTerm . '%';

        // Bind parameters
        $stmt->bindParam(':searchTermExact', $exactMatch, PDO::PARAM_STR);
        $stmt->bindParam(':searchTermPartial', $partialMatch, PDO::PARAM_STR);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Database query error: " . $e->getMessage());
        return [];
    }
}

// Function to get all products
// function getAllProducts($conn)
// {
//     $sql = "
//         SELECT 
//             ec_product.pro_id, 
//             ec_product.pro_name, 
//             ec_product.selling_price, 
//             ec_product.pro_image, 
//             ec_product.status,
//             ec_product.meta_key,
//             ec_categories.cate_name AS category_name, 
//             ec_sub_categories.subcate_name AS subcategory_name
//         FROM 
//             ec_product
//         JOIN 
//             ec_categories ON ec_product.pro_cate = ec_categories.cate_id
//         JOIN 
//             ec_sub_categories ON ec_product.pro_sub_cate = ec_sub_categories.subcate_id
//         ORDER BY 
//             ec_product.pro_id DESCS";

//     try {
//         $stmt = $conn->prepare($sql);
//         $stmt->execute();
//         return $stmt->fetchAll(PDO::FETCH_ASSOC);
//     } catch (PDOException $e) {
//         error_log("Database query error: " . $e->getMessage());
//         return [];
//     }
// }

/**
 * Fetch products with optional filters
 *
 * @param array $filters Associative array of filters (category_id, min_price, max_price, keyword).
 * @return array Filtered list of products.
 */
function fetchFilteredProducts($conn , $filters = [] )
{
    

    // Base query
    $query = "SELECT * FROM ec_product  
                JOIN ec_categories ON ec_product.pro_cate = ec_categories.cate_id
                JOIN ec_sub_categories ON ec_product.pro_sub_cate = ec_sub_categories.subcate_id
                ORDER BY ec_product.pro_id ASC";

    // Add filters dynamically
    if (!empty($filters['cate_id'])) {
        $query .= " AND cate_id = " . intval($filters['cate_id']);
    }

    if (!empty($filters['min_price'])) {
        $query .= " AND price >= " . floatval($filters['min_price']);
    }

    if (!empty($filters['max_price'])) {
        $query .= " AND price <= " . floatval($filters['max_price']);
    }

    if (!empty($filters['meta_key'])) {
        $meta_key = $conn->real_escape_string(strtolower($filters['meta_key']));
        $query .= " AND (LOWER(key) LIKE '%$meta_key%' OR LOWER(description) LIKE '%$meta_key%')";
    }

    // Execute the query
    $result = $conn->query($query);

    if (!$result) {
        die("Query failed: " . $conn->error);
    }

    // Fetch results
    $products = $result->fetch_all(MYSQLI_ASSOC);

    // Close the connection
    $conn->close();

    return $products;
}

/**
 * Fetch products by category.
 *
 * @param int $categoryId The ID of the category to filter by.
 * @return array Filtered products by category.
 */
function fetchProductsByCategory($categoryId)
{
    return fetchFilteredProducts(['category_id' => $categoryId]);
}

/**
 * Fetch products by price range.
 *
 * @param float $minPrice Minimum price.
 * @param float $maxPrice Maximum price.
 * @return array Filtered products within the price range.
 */
function fetchProductsByPriceRange($minPrice, $maxPrice)
{
    return fetchFilteredProducts(['min_price' => $minPrice, 'max_price' => $maxPrice]);
}

/**
 * Fetch products by keyword.
 *
 * @param string $keyword Keyword to search for.
 * @return array Filtered products containing the keyword.
 */
function fetchProductsByKeyword($meta_key)
{
    return fetchFilteredProducts(['meta_key' => $$meta_key]);
}


function getCategories($conn)
{
    $sql = "SELECT * FROM ec_categories WHERE status = 1 ORDER BY cate_name ASC, cate_id ASC";
    try {
        $stmt = $conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error fetching categories: " . $e->getMessage());
        return [];
    }
}

function getSubcategories($conn, $categoryId)
{
    $sql = "SELECT * FROM ec_sub_categories WHERE status = 1 AND parent_cate_id = :cate_id ORDER BY subcate_id ASC";
    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':cate_id', $categoryId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error fetching subcategories: " . $e->getMessage());
        return [];
    }
}


    // product page filter end

// product page end
?>