let client = null;
let socket = null;

async function checkUserID() {
    const userCheckdd = await getUserID();
    return userCheckdd;
}

function setupWebSocket(wsUrl) {
    socket = new WebSocket(wsUrl);

    socket.onopen = () => {
        console.log('WebSocket connected with URL:', wsUrl);
    };

    socket.onmessage = (event) => {
        const message = JSON.parse(event.data);
        console.log('Message from server:', message);

        if (message.type === 'user_connected') {
            console.log('User successfully connected');
        } else if (message.type === 'payment_response') {
            alert(`${JSON.stringify(message.data)}`);
        }
    };

    socket.onclose = () => {
        console.log('WebSocket disconnected');
        localStorage.removeItem('websocketUrl');
    };

    socket.onerror = (error) => {
        console.error('WebSocket error:', error);
    };
}

async function connectToWebSocket(data) {
    const queryString = Object.keys(data)
        .map(key => `${key}=${encodeURIComponent(data[key])}`)
        .join('&');

    const wsUrl = `ws://localhost:8080?${queryString}`;
    localStorage.setItem('websocketUrl', wsUrl);

    setupWebSocket(wsUrl);
}

function restoreWebSocketConnection() {
    const wsUrl = localStorage.getItem('websocketUrl');
    if (wsUrl) {
        console.log('Restoring WebSocket connection...');
        setupWebSocket(wsUrl);
    } else {
        console.log('No WebSocket connection to restore');
    }
}

function sendMessage(type, data) {
    if (socket && socket.readyState === WebSocket.OPEN) {
        socket.send(JSON.stringify({ type, ...data }));
    } else {
        console.error('WebSocket is not connected');
    }
}

function paymentSuccess() {
    sendMessage('payment_success', {
        payment: { userID: client }
    });
}

restoreWebSocketConnection();

checkUserID().then(userId => {
    client = userId;
    console.log('userID:', client);
    connectToWebSocket({ type: 'user', userId: client });
});
