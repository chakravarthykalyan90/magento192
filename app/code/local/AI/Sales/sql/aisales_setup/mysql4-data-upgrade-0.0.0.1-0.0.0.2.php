<?php
$installer = $this;

$installer->startSetup();

$installer->run("
	ALTER TABLE `sales_flat_order` ADD `placed_from` VARCHAR(255) NULL DEFAULT NULL;
");

$installer->endSetup();


