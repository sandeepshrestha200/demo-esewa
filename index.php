<?php

function generateRandomtid()
{
    $tid = sprintf('%03d-%03d-%03d', rand(0, 999), rand(0, 999), rand(0, 999));
    return $tid;
}

$amt = 100;
$tax = 10;
$trans_uuid = generateRandomtid();
$product_code = "EPAYTEST";
$product_service_charge = 10;
$product_delivery_charge = 10;
$total_amt = $amt + $tax + $product_service_charge + $product_delivery_charge;
$parameter = "total_amount,transaction_uuid,product_code";
$signed_field_names = "total_amount=$total_amt,transaction_uuid=$trans_uuid,product_code=$product_code";
echo $signed_field_names;
echo "<br>";
$secret_key = "8gBm/:&EnhH.1/q";
$s = hash_hmac("sha256", $signed_field_names, $secret_key, true);
// echo $s;
echo base64_encode($s);
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>


    <form action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" method="POST" class="my-10 mx-20 w-full">
        <input type="text" id="amount" name="amount" value="<?= $amt ?>" required><br><br>
        <input type="text" id="tax_amount" name="tax_amount" value="<?= $tax ?>" required><br><br>
        <input type="text" id="total_amount" name="total_amount" value="<?= $total_amt ?>" required><br><br>
        <input type="text" id="transaction_uuid" name="transaction_uuid" value="<?= $trans_uuid ?>" required><br><br>
        <input type="text" id="product_code" name="product_code" value="<?= $product_code ?>" required><br><br>
        <input type="text" id="product_service_charge" name="product_service_charge" value="<?= $product_service_charge ?>" required><br><br>
        <input type="text" id="product_delivery_charge" name="product_delivery_charge" value="<?= $product_delivery_charge ?>" required><br><br>
        <input type="text" id="success_url" name="success_url" value="https://esewa.com.np" required><br><br>
        <input type="text" id="failure_url" name="failure_url" value="https://google.com" required><br><br>
        <input type="text" id="signed_field_names" name="signed_field_names" value="total_amount,transaction_uuid,product_code" required><br><br>
        <input type="text" id="signature" name="signature" value="<?= base64_encode($s) ?>" required><br><br>
        <input value=" Submit" type="submit" class="bg-green-600 text-white py-2 px-4 rounded">
    </form>


</body>

</html>