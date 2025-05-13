<?php
include '../Includes/config.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../index.php");
    exit();
}

$adminId = $_SESSION['admin_id'];
$redirectLink = "../admin/adminActivityLogs.php";
?>

<!-- External CSS Link -->
<link rel="stylesheet" href="../asset/css/modals.css">

<!-- Download Report Modal -->
<div class="modal fade" id="downloadReportModal" tabindex="-1" aria-labelledby="DownloadRepModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content md-cont">
            <div class="modal-header">
                <h5 class="modal-title" id="generate_header">Print Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body" style="padding: 20px;">
                <div class="row mb-3"> <!-- Added margin bottom to create space below -->
                    <div class="col">
                        <input type="text" id="report_type" class="form-control" value="Summary of Document Services Administered" readonly>
                    </div>
                </div>

                <div class="row mt-3">
                    <p class="note" style="margin-bottom: 5px;">Kindly input the date range.</p>
                    <div class="col">
                        <label for="ddfromx" style="margin-bottom: 7px;">FROM</label>
                        <input type="date" required autocomplete="off" id="ddfromx" class="form-control" name="from_date">
                    </div>

                    <div class="col">
                        <label for="ddtox" style="margin-bottom: 7px;">TO</label>
                        <input type="date" required autocomplete="off" id="ddtox" class="form-control" name="to_date">
                    </div>
                </div>
            </div>

            <div class="modal-footer" style="padding: 15px 20px; text-align: right;">
                <button type="button" class="btn btn-primary" id="generateReportButton">Generate Report</button>
            </div>
        </div>
    </div>
</div>