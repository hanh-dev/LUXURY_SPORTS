const notifyQuantity = document.getElementById('notifyQuantity');
let responeMessage = '';
$(document).ready(function () {
    displayData();
    loadQuantity();
});

function loadQuantity() {
    $.ajax({
        type: 'GET',
        url: '/LUXURY_SPORTS/Cart/pendingQuantity',
        success: function (data) {
            notifyQuantity.innerHTML = data;
        },
        error: function (status, error) {
            console.log(error.responseText);
        }
    })
}

let currentID = null;
let userName = null;
var myModal = new bootstrap.Modal(document.getElementById('update'));

// Notification
async function notify() {
    const modalElement = document.getElementById('notificationModal');
    const modal = bootstrap.Modal.getInstance(modalElement) || new bootstrap.Modal(modalElement);

    try {
        if (modalElement.classList.contains('show')) {
            modal.hide();
        }

        const response = await $.ajax({
            method: 'POST',
            url: '/LUXURY_SPORTS/HomeAdmin/getPendingConfirmationOrder',
            data: { datasend: true }
        });

        $("#displayNotify").html(response);
        // Hiển thị lại modal
        modal.show();
    } catch (error) {
        console.log('Error while fetching notification data:', error);
    }
}

async function handleAction(action, collapseId, userName) {
    responeMessage = action;
    console.log('checkuserName:',userName);
    const table = document.getElementById(collapseId);

    if (table) {
        const rows = table.querySelectorAll('tbody tr');
        const productIds = [];

        rows.forEach(row => {
            const id = row.getAttribute('data-id');
            if (id) {
                productIds.push(id);
            }
        });

        console.log(`Action: ${action}, Product IDs:`, productIds);

        try {
            const req = await fetch(`/LUXURY_SPORTS/Cart/updateStatus/${userName}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    action: action,
                    productIds: productIds
                })
            });

            const res = await req.json();
            console.log('Check response:', res);
            
            if (res.success) {
                const userID = res.userID;
                await notify();
                displayData();
                loadQuantity();
                // websocket admin send message to client
                sendMessageToClient(userID);

            }
        } catch (error) {
            console.log('Error at updating status for products:', error);
        }
    }
}


// Display order information
function displayData() {
    // loadQuantity();
    $.ajax({
        method: 'POST',
        url: '/LUXURY_SPORTS/HomeAdmin/getAllOrder',
        data: { datasend: 'true',  },
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