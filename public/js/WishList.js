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
        if(data.success){
            // Tìm icon trái tim liên quan đến sản phẩm
            const heartIcon = document.querySelector(`.wrapp_heart i[onclick='addToWishList(${$productID})']`);
            const heartIconDetail = document.querySelector(`.wrapp_heart-detail i[onclick='addToWishList(${$productID})']`)
            if (heartIcon) {
                heartIcon.classList.remove('fa-regular', 'fa-heart');
                heartIcon.classList.add('fa-solid', 'fa-heart');
                heartIcon.setAttribute('onclick', `removeProductFromWishList(${$productID})`);
            }

            if (heartIconDetail) {
                heartIconDetail.classList.remove('fa-regular', 'fa-heart');
                heartIconDetail.classList.add('fa-solid', 'fa-heart');
                heartIconDetail.setAttribute('onclick', `removeProductFromWishList(${$productID})`);
            }  
            
        }
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
            const heartIcon = document.querySelector(`.wrapp_heart i[onclick='addToWishList(${productID})']`);
            const heartIconDetail = document.querySelector(`.wrapp_heart-detail i[onclick='addToWishList(${productID})']`)
            if (heartIcon) {
                heartIcon.classList.remove('fa-solid', 'fa-heart');
                heartIcon.classList.add('fa-regular', 'fa-heart');
                heartIcon.setAttribute('onclick', `addToWishList(${productID})`);
            }

            if (heartIconDetail) {
                heartIconDetail.classList.remove('fa-solid', 'fa-heart');
                heartIconDetail.classList.add('fa-regular', 'fa-heart');
                heartIconDetail.setAttribute('onclick', `addToWishList(${productID})`);
            }
            console.log('Product removed from wish list!');
            document.querySelector(`[data-id="${productID}"]`).remove();
        } else {
            console.error('Failed to remove item:', result.message);
        }
    } catch (error) {
        console.error("Failed to remove product to wish list");
    }
}