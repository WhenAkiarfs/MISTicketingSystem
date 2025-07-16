<?php
require_once '../Includes/config.php';

$loggedInEmployeeId = $_SESSION['UserId'] ?? null;

if (!$loggedInEmployeeId) {
    // redirect to login or show error
    exit('User not logged in');
}

// Fetch employee info with district and branch
$stmt = $conn->prepare("
    SELECT 
        ue.EmployeeId,
        u.UserId,
        u.FirstName,
        u.LastName,
        u.Email,
        u.ContactNo,
        u.DistrictId,
        u.BranchId,
        d.DistrictName,
        b.BranchName
    FROM t_users u
    INNER JOIN t_useremp ue ON u.UserId = ue.UserId
    LEFT JOIN t_district d ON u.DistrictId = d.DistrictId
    LEFT JOIN t_branch b ON u.BranchId = b.BranchId
    WHERE u.UserId = ?
");
$stmt->execute([$loggedInEmployeeId]);
$employee = $stmt->fetch(PDO::FETCH_ASSOC);

// Fetch other dropdown data for form (issue types, subtypes, assets)
$issues = $conn->query("SELECT * FROM t_issuedtype")->fetchAll(PDO::FETCH_ASSOC);
$subtypes = $conn->query("SELECT * FROM t_issuedsubtype")->fetchAll(PDO::FETCH_ASSOC);
$assets = $conn->query("SELECT * FROM t_asset")->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Bootstrap CSS (required) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- External CSS Link/s -->
<link rel="stylesheet" href="asset/css/modals.css">
<link rel="stylesheet" href="asset/css/buttons.css">

<!-- Bootstrap JS (required for modal to function) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!--Submit Ticket Modal-->
<div class="modal fade" id="submitTicketModal" tabindex="-1" aria-labelledby="submitTicketModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="submitTicketModalLabel">Support Ticket Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>    
            </div>

            <div class="modal-body">
                <form action="../employee/create_ticket.php" method="POST">
                    
                    <!-- Employee Info -->
                    <input type="hidden" name="EmployeeId" value="<?= htmlspecialchars($employee['EmployeeId']) ?>">
                    <input type="hidden" name="BranchId" value="<?= htmlspecialchars($employee['BranchId']) ?>">
                    <input type="hidden" name="DistrictId" value="<?= htmlspecialchars($employee['DistrictId']) ?>">

                    <div class="mb-3">
                        <label class="form-label" hidden>Employee</label>
                        <p class="form-control" hidden><?= htmlspecialchars($employee['FirstName'] . ' ' . $employee['LastName']) ?></p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" hidden>Branch</label>
                        <p class="form-control" hidden><?= htmlspecialchars($employee['BranchName']) ?></p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" hidden>District</label>
                        <p class="form-control" hidden><?= htmlspecialchars($employee['DistrictName']) ?></p>
                    </div>

                    <!-- Asset -->
                    <div class="mb-3">
                        <label for="AssetId" class="form-label">Asset</label>
                        <select name="AssetId" class="form-select" required>
                            <option value="">-- Select Asset --</option>
                            <?php foreach ($assets as $a): ?>
                                <option value="<?= $a['AssetId'] ?>">
                                    <?= $a['AssetId'] ?> - <?= htmlspecialchars($a['AssetName'] ?? 'Unnamed') ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

    <!-- Container for multiple issues -->
    <div id="issuesContainer">
        <div class="issue-entry mb-3 border p-3 rounded">

            <!-- Issue Type -->
            <div class="mb-3">
                <label class="form-label">Issue Type</label>
                <select name="IssueId[]" class="form-select" required>
                    <option value="">-- Select Issue --</option>
                    <?php foreach ($issues as $issue): ?>
                        <option value="<?= $issue['IssueId'] ?>"><?= htmlspecialchars($issue['IssueType']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Issue Subtype -->
            <div class="mb-3">
                <label class="form-label">Issue Subtype</label>
                <select name="SubtypeId[]" class="form-select" required>
                    <option value="">-- Select Subtype --</option>
                    <?php foreach ($subtypes as $sub): ?>
                        <option value="<?= $sub['SubtypeId'] ?>"><?= htmlspecialchars($sub['SubtypeName']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Description -->
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="Description[]" class="form-control" rows="3" placeholder="Describe the issue..." required></textarea>
            </div>

            <button type="button" class="btn btn-danger remove-issue-btn">Remove Issue</button>

        </div>
    </div>

    <button type="button" class="btn btn-secondary mb-3" id="addIssueBtn">+ Add Another Issue</button>

    <!-- Submit Button -->
    <div class="modal-footer">
        <button type="submit" class="btn btn-submit">Submit Ticket</button>
    </div>


                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const issuesContainer = document.getElementById('issuesContainer');
    const addIssueBtn = document.getElementById('addIssueBtn');

    addIssueBtn.addEventListener('click', function() {
        // Clone the first issue-entry div
        const firstIssue = issuesContainer.querySelector('.issue-entry');
        const newIssue = firstIssue.cloneNode(true);

        // Clear the values in the cloned fields
        newIssue.querySelectorAll('select, textarea').forEach(input => {
            input.value = '';
        });

        issuesContainer.appendChild(newIssue);
        attachRemoveListeners(); // Re-attach listeners for new buttons
    });

    function attachRemoveListeners() {
        const removeButtons = document.querySelectorAll('.remove-issue-btn');
        removeButtons.forEach(btn => {
            btn.removeEventListener('click', removeIssue);
            btn.addEventListener('click', removeIssue);
        });
    }

    function removeIssue(event) {
        const btn = event.target;
        const issueEntry = btn.closest('.issue-entry');
        // Only remove if more than one issue-entry exists
        if (issuesContainer.children.length > 1) {
            issueEntry.remove();
        } else {
            alert('At least one issue entry is required.');
        }
    }

    attachRemoveListeners(); // Initial call
});
</script>