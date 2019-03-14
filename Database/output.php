

<?php
	include '../auth/validate_user.php';		
	isLoggedIn();

	if(isset($_POST['bug'])){
        

		$con = mysqli_connect("localhost","root");
        mysqli_select_db($con, "Bughound");

        $xml = new XMLWriter();
        
        $queryCols = $_POST['queryCols'];
        $queryJoin = $_POST['queryJoin'];
        $queryConditional = $_POST['queryConditional'];
        $query = $queryCols . $queryJoin . $queryConditional;



        if (!mysqli_query($con,$query))
        {
            echo("Error description: " . mysqli_error($con));
            return;
        }

        $writer = new XMLWriter();
        $writer->openURI('test.xml');
        $writer->startDocument("1.0");
        $writer->startElement("greeting");
        $writer->text('Hello World');
        $writer->endDocument();
        $writer->flush();
        // $result = mysqli_query($con, $query);
        // $xml->openURI("test.xml");
        // $xml->startDocument("1.0");
        // $xml->setIndent(true);
        
        // $xml->startElement('bug');
        
        // while ($row = mysqli_fetch_array($result)) {
        //   $xml->startElement("country");
        //   $xml->writeAttribute('udid', $row['bug_id']);
        //   $xml->writeRaw($row['country']);
        //   $xml->endElement();
        // }
        
        // $xml->endElement();
        // $xml->endDocument();        
        // $xml->flush();

        header("Location: ../report/bug_view.php");
		die();	
	}
?>

