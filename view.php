<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['emp_id'])) {
    include 'conn.php';
    mysqli_select_db($conn, $dbname);

    $emp_id = intval($_POST['emp_id']);
    $sql = "SELECT * FROM emp WHERE emp_id = $emp_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<h3>User Details</h3>";
        echo "Name: " . htmlspecialchars($row['emp_name']) . "<br>";
        echo "Email: " . htmlspecialchars($row['email']) . "<br>";
        echo "Gender: " . htmlspecialchars($row['gender']) . "<br>";
        echo "Mail Status: " . ($row['mail_status'] ? 'Subscribed' : 'Not Subscribed') . "<br>";
    } else {
        echo "User not found.";
    }
    exit;
}
?>
