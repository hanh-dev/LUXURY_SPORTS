$(document).ready(function () {
    displayProduct();
});

function displayProduct() {
    $.ajax({
        method: 'POST',
        url: '/LUXURY_SPORTS/HomeAdmin/getAllProduct',
        data: { dataProduct: 'true' },
        success: function (data, status) {
            $("#display_product").html(data);
        },
    });
}