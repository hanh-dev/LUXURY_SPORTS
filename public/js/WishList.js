async function addToWishList($productID) {
    console.log('addToWishList 1', $productID);

    try {
        const res = await fetch('/LUXURY_SPORTS/Profile/addToWishList', {
            method : 'POST',
            headers : { 
                'Content-Type': 'application/json',
            },
            body : JSON.stringify({productID: $productID})
        });
        const data = await res.json();
        console.log('addToWishList 2', data);
    } catch (error) {
        console.log("Failed to add to wish list");
    }

}

async function removeProductFromWishList(productID) {
    console.log('removeProductFromWishList',productID);

    try {
        const res = await fetch('/LUXURY_SPORTS/Profile/deleteItem', {
            method : 'POST',
            headers : { 
                'Content-Type': 'application/json',
            },
            body : JSON.stringify({id: productID})
        });
        const result = await res.json();
        console.log('removeProduct', result);
        if (result.success) {
            loadQuantity();
            console.log('Item removed successfully!');
            document.querySelector(`[data-id="${productID}"]`).remove();
        } else {
            console.error('Failed to remove item:', result.message);
        }
    } catch (error) {
        console.error("Failed to remove product to wish list");
    }
}