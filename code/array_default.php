<?php
/**
 * getTotal() 
 * 
 * If input is less than zero an exception should be thrown.
 *
 * If input is not numeric an exception should be thrown.
 *
 * @throws Exception if any input is less than zero or not numeric
 *
 * @param  array of integer inputs, must be larger than zero
 * 
 * @return integer total
 */
function getTotal(array $inputs) {
	$ret = 0;
	foreach ($inputs as $value) {
		if (!is_numeric($value)) {
			throw new \Exception("Input must be numeric");	
		}
		if ($value < 0) {
			throw new \Exception("Input must be larger than 0");
		}
		$ret = $value;
	}
	return $ret;
}
