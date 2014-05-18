<?php
require_once("Product.php"); 
require_once("ProductList.php"); 
require_once("ProductView.php"); 

/*
Use the defined classes to show a list of products
Use the prices and names from this pricelist
Price List:
Banana 1.5 sek 
Orange 2.5 sek
Apple 3.5 sek 
*/

//Write your code here


[FILEBREAK]<?php

namespace model;


/**
* Class model\Product represents a product with price
*/
class Product {
	/**
	* @var String title, the product name
	*/
	private $title;

	/**
	* @var float price, the price in SEK
	*/
	private $priceSEK;

	/**
	* Constructs a Product object
	* 
	* @throws \Exception if input is wrong
	*
	* @param String $title, the product title, length must be > 0 characters
	* @param float $priceSEK, the price in SEK, must be larger than 0 SEK
	*/
	public function __construct($title, $priceSEK) {
		if (is_string($title) === FALSE || strlen($title) < 1)
			throw new \Exception("Product title must be of string type with length > 0");

		if (is_numeric($priceSEK) === FALSE || floatval($priceSEK) < 0)
			throw new \Excpetion("Product price must be numeric type and larger than 0 ");

		$this->title = $title;
		$this->priceSEK = $priceSEK;
	}

	/**
	* get product title
	*
	* @return String title, the product name
	*/
	public function getTitle() {
		return $this->title;
	}

	/**
	* get Price in SEK
	*
	* @return float price, the price in SEK
	*/
	public function getPrice() {
		return $this->priceSEK;
	}
}


[FILEBREAK]<?php

namespace model;


/**
* A List of Products 
*
*/
class ProductList implements \IteratorAggregate {

	/**
	 * @var array of \model\Product
	 */
	private $products;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->products = array();
	}

	/**
	 * Adds an product to the list
	 * 
	 * @param Product $toBeAdded
	 */
	public function add(Product $toBeAdded) {
		$this->products[] = $toBeAdded;
	}

	/**
	 * Returns the number of products
	 * 
	 * @return integer, the number of products added to the list
	 */
	public function getCount() {
		return count($this->products);
	}

	/**
	 * returns an ArrayIterator object so that the ProductList can be used in an foreach loop
	 * as an array
	 * 
	 * @return \ArrayIterator
	 */
	public function getIterator() {
        return new \ArrayIterator($this->products);
    }

    /**
     * returns the total price of all products added to the list
     * 
     * @return float, the total price
     */
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


/**
 * The ProductView creates HTML output from an \model\ProductList 
 */
class ProductView {

	/**
	 * The product list object to create HTML from
	 * @var \model\ProductList
	 */
	private $productList;

	/**
	 * Constructor creates an ProductView object
	 * 
	 * @param \model\ProductList $products
	 */
	public function __construct(\model\ProductList $products) {
		$this->productList = $products;
	}

	/**
	 * Outputs HTML-representation of all products in the $productList
	 *
	 * Note that this echoes the output to the output buffer
	 * 
	 * @return void
	 */
	public function show() {
		$count = $this->productList->getCount();
		$totalPrice = $this->productList->getTotalPrice();

		echo "<h3>A List of products</h3>\n";
		echo "<p>Number of products: $count </p>\n";

		echo "<ul>\n";
		foreach ($this->productList as $product) {
			$this->showProduct($product);
		}
		echo "</ul>\n";

		echo "<p>Total Price: $totalPrice sek</p>";
	}

	/**
	 * Internal show products method
	 * 
	 * Note that this echoes the output to the output buffer
	 * 
	 * @param  \model\Product $toShow
	 * @return void
	 */
	private function showProduct(\model\Product $toShow) {

		$title = $toShow->getTitle();
		$price = $toShow->getPrice();
		echo "\t<li>Product: <strong>$title</strong> Price: $price sek</li>\n";
	}
}
