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


