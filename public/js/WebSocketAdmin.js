const socket = new WebSocket('ws://localhost:8080?type=admin');

// WebSocket event listeners
socket.onopen = () => {
    status.textContent = 'WebSocket Status: Connected';
};

let userID = null;

socket.onmessage = (event) => {
    const message = JSON.parse(event.data);
    
    userID = message.userID;

    if (message.type === 'new_payment') {
        userID = message.data['userID'];
        let currentValue = parseInt(notifyQuantity.textContent || 0);
        currentValue += 1;
        notifyQuantity.innerHTML = currentValue;
    }else if(message.type = 'admin_connected') {
        console.log('Admin connected to the server');
    }
};

socket.onclose = () => {
    status.textContent = 'WebSocket Status: Disconnected';
};

socket.onerror = (error) => {
    console.error('WebSocket Error:', error);
};

const sendResponseButton = document.getElementById('sendResponse');

function sendMessage(type, data) {
    if (socket && socket.readyState === WebSocket.OPEN) {
        socket.send(JSON.stringify({ type, ...data }));
    } else {
        console.error('WebSocket is not connected');
    }
}

function sendMessageToClient(clinetID) {
    sendMessage('admin_response', { clientId: clinetID, response: `Response from admin: your order was ${responeMessage}` });
}

