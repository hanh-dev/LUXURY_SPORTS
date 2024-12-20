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
