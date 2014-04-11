<?php
/**
 * max() returns the largest value of its three inputs
 * 
 * If input is less than zero an exception should be thrown.
 *
 * If input is not numeric an exception should be thrown.
 *
 * @throws Exception if any input is less than zero
 *
 * @param  integer $numberOne The first number
 * @param  integer $numberTwo The second number
 * @param  integer $numberThree The third number
 * 
 * @return integer 
 */
function max($numberOne, $numberTwo, $numberThree) {
	if (!is_numeric($numberOne) || !is_numeric($numberTwo) || !is_numeric($numberThree))
		throw new \Exception("Input must be numeric");

	if ($numberOne < 0 || $numberTwo < 0 || $numberThree < 0)
		throw new \Exception("Input must be larger than 0");

	if ($numberOne > $numberTwo && $numberTwo > $numberThree)
	 	return $numberOne;
	else if ($numberOne > $numberTwo && $numberTwo > $numberThree)
	 	return $numberTwo;
	else
	 	return $numberThree;
}
