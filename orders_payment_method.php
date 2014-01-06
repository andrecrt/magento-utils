<?php
/**
 * Magento Order's Payment Method 
 *
 * This web-service returns a JSON with all the order's ID and Payment Method.
 *
 * Tested with Magento versions: 1.6.2
 *
 * @author      André Tavares <@andreftavares>
 */

// Imports.
require_once("app/Mage.php");
$app = Mage::app('');

// Response collection.
$response = array();

// Fetch all orders.
$salesModel=Mage::getModel("sales/order");
$salesCollection = $salesModel->getCollection();

// Add each order's ID and Payment Method information to the response array.
foreach($salesCollection as $order)
{
    $orderId= $order->getIncrementId();
    $response[] = array(
        'id' => $orderId,
        'payment_method' => $order->getPayment()->getMethodInstance()->getTitle()
    );
}

// Set headers.
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

// Encode and return JSON response.
echo json_encode($response);
?>