<?php
include '../Includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteAssetId'])) {
    $id = $_POST['deleteAssetId'];

    // Delete from t_asset
    $sql = "DELETE FROM t_asset WHERE AssetId = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['id' => $id]);

    $_SESSION['deletion_success'] = true;
    header("Location: ../admin/adminAssetMgmt.php"); // not ../admin/ if already in /admin
    exit();
}
?>
