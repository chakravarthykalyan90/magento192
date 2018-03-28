<?php
class Sigma_GWP_Model_Observer
{

			public function AddFreeGift(Varien_Event_Observer $observer)
			{

				
				$quote = $observer->getEvent()->getQuoteItem()->getQuote();
				$item = $observer->getEvent()->getQuoteItem();
				//$quote = Mage::getModel('sales/quote')->load($item->getQuoteId());

				
				if ($item->getParentItem()) {
				   $item = $item->getParentItem();
				}
				//$walletAmount = Mage::app()->getRequest()->getPost('card_wallet_amount');

				//not sure why calling $item->getOriginalPrice() not getting product's price
				//getting price from catalog model
				//$productPrice = Mage::getModel('catalog/product')->load($item->getProductId())->getFinalPrice();
				$product = Mage::getModel('catalog/product')->load(549);
				$finalPrice = 0;
				$quoteItem = $quote->addProduct($product, 1);

				$quoteItem->setCustomPrice($finalPrice);
				$quoteItem->setOriginalCustomPrice($finalPrice);
				$quoteItem->getProduct()->setIsSuperMode(true);
				$quote->collectTotals()->save();

			}
		
}
