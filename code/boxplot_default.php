<?php

require_once("DataSet.php");
require_once("BoxPlot.php");
require_once("SVGStrategy.php");
require_once("CanvasStrategy.php");
require_once("RandomDataGenerator.php");



//Task: Randomly create two separate Data-sets of data with seed 7 and 8
//and render two BoxPlot images 256 * 256 pixels wide
//
// 1. The first image should create a HTML 5 Canvas image for seed 7
// 2. The second image should create a SVG image for seed 8
//
// Use the defined classes to solve the task, note not all classes are needed.
$imageWidth = 256;
$imageHeight = 256;
$svgRandomSeed = 8;
$canvasRandomSeed = 7;


[FILEBREAK]<?php

namespace view;


require_once("PlotCamera.php");

class BoxPlot {

	private $margin = 5;
	private $leftSpace = 25;
	private $bottomSpace = 25;
	private $renderer;

	public function __construct(RenderStrategy $renderer) {
		$this->renderer = $renderer;
	}

	public function draw(\model\DataSet $data) {
		$width = $this->renderer->getWidth();
		$height = $this->renderer->getHeight();
		$lowestValue = $data->getLowestValue();
		$highestValue = $data->getHighestValue();
		$range = $highestValue - $lowestValue;
		$cam = new PlotCamera($lowestValue, $range, $height - $this->bottomSpace, $this->margin);

		
		$this->renderer->drawFrame($this->getBoxLeftSidePos(), $this->margin, $this->getBoxWidth(), $this->getBoxHeight());
		
		$widthPerBox = $this->getBoxWidth() / $data->getNumColumns() ;

		for ($col = 0; $col < $data->getNumColumns(); $col++) {
			$dataColumn = $data->getColumn($col);

			$boxPlotLeftPos = $this->getBoxLeftSidePos() + $widthPerBox * $col;

			$this->drawBoxPlot($dataColumn, $boxPlotLeftPos, $widthPerBox, $cam);
		}

		$this->renderRanges($data, $lowestValue, $range, $this->leftSpace, $height, $cam);
	}

	private function getBoxLeftSidePos() {
		return $this->leftSpace + $this->margin;
	}

	private function getBoxWidth() {
		$width = $this->renderer->getWidth();
		return $width - $this->margin * 2 - $this->leftSpace;
	}

	private function getBoxHeight() {
		$height = $this->renderer->getHeight();
		return $height-$this->margin * 2 - $this->bottomSpace;
	}

	private function renderRanges(\model\DataSet $data, $lowestValue, $range, $leftSpace, $height, PlotCamera $cam) {

		$spaceBetweenIndications = 100;

		$numIndications = $height / $spaceBetweenIndications;

		//draw vertical lines starting with lowest Value
		$i = 0;
		while (true) {
			$value = intval($lowestValue) + $i * intval($range / $numIndications); 
			if ($value > $lowestValue + $range)
				break;

			$ypos = $cam->toImagePos($value);
			$this->renderer->drawLine($leftSpace, $ypos, $leftSpace + 10, $ypos);
			$this->renderer->drawText(0, $ypos+5, $value);
			$i++;
		}
	}


	/**
	 *  -higher-
	 *     -
	 *     -
	 *   --q3--
	 *   |    |
	 *   |-M--|
	 *   |    |
	 *   --q1--
	 *     -
	 *     -
	 *  -lower-
	 * 
	 *  Title
	 */
	private function drawBoxPlot(\model\DataColumn $col, $xpos, $width, PlotCamera $cam) {

		$higher = 	$cam->toImagePos($col->getHighestDatumWithin());
		$q3 = 		$cam->toImagePos($col->getQ3());
		$median = 	$cam->toImagePos($col->getMedian());
		$q1 = 		$cam->toImagePos($col->getQ1());
		$lower = 	$cam->toImagePos($col->getLowestDatumWithin());
		
		$padding = 10;
		$linePadding = $padding * 2;

		//https://en.wikipedia.org/wiki/File:Boxplot_vs_PDF.svg
		$interQuartileRange = $q1 - $q3;

		//Draw center frame from q3 down to lower
		$this->renderer->drawFrame($xpos+$padding, $q3, $width-$padding*2, $interQuartileRange);

		//horizontal lines not as wide as box
		$this->renderer->drawLine($xpos+$linePadding, $lower, $xpos + $width-$linePadding, $lower);
		$this->renderer->drawLine($xpos+$linePadding, $higher, $xpos + $width-$linePadding, $higher);

		//draw Median Line, double line centered on median
		$this->renderer->drawLine($xpos+$padding, $median-0.5, $xpos + $width-$padding, $median-0.5);
		$this->renderer->drawLine($xpos+$padding, $median+0.5, $xpos + $width-$padding, $median+0.5); //make it wider

		//verticala lines
		$this->renderer->drawDottedLine($xpos + $width /2, $lower, $xpos + $width /2, $q1);
		$this->renderer->drawDottedLine($xpos + $width /2, $q3, $xpos + $width /2, $higher);

		//Outlier values
		foreach ($col->getValues() as $value) {
			if ($value < $col->getLowestDatumWithin() || 
				$value > $col->getHighestDatumWithin()) {
				$ypos = 		$cam->toImagePos($value);
				$this->renderer->drawCircle($xpos + $width /2, $ypos, 3);
			}
		}

		//Draw the title at the bottom
		$this->renderer->drawText($xpos+ $width /2 - 10, $cam->getColumnPos(), $col->getTitle());

	}


}[FILEBREAK]<?php

namespace view;

interface RenderStrategy {
	function getWidth();
	function getHeight();

	function drawLine($x1, $y1, $x2, $y2);
	function drawDottedLine($x1, $y1, $x2, $y2);
	function drawFrame($x, $y, $width, $height);
	function drawText($x, $y, $string);
	function drawCircle($cx, $cy, $r);

}[FILEBREAK]<?php

namespace model;


class DataColumn {
	private $sortedValues = array();

	private $titleString;

	public function __construct($titleString) {
		$this->titleString = $titleString;
	}
	

	public function add($numberToAdd) {

		if (is_numeric($numberToAdd) == false) {
			throw new \Exception("Cannot add non-numbers");
		}
		
		$this->sortedValues[] = $numberToAdd;
		sort($this->sortedValues);
	}

	public function getQ1() {
		return $this->getPercentile(0.25);
	}

	public function getMedian() {
		return $this->getPercentile(0.5);
	}

	public function getQ3() {
		return $this->getPercentile(0.75);
	}


	/**
	 * "the lowest datum still within 1.5 IQR of the lower quartile, 
	 * and the highest datum still within 1.5 IQR of the upper quartile 
	 * (often called the Tukey boxplot)[2][3] (as in Figure 3)
	 * one standard deviation above and below the mean of the data" 
	 * - https://en.wikipedia.org/wiki/Box_plot
	 * @return Number 
	 */
	public function getLowestDatumWithin() {
		$iqr = $this->getQ3() - $this->getQ1();
		$lowerLimit = $this->getQ1() - $iqr * 1.5;

		foreach ($this->getValues() as $value) {
			if ($value >= $lowerLimit && $value < $this->getQ1()) {
				return $value;
			}
		}
		return $this->getQ1();
	}

	public function getHighestDatumWithin() {
		$iqr = $this->getQ3() - $this->getQ1();
		$higherLimit = $this->getQ3() + $iqr * 1.5;

		$ret = $this->getQ3();
		foreach ($this->getValues() as $value) {
			if ($value <= $higherLimit && $value > $this->getQ3()) {
				$ret = $value;
			}
		}
		return $ret;
	}

	public function getPercentile($fraction) {
		
		$numValues = count($this->sortedValues);
		return $this->sortedValues[intval($numValues * $fraction)];
	}

	public function getValues() {
		return $this->sortedValues;
	}

	public function getLowestValue() {
		return $this->sortedValues[0];
	}

	public function getHighestValue() {
		return $this->sortedValues[count($this->sortedValues)-1];	
	}

	public function getTitle() {
		return $this->titleString;
	}
}[FILEBREAK]<?php

namespace model;

require_once("DataColumn.php");

class DataSet {
	private $columns = array();

	public function addColumn(DataColumn $column) {
		$this->columns[] = $column;
	}

	public function getNumColumns() {
		return count($this->columns);
	}

	public function getColumn($index) {
		return $this->columns[$index];
	}

	public function getLowestValue() {
		$lowest = 1.8e308; //highest float
		foreach ($this->columns as $column) {
			if ($column->getLowestValue() < $lowest) {
				$lowest = $column->getLowestValue();
			}
		}	

		return $lowest;
	}

	public function getHighestValue() {

		$highest = -1.8e308; //highest float
		foreach ($this->columns as $column) {
			if ($column->getHighestValue() > $highest) {
				$highest = $column->getHighestValue();
			}
		}	

		return $highest;
	}


}[FILEBREAK]<?php


namespace view;

require_once("RenderStrategy.php");


/**
 * Creates an SVG image
 * 
 * @author Daniel Toll
 * @package view
 */
class SVGStrategy implements RenderStrategy {
	private $width;
	private $height;
	private $content; 

	/**
	 * Creates an SVG Strategy object
	 *
	 * Note! that it must be initialized before used
	 */
	public function __construct() {
		$this->content = "";
	}

	/**
	 * Initialize an image to the correct width and height
	 *
	 * @throws Exception if width or height is less than zero
	 * 
	 * @param  Integer $width  Image width > 0
	 * @param  Integer $height Image height > 0
	 * @return void
	 */
	public function initialize($width, $height) {
		if ($width <= 0 || $height <= 0)
			throw new \Exception("Image width and height must be larger than 0");

		$this->width = $width;
		$this->height = $height;
		$this->content = "
				<svg xmlns='http://www.w3.org/2000/svg' version='1.1'
		      width='$this->width' height='$this->height'>";
	}

	/**
	 * gets the width of the image
	 * 
	 * @return Integer 
	 */
	public function getWidth() {
		return $this->width;
	}

	/**
	 * gets the height of the image 
	 * 
	 * @return Integer 
	 */
	public function getHeight() {
		return $this->height;
	}

	/**
	 * Draws a black rectangle, filled with white to the image
	 * 
	 * @param  Integer $posXPixels left position in pixels of the rectangle 
	 * @param  Integer $posYPixels top position in pixels of the rectangle
	 * @param  Integer $width      the width in pixels of the rectangle
	 * @param  Integer $height     the height in pixels of the rectangle
	 * @return void
	 */
	public function drawFrame($posXPixels, $posYPixels, $width, $height) {
		$this->content .= "
			<rect x='$posXPixels' y='$posYPixels' width='$width' height='$height' fill='white' stroke='black' stroke-width='1' />";
	}

	/**
	 * Draws a black line to the image
	 * 
	 * @param  Integer $x1 line start X position
	 * @param  Integer $y1 line start Y position
	 * @param  Integer $x2 line stop X position
	 * @param  Integer $y2 line stop Y position
	 * @return void
	 */
	public function drawLine($x1, $y1, $x2, $y2) {
		$this->content .= "
			<line x1=\"$x1\" y1=\"$y1\" x2=\"$x2\" y2=\"$y2\" stroke=\"black\" />";
	}

	/**
	 * Draws a dotted black line to the image
	 * 
	 * @param  Integer $x1 line start X position
	 * @param  Integer $y1 line start Y position
	 * @param  Integer $x2 line stop X position
	 * @param  Integer $y2 line stop Y position
	 * @return void
	 */
	public function drawDottedLine($x1, $y1, $x2, $y2) {
		$this->content .= "
			<line x1=\"$x1\" y1=\"$y1\" x2=\"$x2\" y2=\"$y2\" stroke=\"black\" stroke-dasharray=\"2 4\" />";
	}

	/**
	 * Draws a black circle with white fill to the image
	 * 
	 * @param  Integer $cx Center X position of the circle
	 * @param  Integer $cy Center y position of the circle
	 * @param  Integer $r  Radius in pixels of the circle
	 * @return void
	 */
	public function drawCircle($cx, $cy, $r) {
		$this->content .= "
			<circle cx=\"$cx\" cy=\"$cy\" r=\"$r\" style=\"stroke:black; stroke-width:1;fill:white\"/>";
	}

	/**
	 * Draws an black text, font , sans-serif to the image
	 * 
	 * @param  Integer $x Left X position of the text
	 * @param  Integer $y Top  Y position of the text
	 * @param  String $string  The text string written to the image
	 * @return void
	 */
	public function drawText($x, $y, $string) {
		 $this->content .=  "
		 	<text x=\"$x\" y=\"$y\" font-size = \"10\" font-family = \"sans-serif\">$string</text>";
	}

	/**
	 * Echoes the content of the image to the output buffer
	 * 
	 * @return void
	 */
	public function toOutputBuffer() {
		echo "
		
		  $this->content
		</svg>
		";
	}

}[FILEBREAK]<?php

require_once("DataSet.php");

class RandomDataGenerator {

	private $randomSeed;

	public function __construct($randomSeed) {
		$this->randomSeed = $randomSeed;
	}

	public function generateRandomData() {
		srand($this->randomSeed);

		$data = new \model\DataSet();

		//Create four columns of data
		for ($c = 0; $c < 4; $c++) { 
			$column = new \model\DataColumn("C: $c");

			//Roll five die's 10 times and sum the values
			for ($t = 0; $t < 10; $t++) {

				$sumOfFiveDies = 0;

				//roll five die's each time
				for ($d = 0; $d < 5; $d++) {
					//roll a single die
					$die = rand() % 6 + 1;

					//sum up the values
					$sumOfFiveDies += $die;
				}

				$column->add($sumOfFiveDies);
			}

			$data->addColumn($column);
		}

		return $data;
	}
}[FILEBREAK]<?php

namespace view;

/**
 * The Plot Camera is used to convert values into correct Y pixel positions
 */
class PlotCamera {
	private $lowestValue;
	private $range;
	private $drawWindowHeight;
	private $margin;

	public function __construct($lowestValue, $range, $drawWindowHeight, $margin) {

		if ($range <= 0) {
			throw new \Exception("Cannot create a camera of range 0", 1);
		}
		

		$this->lowestValue = $lowestValue;
		$this->range = $range;
		$this->drawWindowHeight = $drawWindowHeight;
		$this->margin = $margin;
	}

	public function toImagePos($modelPos) {
		//normalize value down to [0,1]
		$normalize = ($modelPos - $this->lowestValue) / $this->range;

		//flip value to [1,0] 
		$flippedNormalize = (1.0 - $normalize);

		$outSideMargin = $this->margin;
		$insideMargin = $this->margin * 5;

		$drawableArea = $this->drawWindowHeight - $outSideMargin * 2 - $insideMargin * 2;
		
		return $flippedNormalize * $drawableArea + $insideMargin + $outSideMargin ;
	}

	public function getColumnPos() {
		return $this->drawWindowHeight+ 10;
	}
}[FILEBREAK]<?php

namespace view;

class CanvasStrategy implements RenderStrategy {
	private $width;
	private $height;
	private $javascript; 

	public function __construct() {
		$this->javascript = "";
	}

	public function setup($width, $height) {
		if ($width <= 0 || $height <= 0)
			throw new \Exception("Image width and height must be larger than 0");

		$this->width = $width;
		$this->height = $height;
	}

	public function getWidth() {
		return $this->width;
	}

	public function getHeight() {
		return $this->height;
	}

	public function drawFrame($posXPixels, $posYPixels, $width, $height) {
		$this->javascript .= "
							ctx.strokeRect($posXPixels, $posYPixels, $width, $height);";
	}

	public function drawLine($x1, $y1, $x2, $y2) {
		$this->javascript .= "
							  ctx.beginPath();
							  ctx.moveTo( $x1, $y1 ); 
							  ctx.lineTo( $x2, $y2 );
							  ctx.stroke();
							  ";
	}

	public function drawDottedLine($x1, $y1, $x2, $y2) {
		$this->javascript .= "
							  var linedash = ctx.getLineDash();
							  ctx.setLineDash([2,4]);
							  ctx.beginPath();
							  ctx.moveTo( $x1, $y1 ); 
							  ctx.lineTo( $x2, $y2 );
							  ctx.stroke();
							  ctx.setLineDash(linedash);
							  ";
	}

	public function drawCircle($cx, $cy, $r) {
		$this->javascript .= "
							  ctx.beginPath();
							  ctx.arc( $cx, $cy, $r, 2 * Math.PI,false);
							  ctx.stroke();
							  ";
	}

	public function drawText($x, $y, $string) {
		 $this->javascript .=  "
							  ctx.fillText('$string', $x, $y);
							  ";
	}

	public function writeToOB() {
		echo "
		<canvas id=\"drawer\" width='$this->width' height='$this->height'></canvas>
		<script type=\"application/x-javascript\">
			var canvas = document.getElementById('drawer');
			if (canvas.getContext) {
				var ctx = canvas.getContext('2d');
				ctx.strokeStyle = \"black\";
				ctx.lineWidth = 1;

				$this->javascript
			}
		
		</script>
		";
	}

}