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

$datag = new RandomDataGenerator(7);
$canvas = new \view\CanvasStrategy();
$canvas->setup($imageWidth, $imageHeight);
$boxPlot = new \view\BoxPlot($canvas);
$boxPlot->draw($datag->generateRandomData(7) );
$canvas->writeToOB();


$datag = new RandomDataGenerator(8);
$svg = new \view\SVGStrategy();
$svg->initialize($imageWidth, $imageHeight);
$boxPlot = new \view\BoxPlot($svg);
$boxPlot->draw( $datag->generateRandomData(8) );
$svg->toOutputBuffer();
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