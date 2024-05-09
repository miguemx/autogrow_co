<!DOCTYPE html>
<html>
<head>
    <title>Payment Form</title>
    <script src="https://js.stripe.com/v3/"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'css/style.css'; ?>" />
</head>
<body>
<h2>Checkout</h2>
<form action="<?= base_url('payments') ?>" method="POST" id="payment-form">
    <?php if(isset($message)): ?>
        <div class="error"><?php echo $message; ?></div>
    <?php endif; ?>
    <h3>Product details</h3>
    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th>Amount (USD)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $product['description'] ?></td>
                <td><?php echo $product['amount'] ?></td>
            </tr>
        </tbody>
    </table>
    
    <div class="form-row">
        <input type="hidden" name="amount" value="1" />
        <h3>Payment information</h3>
        <div id="card-element">
            
        </div>

        <div id="card-errors" class="small-alert"></div>
    </div>

    <button class="btn btn-yellow">Submit Payment</button>
</form>

<script>
    var stripe = Stripe('<?php echo $key ?>');
    var elements = stripe.elements();

    // Custom styling can be passed to options when creating an Element.
    var style = {
        base: {
            marginBottom: "10px",
            fontSize: "18px",
            spacingUnit: "10px",
            borderRadius: "7px",
            padding: 15,
            '::placeholder': {
                color: '#FBC530',
            },
            '::selection': {
                backgroundColor: "#dedede",
            }
        }
    };
    var card = elements.create('card');
    card.mount('#card-element');

    // Handle form submission.
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        stripe.createToken(card).then(function(result) {
            if (result.error) {
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                stripeTokenHandler(result.token);
            }
        });
    });

    function stripeTokenHandler(token) {
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);
        form.submit();
    }
</script>

</body>
</html>
