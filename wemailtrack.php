<?php
session_start();
$tema = 'EMAIL NOT FOUND';
$misatge = '';
$arr = array ('item1'=>"ID",'item2'=>"EMAIL NOT FOUND",'item3'=>"");
$resultat = ARRAY($misatge); 
if (isset($_REQUEST['id'])){
    include_once 'lesvars.php';
    $mysqli = new mysqli($GLOBALS['$pbase_host'],$GLOBALS['$pbase_user'],$GLOBALS['$pbase_clau'],$GLOBALS['$pbase_nom']);
    if ($mysqli){
        $loque = 'SELECT descrip, descripa, rollo, data FROM trackweb WHERE codi="'.$_REQUEST['id'].'"';
        $ftorna = mysqli_query($mysqli,$loque);
        if ($track = mysqli_fetch_array($ftorna)){
            $tema = '<div class="text-left violet"><h4><b>EMAIL :</b> '.utf8_encode(($GLOBALS['$langles'])?$track[1]:$track[0]).'</h4><small><i>DATE : '.
                    date(($GLOBALS['$langles'])?'m/d/y':'d/m/y', strtotime($track[3])).'</i></small></div>';
            $cos = utf8_encode($track[2]).'</br>';
            $cos = str_replace(chr(10),'</br>',$cos);
            $cos = '<div class="text-left">'.$cos.'</div>';
            $arr = array ('item1'=>$_REQUEST['id'],'item2'=>  $tema,'item3'=>  $cos);
        }
    }
}
echo json_encode($arr);
?>