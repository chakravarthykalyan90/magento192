<?php


require_once('app/Mage.php');
ini_set('display_errors', 1);
Mage::app();

$orderID = "100000200"; //order increment id
$orderDetails = Mage::getModel('sales/order')->loadByIncrementId($orderID);

if($orderDetails->canInvoice() and $orderDetails->getIncrementId())
{
    //$order = Mage::getModel('sales/order')->loadByIncrementId($order_id);
    $orderItems = $orderDetails->getAllItems();
    $invoiceItems = array();
    
    foreach ($orderItems as $_eachItem) {
    $opid = $_eachItem->getId();
    $opdtId = $_eachItem->getProductId();
    $itemss = Mage::getModel('catalog/product')->load($opdtId);
    $psku = $itemss->getSku(); // get product attribute which is used your condition
    if($psku=='hde006'){
        $qty = $_eachItem->getQtyOrdered();
    } else {
        $qty = 0;
    }

    $itemsarray[$opid] = $qty;
    }
    
    if($orderDetails->canInvoice()) { 
/*    echo $invoiceId = Mage::getModel('sales/order_invoice_api')
    ->create($orderDetails->getIncrementId(), $itemsarray ,'Partially create Invoice programatically' ,0,0);*/


     $invoice = Mage::getModel('sales/service_order', $orderDetails)->prepareInvoice($itemsarray);
  $invoice->setRequestedCaptureCase(Mage_Sales_Model_Order_Invoice::CAPTURE_ONLINE);
  $invoice->register()->pay(); 

  Mage::getModel('core/resource_transaction')
      ->addObject($invoice)
      ->addObject($invoice->getOrder())
      ->save();

      
    }
}
?>