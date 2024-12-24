<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <base href="/LUXURY_SPORTS/">
    <link rel="stylesheet" href="public/css/ManageProduct.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <!-- Modal Add New Product -->
    <div class="modal fade" id="completeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">Add Product</h1>
                </div>
                <div class="modal-body">
                    <!-- Category -->
                    <div class="mb-3">
                        <label for="Category" class="form-label">Category</label>
                        <select id="category" class="form-select">
                            <option value="Football">Football</option>
                            <option value="Tennis">Tennis</option>
                            <option value="Basketball">Basketball</option>
                            <option value="Pickleball">Pickleball</option>
                        </select>
                    </div>
                    <!-- Image -->
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" id="image" class="form-control">
                    </div>
                    <!-- Name -->
                    <div class="mb-3">
                        <label for="Name" class="form-label">Name</label>
                        <input type="text" id="name" class="form-control" placeholder="Input Product Name...">
                    </div>
                    <!-- Description -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" id="des" class="form-control" placeholder="Input Product Description...">
                    </div>
                    <!-- Quantity -->
                    <div class="mb-3">
                        <label for="qty" class="form-label">Quantity</label>
                        <input type="number" id="qty" class="form-control" placeholder="Input Product Quantity...">
                    </div>
                    <!-- Price -->
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" id="price" class="form-control" placeholder="Input Product Price...">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="close">Close</button>
                    <button type="button" class="btn btn-primary" onclick="addProduct()" >Add Product</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Update Modal Product -->
    <div class="modal fade" id="update" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-center" id="update">Update Product</h1>
            </div>
            <div class="modal-body">
                <!-- Category -->
                <div class="mb-3">
                    <label for="Category" class="form-label">Category</label>
                    <select id="categoryUpdate" class="form-select">
                        <option value="Football">Football</option>
                        <option value="Tennis">Tennis</option>
                        <option value="Basketball">Basketball</option>
                        <option value="Pickleball">Pickleball</option>
                    </select>
                </div>
                <!-- Image -->
                <div class="mb-3">
                    <label for="Image" class="form-label">Image</label>
                    <input type="file" id="imgUpdate"></input>
                </div>
                <!-- Name -->
                <div class="mb-3">
                    <label for="Name" class="form-label">Name</label>
                    <input type="text" id="nameUpdate" class="form-control">
                </div>
                <!-- Quantity -->
                <div class="mb-3">
                    <label for="Quantity" class="form-label">Quantity</label>
                    <input type="number" id="quantityUpdate" class="form-control">
                </div>
                <!-- Description -->
                <div class="mb-3">
                    <label for="Des" class="form-label">Description</label>
                    <input type="text" id="desdUpdate" class="form-control">
                </div>
                <!-- Price -->
                <div class="mb-3">
                    <label for="Price" class="form-label">Price</label>
                    <input type="number" id="priceUpdate" class="form-control">
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
            Add New Product
        </button>
        <div id="display_data">

        </div>
    </div>
    <!-- js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="public/js/manageProduct.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>