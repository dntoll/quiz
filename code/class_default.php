<?php

require_once("HTMLPageView.php");

$view = new HTMLPageView("foo", "boody");

$view->echoHTML();

[FILEBREAK]<?php

class HTMLPageView {

	private $title;
	private $bodyHTML;

	public function __construct($title, $body) {
		$this->title = $title;
		$this->bodyHTML = $body;
	}

	public function echoHTML() {
		echo "
		<!DOCTYPE html>
		<html>
			<head>
			<meta charset='utf-8'>
			<title>$this->title</title>
			</head>
			<body>
				$this->bodyHTML
			</body>
		</html>";

	}
}