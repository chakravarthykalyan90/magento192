<?php
class AI_Sales_Model_Observer
{
    public function updateOrder($observer)
	{
		$orderIds = $observer->getEvent()->getOrderIds();
		//echo "<pre>"; print_r($orderId); die;
		foreach($orderIds as $_orderId) {
			
			$order = Mage::getModel('sales/order')->load($_orderId);
			
			//echo "<pre>"; print_r($order->getData());die;
			if($order->getData()) {
				$order->setPlacedFrom('frontend');
				
				$order->save();
			}
			
			
		}
		
	}
}
?>
