<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>ADD, EDIT AND DELETE PRODUCT</h2>
    <button>Add Product</button>
    <div>
        <form action="" method="POST">
            <h3>add a new product</h3>
            <input type="text" placeholder="enter product name" name="product_name">
            <input type="number" placeholder="enter product price" name="product_price">
            <input type="file" accept="image/png, image/jpg, image/jpeg" name="product_img">
            <input type="submit" name="product_submit" value="add product">
        </form>
    </div>
    <div>
        <table>
            <tr>
                <th>ID</th>
                <th>IMG</th>
                <th>NAME</th>
                <th>PRICE</th>
                <th>ACTION</th>
            </tr>
            <tr>
                <td>1</td>
                <td>
                    <img src="" alt="">
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
</body>
</html>