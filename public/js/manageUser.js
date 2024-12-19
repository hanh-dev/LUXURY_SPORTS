$(document).ready(function () {
    displayData();
});
// Display information
function displayData() {
    $.ajax({
        method: 'POST',
        url: '/LUXURY_SPORTS/HomeAdmin/getAllUser',
        data: { datasend: 'true' },
        success: function (data, status) {
            $("#display_data").html(data);
        },
    });
}
// Create New User
function addUser() {
    const name = $('#name');
    const email = $('#email');
    const password = $('#password');
    const modal = $('#close');

    $.ajax({
        type: 'POST',
        url: '/LUXURY_SPORTS/HomeAdmin/createUser',
        data: {
            name: name.val(),
            email: email.val(),
            password: password.val()
        },
        success: function (data, status) {
            displayData();
            name.val('');
            email.val('');
            password.val('');
            modal.click();
        }
    });
}

function deleteUser($id) {
    const id = $id;
    $.ajax({
        type: 'POST',
        url: '/LUXURY_SPORTS/HomeAdmin/deleteUser',
        data: {id: id},
        success: function (data, status) {
            displayData();
        },
    });
}

function updateUser($id) {
    const name = $('#nameUpdate');
    const email = $('#emailUpdate');
    const password = $('#passwordUpdate');
    const modal = $('#openUpdate');
    const modalClose = $('#closeUpdate');

    const id = $id;
    modal.click();

    name.val('');
    email.val('');
    password.val('');

    $.ajax({
        type: 'POST',
        url: '/LUXURY_SPORTS/HomeAdmin/getInfor',
        data: { id: id },
        success: function (data, status) {
            try {
                const user = JSON.parse(data);
                name.val(user.Name);
                email.val(user.EmailAddress);
                password.val(user.Password);
            } catch (e) {
                console.error("Error parsing JSON:", e);
            }
        },
    });


$('#updateButton').off('click').on('click', function() {
    const updatedName = name.val();
    const updatedEmail = email.val();
    const updatedPassword = password.val();

    if(updatedName && updatedEmail && updatedPassword) {
        $.ajax({
            type: 'POST',
            url: '/LUXURY_SPORTS/HomeAdmin/updateUser',
            data: {id:id, name:updatedName, email:updatedEmail, password:updatedPassword},
            success: function (data, status) {
                displayData();  
                modalClose.click();
            }
        });
    }
});
}