<!-- External CSS Link/s -->
<link rel="stylesheet" href="../asset/css/modals.css">
<link rel="stylesheet" href="../asset/css/buttons.css">

<!-- External JS Link/s -->
<script src="../asset/js/buttons.js"></script>

<!-- View Ticket Modal -->
<div class="modal fade" id="viewTicketModal" tabindex="-1" aria-labelledby="viewTicketModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg">
<div class="modal-content">
    <div class="modal-header">
    <h5 class="modal-title">Ticket Details</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
    <p><strong>Ticket ID:</strong> <span id="modalTicketId"></span></p>
    <p><strong>Submitted At:</strong> <span id="modalSubmittedAt"></span></p>
    <p><strong>Branch:</strong> <span id="modalBranch"></span></p>
    <p><strong>Issue:</strong> <span id="modalIssue"></span></p>
    <p><strong>Assigned IT:</strong> <span id="modalAssigned"></span></p>
    <p><strong>Status:</strong> <span id="modalStatus"></span></p>
    </div>
    <div class="modal-footer" id="ticketModalFooter">
    <!-- Buttons will be injected here based on conditions -->
    </div>
</div>
</div>
</div>