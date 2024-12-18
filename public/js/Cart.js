async function addToCart($productID) {
    const toastElement = document.getElementById('myToast');
    const toast = new bootstrap.Toast(toastElement);
    const productID = $productID;
    try {
        const res = await fetch('/LUXURY_SPORTS/Cart/createOrder', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ productID })
        })

        const data = await res.json();

        if(data.success == true) {
            toast.show();
            setTimeout(function () {
                toast.hide();
            }, 2500);
            return;
        } else {
            alert('Failed to add product to cart');
        }
    } catch (error) {
        console.error('Error at creating order', error);
    }
}