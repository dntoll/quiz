function tryArray(array $inputArray, $expectedOutput, $expectedException = false) {

	for($i = 0; $i < count($inputArray); $i++) {
		

		try {
			$actual = max($inputArray[0],$inputArray[1],$inputArray[2]);
			if ($expectedException == false) {
				assert($actual == $expectedOutput, "wrong output [$actual] for [$inputArray[0],$inputArray[1],$inputArray[2]]should be [$expectedOutput] ");
			} else {
				assert(false, "wrong output [$actual] for [$inputArray[0],$inputArray[1],$inputArray[2]]should be [Exception] ");
			}
		} catch (\Exception $e) { 
			
			if ($expectedException == false) {
				assert(false, "wrong output [Exception] for [$inputArray[0],$inputArray[1],$inputArray[2]]should be [$expectedOutput]");
			} else {
				//OK
			}
		}

		$first = array_shift($inputArray);
		$inputArray[] = $first;
	}
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
echo "done";
