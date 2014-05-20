<?php

ob_start();
ob_implicit_flush(false); 


/*
Use the defined classes to show a list of products
Use the prices and names from this pricelist
Price List:
Product: Banana, Price: 10.5 sek, Category: Fruit, Tax: (0.15)
Product: Cucumber, Price: 15.5 sek, Category: Vegetables, Tax: (0.16)
Product: Frozen Pizza, Price: 49.0 sek, Category: Food, Tax: (0.30)
*/

$pl = new \model\ProductList();
$pl->add(new \model\Product("Banana", 10.5), new \model\Category("Fruit", 0.15));
$pl->add(new \model\Product("Cucumber", 15.5), new \model\Category("Vegetables", 0.16));
$pl->add(new \model\Product("Frozen Pizza", 49.0), new \model\Category("Food", 0.30));

$pv = new \view\ProductView($pl);

$pv->show();
$expectedOutput = ob_get_contents();
ob_clean();

/*$expectedOutput = "<h3>A List of products</h3>
<p>Number of products 3 </p>
<ul>
	<li>Product: <strong>Banana</strong> Price: 1.5 sek</li>
	<li>Product: <strong>Orange</strong> Price: 2.5 sek</li>
	<li>Product: <strong>Apple</strong> Price: 3.5 sek</li>
</ul>
<p>Total Price: 7.5sek</p>";*/

if (isset($codeOutput) == false) {
	throw new \Exception("no output from program should output $expectedOutput");
}

if (compareOutput($codeOutput,$expectedOutput) == false) {
	//var_dump($codeOutput);
	//var_dump($expectedOutput);
	throw new \Exception("output was [$codeOutput] from program should output [$expectedOutput]");
}