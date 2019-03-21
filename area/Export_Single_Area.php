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
    $areaID = $_POST['areaID'];
    $query = "select area_id, programs.program_name, area_name
    FROM areas INNER JOIN programs ON areas.program_id = programs.program_id
    WHERE area_ID = $areaID
    ";
    $con = mysqli_connect("localhost","root");
    mysqli_select_db($con, "Bughound");
    $result = mysqli_query($con, $query);
    $none = 0;
    $file = fopen('Output/Area-output-'.date('Y-m-d-H-s').'.txt',"w");
while($row = mysqli_fetch_row($result)){
    $none=1;
    $string = sprintf("Area ID: %s\n", $row[0]);
    $string .= sprintf("Program Name: %s\n", $row[1]);
    $string .= sprintf("Area Name: %s\n", $row[2]);
    $string .= "\n=======================\n";
    fwrite($file,$string);
}
fclose($file);
mysqli_close($con);
?>
<?php
        $query = "select area_id, programs.program_name, area_name
        FROM areas INNER JOIN programs ON areas.program_id = programs.program_id
        WHERE area_ID = $areaID
        ";
        $dbh = new PDO('mysql:host=localhost;dbname=Bughound','root');
        $sxe = new SimpleXMLElement('<AreaExport></AreaExport>');
        $sxe_crs = $sxe->addChild('AreaList');
        
        function array_walk_simplexml(&$value, $key, &$sx) {
            $sx->addChild($key, $value);
        }
        
        $stmt = $dbh->query($query);
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $sx_cr = $sxe_crs->addChild('Area');
            array_walk($row, 'array_walk_simplexml', $sx_cr);
        }
        
        $dom_sxe = dom_import_simplexml($sxe);
        $dom = new DOMDocument('1.0');
        $dom->formatOutput = true;
        $dom_sxe = $dom->importNode($dom_sxe, true);
        $dom_sxe = $dom->appendChild($dom_sxe);
        $dom->save('Output/output-'.date('Y-m-d-H-s').'.xml');
?>
</table>
<script language=Javascript>
            function go_home(){
                window.location.replace("../index.php");
            }
        </script>      
    </body>
</html>