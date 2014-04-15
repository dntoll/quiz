<?php
/**
 * mymax() returns the largest value of its three inputs
 * @return integer 
 */
function mymax($one, $two, $three) {
	if (!is_numeric($one) || !is_numeric($two) || !is_numeric($three))
		throw new \Exception("Input must be numeric");

	if ($one < 0 || $two < 0 || $three < 0)
		throw new \Exception("Input must be larger than 0");

	if ($one > $two && $two > $three)
	 	return $one;
	else if ($one > $two && $two > $three)
	 	return $two;
	else
	 	return $three;
}
