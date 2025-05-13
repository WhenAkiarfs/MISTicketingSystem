<?php
include 'Includes/config.php';
include 'Includes/check_session.php';

// Fetch Issue Types
$issues = $conn->query("SELECT * FROM t_issuedtype")->fetchAll(PDO::FETCH_ASSOC);

// Fetch Subtypes
$subtypes = $conn->query("SELECT * FROM t_issuedsubtype")->fetchAll(PDO::FETCH_ASSOC);

// Optional: Fetch Assets (if you have an assets table)
$assets = $conn->query("SELECT * FROM t_asset")->fetchAll(PDO::FETCH_ASSOC);

// Optional: Fetch Employee IDs from t_useremp
$employees = $conn->query("SELECT EmployeeId FROM t_useremp")->fetchAll(PDO::FETCH_ASSOC);

// Optional: Fetch Employee IDs from t_useremp
$branches = $conn->query("SELECT BranchId FROM t_branch")->fetchAll(PDO::FETCH_ASSOC);

// Optional: Fetch Employee IDs from t_useremp
$districts = $conn->query("SELECT DistrictId FROM t_branch")->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Bootstrap CSS (required) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- External CSS Link/s -->
<link rel="stylesheet" href="asset/css/modals.css">
<link rel="stylesheet" href="asset/css/buttons.css">

<!-- Bootstrap JS (required for modal to function) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


<!-- Submit Ticket Modal -->
<div class="modal fade" id="submitTicketModal" tabindex="-1" aria-labelledby="submitTicketModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg"> <!-- Large modal -->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="submitTicketModalLabel">Submit A Ticket</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <!-- Original PHP Form -->
        <form action="../employee/create_ticket.php" method="POST">
            <label for="EmployeeId">Employee ID:</label>
            <select name="EmployeeId" required>
                <option value="">-- Select Employee --</option>
                <?php foreach ($employees as $emp): ?>
                    <option value="<?= htmlspecialchars($emp['EmployeeId']) ?>"><?= htmlspecialchars($emp['EmployeeId']) ?></option>
                <?php endforeach; ?>
            </select><br><br>

            <label for="BranchId">Branch:</label>
            <select name="BranchId" required>
                <option value="">-- Select Branch --</option>
                <?php foreach ($branches as $branch): ?>
                    <option value="<?= $branch['BranchId'] ?>"><?= $branch['BranchId'] ?> - <?= $branch['BranchName'] ?? 'Unnamed' ?></option>
                <?php endforeach; ?>
            </select><br><br>

            <label for="DistrictId">District:</label>
            <select name="DistrictId" required>
                <option value="">-- Select District --</option>
                <?php foreach ($districts as $district): ?>
                    <option value="<?= $district['DistrictId'] ?>"><?= $district['DistrictId'] ?> - <?= $district['BranchName'] ?? 'Unnamed' ?></option>
                <?php endforeach; ?>
            </select><br><br>

            <label for="AssetId">Asset:</label>
            <select name="AssetId" required>
                <option value="">-- Select Asset --</option>
                <?php foreach ($assets as $a): ?>
                    <option value="<?= $a['AssetId'] ?>"><?= $a['AssetId'] ?> - <?= $a['AssetName'] ?? 'Unnamed' ?></option>
                <?php endforeach; ?>
            </select><br><br>

            <label for="IssueId">Issue Type:</label>
            <select name="IssueId" required>
                <option value="">-- Select Issue --</option>
                <?php foreach ($issues as $issue): ?>
                    <option value="<?= $issue['IssueId'] ?>"><?= htmlspecialchars($issue['IssueType']) ?></option>
                <?php endforeach; ?>
            </select><br><br>

            <label for="SubtypeId">Issue Subtype:</label>
            <select name="SubtypeId" required>
                <option value="">-- Select Subtype --</option>
                <?php foreach ($subtypes as $sub): ?>
                    <option value="<?= $sub['SubtypeId'] ?>">
                        <?= htmlspecialchars($sub['SubtypeName']) ?>
                    </option>
                <?php endforeach; ?>
            </select><br><br>

            <label for="Description">Description:</label><br>
            <textarea name="Description" rows="4" cols="50" placeholder="Describe the issue..."></textarea><br><br>

           

            <button type="submit" class="btn btn-success">Submit Ticket</button>
        </form>
      </div>
    </div>
  </div>
</div>



<!--form action="create_ticket.php" method="POST">
    <label for="EmployeeId">Employee ID:</label>
    <select name="EmployeeId" required>
        <option value="">-- Select Employee --</option>
        <?php foreach ($employees as $emp): ?>
            <option value="<?= htmlspecialchars($emp['EmployeeId']) ?>"><?= htmlspecialchars($emp['EmployeeId']) ?></option>
        <?php endforeach; ?>
    </select><br><br>


<label for="BranchId">Branch:</label>
<select name="BranchId" required>
    <option value="">-- Select Branch --</option>
    <?php foreach ($branches as $branch): ?>
        <option value="<?= $branch['BranchId'] ?>"><?= $branch['BranchId'] ?> - <?= $branch['BranchName'] ?? 'Unnamed' ?></option>
    <?php endforeach; ?>
</select><br><br>

<label for="DistrictId">District:</label>
<select name="DistrictId" required>
    <option value="">-- Select District --</option>
    <?php foreach ($districts as $district): ?>
        <option value="<?= $district['DistrictId'] ?>"><?= $district['DistrictId'] ?> - <?= $district['BranchName'] ?? 'Unnamed' ?></option>
    <?php endforeach; ?>
</select><br><br>

    <label for="AssetId">Asset:</label>
    <select name="AssetId" required>
        <option value="">-- Select Asset --</option>
        <?php foreach ($assets as $a): ?>
            <option value="<?= $a['AssetId'] ?>"><?= $a['AssetId'] ?> - <?= $a['AssetName'] ?? 'Unnamed' ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label for="IssueId">Issue Type:</label>
    <select name="IssueId" required>
        <option value="">-- Select Issue --</option>
        <?php foreach ($issues as $issue): ?>
            <option value="<?= $issue['IssueId'] ?>"><?= htmlspecialchars($issue['IssueType']) ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label for="SubtypeId">Issue Subtype:</label>
    <select name="SubtypeId" required>
        <option value="">-- Select Subtype --</option>
        <?php foreach ($subtypes as $sub): ?>
            <option value="<?= $sub['SubtypeId'] ?>">
                <?= htmlspecialchars($sub['SubtypeName']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label for="Description">Description:</label><br>
    <textarea name="Description" rows="4" cols="50" placeholder="Describe the issue..."></textarea><br><br>

    <label for="Priority">Priority:</label>
    <select name="Priority">
        <option value="Low" selected>Low</option>
        <option value="Medium">Medium</option>
        <option value="High">High</option>
    </select><br><br>

    <button type="submit">Submit Ticket</button>
</!--form>-->
