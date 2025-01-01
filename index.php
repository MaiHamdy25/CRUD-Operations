<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    include 'conn.php';
    mysqli_select_db( $conn,$dbname );
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $emp_name = $_POST['emp_name'] ?? '';
        $email = $_POST['email'] ?? '';
        $gender = $_POST['gender'] ?? '';
        $mail_status = isset($_POST['mail_status']) ? 1 : 0;

        if (!empty($emp_name) && !empty($email) && !empty($gender)) {
            $sql = "INSERT INTO emp(emp_id, emp_name, email, gender, mail_status) 
            VALUES (null, '$emp_name', '$email', '$gender', '$mail_status')";

            $retval = mysqli_query($conn, $sql);

            if (!$retval) {
                die('Could not insert to table: ' . mysqli_error($conn));
            } else {
                echo "Record inserted successfully.";
            }
        } else {
            echo "Please fill in all required fields.";
        }
    }
    ?>
    <h1>User Registration Form</h1>
    <p>Please fill in this form and submit to add user in database.</p>
    <form action="" method="post">
        <label for="emp_name">Employee Name:</label><br>
        <input type="text" id="emp_name" name="emp_name"><br>
        <label for="email">Email:</label><br>
        <input type="text" id="email" name="email"><br>
        <label for="gender">Gender:</label><br>
        <input type="radio" name="gender" value="female" id="female">
        <label for="female">Female</label><br>
        <input type="radio" name="gender" value="male" id="male">
        <label for="male">Male</label><br>
        <input type="checkbox" name="mail_status" id="mail_status">
        <label for="mail_status">Receive emails from us</label><br>
        <input type="submit" value="Submit">
        <input type="reset" value="Reset">
    </form>

</body>

</html>