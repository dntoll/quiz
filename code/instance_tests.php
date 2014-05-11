<?php

/*
$pl = new \model\ProductList();
$pl->add(new \model\Product("Banana", 1.5));
$pl->add(new \model\Product("Orange", 2.5));
$pl->add(new \model\Product("Apple", 3.5));

$pv = new \view\ProductView($pl);

$pv->show();*/

$expectedOutput = "<h3>A List of products</h3>
<p>Number of products 3 </p>
<ul>
	<li>Product: <strong>Banana</strong> Price: 1.5 sek</li>
	<li>Product: <strong>Orange</strong> Price: 2.5 sek</li>
	<li>Product: <strong>Apple</strong> Price: 3.5 sek</li>
</ul>
<p>Total Price: 7.5sek</p>";

if (isset($codeOutput) == false) {
	throw new \Exception("no output from program should output $expectedOutput");
}

if ($codeOutput != $expectedOutput) {
	//var_dump($codeOutput);
	//var_dump($expectedOutput);
	throw new \Exception("output was [$codeOutput] from program should output [$expectedOutput]");
}