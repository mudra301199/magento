<?php

$installer = $this;

$installer->startSetup();

$installer->run("

DROP TABLE IF EXISTS `vendor`;
CREATE TABLE `vendor` (
  `vendor_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `vendor`
  ADD PRIMARY KEY (`vendor_id`);

ALTER TABLE `vendor`
  MODIFY `vendor_id` int(11) NOT NULL AUTO_INCREMENT;

");


$installer->endSetup();
