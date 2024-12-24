<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/LUXURY_SPORTS/">
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 bg-dark vh-100">
                <h4 class="text-center py-3" style="color: white;">Admin Panel</h4>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="HomeAdmin/show" id="dashBoard" class="nav-link" style="cursor: pointer">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a href="HomeAdmin/manageUser" id="manageUser" class="nav-link" style="cursor: pointer">Manage User</a>
                    </li>
                    <li class="nav-item">
                        <a href="HomeAdmin/manageProduct" id="manageProduct" class="nav-link" style="cursor: pointer">Manage Product</a>
                    </li>
                    <li class="nav-item">
                        <a href="HomeAdmin/manageOder" id="manageOder" class="nav-link" style="cursor: pointer">Manage Oder</a>
                    </li>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="col-md-9">
                <div id="display_main">
                    <?php
                        require_once './app/views/pages/'.$data['Page'].'.view'.'.php';
                    ?>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>