<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['emp_id'])) {
    include 'conn.php';
    mysqli_select_db($conn, $dbname);

    $emp_id = intval($_POST['emp_id']);
    $sql = "DELETE FROM emp WHERE emp_id = $emp_id";

    $response = [];
    if ($conn->query($sql) === TRUE) {
        $response['success'] = true;
    } else {
        $response['success'] = false;
        $response['error'] = $conn->error;
    }

    echo json_encode($response);
    $conn->close();
    exit;
}
?>
