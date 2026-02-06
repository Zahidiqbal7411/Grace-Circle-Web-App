<!DOCTYPE html>
<html>
<head>
    <title>Stripe Checkout</title>
</head>
<body>

<h2>Pay $10</h2>

<form action="/checkout" method="POST">
    @csrf
    <button type="submit">Pay with Stripe</button>
</form>

</body>
</html>
