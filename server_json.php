<?php
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables // CONSULTAR https://www.datatables.net/
 */
include_once 'lesvars.php';
include_once 'milib.php';

function no_empty_date($que){
    if ($que == "0000-00-00"){
        return "";
    }
    else{
        return date(($GLOBALS['theLanguage']=='ES')?'d/m/y':'m/d/y', strtotime($que));
    }
}

session_start();
$GLOBALS['theLanguage'] = $_REQUEST['langles'];
// Filtre general de la consulta ...
//$GLOBALS['el_filtre'] = "codcli = '0041'";
$GLOBALS['el_filtre'] = "";
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case object
// parameter names
 
// DB table to use
$tmp = explode(";",$_REQUEST['ambque']);
$table = $tmp[0];
$mesparam = $_REQUEST['mesparam'];
$GLOBALS['el_filtre'] = '';

switch ($table) {
    case 'agr_ptdas':
        $GLOBALS['el_filtre'] = " lcl.ref='".$mesparam."' ";
        $primaryKey = 'ref';
        $table = "lcl";
        $columns = array(
            array( 'db' => 'container', 'dt' => 'container' ),
            array( 'db' => 'client', 'dt' => 'client' ),
            array( 'db' => 'bultos', 'dt' => 'bultos' ),
            array( 'db' => 'tipobult', 'dt' => 'tipobult' ),
            array( 'db' => 'mercancia', 'dt' => 'mercancia' ),
            array( 'db' => 'imo', 'dt' => 'imo' ),
            array( 'db' => 'pes', 'dt' => 'pes' ),
            array( 'db' => 'cbmreal', 'dt' => 'cbmreal' ),
            array( 'db' => 'cbmmax', 'dt' => 'cbmmax' ),
            array( 'db' => 'descpunt', 'dt' => 'descpunt' ),
            array( 'db' => 'admitase', 'dt' => 'admitase' ),
            array( 'db' => 'dua', 'dt' => 'dua' ),
            array( 'db' => 'codi', 'dt' => 'codi' ),
            array( 'db' => 'precoex', 'dt' => 'precoex' ,'formatter' => function( $d, $row ) {return (($d == '1')?'P':(($d == '2')?(($d == '2')?'X':''):''));}),
        );
        break;
    case 'agrupa':
        $primaryKey = 'ref';
        $table = "agrupa";
        $columns = array(
            array( 'db' => 'ref', 'dt' => 'ref' ),
            array( 'db' => 'descpod', 'dt' => 'descpod' ),
            array( 'db' => 'ets', 'dt' => 'eta'  ,'formatter' => function( $d, $row ) {return no_empty_date($d);}),
            array( 'db' => 'eta', 'dt' => 'ets'  ,'formatter' => function( $d, $row ) {return no_empty_date($d);}),
            array( 'db' => 'fcl', 'dt' => 'fcl' ,'formatter' => function( $d, $row ) {return (($d)?'FCL':(($row['cocarga'])?'CO':''));}),
            array( 'db' => 'descbarco', 'dt' => 'descbarco' ),
            array( 'db' => 'nomage', 'dt' => 'nomage' ),
            array( 'db' => 'ptdas1', 'dt' => 'ptdas1' ,'formatter' => function( $d, $row ) {return ($d+$row['ptdas2']+$row['ptdas3']);}),
            array( 'db' => 'cocarga', 'dt' => 'cocarga' ),
            array( 'db' => 'ptdas2', 'dt' => 'ptdas2' ),
            array( 'db' => 'ptdas3', 'dt' => 'ptdas3' ),
        );
        break;
    case 'viae_ptdas':
        $GLOBALS['el_filtre'] = " lcle.ref='".$mesparam."' ";
        $primaryKey = 'ref';
        $table = "lcle";
        $columns = array(
            array( 'db' => 'ncontaine', 'dt' => 'ncontaine' ),
            array( 'db' => 'client', 'dt' => 'client' ),
            array( 'db' => 'bultos', 'dt' => 'bultos' ),
            array( 'db' => 'tipobult', 'dt' => 'tipobult' ),
            array( 'db' => 'mercancia', 'dt' => 'mercancia' ),
            array( 'db' => 'pes', 'dt' => 'pes' ),
            array( 'db' => 'cbm', 'dt' => 'cbm' ),
            array( 'db' => 'cbmmax', 'dt' => 'cbmmax' ),
            array( 'db' => 'descdesti', 'dt' => 'descdesti' ),
            array( 'db' => 'bl', 'dt' => 'bl' ),
            array( 'db' => 'npart', 'dt' => 'npart'),
            array( 'db' => 'codi', 'dt' => 'codi'),
            array( 'db' => 'codi', 'dt' => 'codi'),
            array( 'db' => 'preco', 'dt' => 'preco' ,'formatter' => function( $d, $row ) {return (($d == '1')?'P':(($d == '2')?'C':''));}),
        );
        break;
    case 'viae':
        $primaryKey = 'ref';
        $table = "viae";
        $columns = array(
            array( 'db' => 'ref', 'dt' => 'ref' ),
            array( 'db' => 'descpol', 'dt' => 'descpol' ),
            array( 'db' => 'eta', 'dt' => 'eta'  ,'formatter' => function( $d, $row ) {return no_empty_date($d);}),
            array( 'db' => 'ets', 'dt' => 'ets'  ,'formatter' => function( $d, $row ) {return no_empty_date($d);}),
            array( 'db' => 'fcl', 'dt' => 'fcl' ,'formatter' => function( $d, $row ) {return (($d)?'FCL':(($row['cocarga'])?'CO':''));}),
            array( 'db' => 'nombarco', 'dt' => 'nombarco' ),
            array( 'db' => 'descage', 'dt' => 'descage' ),
            array( 'db' => 'ptdasb', 'dt' => 'ptdasb' ),
            array( 'db' => 'cocarga', 'dt' => 'cocarga' ),
        );
        break;
    case 'lcl':
        $primaryKey = 'codi';
        $table = "lclagrupa";
        if ($_SESSION['usr_codcli']){
            $GLOBALS['el_filtre'] = " lclagrupa.codcli='".$_SESSION['usr_codcli']."' ";
        }
        $columns = array(
            array( 'db' => 'bl',  'dt' => 'bl' ,'formatter' => function( $d, $row ) {return trim($d).(($row['imo'])?' - IMO':'');} ),
            array( 'db' => 'descpunt', 'dt' => 'descpunt' ),
            array( 'db' => 'descbarco',  'dt' => 'descbarco' ,'formatter' => function( $d, $row ) {return (($row['refade'])?$row['bl_barco']:$d);}),
            array( 'db' => 'ets', 'dt' => 'ets' ,'formatter' => function( $d, $row ) {return no_empty_date($row['refade']?$row['bl_ets']:$d);}),
            array( 'db' => 'eta', 'dt' => 'eta'  ,
                   'formatter' => function( $d, $row ) {return no_empty_date((($row['refade'])?$row['dataedad']:$d));}),
            array( 'db' => 'bultos', 'dt' => 'bultos' ),
            array( 'db' => 'pes', 'dt' => 'pes' ),
            array( 'db' => 'cbm', 'dt' => 'cbm' ,'formatter' => function( $d, $row ) {return number_format($d,3);}),
            array( 'db' => 'refcil', 'dt' => 'refcil' ),
            array( 'db' => 'codi', 'dt' => 'codi'),
            array( 'db' => 'status', 'dt' => 'status' ),
            array( 'db' => 'statusa', 'dt' => 'statusa' ),
            array( 'db' => 'refade', 'dt' => 'refade'),
            array( 'db' => 'bl_barco', 'dt' => 'bl_barco'),
            array( 'db' => 'bl_ets', 'dt' => 'bl_ets'),
            array( 'db' => 'dataedad', 'dt' => 'dataedad'),
            array( 'db' => 'imo', 'dt' => 'imo'),
            array( 'db' => 'op', 'dt' => 'op')
        );
        break;
    case 'lcle':
        $primaryKey = 'codi';
        $table = "lcleviae";
//        $ames = "";
        if (esagent()){
            $GLOBALS['el_filtre'] = " lcleviae.codage='".$_SESSION['usr_codage']."' ";
        } 
        elseif ($_SESSION['usr_codcli']){
            $GLOBALS['el_filtre'] = " lcleviae.codcli='".$_SESSION['usr_codcli']."' ";
        }
//        (($_SESSION['usr_tct'] && $row['lpor'])?'*':'')
        $columns = array(
            array( 'db' => 'codi', 'dt' => 'codi'),
            array( 'db' => 'lpor', 'dt' => 'lpor'),
            array( 'db' => 'bl', 'dt' => 'bl' ),
            array( 'db' => 'cntr', 'dt' => 'cntr' ),
            array( 'db' => 'descpol', 'dt' => 'descpol','formatter' => function( $d, $row ) {return $d.(($_SESSION['usr_tct'] && $row['lpor'])?'*':'');}),
            array( 'db' => 'nombarco', 'dt' => 'nombarco' ),
            array( 'db' => 'ets', 'dt' => 'ets' ,'formatter' => function( $d, $row ) {return no_empty_date($d);}),
            array( 'db' => 'eta', 'dt' => 'eta'  ,'formatter' => function( $d, $row ) {return no_empty_date($d);}),
            array( 'db' => 'bultos', 'dt' => 'bultos' ),
            array( 'db' => 'pes', 'dt' => 'pes' ),
            array( 'db' => 'prevvuit', 'dt' => 'prevvuit' ,'formatter' => function( $d, $row ) {return no_empty_date($d);}),
            array( 'db' => 'vuit', 'dt' => 'vuit' ,'formatter' => function( $d, $row ) {return no_empty_date($d);}),
            array( 'db' => 'codi', 'dt' => 'codi') 
        );
        break;
    case 'wusuaris':
        $table = "wusuaris";
        $primaryKey = 'codi';
        $columns = array(
            array( 'db' => 'codi',  'dt' => 'codi' ),
            array( 'db' => 'email',  'dt' => 'email' ),
            array( 'db' => 'nomuser','dt' => 'nomuser' ),
            array( 'db' => 'tct', 'dt' => 'tct'),
            array( 'db' => 'clientoagent', 'dt' => 'clientoagent','formatter' => function( $d, $row ) {return (($d==0)?'CL':(($d==1)?'AG':'TCT'));}), 
            array( 'db' => 'usuari',  'dt' => 'usuari' ),
            array( 'db' => 'email',   'dt' => 'email' ),
            array( 'db' => 'codcli','dt' => 'codcli' ),
            array( 'db' => 'nomcli','dt' => 'nomcli' ),
            array( 'db' => 'nomuser','dt' => 'nomuser' ),
            array( 'db' => 'tct', 'dt' => 'tct'),
            array( 'db' => 'admin', 'dt' => 'admin'),
            array( 'db' => 'ip','dt' => 'ip' )
        );
        break;
    case 'selage':
        $GLOBALS['el_filtre'] = '';
        $table = "agents";
        $primaryKey = 'codi';
        $columns = array(
            array( 'db' => 'codi', 'dt' => 'codi' ),
            array( 'db' => 'nom',  'dt' => 'nom' ),
            array( 'db' => 'pobage',   'dt' => 'pobage' )
        );
        break;
    case 'selempre':
        $GLOBALS['el_filtre'] = '';
        $table = "clients";
        $primaryKey = 'codi';
        $columns = array(
            array( 'db' => 'codi', 'dt' => 'codi' ),
            array( 'db' => 'nomcli',  'dt' => 'nomcli' ),
            array( 'db' => 'pobcli',   'dt' => 'pobcli' )
        );
        break;
    case 'quefan':
        $GLOBALS['el_filtre'] = '';
        $table = "quefan";
        $primaryKey = 'codi';
        $columns = array(
            array( 'db' => 'codi', 'dt' => 'codi' ),
            array( 'db' => 'ip',  'dt' => 'ip' ),
            array( 'db' => 'DT',   'dt' => 'DT' ),
            array( 'db' => 'pagina',   'dt' => 'pagina' ),
            array( 'db' => 'accio',   'dt' => 'accio' ),
            array( 'db' => 'valor',   'dt' => 'valor' ),
            array( 'db' => 'atribut',   'dt' => 'atribut' )
        );
        break;

    default:
        break;
}
// SQL server connection information
$sql_details = array('user' => $GLOBALS['$pbase_user'],'pass' => $GLOBALS['$pbase_clau'],'db'   => $GLOBALS['$pbase_nom'],'host' => $GLOBALS['$pbase_host']);
/* If you just want to use the basic configuration for DataTables with PHP server-side, there is no need to edit below this line. */
require( 'ssp.class.php' );
echo json_encode(SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns));
?>