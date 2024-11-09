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

// function get_sub_Categories($conn)
// {
//   $sql = "SELECT * FROM ec_sub_categories ORDER BY id DESC";
//   $check = mysqli_query($conn, $sql);
//   $sno = 1;
//   while ($result = mysqli_fetch_assoc($check)) {
//     $sql2 = "SELECT cate_name FROM ec_categories WHERE cate_id = '$result[parent_id]'";
//     $check2 = mysqli_query($conn, $sql2);
//     $parent = mysqli_fetch_assoc($check2);
//     echo  $output = "<tr>
//                <td>" . $sno++ . "</td>
//                <td>" . $result['cate_id'] . "</td>
//                <td>" . $result['cate_name'] . "</td> 
//                <td>" . $parent['cate_name'] . "</td> 
//                <td>" . $result['slug_url'] . "</td> 
//                <td>" . $result['added_on'] . "</td> 
//                <td>" . ($result['status'] ? 'Active' : 'Inactive') . "</td>
//             </tr>";
//   }
// }
// Function to get Sub Categories with Pagination
function get_sub_Categories($conn, $page = 1, $limit = 10, $search = "")
{
  // Calculate the starting row for the SQL query
  $offset = ($page - 1) * $limit;

  // Base query with search filter if search term exists
  $searchCondition = $search ? "AND ec_sub_categories.cate_name LIKE '%" . mysqli_real_escape_string($conn, $search) . "%'" : "";
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
                       <td>" . $result['cate_id'] . "</td>
                       <td>" . $result['parent_name'] . "</td>
                       <td>" . $result['cate_name'] . "</td> 
                       <td>" . $result['slug_url'] . "</td> 
                       <td>" . $result['added_on'] . "</td> 
                       <td>" . ($result['status'] ? 'Active' : 'Inactive') . "</td>
                       </tr>";
  }

  return $output;
}

// Function to calculate total number of pages for pagination
function getTotalSubCategoriesPages($conn, $limit = 10, $search = "")
{
  $searchCondition = $search ? "WHERE cate_name LIKE '%" . mysqli_real_escape_string($conn, $search) . "%'" : "";
  $result = mysqli_query($conn, "SELECT COUNT(*) as total FROM ec_sub_categories $searchCondition");
  $row = mysqli_fetch_assoc($result);
  return ceil($row['total'] / $limit);
}

// sub categories end



// add product page start ajax code
if (isset($_POST['cate_id'])) {
  $p_id = $_POST['cate_id'];
  $sql = "SELECT * FROM ec_sub_categories WHERE parent_id = $p_id ORDER BY id DESC";
  $check = mysqli_query($conn, $sql);
?>
  <option value="">--Select--</option>

<?php
  while ($result = mysqli_fetch_assoc($check)) {
    echo "<option value=" . $result['cate_id'] . ">" . $result['cate_name'] . "</option>";
  }
}
// add product page end

// view products start
function get_Products($conn)
{
  // $sql = "SELECT * FROM ec_product ORDER BY id DESC";
  $sql = "SELECT ec_product.pro_id, ec_product.pro_name, ec_product.selling_price, ec_product.pro_image, ec_product.status, ec_categories.cate_name AS category_name, ec_sub_categories.cate_name AS subcategory_name
FROM 
    ec_product
JOIN 
    ec_categories ON ec_product.pro_cate = ec_categories.cate_id
JOIN 
    ec_sub_categories ON ec_product.pro_sub_cate = ec_sub_categories.cate_id";
  $check = mysqli_query($conn, $sql);
  $sno = 1;

  while ($result = mysqli_fetch_assoc($check)) {


    // Output the product row, using null coalescing to handle missing data
    echo "<tr>
               <td>" . $sno++ . "</td>
               <td>" . ($result['category_name'] ?? 'N/A') . "</td>
               <td>" . ($result['subcategory_name'] ?? 'N/A') . "</td>
               <td>" . $result['pro_id'] . "</td>
               <td>" . $result['pro_name'] . "</td> 
               <td>$" . $result['selling_price'] . "</td> 
               <td><img src='" . $result['pro_image'] . "' alt='Product Image' style='width: 100px; height: auto;'></td>
               <td>" . ($result['status'] ? 'Active' : 'Inactive') . "</td> 
               
            </tr>";
  }
}
// view products end


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


?>