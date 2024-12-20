 // Edit
let edit = false;
document.getElementById('edit').addEventListener('click', () => {
    edit = true;
    const color = document.getElementById('edit');
    const inputs = document.querySelectorAll('.right_hold input');

    inputs.forEach(input => {
        input.removeAttribute('readonly');
    });

    color.style.backgroundColor = '#cdff00';
});

// Save
document.getElementById('save').addEventListener('click', async () => {
    const toastElement = document.getElementById('myToast');
    const toast = new bootstrap.Toast(toastElement);
    const content = document.getElementById('content_toast');
    const icon = document.getElementById('icon_noti');
    const color = document.getElementById('edit');
    

    if (edit) {
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const phone = document.getElementById('phone').value;

        // Validate Email
        if (!validE(email)) {
            icon.className = 'fa-solid fa-circle-exclamation';
            toastElement.style.backgroundColor = 'red';
            content.textContent = 'Invalid Email!';
            toast.show();
            setTimeout(function () {
                toast.hide();
            }, 2800);
            return;
        }

        // Validate PhoneNumber
        if (!validP(phone)) {
            icon.className = 'fa-solid fa-circle-exclamation';
            toastElement.style.backgroundColor = 'red';
            content.textContent = 'Invalid PhoneNumber!';
            toast.show();
            setTimeout(function () {
                toast.hide();
            }, 2800);
            return;
        }
        // 
        try {
            const res = await fetch('/LUXURY_SPORTS/Profile/update', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ name, email, phone })
            });

            const data = await res.json();
            const inputs = document.querySelectorAll('.right_hold input');
            inputs.forEach(input => {
                input.setAttribute('readonly', 'readonly');
            });

            color.style.backgroundColor = '#f0f0f0';

            // Success notification
            if (data.success == true) {
                icon.className = 'fa-solid fa-circle-check';
                toastElement.style.backgroundColor = 'green';
                content.textContent = 'Profile updated successfully!';
                toast.show();
                edit = false;
                setTimeout(function () {
                    toast.hide();
                }, 2800);

            }

        } catch (error) {
            console.error('Error updating profile:', error);
            alert('An error occurred while updating the profile.');
        }
    } else {
        // Error notification
        toastElement.style.backgroundColor = 'red';
        icon.className = 'fa-solid fa-circle-exclamation';
        content.textContent = 'You must be in edit mode!';
        toast.show();
        setTimeout(function () {
            toast.hide();
        }, 2800);
    }
});

// Validate email
function validE(e) {
    const patt = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    return patt.test(e);
}
// Validate phone number
function validP(p) {
    const phoneRegex = /^[0-9]{10,11}$/;
    return phoneRegex.test(p);
}

// Logout
document.getElementById('logout').addEventListener('click', async () => {
    try {
        const res = await fetch('/LUXURY_SPORTS/Profile/unsetUser', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            },
        });

        const data = await res.json();
        if(data.success == true) {
            window.location.href = '/LUXURY_SPORTS/Home';
        }
    } catch (error) {
        console.log('Error at logout', error);
    }
});

document.getElementById('image').addEventListener('click', () => {
    const fileInput = document.getElementById('fileInput');
    fileInput.click();
});

// Form image
document.getElementById('fileInput').addEventListener('change', async() => {
    const file = fileInput.files[0];

    if (!file) {
        console.error('No file selected');
        return;
    }

    const formData = new FormData(); // multipart/form-data
    formData.append('image', file);

    try {
        const response = await fetch('/LUXURY_SPORTS/UploadImage/updateImage', {
            method: 'POST',
            body: formData
        });

        const result = await response.json();
        if (result.success) {
            document.getElementById('image').src = imageUrl;
        } else {
            console.error('Upload failed:', result.message);
        }
    } catch (error) {
        console.error('Upload failed:', error);
    }
});
