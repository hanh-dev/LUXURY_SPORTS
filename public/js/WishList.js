async function addToWishList($productID) {
    console.log('addToWishList 1', $productID);
    const toastElement = document.getElementById('toastWishList');
    const toast = new bootstrap.Toast(toastElement);

    // Disable the heart icon temporarily to prevent multiple clicks
    const heartIcon = document.querySelector(`.wrapp_heart i[onclick='addToWishList(${$productID})']`);
    if (heartIcon) {
        heartIcon.classList.add('disabled');
    }

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
            // Update heart icon to show as added
            const heartIconDetail = document.querySelector(`.wrapp_heart-detail i[onclick='addToWishList(${$productID})']`);
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
            
            toast.show();
            setTimeout(function () {
                toast.hide();
            }, 2500);
        }
    } catch (error) {
        console.log("Failed to add to wish list");
    } finally {
        // Re-enable the heart icon after the operation completes
        if (heartIcon) {
            heartIcon.classList.remove('disabled');
        }
    }
}


async function removeProductFromWishList(productID) {
    console.log('removeProductFromWishList', productID);
    const productElement = document.querySelector(`[data-id="${productID}"]`);
    try {
        const res = await fetch('/LUXURY_SPORTS/Profile/deleteItem', {
            method : 'POST',
            headers : { 
                'Content-Type': 'application/json',
            },
            body : JSON.stringify({id: productID})
        });
        const result = await res.json();

        if (productElement) {
            productElement.remove();
        };
        if (result.success) {
            // Update heart icon to show as removed
            const heartIcon = document.querySelector(`.wrapp_heart i[onclick='removeProductFromWishList(${productID})']`);
            const heartIconDetail = document.querySelector(`.wrapp_heart-detail i[onclick='removeProductFromWishList(${productID})']`);
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
            
        } else {
            console.error('Failed to remove item:', result.message);
        }
    } catch (error) {
        console.error("Failed to remove product from wish list", error);
    }
}
