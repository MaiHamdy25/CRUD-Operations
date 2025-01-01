<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://kit.fontawesome.com/9549cfd088.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    include 'conn.php';
    mysqli_select_db( $conn,$dbname );
    $sql = "SELECT emp_id, emp_name, email, gender, mail_status FROM emp";
    $result = $conn->query($sql);
    echo "<br>";
    echo "<div class='head'><h1>User Details</h1><button><a href='index.php'>Add User</a></button></div>";
    if ($result->num_rows > 0) {
        echo "<table><tr><th>#</th><th>Name</th><th>email</th><th>gender</th><th>mail status</th><th>action</th></tr>";
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["emp_id"] . "</td><td>" . $row["emp_name"] . "</td><td>".$row["email"]."</td><td>".$row["gender"]."</td><td>".$row["mail_status"]."</td><td><i class='fa-regular fa-eye'></i><i class='fa-regular fa-pen-to-square'></i><i class='fa-solid fa-trash'></i></td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }
    $conn->close();
    ?>
</body>

</html>