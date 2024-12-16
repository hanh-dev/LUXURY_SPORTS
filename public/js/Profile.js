// EditEdit
document.getElementById('edit').addEventListener('click', ()=> {
    const color = document.getElementById('edit');
    const inputs = document.querySelectorAll('.right_hold input');

    inputs.forEach(input => {
        input.removeAttribute('readonly');
    });

    color.style.backgroundColor = '#cdff00';
})

// Save
document.getElementById('save').addEventListener('click', async () => {
    const color = document.getElementById('edit');
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const phone = document.getElementById('phone').value;

    // Validate Email
    if(!validE(email)) {
        alert('Invalid Email');
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

        const data = await res.json(res);
        const inputs = document.querySelectorAll('.right_hold input');
        inputs.forEach(input => {
            input.setAttribute('readonly', 'readonly');
        });

        color.style.backgroundColor = '#f0f0f0';
        if (data.success == true) {
            alert('Profile updated successfully!');
        }
    } catch (error) {
        console.error('Error updating profile:', error);
        alert('An error occurred while updating the profile.');
    }
});

function validE(e) {
    const patt = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    return patt.test(e);
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
})
