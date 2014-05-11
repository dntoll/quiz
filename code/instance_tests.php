<?php

/*
$pl = new \model\ProductList();
$pl->add(new \model\Product("Banana", 1.5));
$pl->add(new \model\Product("Orange", 2.5));
$pl->add(new \model\Product("Apple", 3.5));

$pv = new \view\ProductView($pl);

$pv->show();*/

$expectedOutput = "<h3>A List of products</h3>\n<p>Number of products 3 </p>\n<ul>\n\t<li>Banana 1.5 sek </li>\n\t<li>Orange 2.5 sek </li>\n\t<li>Apple 3.5 sek </li>\n</ul>\n<p>Total Price: 7.5sek</p>";

if (isset($codeOutput) == false) {
	throw new \Exception("no output from program should output $expectedOutput");
}

if ($codeOutput != $expectedOutput) {
	//var_dump($codeOutput);
	//var_dump($expectedOutput);
	throw new \Exception("output was [$codeOutput] from program should output [$expectedOutput]");
}