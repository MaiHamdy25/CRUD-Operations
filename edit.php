<?php
include 'conn.php';

if (isset($_GET['emp_id'])) {
    $emp_id = intval($_GET['emp_id']);
    mysqli_select_db($conn, $dbname);

    // جلب بيانات المستخدم
    $sql = "SELECT * FROM emp WHERE emp_id = $emp_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        die("User not found.");
    }
} else {
    die("Invalid request.");
}

// تحديث البيانات عند إرسال النموذج
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $emp_name = $_POST['emp_name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $mail_status = isset($_POST['mail_status']) ? 1 : 0;

    $update_sql = "UPDATE emp SET emp_name = ?, email = ?, gender = ?, mail_status = ? WHERE emp_id = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("sssii", $emp_name, $email, $gender, $mail_status, $emp_id);

    if ($stmt->execute()) {
        echo "User updated successfully.";
        header("Location: select.php");
        exit;
    } else {
        echo "Error updating user: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Edit User</h1>
    <form method="POST">
        <label for="emp_name">Name:</label>
        <input type="text" id="emp_name" name="emp_name" value="<?php echo htmlspecialchars($row['emp_name']); ?>" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required><br>

        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
            <option value="Male" <?php echo $row['gender'] === 'Male' ? 'selected' : ''; ?>>Male</option>
            <option value="Female" <?php echo $row['gender'] === 'Female' ? 'selected' : ''; ?>>Female</option>
        </select><br>

        <label for="mail_status">Mail Status:</label>
        <input type="checkbox" id="mail_status" name="mail_status" <?php echo $row['mail_status'] ? 'checked' : ''; ?>><br>

        <button type="submit">Save Changes</button>
    </form>
    <a href="select.php">Cancel</a>
</body>
</html>
