<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>BugHound Adding Bug</title>
    </head>
<body>
<h2>Export completed <input type="button" value="Return" id=button1 name=button1 onclick="go_home()"> </h2> 
<table>
<?php

include '../auth/validate_user.php';		
    isLoggedIn();
    $query = $_POST['query'];
    $con = mysqli_connect("localhost","root");
    mysqli_select_db($con, "Bughound");
    $result = mysqli_query($con, $query);
    $none = 0;
    $file = fopen('Output/output-'.date('Y-m-d-H-s').'.txt',"w");
while($row = mysqli_fetch_row($result)){
    $none=1;
    // $string = implode(" ", $row)."\n";
    $string = sprintf("Bug ID: %s\n", $row[0]);
    $string .= sprintf("Program Name: %s\n", $row[2]);
    $string .= sprintf("Report type: %s\n", $row[3]);
    $string .= sprintf("Severity: %s\n", $row[4]);
    $string .= sprintf("Problem Summary: %s\n", $row[1]);
    $string .= sprintf("Problem: %s\n", $row[13]); //missing
    $string .= sprintf("Reproducible %s\n", $row[14]);//missing
    $string .= sprintf("Suggested Fix: %s\n", $row[15]); //missing
    $string .= sprintf("Reported by: %s\n", $row[10]);
    $string .= sprintf("Report Date: %s\n", $row[11]);
    $string .= "-----\n";
    $string .= sprintf("Area: %s\n", $row[5]);
    $string .= sprintf("Assigned to: %s\n", $row[6]);
    $string .= sprintf("Comments: %s\n", $row[16]); //missing
    $string .= sprintf("Bug Status: %s\n", $row[7]);
    $string .= sprintf("Priority: %s\n", $row[8]);
    $string .= sprintf("Resolution: %s\n", $row[9]);
    $string .= sprintf("Resolution Version %s\n", $row[17]);//missing
    $string .= sprintf("Resolved by: %s\n", $row[18]); //missing
    $string .= sprintf("Resolved date: %s\n", $row[12]);
    $string .= sprintf("Tested by: %s\n", $row[19]); //missing
    $string .= sprintf("Test Date: %s\n", $row[20]);//missing
    $string .= sprintf("Deferred: %s\n", $row[21]);//missing
    $string .= "\n=======================\n";
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

        $dom->save('Output/output-'.date('Y-m-d-H-s').'.xml');
    }
?>   
        <script language=Javascript>
            function go_home(){
                window.location.replace("../bug_view.php");
            }
        </script>      
    </body>
</html>

