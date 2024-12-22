<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public/css/AdminProduct.css?ver=<?php echo time();?>">
    <title>Document</title>
</head>
<body>
    <h2 class="title-admin">ADD, EDIT AND DELETE PRODUCT</h2>
    <div id="display_product"></div>
    <!-- <div class="container-admin">
        <button class="display-form">Add Product +</button>
        <div class="box-form">
            <form class="form" action="" method="POST">
                <h3>ADD A NEW PRODUCT</h3>
                <input type="text" class="input-name" placeholder="Enter product name" name="product_name">
                <input type="number" class="input-price" placeholder="Enter product price" name="product_price">
                <input type="file" class="input-img" accept="image/png, image/jpg, image/jpeg" name="product_img">
                <input type="submit" class="input-add" name="product_submit" value="ADD">
            </form>
        </div>
        <div>
            <table class="table">
                <?php $product = $data['Product'];?>
                <tr class="header-tb">
                    <th class="id-tb">ID</th>
                    <th class="img-tb">IMG</th>
                    <th class="name-tb">NAME</th>
                    <th class="price-tb">PRICE</th>
                    <th class="action-tb">ACTION</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>
                        <div class="img-database">
                            <img src="<?php 'public/images/' .$product['ImageImage'] . '.png'?>" alt="">
                        </div>
                    </td>
                    <td><?php echo $product['NameName']?></td>
                    <td><b><?php echo $product['PricePrice']?></b></td>
                    <td>
                        <button class="edit-tb">Edit</button>
                        <button class="delete-tb">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>
                        <div class="img-database">
                            <img src="https://cdn-images.vtv.vn/thumb_w/640/66349b6076cb4dee98746cf1/2024/10/11/11102024-hon-70--quan-the--ong-vat-hoang-da-bien-mat-3-35031029403874098180547.png" alt="">
                        </div>
                    </td>
                    <td>N</td>
                    <td>Price</td>
                    <td>
                        <button>Edit</button>
                        <button>Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>
                        <div class="img-database">
                            <img src="https://cdn-images.vtv.vn/thumb_w/640/66349b6076cb4dee98746cf1/2024/10/11/11102024-hon-70--quan-the--ong-vat-hoang-da-bien-mat-3-35031029403874098180547.png" alt="">
                        </div>
                    </td>
                    <td>N</td>
                    <td>Price</td>
                    <td>
                        <button>Edit</button>
                        <button>Delete</button>
                    </td>
                </tr>
            </table>
        </div>
        <form class="form-edit" action="" method="POST">
            <h3>UPDATA THE PRODUCT</h3>
            <input class="name-edit" type="text" placeholder="Enter new name">
            <input class="price-edit" type="number" placeholder="Enter new price">
            <input class="img-edit" type="file" accept="image/png, image/jpg, image/jpeg" name="product_img">
            <button class="edit-button">Update Product</button>
            <button class="out-button">Go Back!</button>
        </form>
    </div> -->
</body>
</html>