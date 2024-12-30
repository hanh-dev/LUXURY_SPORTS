async function confirmDelete($productID) {
    let result = confirm("Do you want to continue?");
    if (result) {
        console.log('Removing product with ID ' + $productID);
        try {
            const res = await fetch('/LUXURY_SPORTS/Cart/removeProduct', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ productID: $productID })
            });

            const result = await res.json();
            if (result.success === true) {
                // Hiển thị thông báo xóa thành công


                // Hiển thị thông báo xóa thành công
                const statusMessage = document.getElementById('notification-deleted');
                statusMessage.textContent = 'Product deleted successfully';
                statusMessage.style.color = 'green';


                // Xóa sản phẩm khỏi giao diện ngay lập tức
                const row = document.querySelector(`tr.item[data-id="${$productID}"]`);
                if (row) {
                    row.remove(); // Xóa phần tử sản phẩm khỏi bảng
                }

                updateCartTotals(); // Cập nhật lại tổng giỏ hàng  
                await updateCartQuantity();
                // Sau 3 giây, ẩn thông báo
                setTimeout(() => {
                    statusMessage.textContent = '';
                }, 1000);

            } else {
                alert('Product not deleted successfully');
            }
        } catch (error) {
            console.error('Error during product deletion:', error);
        }
    }
}

// Hàm cập nhật số lượng giỏ hàng
async function updateCartQuantity() {
    try {
        const res = await fetch('/LUXURY_SPORTS/Cart/getQuantityCart');
        const quantity = await res.text();

        const quantityElement = document.getElementById('display_quantity');
        if (quantityElement) {
            quantityElement.innerHTML = quantity;
        }
    } catch (error) {
        console.error('Error updating cart quantity:', error);
    }
}

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

document.addEventListener('DOMContentLoaded', function () {
    const checkboxes = document.querySelectorAll('.check-select');
    const updateQty = document.querySelectorAll('.qty input');

     // Khôi phục trạng thái checkbox từ localStorage
    checkboxes.forEach(checkbox => {
        // checkbox.addEventListener('change', updateCartTotals);
        const productID = checkbox.closest('tr.item').dataset.id;
        const isChecked = localStorage.getItem(`product-${productID}-checked`) === 'true';
        checkbox.checked = isChecked;

        // Lắng nghe sự kiện thay đổi của checkbox
        checkbox.addEventListener('change', () => {
            localStorage.setItem(`product-${productID}-checked`, checkbox.checked);
            updateCartTotals();
        });
    });

    // Lắng nghe sự kiện thay đổi số lượng sản phẩm
    updateQty.forEach(input => {
        input.addEventListener('input', () => {

            updateCartTotals();
            updateProductTotals(input);
        });
    });
});

function updateProductTotals(input) {
    const row = input.closest('tr.item');
    const price = parseFloat(row.querySelector('.price').textContent.replace('$', ''));
    const quantity = parseInt(input.value);

    // Cập nhật lại tổng của sản phẩm trong dòng tương ứng
    if (!isNaN(price) && !isNaN(quantity)) {
        const total = price * quantity;
        row.querySelector('.total').textContent = `$${total}`;
    }

    updateCartTotals();  // Cập nhật lại tổng giỏ hàng
}

function updateCartTotals() {
    let subtotal = 0;

    // Lấy tất cả checkbox đã được chọn
    const selectedCheckboxes = document.querySelectorAll('.check-select:checked');

    if(selectedCheckboxes.length === 0) {
        // Lặp qua tất cả sản phẩm còn lại của giỏ hàng
        document.querySelectorAll('tr.item').forEach(row => {
            const totalProduct = parseFloat(row.querySelector('.total').textContent.replace('$', '')); // Lấy tổng của từng sản phẩm
           
            if (!isNaN(totalProduct)) {
                subtotal += totalProduct;
            }
        })
       
    } else {
        // Tính tổng tiền chỉ dựa trên các sản phẩm được chọn
        selectedCheckboxes.forEach(checkbox => {
            const row = checkbox.closest('tr.item');
            const totalProduct = parseFloat(row.querySelector('.total').textContent.replace('$', ''));
   
            if (!isNaN(totalProduct)) {
                subtotal += totalProduct;
            }
        });
    }

    const total = subtotal;
    document.getElementById('subtotal-value').textContent = `$${subtotal}`;
    document.getElementById('total-value').textContent =`$${total}`;
}


async function checkout() {
    const selectedCheckboxes = document.querySelectorAll('.check-select:checked');
    const selectedProducts = [];

    selectedCheckboxes.forEach(checkbox => {
        const row = checkbox.closest('tr.item');
        const ID = row.dataset.id;
        const Qty = row.querySelector('.item-quantity').value;
        const Price = row.querySelector('.price').textContent.replace('$', ''); // Loại bỏ ký tự '$'
        const Image = row.querySelector('img').src.split('/').pop().replace('.png', ''); // Lấy tên ảnh
        const Name = row.querySelector('.product-Name .text-hover').textContent; // Lấy tên sản phẩm

        // Thêm thông tin sản phẩm vào mảng selectedProducts
        selectedProducts.push({
            ID, 
            Price, 
            Image, 
            Name, 
            Qty
        });
    });

    console.log("Sản phẩm đã chọn: ", JSON.stringify(selectedProducts));
    try {
        const res = await fetch('/LUXURY_SPORTS/Cart/checkout', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },

            body: JSON.stringify({ selectedProducts })
        });

        const html = await res.text();
        document.querySelector('#cart').innerHTML = html;
    } catch (error) {
        console.log('Error during checkout:', error);
    }
}