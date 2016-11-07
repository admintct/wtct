<?php
include_once 'lesvars.php';
$mysqli = new MySQLi($GLOBALS['$pbase_host'],$GLOBALS['$pbase_user'],$GLOBALS['$pbase_clau'],$GLOBALS['$pbase_nom']);
/* Connect to database and set charset to UTF-8 */
if($mysqli->connect_error) {
        echo 'Database connection failed...' . 'Error: ' . $mysqli->connect_errno . ' ' . $mysqli->connect_error;
        exit;
    } 
    else 
    {$mysqli->set_charset('utf8');}
//        echo '<script type="text/javascript">alert("pp");</script>';
/* retrieve the search term that autocomplete sends */
$term = strtoupper(trim(strip_tags($_REQUEST['term']))); 
$elid = "*";
$segon = (isset($_REQUEST['segon']) && $_REQUEST['segon'])?$_REQUEST['segon']:'';
if (isset($_REQUEST['id'])){
    $elid = strtolower(trim(strip_tags($_REQUEST['id']))); 
}
$consulta = "SELECT codi,nomcli FROM clients WHERE upper(nomcli) LIKE '%".$term."%' ORDER BY nomcli";
switch ($elid) {
    case 'agents_codi':
        $consulta = "SELECT codi,nom FROM agents WHERE upper(codi) LIKE '%".$term."%' ORDER BY codi";
        break;
    case 'agents_nom':
        $consulta = "SELECT codi,nom FROM agents WHERE upper(nom) LIKE '%".$term."%' ORDER BY nom";
        break;
    case 'clients_codi':
        $consulta = "SELECT codi,nomcli FROM clients WHERE upper(codi) LIKE '%".$term."%' ORDER BY codi";
        break;
    case 'clients_nomcli':
        $consulta = "SELECT codi,nomcli FROM clients WHERE upper(nomcli) LIKE '%".$term."%' ORDER BY nomcli";
        break;
    case 'puntse_pais':
        $consulta = "SELECT DISTINCT pais, ltarifase FROM punts WHERE ltarifase AND upper(pais) LIKE '".$term."%' ORDER BY pais";
        break;
    case 'puntse_punt':
        if ($segon){
            $consulta = "SELECT descrip, pais FROM punts WHERE ltarifase AND upper(pais) LIKE '".$segon."' AND  upper(descrip) LIKE '".$term."%' ORDER BY pais";
        }
        else{
            $consulta = "SELECT descrip FROM punts WHERE ltarifase AND upper(descrip) LIKE '".$term."%' ORDER BY pais";
        }
        break;
    case 'puntsi_pais':
        $consulta = "SELECT DISTINCT pais, ltarifasi FROM punts WHERE ltarifasi AND upper(pais) LIKE '".$term."%' ORDER BY pais";
        break;
    case 'puntsi_punt':
        if ($segon){
            $consulta = "SELECT descrip, pais FROM punts WHERE ltarifasi AND upper(pais) LIKE '".$segon."' AND  upper(descrip) LIKE '".$term."%' ORDER BY pais";
        }
        else{
            $consulta = "SELECT descrip FROM punts WHERE ltarifasi AND upper(descrip) LIKE '".$term."%' ORDER BY pais";
        }
        break;
    default:
        break;
}
//echo '**'.$term.'**';
$a_json = array();
$a_json_row = array();
if ($data = $mysqli->query($consulta)) {
	while($row = mysqli_fetch_array($data)) {
                switch ($elid){
                    case 'agents_nom':
                        $nom = stripslashes($row['nom']);
                        $codi = stripslashes($row['codi']);
                        $a_json_row["label"] = $nom;
                        $a_json_row["bo"] = $nom;
                        $a_json_row["id"] = $codi;
                        break;
                    case 'agents_codi':
                        $nom = stripslashes($row['nom']);
                        $codi = stripslashes($row['codi']);
                        $a_json_row["label"] = $codi."-".$nom;
                        $a_json_row["bo"] = $codi;
                        $a_json_row["id"] = $nom;
                        break;
                    case 'clients_nomcli':
                        $nomcli = stripslashes($row['nomcli']);
                        $codi = stripslashes($row['codi']);
                        $a_json_row["label"] = $nomcli;
                        $a_json_row["bo"] = $nomcli;
                        $a_json_row["id"] = $codi;
                        break;
                    case 'clients_codi':
                        $nomcli = stripslashes($row['nomcli']);
                        $codi = stripslashes($row['codi']);
                        $a_json_row["label"] = $codi."-".$nomcli;
                        $a_json_row["bo"] = $codi;
                        $a_json_row["id"] = $nomcli;
                        break;
                    case 'puntse_pais':
                    case 'puntsi_pais':
                        $pais = stripslashes($row['pais']);
                        $a_json_row["label"] = $pais;
                        $a_json_row["bo"] = $pais;
                        $a_json_row["id"] = $pais;
                        break;
                    case 'puntse_punt':
                    case 'puntsi_punt':
                        $descrip = stripslashes($row['descrip']);
                        $a_json_row["label"] = $descrip;
                        $a_json_row["bo"] = $descrip;
                        $a_json_row["id"] = $descrip;
                        break;
                    default : 
                        $codi = stripslashes($row[0]);
                        $a_json_row["label"] = $elid."*ERROR*".$term."*".$codi;
                        $a_json_row["bo"] = $elid."*ERROR*".$term."*".$codi;
                        break;
                }
                
		array_push($a_json, $a_json_row);
	}
}
// jQuery wants JSON data
//print_r($a_json);
echo json_encode($a_json);
flush();
 
$mysqli->close();
?>