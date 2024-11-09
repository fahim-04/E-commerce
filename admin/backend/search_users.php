<?php
// include 'functions.php';
include 'db-conn.php';

if (isset($_GET['query'])) {
    $query = mysqli_real_escape_string($conn, $_GET['query']);  // Sanitize input for security

    $sql = "SELECT * FROM users WHERE user_name LIKE '%$query%' ORDER BY id ASC";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                <td>" . $row['id'] . "</td>
                <td>" . $row['user_name'] . "</td>
                <td>" . $row['user_email'] . "</td>
                <td>" . $row['user_phone'] . "</td>
                <td>" . $row['user_type'] . "</td>
                <td>" . ($row['user_status'] ? 'Active' : 'Inactive') . "</td>
                <td>
                    <a href='edit-user.php?id=" . $row['id'] . "' class='btn btn-primary btn-sm'>Edit</a>
                    <a href='delete-user.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure you want to delete this user?\")' class='btn btn-danger btn-sm'>Delete</a>
                </td>
            </tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No results found</td></tr>";
    }
}
