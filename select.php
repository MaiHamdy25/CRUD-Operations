<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <script src="https://kit.fontawesome.com/9549cfd088.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <?php
    include 'conn.php';
    mysqli_select_db($conn, $dbname);
    $sql = "SELECT emp_id, emp_name, email, gender, mail_status FROM emp";
    $result = $conn->query($sql);
    echo "<div class='head'><h1>User Details</h1><button><a href='index.php'>Add User</a></button></div>";
    if ($result->num_rows > 0) {
        echo "<table><tr><th>#</th><th>Name</th><th>Email</th><th>Gender</th><th>Mail Status</th><th>Action</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr id='row-{$row['emp_id']}'>
            <td>{$row['emp_id']}</td>
            <td>{$row['emp_name']}</td>
            <td>{$row['email']}</td>
            <td>{$row['gender']}</td>
            <td>" . ($row['mail_status'] ? 'Yes' : 'No') . "</td>
            <td>
                <i class='fa-regular fa-eye' onclick='viewUser({$row['emp_id']})'></i>
                <i class='fa-regular fa-pen-to-square' onclick='editUser({$row['emp_id']})'></i>
                <i class='fa-solid fa-trash' onclick='deleteUser({$row['emp_id']})'></i>
            </td>
            </tr>";
        }
        echo "</table>";
    } else {
        echo "No results found.";
    }
    $conn->close();
    ?>

    <!-- Popup Modal -->
    <div id="popup" style="display:none;">
        <div id="popup-content"></div>
        <button onclick="closePopup()">Close</button>
    </div>

    <script src="script.js"></script>
    
</body>
</html>
