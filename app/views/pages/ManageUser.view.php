<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <base href="/LUXURY_SPORTS/">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <!-- Modal -->
    <div class="modal fade" id="completeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">Add User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Name -->
                    <div class="mb-3">
                        <label for="Name" class="form-label">Name</label>
                        <input type="text" id="name" class="form-control" placeholder="Input Name...">
                    </div>
                    <!-- Email -->
                    <div class="mb-3">
                        <label for="Email" class="form-label">Email</label>
                        <input type="email" id="email" class="form-control" placeholder="Input Email...">
                    </div>
                    <!-- Password -->
                    <div class="mb-3">
                        <label for="Email" class="form-label">Password</label>
                        <input type="password" id="password" class="form-control" placeholder="Input Password...">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="close">Close</button>
                    <button type="button" class="btn btn-primary" onclick="addUser()" >Add User</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Update Modal -->
    <div class="modal fade" id="update" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-center" id="update">Update User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Name -->
                <div class="mb-3">
                    <label for="Name" class="form-label">Name</label>
                    <input type="text" id="nameUpdate" class="form-control">
                </div>
                <!-- Email -->
                <div class="mb-3">
                    <label for="Email" class="form-label">Email</label>
                    <input type="email" id="emailUpdate" class="form-control">
                </div>
                <!-- Password -->
                <div class="mb-3">
                    <label for="Password" class="form-label">Password</label>
                    <input type="password" id="passwordUpdate" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="closeUpdate">Close</button>
                <button type="button" class="btn btn-primary" id="updateButton">Save</button>
            </div>
        </div>
    </div>
</div>

    <div class="container my-3">
        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#completeModal" id="open">
            Add New User
        </button>

        <div id="display_data">

        </div>
    </div>
    <!-- js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="public/js/manageUser.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>