<?php 
include('simple_html_dom\simple_html_dom.php');

// get file name
if (count($argv) < 2) {
	die("Name of csv file not found.");
}
$filename = $argv[1];
$file = fopen($filename, 'rt') or die("Entered file not found.");

for($i=0; $data = fgetcsv($file, 1000, ";"); $i++){
	// skip first line because it is header
	if ($i == 0) {
		continue;
	}
	
	// don't take into account row if it's columns amount != 3
	$columnCount = count($data);
	echo "line $i: \n\r";
	if ($columnCount != 3) {
		echo "incorrect row $i, columns amount does not equal to 3\r\n";
		for ($c=0; $c < $columnCount; $c++) {
			echo $data[$c]."; ";
			if ($c == $columnCount-1){
				echo "\r\n";
			}
		}
	}
	else {
		// values from the csv row
		$url = $data[0];
		$checkingTitle = $data[1];
		$checkingDescr = $data[2];
		
		echo "Checking url: $url ...\r\n";

		// set cookie to request
		$opts = array('http'=>array('header'=>"Cookie: test=seo"));
		$context = stream_context_create($opts);

		// get html by url
		$html = new simple_html_dom();
		$html = file_get_html($url, false, $context);
		$dom = new DOMDocument();
		@$dom->loadHtml($html);
		$xpath = new DOMXPath($dom);

		// get seo attributes from html
		$title = $xpath->evaluate('string(/html/head/title[normalize-space() != ""][1])');
		$description = $xpath->evaluate('string(/html/head/meta[@name="description"]/@content)');

		// checks
		if ($title != $checkingTitle)
			echo "Title is incorrect. Expected: '".$checkingTitle."'. Actual: '$title'.\n\r";
		else echo "Title is correct.\n\r";
		if ($description != $checkingDescr)
			  echo "Decription is incorrect. Expected: '".$checkingDescr."' Actual: '$description'.\n\r";
		else echo "Description is correct.\n\r"; 	
  }
  echo "\n\r";
}
fclose($file);

?>