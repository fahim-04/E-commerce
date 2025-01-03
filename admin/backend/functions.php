<?php
// include files
include 'db-conn.php';
// include 'connection.php'; 


// For view categories page
function get_Categories($conn)
{
  $sql = "SELECT * FROM ec_categories ORDER BY id DESC";
  $check = mysqli_query($conn, $sql);
  $sno = 1;
  while ($result = mysqli_fetch_assoc($check)) {
    echo  $output = "<tr>
               <td>" . $sno++ . "</td>
               <td>" . $result['cate_id'] . "</td>
               <td>" . $result['cate_name'] . "</td> 
               <td>" . $result['slug_url'] . "</td> 
               <td>" . $result['added_on'] . "</td> 
               <td>" . ($result['status'] ? 'Active' : 'Inactive') . "</td>
            </tr>";
  }
}
//   view categories page end X


//sub categories start

// Function to get Sub Categories with Pagination
$conn = mysqli_connect(
  "localhost",
  "root",
  "",
  "ecom"
);
function get_sub_Categories($conn, $page = 1, $limit = 20, $search = "")
{
  // Calculate the starting row for the SQL query
  $offset = ($page - 1) * $limit;

  // Base query with search filter if search term exists
  $searchCondition = $search ? "AND ec_sub_categories.subcate_name LIKE '%" . mysqli_real_escape_string($conn, $search) . "%'" : "";
  $sql = "SELECT ec_sub_categories.*, ec_categories.cate_name AS parent_name
            FROM ec_sub_categories
            LEFT JOIN ec_categories ON ec_sub_categories.parent_id = ec_categories.cate_id
            WHERE 1 $searchCondition
            ORDER BY ec_sub_categories.id DESC
            LIMIT $limit OFFSET $offset";
  $check = mysqli_query($conn, $sql);

  $output = '';
  $sno = $offset + 1;

  while ($result = mysqli_fetch_assoc($check)) {
    $output .= "<tr>
                       <td>" . $sno++ . "</td>
                       <td>" . $result['subcate_id'] . "</td>
                       <td>" . $result['parent_name'] . "</td>
                       <td>" . $result['subcate_name'] . "</td> 
                       <td>" . $result['slug_url'] . "</td> 
                       <td>" . $result['added_on'] . "</td> 
                       <td>" . ($result['status'] ? 'Active' : 'Inactive') . "</td>
                       </tr>";
  }
  return $output;
}

// Function to calculate total number of pages for pagination
function getTotalSubCategoriesPages($conn, $limit = 20, $search = "")
{
  $searchCondition = $search ? "WHERE subcate_name LIKE '%" . mysqli_real_escape_string($conn, $search) . "%'" : "";
  $result = mysqli_query($conn, "SELECT COUNT(*) as total FROM ec_sub_categories $searchCondition");
  $row = mysqli_fetch_assoc($result);
  return ceil($row['total'] / $limit);
}

// sub categories end



// add product page start ajax code
// add product page ajax code
if (isset($_POST['cate_id'])) {
  $p_id = $_POST['cate_id'];
  $sql = "SELECT * FROM ec_sub_categories WHERE parent_id = $p_id ORDER BY id DESC";
  $check = mysqli_query($conn, $sql);
?>
  <option value="">--Select--</option>
<?php
  while ($result = mysqli_fetch_assoc($check)) {
    echo "<option value=" . $result['subcate_id'] . ">" . $result['subcate_name'] . "</option>";
  }
}
// add product page end

//view products start

// Fetch products with search and pagination
function get_Products($conn, $search = '', $page = 1, $results_per_page = 15)
{
  // Calculate offset
  $offset = ($page - 1) * $results_per_page;

  // SQL query with search and pagination
  $sql = "
        SELECT 
            ec_product.pro_id, 
            ec_product.pro_name, 
            ec_product.selling_price, 
            ec_product.pro_image, 
            ec_product.status, 
            ec_product.added_on,
            ec_categories.cate_name AS category_name, 
            ec_sub_categories.subcate_name AS subcategory_name
        FROM 
            ec_product
        JOIN 
            ec_categories ON ec_product.pro_cate = ec_categories.cate_id
        JOIN 
            ec_sub_categories ON ec_product.pro_sub_cate = ec_sub_categories.subcate_id
        WHERE 
            ec_product.pro_name LIKE ? OR 
            ec_categories.cate_name LIKE ? OR 
            ec_sub_categories.subcate_name LIKE ?
        ORDER BY 
          ec_product.added_on ASC
        LIMIT ? OFFSET ?";

  $stmt = mysqli_prepare($conn, $sql);

  $search_param = '%' . $search . '%';
  mysqli_stmt_bind_param($stmt, "sssii", $search_param, $search_param, $search_param, $results_per_page, $offset);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  $sno = $offset + 1;

  while ($row = mysqli_fetch_assoc($result)) {
    $status_color = $row['status'] ? 'green' : 'red';
    $status_text = $row['status'] ? 'Active' : 'Inactive';
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
                    <a href='delete-product.php?id=" . $row['pro_id'] . "' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure you want to delete ".$row['pro_name']."?')\">Delete</a>
                </td>
                </tr>";
  }

  mysqli_free_result($result);
  mysqli_stmt_close($stmt);
}

// New function to calculate total pages based on search
function getProductPagesCount($conn, $search = '', $results_per_page = 15)
{
  $sql = "
        SELECT COUNT(*) AS total
        FROM ec_product
        JOIN ec_categories ON ec_product.pro_cate = ec_categories.cate_id
        JOIN ec_sub_categories ON ec_product.pro_sub_cate = ec_sub_categories.subcate_id
        WHERE 
            ec_product.pro_name LIKE ? OR 
            ec_categories.cate_name LIKE ? OR 
            ec_sub_categories.subcate_name LIKE ?";

  $stmt = mysqli_prepare($conn, $sql);
  $search_param = '%' . $search . '%';
  mysqli_stmt_bind_param($stmt, "sss", $search_param, $search_param, $search_param);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $row = mysqli_fetch_assoc($result);
  $total_pages = ceil($row['total'] / $results_per_page);

  mysqli_free_result($result);
  mysqli_stmt_close($stmt);

  return $total_pages;
}

// view products end

// view users start
function get_UsersInfo($conn, $page = 1, $limit = 10)
{
  // Calculate the starting row for the SQL query
  $offset = ($page - 1) * $limit;

  // Query to fetch the users with pagination
  $sql = "SELECT * FROM users ORDER BY id ASC LIMIT $limit OFFSET $offset";
  $check = mysqli_query($conn, $sql);

  $output = '';

  while ($result = mysqli_fetch_assoc($check)) {
    $output .= "<tr>
                   <td>" . $result['id'] . "</td>
                   <td>" . $result['user_name'] . "</td> 
                   <td>" . $result['user_email'] . "</td> 
                   <td>" . $result['user_phone'] . "</td> 
                   <td>" . $result['user_type'] . "</td> 
                   <td>" . ($result['user_status'] ? 'Active' : 'Inactive') . "</td>
                   <td>
                    <a href='edit-user.php?id=" . $result['id'] . "' class='btn btn-primary btn-sm'>Edit</a>
                    <a href='delete-user.php?id=" . $result['id'] . "' onclick='return confirm(\"Are you sure you want to delete this user?\")' class='btn btn-danger btn-sm'>Delete</a>
                </td>
                </tr>";
  }

  return $output;
}
// Function to calculate total number of pages
function getTotalPages($conn, $limit = 10)
{
  $result = mysqli_query($conn, "SELECT COUNT(*) as total FROM users");
  $row = mysqli_fetch_assoc($result);
  return ceil($row['total'] / $limit);
}
// view users end

// view orders start
function get_Orders($conn, $search = '', $page = 1, $results_per_page = 15)
{
  $offset = ($page - 1) * $results_per_page;

  $sql = "
        SELECT 
            ec_orders.order_id, 
            ec_orders.customer_name,
            ec_orders.item_name,
            ec_orders.item_id,
            ec_orders.m_number,
            ec_orders.quantity, 
            ec_orders.total_price,  
            ec_orders.ordered_on,
            ec_orders.status,
            ec_orders.customer_email
        FROM 
            ec_orders
        WHERE 
            ec_orders.item_id LIKE ? OR 
            ec_orders.item_name LIKE ? OR
            ec_orders.status LIKE ? OR
            ec_orders.customer_name LIKE ?
        ORDER BY 
            ec_orders.ordered_on DESC
        LIMIT ? OFFSET ?";

  $stmt = mysqli_prepare($conn, $sql);
  $search_param = '%' . $search . '%';

  // Bind exactly 6 parameters
  mysqli_stmt_bind_param(
    $stmt,
    "sssiii", // 4 strings for search_param and 2 integers for limit and offset
    $search_param,
    $search_param,
    $search_param,
    $search_param,
    $results_per_page,
    $offset
  );

  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  $sno = $offset + 1;

  while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
                <td>" . $sno++ . "</td>
                <td>" . htmlspecialchars($row['order_id']) . "</td>
                <td>" . htmlspecialchars($row['item_name']) . "</td>
                <td>" . htmlspecialchars($row['item_id']) . "</td>
                <td>" . htmlspecialchars($row['customer_name']) . "</td>
                <td>" . htmlspecialchars($row['customer_email']) . "</td>
                <td>" . htmlspecialchars($row['m_number']) . "</td>
                <td>" . $row['quantity'] . "</td>
                <td>$" . $row['total_price'] . "</td>
                <td>" . htmlspecialchars($row['ordered_on']) . "</td>
                <td><p>" . $row['status'] . "</p></td>
                <td>
                    <a href='edit-order.php?order_id=" . $row['order_id'] . "' class='btn btn-primary btn-sm'>Edit</a>
                    <a href='cancel-order.php?order_id=" . $row['order_id'] . "' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure you want to cancel this order?')\">Cancel</a>
                </td>
              </tr>";
  }

  mysqli_free_result($result);
  mysqli_stmt_close($stmt);
}
function getOrderPagesCount($conn, $search = '', $results_per_page = 15)
{
  $sql = "
        SELECT COUNT(*) AS total 
        FROM ec_orders 
        WHERE customer_name LIKE ? OR item_name LIKE ? OR item_id LIKE ? OR status LIKE ?";
  $stmt = mysqli_prepare($conn, $sql);
  $search_param = '%' . $search . '%';
  mysqli_stmt_bind_param($stmt, "ssss", $search_param, $search_param, $search_param, $search_param);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $row = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  mysqli_stmt_close($stmt);

  return ceil($row['total'] / $results_per_page);
}

// view orders end




?>