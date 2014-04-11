# PHP Experiment

## Code
	Enter code for a max function 
	It should be called mymax that returns the largest of two argument $a and $b
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
