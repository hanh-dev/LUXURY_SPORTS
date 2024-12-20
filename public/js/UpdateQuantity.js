async function updateQuantity(event, $productID) {
    if (event.key !== 'Enter') {
        return; // Nếu không phải phím Enter thì không làm gì cả
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

        const textResponse = await res.text(); // Lấy phản hồi dưới dạng text
        const result = JSON.parse(textResponse); // Chuyển đổi nội dung thành JSON

        if(result.success) {
            // const price = parseFloat(event.target.dataset.value);
            // console.log('Price:', price);
            const totalElement = document.querySelector(`#total-${$productID}`);
            if(totalElement) {
                totalElement.textContent = (price * quantity).toFixed(2);
            }

            updateCartTotal();
        } else {
            alert(result.message);    
        }
    } catch (error) {
        console.error('Error updating quantity:', error);
    }
}


