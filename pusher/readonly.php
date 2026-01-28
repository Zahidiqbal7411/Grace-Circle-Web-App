<!DOCTYPE html>
<html>
<head>
    <title>Get Firebase Data with jQuery</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<h2>Firebase Data:</h2>
<pre id="output"></pre>

<script>
    var firebaseURL = "https://webtechfusion-6415f-default-rtdb.firebaseio.com/.json";

    $.ajax({
        url: firebaseURL,
        type: "GET",
        success: function (data) {
            console.log(data);
            $('#output').text(JSON.stringify(data, null, 2));
        },
        error: function (xhr, status, error) {
            console.error("Error: " + error);
        }
    });
</script>

</body>
</html>
