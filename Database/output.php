<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>BugHound Adding Bug</title>
    </head>
<body>
<h2>Export completed

<?php
	include '../auth/validate_user.php';		
    isLoggedIn();
    
    if(isset($_POST['bug'])){
        $query = $_POST['query'];
    
    
        $dbh = new PDO('mysql:host=localhost;dbname=Bughound','root');
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
        $dom->save('output-'.date('Y-m-d-H-s').'.xml');
        

        // header("Location: ../report/bug_view.php");
        die();	
    }
?>

<input type="button" value="Return" id=button1 name=button1 onclick="go_home()">    
</h2>
        <script language=Javascript>
            function go_home(){
                window.location.replace("http://localhost/BugHound/index.php");
            }
        </script>
                    
    </body>
</html>

