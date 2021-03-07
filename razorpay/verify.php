<?php

    require('config.php');

    session_start();

    require('razorpay-php/Razorpay.php');

    use Razorpay\Api\Api;
    use Razorpay\Api\Errors\SignatureVerificationError;

    $success = true;

    $error = "Payment Failed";

    if (empty($_POST['razorpay_payment_id']) === false) {
        $api = new Api($keyId, $keySecret);

        try {
            // Please note that the razorpay order ID must
            // come from a trusted source (session here, but
            // could be database or something else)
            $attributes = array(
                'razorpay_order_id' => $_SESSION['razorpay_order_id'],
                'razorpay_payment_id' => runUserInputSanitizationHook($_POST['razorpay_payment_id']),
                'razorpay_signature' => runUserInputSanitizationHook($_POST['razorpay_signature'])
            );

            $api->utility->verifyPaymentSignature($attributes);
        } catch (SignatureVerificationError $e) {
            $success = false;
            $error = 'Razorpay Error : ' . $e->getMessage();
        }
    }

    if ($success === true) {
        $_SESSION['paymentstatus'] = "Successful";
        $_SESSION['razorpay_payment_id'] = runUserInputSanitizationHook($_POST['razorpay_payment_id']);
        /*$html = "<p>Your payment was successful</p>
                 <p>Payment ID: {runUserInputSanitizationHook($_POST['razorpay_payment_id'])}</p>";*/
    } else {
        $_SESSION['paymentstatus'] = "Failure";
        /*$html = "<p>Your payment failed</p>
                 <p>{$error}</p>";*/
    }
    echo '<script>window.location.href="../thankyou.php";</script>';
    /*echo $html;*/
?>
