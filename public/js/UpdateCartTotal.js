document.addEventListener('DOMContentLoaded', function () {
    const checkboxes = document.querySelectorAll('.check-select');
    const updateQty = document.querySelectorAll('.qty input');

    // Lắng nghe sự kiện thay đổi của checkbox
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateCartTotals);
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
        row.querySelector('.total').textContent = `$${total.toFixed(2)}`;
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
    document.getElementById('subtotal-value').textContent = `$${subtotal.toFixed(2)}`;
    document.getElementById('total-value').textContent =`$${total.toFixed(2)}`;
}
