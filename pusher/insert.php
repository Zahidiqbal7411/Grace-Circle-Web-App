<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'username' => $_POST['username'],
        'message' => $_POST['message'],
        'div_id' => $_POST['div_id']
    ];

    $jsonData = json_encode($data);
    $firebaseUrl = "https://webtechfusion-6415f-default-rtdb.firebaseio.com/Pusher.json";

    // Step 1: POST to Firebase
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $firebaseUrl);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    $response = curl_exec($ch);
    curl_close($ch);

    // Decode response to get the unique key
    $result = json_decode($response, true);
    if (isset($result['name'])) {
        $key = $result['name'];

        // Step 2: DELETE the data immediately after insert
        $deleteUrl = "https://webtechfusion-6415f-default-rtdb.firebaseio.com/Pusher/$key.json";
        $chDelete = curl_init();
        curl_setopt($chDelete, CURLOPT_URL, $deleteUrl);
        curl_setopt($chDelete, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($chDelete, CURLOPT_RETURNTRANSFER, true);
        $deleteResponse = curl_exec($chDelete);
        curl_close($chDelete);

        echo json_encode(['status' => 'triggered', 'inserted_key' => $key]);
    } else {
        echo json_encode(['status' => 'error', 'response' => $response]);
    }
	exit;
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Insert Data to Firebase</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<h2>Send Message to Firebase</h2>
<form id="pushForm">
    <label>Username:</label><br>
    <input type="text" name="username" required><br><br>

    <label>Message:</label><br>
    <input type="text" name="message" required><br><br>

    <label>Div ID (e.g., message_1_4 or message_3_5):</label><br>
    <input type="text" name="div_id" required><br><br>

    <button type="submit">Send</button>
</form>

<div id="result"></div>

<script>
    $('#pushForm').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: 'insert.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                $('#result').html("<b>Message sent!</b><br>" + response);
                $('#pushForm')[0].reset();
            },
            error: function(xhr) {
                $('#result').html("<b>Error:</b><br>" + xhr.responseText);
            }
        });
    });
</script>

</body>
</html>
