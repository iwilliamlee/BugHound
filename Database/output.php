<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>BugHound Adding Bug</title>
    </head>
<body>
<h2>Export completed <input type="button" value="Return" id=button1 name=button1 onclick="go_home()">    
<table>
<?php

include '../auth/validate_user.php';		
    isLoggedIn();

$query = "SELECT * FROM bugs";
$con = mysqli_connect("localhost","root");
mysqli_select_db($con, "Bughound");
$result = mysqli_query($con, $query);
    $none = 0;
    $file = fopen('output-'.date('Y-m-d-H-s').'.txt',"w");
while($row = mysqli_fetch_row($result)){
    $none=1;
    $string = implode(" ", $row)."\n";
    fwrite($file,$string);
}
fclose($file);
mysqli_close($con);
?>
</table>

<?php
    if(isset($_POST['bug'])){
        $query = $_POST['query'];
    
    
        $dbh = new PDO('mysql:host=localhost;dbname=Bughound','root');
        $sxe = new SimpleXMLElement('<bugReport></bugReport>');
        $sxe_crs = $sxe->addChild('bugContent');
        
        function array_walk_simplexml(&$value, $key, &$sx) {
            $sx->addChild($key, $value);
        }
        
        $stmt = $dbh->query($query);
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $sx_cr = $sxe_crs->addChild('bug');
            array_walk($row, 'array_walk_simplexml', $sx_cr);
        }
        
        $dom_sxe = dom_import_simplexml($sxe);
        $dom = new DOMDocument('1.0');
        $dom->formatOutput = true;
        $dom_sxe = $dom->importNode($dom_sxe, true);
        $dom_sxe = $dom->appendChild($dom_sxe);
        // echo $sxe->asXML();

        $dom->save('output-'.date('Y-m-d-H-s').'.xml');
        
        die();	
    }
?>   
</h2>
        <script language=Javascript>
            function go_home(){
                window.location.replace("../bug_view.php");
            }
        </script>
                    
    </body>
</html>

