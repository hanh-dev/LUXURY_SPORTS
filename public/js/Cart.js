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
            console.log('Data returned', data);

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
    window.payment = async () => {
        const toastValidate = document.getElementById('error-message');
        const name = document.getElementById('name').value;
        const address = document.getElementById('address').value;
        const phone = document.getElementById('phone').value;
        if(name === '' || address === '' || phone === '') {
            toastValidate.style.display = 'block';
            return;
        }
        // Lấy tất cả các sản phẩm đã chọn
        const selectedProducts = document.querySelectorAll('.product-item');
        const productIds = [];
        selectedProducts.forEach(product => {
            const id = product.getAttribute('data-id');
            const numericId = +id;
            if (!isNaN(numericId)) {
                productIds.push(numericId);
            }
        });
        const totalSpan = document.getElementById('total');
        const totalPrice = totalSpan.innerText.replace('$', '').trim();
        try {
            const res = await fetch('/LUXURY_SPORTS/Cart/checkoutStripe', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ total:totalPrice }),
            });
    
            if (!res.ok) {
                throw new Error(`HTTP error! Status: ${res.status}`);
            }
    
            const data = await res.json();
    
            if (data.success === false) {
                console.error('Error at payment:', data.message);
                alert('Payment failed: ' + data.message);
            } else if (data.success) {
                console.log('ProductID', productIds);
                try {
                    const res = await fetch('/LUXURY_SPORTS/Cart/updateStatus', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({ productIds }),
                    });

                    if(!res.ok) {
                        throw new Error('HTTP error ! Status: ' + res.status);
                    }
                    //
                    window.location.href = data.url;
                } catch (error) {
                    console.log('Error at updating status');
                }
            } else {
                console.error('Unexpected response:', data);
            }
        } catch (error) {
            console.error('Payment failed:', error.message);
            alert('An error occurred during payment. Please try again.');
        }
    }
});
