<?php


ob_start();
ob_implicit_flush(false); 
$view = new \view\HTMLPageView($title, $body);
$view->echoHTML();
$expectedOutput = ob_get_contents();
ob_clean();

if (strcmp($expectedOutput, $codeOutput) != 0) {
	throw new \Exception("output was [$codeOutput] from program should output [$expectedOutput]");
}