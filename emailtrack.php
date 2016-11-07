<?php
session_start();
include_once 'lesvars.php';
$tema = 'EMAIL NOT FOUND';
$misatge = '';
$arr = array ('item1'=>"ID",'item2'=>"EMAIL NOT FOUND",'item3'=>"");
$resultat = ARRAY($misatge); 
if (isset($_REQUEST['id'])){
    include_once 'lesvars.php';
    $mysqli = new mysqli($GLOBALS['$pbase_host'],$GLOBALS['$pbase_user'],$GLOBALS['$pbase_clau'],$GLOBALS['$pbase_nom']);
    if ($mysqli){
        $loque = 'SELECT tema, email, dt FROM track WHERE unic="'.$_REQUEST['id'].'"';
        $ftorna = mysqli_query($mysqli,$loque);
        if ($track = mysqli_fetch_array($ftorna)){
            $tema = '<div class="text-left violet"><h4><b>EMAIL :</b> '.utf8_encode($track[0]).'</h4><small><i>DATE : '.
                    date(($GLOBALS['$langles'])?'m/d/y':'d/m/y', strtotime($track[2])).'</i></small></div>';
            $cos = utf8_encode($track[1]).'</br>';
            $cos = str_replace(chr(10),'</br>',$cos);
            $cos = '<div class="text-left">'.$cos.'</div>';
            $arr = array ('item1'=>$_REQUEST['id'],'item2'=>  $tema,'item3'=>  $cos);
        }
    }
}
echo json_encode($arr);
?>