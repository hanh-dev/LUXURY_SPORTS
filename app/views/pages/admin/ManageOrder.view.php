<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <base href="/LUXURY_SPORTS/">
    <link rel="stylesheet" href="public/css/ManageOrder.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJpX4n6+q/0gQv5PaJrGrfBgu7yF4H34pkslN7nECKFZiW7zVLFJ9ek03xxs" crossorigin="anonymous">
</head>
<body>
    <div class="d-flex align-items-center justify-content-between mt-2">
        <h4>Manage Orders</h4>
        <div class="notification-container" onclick="notify()">
            <i class="fa-regular fa-bell" style="font-size: 20px; cursor: pointer;"></i>
            <span class="notification-badge" id="notifyQuantity"></span>
        </div>
    </div>
    <div id="display_data">
        <!-- Order Data -->
    </div>
    <!-- Notifycation modal -->
    <div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="notificationModalLabel">Notifications</h5>
                </div>
                <div class="modal-body" id='displayNotify'>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="update" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-center" id="update">Update Status</h1>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="Status" class="form-label">Status</label>
                        <select id="statusUpdate" class="form-select">
                            <option value="Paid">Paid</option>
                            <option value="Cancelled">Cancelled</option>
                            <option value="Shipped">Shipped</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="close">Close</button>
                    <button type="button" class="btn btn-primary" onclick="updateStatus()" >Update Status</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Bootstrap CSS (Phiên bản mới nhất) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="public/js/manageOrder.js"></script>
</body>
</html>