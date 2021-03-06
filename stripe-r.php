<?php
require_once('stripe-php/init.php');
?>
<head>
 <script src="build/react.js"></script>
  <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
  <!-- jQuery is used only for this example; it isn't required to use Stripe -->
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

  <!-- New section -->
  <script type="text/javascript">
    Stripe.setPublishableKey('pk_test_Yrkau1BYhyfenXMo78OXRObx');

   var stripeResponseHandler = function(status, response) {
     var $form = $('#payment-form');

     if (response.error) {
       // Show the errors on the form
       $form.find('.payment-errors').text(response.error.message);
       $form.find('button').prop('disabled', false);
     } else {
       // token contains id, last4, and card type
       var token = response.id;
       // Insert the token into the form so it gets submitted to the server
       $form.append($('<input type="hidden" name="stripeToken" />').val(token));
       // and re-submit
       $form.get(0).submit();
     }
   };

   jQuery(function($) {
     $('#payment-form').submit(function(e) {
       var $form = $(this);

       // Disable the submit button to prevent repeated clicks
       $form.find('button').prop('disabled', true);

       Stripe.card.createToken($form, stripeResponseHandler);

       // Prevent the form from submitting with the default action
       return false;
     });
   });
 </script>
</head>



  <body>
  <h1>Jovan's Playground</h1>
       <div id="billing"></div>
 <script src="build/billing.js"></script>
 


</body>
</html>
