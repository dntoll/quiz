## What does "PHP" stand for?
 + Previous name: Personal Home Page
 + PHP: Hypertext Preprocessor
 - Parly Hyperbola Pro
 - Poo, Heat, and Poo

## What are valid PHP types
	Only types directly supported by language applies
 + Booleans
 + Integers
 + Floating point numbers
 + Strings
 + Arrays
 + Objects
 + Resources
 - Double
 - URLs
 
## What is the difference between $A == $B and $A === $B?
	Mark all that applies
 + They are different operators.
 + They produce the same boolean output for $A = true and $B = true
 - == also checks type
 + === also checks type

## Validate code
	Enter code
 E http://localhost:8888/2013secret/quizphpevaluator/validator.php
	if (mymax(3, 1) != 3) {
		echo 'false';
		return;
	}
	if (mymax(-1, 1) != 1) {
		echo 'false';
		return;
	}
	if (mymax(1, 3) != 3) {
		echo 'false';
		return;
	}
	if (mymax(0, 0) != 0) {
		echo 'false';
		return;
	}
	echo 'true';

## Was that fun
 + Yes
 - No

## What is your name?
	Enter your full name eg. John Johnsson
 T /[a-z\sA-ZÅÄÖåäö]{2,50}/
