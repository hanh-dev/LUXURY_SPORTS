async function updateQuantity(event, $productID) {
    if (event.key !== 'Enter') {
        return;
    }

    const quantity = event.target.value;
    if(quantity <= 0) {
        alert('Quantity must be greater than 0');
        return;
    }

    try {
        const res = await fetch(`/LUXURY_SPORTS/Cart/updateProductQty/${$productID}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },

            body: JSON.stringify({ quantity})
        })

        const textResponse = await res.text();
        const result = JSON.parse(textResponse);

        if(result.success) {
            const totalElement = document.querySelector(`#total-${$productID}`);
            if(totalElement) {
                totalElement.textContent = (price * quantity).toFixed(2);
            }

            updateCartTotal();
        } else {
            alert(result.message);
            const initialQuantity = result.currentQuantity;
            event.target.value = initialQuantity;

            updateProductTotals(event.target);

        }
    } catch (error) {
        console.error('Error updating quantity:', error);
    }
}