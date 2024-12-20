//lắng nghe sự kiện click
document.getElementById('searchIcon').addEventListener('click', function (e) {
    e.preventDefault(); //ngăn chuyển trang
    const searchContainer = document.getElementById('searchContainer');

    //hiển thị thanh tìm kiếm
    if (searchContainer.style.display === 'none' || searchContainer.style.display === '') {
        searchContainer.style.display = 'block';
    } else {
        searchContainer.style.display = 'none';
    }
});

$(document).ready(function(){
    loadProducts();

    $('#searchProduct').on('keyup', function(){
        var searchProduct = $(this).val();
        if (searchProduct.length > 0){
            $.ajax({
                type: 'POST',
                url: '/LUXURY_SPORTS/Product/searchProduct',
                data: {searchProduct: searchProduct},
                success: function(response){
                    console.log("Response from server:", response);
                    $('.product_menu').html(response);
                }
            });
        } else{
            loadProducts();
        }
    });

    function loadProducts(){
        $.ajax({
            type: 'POST',
            url: '/LUXURY_SPORTS/Product/getAll',
            success: function(response){
                $('.product_menu').html(response);
            }
        })
    }
})

