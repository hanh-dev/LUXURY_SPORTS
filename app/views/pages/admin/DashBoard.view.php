<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <h4 class="text text-center">Hello , <?= $data['Admin']['UserName']; ?></h4>
    <div>
        <p id="status">WebSocket Status: Connecting...</p>
    </div>
    <div>
        <h2>New Payments</h2>
        <ul id="payments"></ul>
    </div>
    <div>
        <h3>Respond to Payment</h3>
        <input type="text" id="response" placeholder="Enter your response">
        <input type="text" id="clientId" placeholder="Enter client ID">
        <button id="sendResponse">Send Response</button>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>