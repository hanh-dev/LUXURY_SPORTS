$(document).ready(function () {
    loadQuantity();

    function loadQuantity() {
        $.ajax({
            type: "GET",
            url: "/LUXURY_SPORTS/Cart/getQuantityCart",
            success: function (res) {
                $('#display_quantity').html(res);
            },
            error: function () {
                console.error('Error loading cart quantity.');
            }
        });
    }

    window.addToCart = async function ($productID) {
        const productID = $productID;
        const quantity = document.getElementById('number_step') 
        ? document.getElementById('number_step').value 
        : 1;
        // Get the quantity of product
        try {
            const res = await fetch('/LUXURY_SPORTS/Cart/getQuantityOfProduct', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({productID: productID})
            });

            const data = await res.json();
            if(quantity>data.quantity) {
                alert('Only has ' + data.quantity + ' of this product in stock.');
                return;
            }
        } catch (error) {
            console.log('Error at creating order related to quantity', error);
        }
        const toastElement = document.getElementById('myToast');
        const toast = new bootstrap.Toast(toastElement);

        try {
            const res = await fetch('/LUXURY_SPORTS/Cart/createOrder', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ productID, quantity })
            });

            const data = await res.json();

            if (data.success == true) {
                toast.show();
                setTimeout(function () {
                    toast.hide();
                }, 2500);

                loadQuantity();

                return;
            } else {
                alert('Failed to add product to cart');
            }
        } catch (error) {
            console.error('Error at creating order', error);
        }
    };
});
