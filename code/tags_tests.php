<?php

//tests does nothing

if (isset($codeOutput ) == false) {
	throw new \Exception("no output from program should output Hello World");
}

if ($codeOutput != "Hello World")
	throw new \Exception("output was [$codeOutput] from program should output [Hello World]");