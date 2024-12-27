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
                id: currentID,
                status: status, 
                userName: userName 
            })
        });

        if (!res.ok) {
            throw new Error('Failed to fetch page updateStatus');
        }
        const responseData = await res.json();

        if (responseData.success === false) {
            alert('Có lỗi xảy ra khi cập nhật trạng thái.');
        } else {
            var row = document.querySelector('tr[data-id="' + currentID + '"]');
            var statusCell = row.querySelector('.status');
            statusCell.innerHTML = status + ' <span onclick="changeStatus(' + currentID + ')">change status</span>';
            console.log('Cập nhật trạng thái thành công!');
        }
    } catch (error) {
        console.log('Lỗi khi cập nhật:', error);
    }
    myModal.hide();
}
