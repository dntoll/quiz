<?php


function test() {

	$expectedOutput = 3;
	$correctInputs = array(0, 1, 3);
	$stringInput = array("one",2, $expectedOutput);
	$negativeInput = array(-1,2,$expectedOutput);
	$arrayInput = array(array(1,2,3),NULL,$expectedOutput);

	$actual = getTotal($correctInputs);
	if ($actual != 4+0) {
		throw new \Exception("Wrong output $actual ");
	}


}

test();

