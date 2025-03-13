<?php
include "config.php";

$row = []; // Initialize to avoid errors if query fails

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $qry1 = "SELECT * FROM employee WHERE e_id='$id'";
    $result = $conn->query($qry1);
    
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_row();
    } else {
        $row = array_fill(0, 12, ""); // Fill missing indexes with empty values
    }
}

if (isset($_POST['update'])) {
    $id = mysqli_real_escape_string($conn, $_POST['eid']);
    $fname = mysqli_real_escape_string($conn, $_POST['efname']);
    $lname = mysqli_real_escape_string($conn, $_POST['elname']);
    $age = mysqli_real_escape_string($conn, $_POST['eage']);
    $sex = mysqli_real_escape_string($conn, $_POST['esex']);
    $etype = mysqli_real_escape_string($conn, $_POST['etype']);
    $jdate = mysqli_real_escape_string($conn, $_POST['ejdate']);
    $sal = mysqli_real_escape_string($conn, $_POST['esal']);
    $phno = mysqli_real_escape_string($conn, $_POST['ephno']);
    $mail = mysqli_real_escape_string($conn, $_POST['e_email']);
    $add = mysqli_real_escape_string($conn, $_POST['eadd']);

    $sql = "UPDATE employee
            SET e_fname='$fname', e_lname='$lname', e_age='$age', e_sex='$sex',
            e_type='$etype', e_jdate='$jdate', e_sal='$sal', e_phno='$phno', e_email='$mail', e_add='$add' 
            WHERE e_id='$id'";

    if ($conn->query($sql)) {
        header("location:employee-view.php");
        exit(); // Prevent further execution after redirect
    } else {
        echo "<p style='font-size:8; color:red;'>Error! Unable to update.</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="nav2.css">
<link rel="stylesheet" type="text/css" href="form4.css">
<title>Employees</title>
</head>

<body>
    <div class="sidenav">
        <h2 style="font-family:Arial; color:white; text-align:center;"> PHARMACY </h2>
        <a href="adminmainpage.php">Dashboard</a>
        <button class="dropdown-btn">Inventory</button>
        <div class="dropdown-container">
            <a href="inventory-add.php">Add New Medicine</a>
            <a href="inventory-view.php">Manage Inventory</a>
        </div>
        <button class="dropdown-btn">Suppliers</button>
        <div class="dropdown-container">
            <a href="supplier-add.php">Add New Supplier</a>
            <a href="supplier-view.php">Manage Suppliers</a>
        </div>
        <button class="dropdown-btn">Stock Purchase</button>
        <div class="dropdown-container">
            <a href="purchase-add.php">Add New Purchase</a>
            <a href="purchase-view.php">Manage Purchases</a>
        </div>
        <button class="dropdown-btn">Employees</button>
        <div class="dropdown-container">
            <a href="employee-add.php">Add New Employee</a>
            <a href="employee-view.php">Manage Employees</a>
        </div>
        <button class="dropdown-btn">Customers</button>
        <div class="dropdown-container">
            <a href="customer-add.php">Add New Customer</a>
            <a href="customer-view.php">Manage Customers</a>
        </div>
        <a href="salesitems-view.php">View Sold Products Details</a>
        <button class="dropdown-btn">Reports</button>
        <div class="dropdown-container">
            <a href="stockreport.php">Medicines - Low Stock</a>
            <a href="expiryreport.php">Medicines - Soon to Expire</a>
        </div>
    </div>

    <div class="topnav">
        <a href="logout.php">Logout</a>
    </div>

    <center>
        <div class="head">
            <h2>UPDATE EMPLOYEE DETAILS</h2>
        </div>
    </center>

    <div class="one">
        <div class="row">
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                <div class="column">
                    <p>
                        <label for="eid">Employee ID:</label><br>
                        <input type="number" name="eid" value="<?= isset($row[0]) ? $row[0] : ''; ?>" readonly>
                    </p>
                    <p>
                        <label for="efname">First Name:</label><br>
                        <input type="text" name="efname" value="<?= isset($row[1]) ? $row[1] : ''; ?>">
                    </p>
                    <p>
                        <label for="elname">Last Name:</label><br>
                        <input type="text" name="elname" value="<?= isset($row[2]) ? $row[2] : ''; ?>">
                    </p>
                    <p>
                        <label for="eage">Age:</label><br>
                        <input type="number" name="eage" value="<?= isset($row[3]) ? $row[3] : ''; ?>">
                    </p>
                    <p>
                        <label for="esex">Sex:</label><br>
                        <input type="text" name="esex" value="<?= isset($row[4]) ? $row[4] : ''; ?>">
                    </p>
                </div>
                <div class="column">
                    <p>
                        <label for="etype">Employee Type:</label><br>
                        <input type="text" name="etype" value="<?= isset($row[5]) ? $row[5] : ''; ?>">
                    </p>
                    <p>
                        <label for="ejdate">Date of Joining:</label><br>
                        <input type="date" name="ejdate" value="<?= isset($row[6]) ? $row[6] : ''; ?>">
                    </p>
                    <p>
                        <label for="esal">Salary:</label><br>
                        <input type="number" step="0.01" name="esal" value="<?= isset($row[7]) ? $row[7] : ''; ?>">
                    </p>
                    <p>
                        <label for="ephno">Phone Number:</label><br>
                        <input type="number" name="ephno" value="<?= isset($row[8]) ? $row[8] : ''; ?>">
                    </p>
                    <p>
                        <label for="e_email">Email ID:</label><br>
                        <input type="text" name="e_email" value="<?= isset($row[9]) ? $row[9] : ''; ?>">
                    </p>
                    <p>
                        <label for="eadd">Address:</label><br>
                        <input type="text" name="eadd" value="<?= isset($row[10]) ? $row[10] : ''; ?>">
                    </p>
                </div>
                <input type="submit" name="update" value="Update">
            </form>
        </div>
    </div>
</body>

<script>
var dropdown = document.getElementsByClassName("dropdown-btn");
for (var i = 0; i < dropdown.length; i++) {
    dropdown[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var dropdownContent = this.nextElementSibling;
        dropdownContent.style.display = dropdownContent.style.display === "block" ? "none" : "block";
    });
}
</script>

</html>
