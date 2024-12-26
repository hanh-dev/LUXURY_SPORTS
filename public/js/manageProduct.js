$(document).ready(function () {
    displayData();
});
// Display product information
function displayData() {
    $.ajax({
        method: 'POST',
        url: '/LUXURY_SPORTS/HomeAdmin/getAllProduct',
        data: { datasend: 'true' },
        success: function (data, status) {
            $("#display_data").html(data);
        },
    });
}
// add product
function addProduct() {
    const category = $('#category').val();
    const name = $('#name').val();
    const des = $('#des').val();
    const qty = $('#qty').val();
    const price = $('#price').val();
    const image = $('#image')[0].files[0];

    const formData = new FormData();
    formData.append('name', name);
    formData.append('description', des);
    formData.append('quantity', qty);
    formData.append('price', price);
    formData.append('image', image);
    formData.append('category', category);

    $.ajax({
        type: 'POST',
        url: '/LUXURY_SPORTS/HomeAdmin/createProduct',
        data: formData,
        processData: false,
        contentType: false,
        success: function (data, status) {
            displayData();
            $('#close').click();
            $('#name').val('');
            $('#des').val('');
            $('#qty').val('');
            $('#price').val('');
            $('#image').val('');

            const response = JSON.parse(data);
            if (response.success === false) {
                alert(response.message);
            } else {
                alert('Product added successfully!');
            }
        },
        error: function (xhr, status, error) {
            console.error('Error:', error);
            alert('An error occurred while adding the product.');
        }
    });
}
// delete product
function deleteProduct($id) {
    console.log($id);
    const continueDelete = confirm('Do you want to continue delete?');
    if(!continueDelete) {
        return;
    }
    const id = $id;
    $.ajax({
        type: 'POST',
        url: '/LUXURY_SPORTS/HomeAdmin/deleteProduct',
        data: {id: id},
        success: function (data, status) {
            displayData();
        },
    });
}
// update product
function updateProduct($id) {
    const category = $('#categoryUpdate');
    const name = $('#nameUpdate');
    const des = $('#desdUpdate');
    const qty = $('#quantityUpdate');
    const price = $('#priceUpdate');
    const modal = $('#openUpdate');
    const modalClose = $('#closeUpdate');

    const id = $id;
    modal.click();

    name.val('');

    $.ajax({
        type: 'POST',
        url: '/LUXURY_SPORTS/HomeAdmin/productInfo',
        data: { id: id },
        success: function (data, status) {
            try {
                const product = JSON.parse(data);
                category.val(product[0].CategoryName)
                name.val(product[0].Name);
                des.val(product[0].Description);
                price.val(product[0].Price);
                qty.val(product[0].Qty_in_stock);
            } catch (e) {
                console.error("Error parsing JSON:", e);
            }
        },
    });
    $('#updateButton').off('click').on('click', function() {
        const formData = new FormData();
        formData.append('id', id);
        formData.append('name', name.val());
        formData.append('description', des.val());
        formData.append('quantity', qty.val());
        formData.append('price', price.val());
        const image = $('#imgUpdate')[0].files[0] ?? null;
        formData.append('image', image);
        formData.append('category', category.val());

        $.ajax({
            type: 'POST',
            url: '/LUXURY_SPORTS/HomeAdmin/updateProduct',
            processData: false,
            contentType: false,
            data: formData,
            success: function (data, status) {
                displayData();
                modalClose.click();
                $('#imgUpdate').val('');
                const user = JSON.parse(data);
                if(user.success === false) {
                    alert(user.message);
                    return;
                }
            }
        });
    });
}