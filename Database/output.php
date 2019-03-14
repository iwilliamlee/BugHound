

<?php
	include '../auth/validate_user.php';		
    isLoggedIn();
    
    if(isset($_POST['bug'])){
        $queryCols = $_POST['queryCols'];
        $queryJoin = $_POST['queryJoin'];
        $queryConditional = $_POST['queryConditional'];
        $query = $queryCols . $queryJoin . $queryConditional;
    
    
        $dbh = new PDO('mysql:host=localhost;dbname=bughound','root');
        $sxe = new SimpleXMLElement('<workResponse></workResponse>');
        $sxe_crs = $sxe->addChild('contentResponses');
        
        function array_walk_simplexml(&$value, $key, &$sx) {
            $sx->addChild($key, $value);
        }
        
        $stmt = $dbh->query($query);
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $sx_cr = $sxe_crs->addChild('contentResponse');
            array_walk($row, 'array_walk_simplexml', $sx_cr);
        }
        
        $dom_sxe = dom_import_simplexml($sxe);
        $dom = new DOMDocument('1.0');
        $dom->formatOutput = true;
        $dom_sxe = $dom->importNode($dom_sxe, true);
        $dom_sxe = $dom->appendChild($dom_sxe);
        
        echo $dom->saveXML();
        $dom->save('test1.xml');

        header("Location: ../report/bug_view.php");
		die();	
    }
?>

