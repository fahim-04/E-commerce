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


function searchProducts($conn, $searchTerm)
{
    $sql = "
        SELECT 
            ec_product.pro_id, 
            ec_product.pro_name, 
            ec_product.selling_price, 
            ec_product.pro_image, 
            ec_product.status,
            ec_product.meta_title,
            ec_categories.cate_name AS category_name, 
            ec_sub_categories.cate_name AS subcategory_name
        FROM 
            ec_product
        JOIN 
            ec_categories ON ec_product.pro_cate = ec_categories.cate_id
        JOIN 
            ec_sub_categories ON ec_product.pro_sub_cate = ec_sub_categories.cate_id
        WHERE 
            ec_product.pro_name LIKE :searchTerm OR 
            ec_categories.cate_name LIKE :searchTerm OR 
            ec_sub_categories.cate_name LIKE :searchTerm
        ORDER BY 
            ec_product.pro_id DESC";

    try {
        $stmt = $conn->prepare($sql);
        $likeSearchTerm = '%' . $searchTerm . '%';
        $stmt->bindParam(':searchTerm', $likeSearchTerm, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Database query error: " . $e->getMessage());
        return [];
    }
}

function getFilteredProducts($conn, $filters)
{
    $sql = "SELECT * FROM ec_product WHERE status = 1";
    $params = [];

    // Filter by price range
    if (!empty($filters['min_price']) && !empty($filters['max_price'])) {
        $sql .= " AND selling_price BETWEEN :min_price AND :max_price";
        $params[':min_price'] = $filters['min_price'];
        $params[':max_price'] = $filters['max_price'];
    }

    // Filter by category
    if (!empty($filters['cate_id'])) {
        $sql .= " AND pro_cate = :cate_id";
        $params[':cate_id'] = $filters['cate_id'];
    }

    // Filter by subcategory
    if (!empty($filters['subcate_id'])) {
        $sql .= " AND pro_sub_cate = :subcate_id";
        $params[':subcate_id'] = $filters['subcate_id'];
    }

    // Filter by attributes (e.g., color, brand)
    if (!empty($filters['attributes']) && is_array($filters['attributes'])) {
        foreach ($filters['attributes'] as $key => $value) {
            $attributeKey = ":attribute_" . $key;
            $sql .= " AND $key = $attributeKey";
            $params[$attributeKey] = $value;
        }
    }

    $sql .= " ORDER BY added_on DESC"; // Default ordering

    try {
        $stmt = $conn->prepare($sql);
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error fetching filtered products: " . $e->getMessage());
        return [];
    }
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
    $sql = "SELECT * FROM ec_sub_categories WHERE status = 1 AND parent_cate_id = :category_id ORDER BY cate_name ASC, cate_id ASC";
    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
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