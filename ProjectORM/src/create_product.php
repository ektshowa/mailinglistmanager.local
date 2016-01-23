<?php
require_once "/var/www/html/mailinglistmanager.local/mailinglist/ProjectORM/bootstrap.php";

$newProductName = $argv[1];

$product = new Product();
$product->setName($newProductName);

$entityManager->persist($product);
$entityManager->flush();

echo "Created Product with ID " . $product->getId() . "\n";
