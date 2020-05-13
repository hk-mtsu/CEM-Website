<?php

require('../fpdf/html2pdf.php');


class WebcastCertificate 
{
	public $variables = array();
	public $cert = '';
	public function __construct($title,$webcast,$fname,$lname,$date_time,$viewing_duration,$cert_template='certificate_template.html')
	{
		$this->variables['title']=$title;
		$this->variables['webcast']=$webcast;
		$this->variables['fname'] = $fname;
		$this->variables['lname'] = $lname;
		$this->variables['date_time'] = $date_time;
		$this->variables['viewing_duration'] = $viewing_duration;
		$this->compile_cert($cert_template);
	}	
	private function compile_cert($cert_template)
	{
		// load template
		$cert_text = file_get_contents($cert_template);
		// interpolate / replace vars
	    foreach($this->variables as $key => $value)
	    {
	        $cert_text = str_replace('{{ '.$key.' }}', $value, $cert_text);
	    }
	    $this->cert = $cert_text;
	}
	function get_cert()
	{
		return $this->cert;
	}
}

$title='Certificate of Completion';
$webcast ='Test Certificate';
$fname = "J";
$lname = "V";
$date_time = "Friday, November 22, 2019 - 3:28pm CST";
$viewing_duration = "2s / 37m";


$new_cert = new WebcastCertificate(
	$title,
	$webcast,
	$fname,
	$lname,
	$date_time,
	$viewing_duration
);

$cert_html = $new_cert->get_cert();

//todo: render html as pdf..
echo $cert_html;


//this is not working, might need to find something else other than fpdf
/*
$pdf = new createPDF(
    $cert_html,   // html text to publish
    "test title",  // article title
    "test url",    // article URL
    "test author", // author name
    time()
);
$pdf->run();
*/


?>