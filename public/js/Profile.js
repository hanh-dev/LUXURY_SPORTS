document.addEventListener('DOMContentLoaded', () => {
    const content_right = document.getElementById('profile_display');
    let currentPage = '';
    let page = 'accountDetailPage';
    
    const handlePage = async () => {
        if (currentPage === page) {
            console.log(`Already on ${page}, skipping reload.`);
            return;
        }
    
        content_right.innerHTML = '';
        console.log(`Move to ${page}`);
        try {
            const res = await fetch('/LUXURY_SPORTS/Profile/' + page);
            if (!res.ok) {
                throw new Error('Failed to fetch page in profile');
            }
    
            const html = await res.text();
            content_right.innerHTML = html;
            currentPage = page;
            attachDynamicEventListeners();
        } catch (error) {
            console.error('Error at fetching page in profile:', error);
        }
    };
    // 
    const attachDynamicEventListeners = () => {
        const editButton = document.getElementById('edit');
        const saveButton = document.getElementById('save');
        const statusSelect = document.getElementById("status");

        if (editButton) {
            editButton.addEventListener('click', () => {
                edit = true;
                const inputs = document.querySelectorAll('.right_hold input');
                inputs.forEach(input => {
                    input.removeAttribute('readonly');
                });
                editButton.style.backgroundColor = '#cdff00';
            });
        }

        if (saveButton) {
            saveButton.addEventListener('click', async () => {
                const toastElement = document.getElementById('myToast');
                const toast = new bootstrap.Toast(toastElement);
                const content = document.getElementById('content_toast');
                const icon = document.getElementById('icon_noti');
                const editButton = document.getElementById('edit');

                if (edit) {
                    const name = document.getElementById('name').value;
                    const email = document.getElementById('email').value;
                    const phone = document.getElementById('phone').value;

                    // Validate email
                    if (!validE(email)) {
                        showToast(toastElement, icon, content, 'Invalid Email!', 'red', 'fa-circle-exclamation');
                        return;
                    }

                    // Validate phone number
                    if (!validP(phone)) {
                        showToast(toastElement, icon, content, 'Invalid PhoneNumber!', 'red', 'fa-circle-exclamation');
                        return;
                    }

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

                        editButton.style.backgroundColor = '#f0f0f0';

                        if (data.success) {
                            showToast(toastElement, icon, content, 'Profile updated successfully!', 'green', 'fa-circle-check');
                            edit = false;
                        }
                    } catch (error) {
                        console.error('Error updating profile:', error);
                        alert('An error occurred while updating the profile.');
                    }
                } else {
                    showToast(toastElement, icon, content, 'You must be in edit mode!', 'red', 'fa-circle-exclamation');
                }
            });
        }
        if(statusSelect) {
            statusSelect.addEventListener("change", async() => {
                const container = document.getElementById('cart');
                container.innerHTML = '';
                const selectedValue = statusSelect.value;

                try {
                    const res = await fetch('/LUXURY_SPORTS/Profile/OrderPage_Status', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ status: selectedValue })
                    })
                    const html = await res.text();
                    container.innerHTML = html;
                } catch (error) {
                    console.log('Error at fetching OrderPage_Status', error);
                }

            });
        }
    };

    const showToast = (toastElement, icon, content, message, bgColor, iconClass) => {
        icon.className = `fa-solid ${iconClass}`;
        toastElement.style.backgroundColor = bgColor;
        content.textContent = message;
        const toast = new bootstrap.Toast(toastElement);
        toast.show();
        setTimeout(() => toast.hide(), 2800);
    };

    // Validate email
    const validE = (email) => /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(email);

    // Validate phone number
    const validP = (phone) => /^[0-9]{10,11}$/.test(phone);

    // Attach event listeners for navigation
    document.getElementById('accountDetail').addEventListener('click', () => {
        page = 'accountDetailPage';
        handlePage();
    });

    document.getElementById('ordertrack').addEventListener('click', () => {
        page = 'orderPage';
        handlePage();
    });

    // Logout
    document.getElementById('logout').addEventListener('click', async () => {
        try {
            const res = await fetch('/LUXURY_SPORTS/Profile/unsetUser', {
                headers: {
                    'Content-Type': 'application/json',
                },
            });

            const data = await res.json();
            if (data.success) {
                window.location.href = '/LUXURY_SPORTS/Home';
            }
        } catch (error) {
            console.log('Error at logout', error);
        }
    });

    // Image upload
    document.getElementById('image').addEventListener('click', () => {
        const fileInput = document.getElementById('fileInput');
        fileInput.click();
    });

    document.getElementById('fileInput').addEventListener('change', async () => {
        const file = document.getElementById('fileInput').files[0];

        if (!file) {
            console.error('No file selected');
            return;
        }

        const formData = new FormData();
        formData.append('image', file);

        try {
            const res = await fetch('/LUXURY_SPORTS/UploadImage/updateImage', {
                method: 'POST',
                body: formData
            });
            const data = await res.json();
            document.getElementById('image').src = data.imageUrl;
        } catch (error) {
            console.error('Upload failed:', error);
        }
    });
    handlePage();
});
// delete
removeItem = async function (id) {
    console.log('You are deleting an item:', id);

    try {
        const response = await fetch('/LUXURY_SPORTS/Profile/removeItem', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ id }),
        });

        const result = await response.json();
        if (result.success) {
            loadQuantity();
            console.log('Item removed successfully!');
            document.querySelector(`[data-id="${id}"]`).remove();
        } else {
            console.error('Failed to remove item:', result.message);
        }
    } catch (error) {
        console.error('Error while removing item:', error);
    }
};
function loadQuantity() {
    $.ajax({
        type: "GET",
        url: "/LUXURY_SPORTS/Cart/getQuantityCart",
        success: function (res) {
            $('#display_quantity').html(res);
        },
        error: function () {
            console.error('Error loading cart quantity.');
        }
    });
}

