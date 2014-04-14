<?php
function tryArray(array $inputArray, $expectedOutput, $expectedException = false) {
	$errors = 0;
	for($i = 0; $i < count($inputArray); $i++) {
		

		try {
			$actual = mymax($inputArray[0],$inputArray[1],$inputArray[2]);
			if ($expectedException == false) {
				if ($actual != $expectedOutput) {
					throw new \Exception ("wrong output [$actual] for [$inputArray[0],$inputArray[1],$inputArray[2]]should be [$expectedOutput]");
					$errors++;
				}
			} else {
				throw new \Exception ("wrong output [$actual] for [$inputArray[0],$inputArray[1],$inputArray[2]]should be [Exception]");
				$errors++;
			}
		} catch (\Exception $e) { 
			
			if ($expectedException == false) {
				throw new \Exception ("wrong output [Exception] for [$inputArray[0],$inputArray[1],$inputArray[2]]should be [$expectedOutput]");
				$errors++;
			} else {
				//OK
			}
		}

		$first = array_shift($inputArray);
		$inputArray[] = $first;
	}
	
	if ($errors > 0)
		die();
	return true;
}

function test() {

	$expectedOutput = 3;
	$correctInputs = array(0, 1, $expectedOutput);
	$stringInput = array("one",2, $expectedOutput);
	$negativeInput = array(-1,2,$expectedOutput);
	$arrayInput = array(array(1,2,3),NULL,$expectedOutput);

	tryArray($correctInputs, $expectedOutput, false);
	tryArray($negativeInput, 0, true);
	tryArray($stringInput, 0, true);
	tryArray($arrayInput, 0, true);
}

test();

