$(document).ready(function () {
    displayData();
});
let currentID = null;
let userName = null;
var myModal = new bootstrap.Modal(document.getElementById('update'));
// Display order information
function displayData() {
    $.ajax({
        method: 'POST',
        url: '/LUXURY_SPORTS/HomeAdmin/getAllOrder',
        data: { datasend: 'true' },
        success: function (data, status) {
            $("#display_data").html(data);
        },
    });
};

function changeStatus(id) {
    currentID = id;
    var row = document.querySelector('tr[data-id="' + id + '"]');
    var statusCell = row.querySelector('.status');
    var currentStatus = statusCell.childNodes[0].textContent.trim();

    console.log("Trạng thái hiện tại là:", currentStatus);
    var userNameCell = row.querySelector('.userName');
    var userNameCheck = userNameCell ? userNameCell.textContent.trim() : '';
    console.log("Tên người dùng là:", userNameCheck);
    var statusSelect = document.getElementById('statusUpdate');
    statusSelect.value = currentStatus;
    var myModal = new bootstrap.Modal(document.getElementById('update'));
    userName = userNameCheck;
    myModal.show();
}

// Hàm để lưu trạng thái và gửi yêu cầu update
async function updateStatus() {
    var myModal = bootstrap.Modal.getInstance(document.getElementById('update'));
    const status = document.getElementById('statusUpdate').value;

    try {
        const res = await fetch('/LUXURY_SPORTS/HomeAdmin/updateStatus', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                id: currentID,  // Gửi id của sản phẩm
                status: status, 
                userName: userName  // Gửi trạng thái mới
            })
        });

        if (!res.ok) {
            throw new Error('Failed to fetch page updateStatus');
        }
        const responseData = await res.json(); // Lấy dữ liệu JSON trả về từ server

        if (responseData.success === false) {
            alert('Có lỗi xảy ra khi cập nhật trạng thái.');
        } else {
            console.log('Cập nhật trạng thái thành công!');
        }
    } catch (error) {
        console.log('Lỗi khi cập nhật:', error);
    }
    myModal.hide();  // Đóng modal sau khi cập nhật
}

