<!DOCTYPE html>
<html>
<head>
    <title>Payment Success</title>
    <link rel="stylesheet" type="text/css" href="/css/style.css" />
    <script type="text/javascript">
        function newPayment() {
            document.location.href = "/payments";
        }
    </script>
</head>
<body>
    <h1>Payment received successfully</h1>
    <div class="succes-payment-message">Please click button below to procced to a new payment</div>
    <button class="btn btn-yellow" onclick="newPayment()">New Payment</button>
</body>
</html>
