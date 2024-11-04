<?php
// include files
include 'db-conn.php';


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


// sub categories start
function get_sub_Categories($conn)
{
  $sql = "SELECT * FROM ec_sub_categories ORDER BY id DESC";
  $check = mysqli_query($conn, $sql);
  $sno = 1;
  while ($result = mysqli_fetch_assoc($check)) {
    $sql2 = "SELECT cate_name FROM ec_categories WHERE cate_id = '$result[parent_id]'";
    $check2 = mysqli_query($conn, $sql2);
    $parent = mysqli_fetch_assoc($check2);
    echo  $output = "<tr>
               <td>" . $sno++ . "</td>
               <td>" . $result['cate_id'] . "</td>
               <td>" . $result['cate_name'] . "</td> 
               <td>" . $parent['cate_name'] . "</td> 
               <td>" . $result['slug_url'] . "</td> 
               <td>" . $result['added_on'] . "</td> 
               <td>" . ($result['status'] ? 'Active' : 'Inactive') . "</td>
            </tr>";
  }
}


// add product page ajax code
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
// sub categories end

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
    // Initialize $cate and $subCate to null to avoid undefined variable warnings
    // $cate = null;
    // $subCate = null;

    // // Check if parent_id is set and fetch category name
    // if (isset($result['parent_id'])) {
    //   $sql2 = "SELECT cate_name FROM ec_categories WHERE cate_id = ?";
    //   $stmt2 = $conn->prepare($sql2);
    //   $stmt2->bind_param("i", $result['parent_id']);
    //   $stmt2->execute();
    //   $check2 = $stmt2->get_result();
    //   $cate = $check2->fetch_assoc();
    // }

    // // Check if subCate is set and fetch subcategory name
    // if (isset($result['subCate'])) {
    //   $sql3 = "SELECT cate_name FROM ec_sub_categories WHERE cate_id = ?";
    //   $stmt3 = $conn->prepare($sql3);
    //   $stmt3->bind_param("i", $result['subCate']);
    //   $stmt3->execute();
    //   $check3 = $stmt3->get_result();
    //   $subCate = $check3->fetch_assoc();
    // }

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

// view users start
function get_UsersInfo($conn)
{
  $sql = "SELECT * FROM users ORDER BY id ASC";
  $check = mysqli_query($conn, $sql);

  while ($result = mysqli_fetch_assoc($check)) {
    echo  $output = "<tr>
               
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
}
// view users end



?>