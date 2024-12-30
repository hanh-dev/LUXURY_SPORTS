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
