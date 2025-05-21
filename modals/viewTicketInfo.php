<?php

?>

<!-- External CSS Link/s -->
<link rel="stylesheet" href="../asset/css/modals.css">
<link rel="stylesheet" href="../asset/css/buttons.css">

<!-- External JS Link/s -->
<script src="../asset/js/buttons.js"></script>

<!-- View Ticket Modal -->
<div class="modal fade" id="viewTicketModal" tabindex="-1" aria-labelledby="viewTicketModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" id="viewTicketModalLabel">Ticket Information</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body" id="viewTicketModalBody">
                < id="view-ticket-form">
                    <div class="col-12">
                        <div class="col-6">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="view-ticket-id">Ticket ID</label>
                                    <input type="text" class="form-control" id="view-ticket-id" name="view-ticket-id" readonly>
                                </div>
                            </div>  
                        </div>
                        </div>

                        <div class="col-6">
                            <div class="row">
                                <div class="col-3">
                                    <div class="row">
                                        <!-- Pending, On Going, Completed, Cancelled -->
                                    <button type="button" class="btn btn-status" id="view-ticket-status" name="view-ticket-status">
                                        <span id="view-ticket-status-text"></span>
                                    </button>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="row">
                                        <!-- Hardware or Software -->
                                    <button type="button" class="btn btn-type" id="view-ticket-type" name="view-ticket-type">
                                        <span id="view-ticket-type-text"></span>
                                    </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row">
                            <div class="col-4">
                            <div class="form-group">
                                <label for="view-ticket-date">Submitted At</label>
                                <input type="text" class="form-control" id="view-ticket-date" name="view-ticket-date" readonly>
                            </div>
                            </div>
                            
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="view-ticket-branch">Branch</label>
                                    <input type="text" class="form-control" id="view-ticket-branch" name="view-ticket-branch" readonly>
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="form-group">
                                    <label for="view-ticket-district">District</label>
                                    <input type="text" class="form-control" id="view-ticket-district" name="view-ticket-district" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="view-ticket-requester">Requester</label>
                                <input type="text" class="form-control" id="view-ticket-requester" name="view-ticket-requester" readonly>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="view-requester-email">Email</label>
                                <input type="text" class="form-control" id="view-requester-email" name="view-requester-email" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="view-ticket-requester-contact">Contact No.</label>
                                <input type="text" class="form-control" id="view-ticket-requester-contact" name="view-ticket-requester-contact" readonly>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="view-ticket-technician">IT Technician</label>
                                <input type="text" class="form-control" id="view-ticket-technician" name="view-ticket-technician" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label for="view-ticket-description">Description</label>
                            <textarea class="form-control" id="view-ticket-description" name="view-ticket-description" readonly>
                                Enter Description
                            </textarea>
                        </div>
                    </div>
                    
                    <!--?php if(strtolower($ticket['Status'])=="pending") { ?>-->
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-accept">Approve</button>
                    </div>
                    <!--?php endif; ?-->
                </form>
            </div>
        </div>
    </div>
</div>