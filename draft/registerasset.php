<?php
session_start();

    
include '../Includes/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $BranchId = $_POST['BranchId'];
    $AssetName = $_POST['AssetName'];
    $AssetTypeId = $_POST['AssetTypeId'];
    $SerialNumber = $_POST['SerialNumber'];
    $PurchasedDate = $_POST['PurchasedDate'];
    $AssetStatus = $_POST['AssetStatus'];
    $Description = $_POST['Description'];

    // Prepare the SQL query using PDO
    $sql = "INSERT INTO t_asset (BranchId, AssetName, AssetTypeId, SerialNumber, PurchasedDate, AssetStatus, Description)
            VALUES (:BranchId, :AssetName, :AssetTypeId, :SerialNumber, :PurchasedDate, :AssetStatus, :Description)";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind parameters to the SQL query
    $stmt->bindParam(':BranchId', $BranchId);
    $stmt->bindParam(':AssetName', $AssetName);
    $stmt->bindParam(':AssetTypeId', $AssetTypeId);
    $stmt->bindParam(':SerialNumber', $SerialNumber);
    $stmt->bindParam(':PurchasedDate', $PurchasedDate);
    $stmt->bindParam(':AssetStatus', $AssetStatus);
    $stmt->bindParam(':Description', $Description);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        echo "New asset registered successfully!";
    } else {
        echo "Error: Unable to register asset.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QCPL STS - Dashboard</title>
    <link rel="icon" type="image/x-icon" href="../asset/img/qcpl-sts-logo.png">

    <!-- External CSS Link/s -->
    <link rel ="stylesheet" href="../asset/css/admin-sidebar.css">
    <link rel="stylesheet" href="../asset/css/admin-dashboard.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap 5 JS Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Font Awesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
/* The Modal (background) */
.modal {
  display: block; /* Show the modal by default if it exists */
  position: fixed;
  z-index: 1000;
  padding-top: 150px;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0,0,0,0.5);
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 30px;
  border: 1px solid #888;
  width: 400px;
  border-radius: 10px;
  position: relative;
  text-align: center;
}

/* The Close Button */
.close {
  color: #aaa;
  position: absolute;
  right: 15px;
  top: 10px;
  font-size: 28px;
  font-weight: bold;
  cursor: pointer;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
}
</style>
</head>

<body style="background-color: #f3f2f7;">
    <div class="d-flex">
        <!-- Include Sidebar -->
        <?php include '../admin/inc/admin-sidebar.php'; ?>

       <!-- Wrapper for Header + Main -->
       <div class="main-wrapper w-100" style="margin-left: 80px; margin-top: 30px;">

<!-- Main Content (separate from header) -->
<main class="px-4 py-5">
            <div class="row align-items-stretch" style="margin-left: 260px; padding: 20px;">
                <h2>Welcome, <?php echo $_SESSION['FirstName']; ?>!</h2>
                <p> Add an asset.</p>
                <br>
                
                <h2>Register a New Asset</h2>
                <form action="registerasset.php" method="POST">
                    <select name="BranchId" required>
                    <option value="">-- Select Branch --</option>
<?php
// Query only from t_branch
$stmt = $conn->query("SELECT BranchId, BranchName FROM t_branch");

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo '<option value="' . $row['BranchId'] . '">' . $row['BranchName'] . '</option>';
}
?>
</select><br><br>

                    <label for="assetName">Asset Name:</label>
                    <input type="text" name="AssetName" id="assetName" required><br><br>

                    <label for="assetTypeId">Asset Type ID:</label>
                    <input type="number" name="AssetTypeId" id="assetTypeId" required><br><br>

                    <label for="serialNumber">Serial Number:</label>
                    <input type="text" name="SerialNumber" id="serialNumber" required><br><br>

                    <label for="purchasedDate">Purchased Date:</label>
                    <input type="date" name="PurchasedDate" id="purchasedDate" required><br><br>

                    <label for="assetStatus">Asset Status:</label>
                    <select name="AssetStatus" id="assetStatus" required>
                        <option value="">-- Select Status --</option>
                        <option value="available">Available</option>
                        <option value="in use">In Use</option>
                        <option value="maintenance">Maintenance</option>
                        <option value="disposed">Disposed</option>
                        <option value="transferred">Transferred</option>
                        <option value="transfer request">Transfer Request</option>
                    </select>
                    <br><br>


                    <label for="description">Description:</label>
                    <textarea name="Description" id="description"></textarea><br><br>

                    <button type="submit">Register Asset</button>
                    <a href="../admin/manageasset.php"> Back </a>
                </form>
            </div>
        </div>
    </div>
    </main>

    <script>
document.addEventListener('DOMContentLoaded', function() {
  var modal = document.getElementById('successModal');
  var span = document.getElementsByClassName('close')[0];

  span.onclick = function() {
    modal.style.display = "none";
  }

  // Optional: Close modal when clicking outside the modal content
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
});
</script>
</body>
</html>