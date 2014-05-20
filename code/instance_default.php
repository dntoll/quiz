<?php
require_once("Product.php"); 
require_once("ProductList.php"); 
require_once("ProductView.php"); 

/*
Use the defined classes to show a list of products
Use the prices and names from this pricelist
Price List:
Product: Banana, Price: 10.5 sek, Category: Fruit, Tax: (0.15)
Product: Cucumber, Price: 15.5 sek, Category: Vegetables, Tax: (0.16)
Product: Frozen Pizza, Price: 49.0 sek, Category: Food, Tax: (0.30)
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


class Category {
	private $title;

	private $taxPercent;

	public function __construct($title, $taxPercent) {
		if (is_string($title) === FALSE || strlen($title) < 1)
			throw new \Exception("Category title must be of string type with length > 0");

		if (is_numeric($taxPercent) === FALSE || floatval($taxPercent) < 0)
			throw new \Excpetion("Category taxPercent must be numeric type and larger than 0 ");

		$this->title = $title;
		$this->taxPercent = $taxPercent;
	}

	public function getTitle() {
		return $this->title;
	}

	public function getTaxPercent() {
		return $this->taxPercent;
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
	 * @var array of array (\model\Product, \model\Category)
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
	public function add(Product $toBeAdded, Category $category) {
		$this->products[] = array($toBeAdded, $category);
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
		foreach ($this->products as $productWithCategory) {
			$product = $productWithCategory[0];
			$category = $productWithCategory[1];

			$total += $product->getPrice() + $category->getTaxPercent() * $product->getPrice();
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
		foreach ($this->productList as $productWithCategory) {
			$product = $productWithCategory[0];
			$category = $productWithCategory[1];

			$this->showProduct($product, $category);
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
	private function showProduct(\model\Product $toShow, \model\Category $productCategory) {

		$title = $toShow->getTitle();
		$price = $toShow->getPrice();
		$category = $productCategory->getTitle();
		$tax = $productCategory->getTaxPercent() * $toShow->getPrice();

		echo "\t<li>$category: <strong>$title</strong> Price: $price sek Tax $tax</li>\n";
	}
}
