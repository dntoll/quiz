<?php
require_once("1.php"); //Product
require_once("2.php"); //ProductList
require_once("3.php"); //ProductView

/*
Use the defined classes to show a list of products
Use the prices and names from this pricelist
Price List:
Banana 1.5 sek 
Orange 2.5 sek
Apple 3.5 sek 

*/

//Write your code here

$pl = new \model\ProductList();
$pl->add(new \model\Product("Banana", 1.5));
$pl->add(new \model\Product("Orange", 2.5));
$pl->add(new \model\Product("Apple", 3.5));

$pv = new \view\ProductView($pl);

$pv->show();

[FILEBREAK]<?php

namespace model;

class Product {
	private $title;
	private $price;

	public function __construct($title, $price) {
		if (is_string($title) === FALSE || strlen($title) < 1)
			throw new \Exception("Product title must be of string type with length > 0");

		if (is_numeric($price) === FALSE || floatval($price) < 0)
			throw new \Excpetion("Product price must be numeric type and larger than 0 ");

		$this->title = $title;
		$this->price = $price;
	}

	public function getTitle() {
		return $this->title;
	}

	public function getPrice() {
		return $this->price;
	}
}


[FILEBREAK]<?php

namespace model;

class ProductList implements \IteratorAggregate {

	private $products;

	public function __construct() {
		$this->products = array();
	}

	public function add(Product $toBeAdded) {
		$this->products[] = $toBeAdded;
	}

	public function getCount() {
		return count($this->products);
	}

	public function getIterator() {
        return new \ArrayIterator($this->products);
    }

    public function getTotalPrice() {
    	$total = 0;
		foreach ($this->products as $product) {
			$total += $product->getPrice();
		}
		return $total;
    }
}

[FILEBREAK]<?php

namespace view;

class ProductView {

	private $productList;

	public function __construct(\model\ProductList $products) {
		$this->productList = $products;
	}

	public function show() {
		echo "<h3>A List of products</h3>\n";
		echo "<p>Number of products " . $this->productList->getCount() . " </p>\n";

		echo "<ul>\n";
		foreach ($this->productList as $product) {
			$this->showProduct($product);
		}
		echo "</ul>\n";

		echo "<p>Total Price: " . $this->productList->getTotalPrice() .  "sek</p>";
	}

	private function showProduct(\model\Product $toShow) {
		echo "\t<li>" . $toShow->getTitle() . " " . $toShow->getPrice() ." sek </li>\n";
	}
}
