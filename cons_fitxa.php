<?php
session_start();
$tema = 'NOT FOUND';
$misatge = '';
$arr = array ('item1'=>"ID",'item2'=>"NOT FOUND",'item3'=>"");
$resultat = ARRAY($misatge); 
$xtab = ((isset($_REQUEST['xtab'])) && $_REQUEST['xtab'])?strtoupper($_REQUEST['xtab']):'';
if (isset($_REQUEST['id'])){
    $ie = $_REQUEST['ie'];
    include_once 'lesvars.php';
    $mysqli = new mysqli($GLOBALS['$pbase_host'],$GLOBALS['$pbase_user'],$GLOBALS['$pbase_clau'],$GLOBALS['$pbase_nom']);
    if ($xtab){
        switch ($xtab) {
            case 'DEPOT':
                $loque = 'SELECT * FROM depot WHERE codi="'.$_REQUEST['id'].'"';
                 $ftorna = mysqli_query($mysqli,$loque);
                 if ($depot = mysqli_fetch_array($ftorna)){
                     $tema = '<div class="text-left violet"><h5><b>DEPOT :</b> '.utf8_encode($depot['descrip']).'</h5></div>';
                     $cos = utf8_encode(trim($depot['domdepot']).'</br>'.
                            (($depot['cpdepot'])?$depot['cpdepot'].' - ':'').utf8_encode(trim($depot['pobdepot']))).'</br>'.
                            (($depot['prodepot'])?$depot['prodepot'].' ':'').utf8_encode(trim($depot['pais'])).'</br>'.
                             '</br>'.
                             (($depot['teldepot1'])?'Tel.: '.$depot['teldepot1'].'</br>':'').
                             (($depot['teldepot2'])?'Tel.: '.$depot['teldepot2'].'</br>':'').
                             (($depot['faxdepot1'])?'Fax : '.$depot['faxdepot1'].'</br>':'').
                             '</br>'.
                             (($depot['horario'])?'HORARIO : '.$depot['horario'].'</br>':'');
                             if (($ie == "I")  && (! empty($depot['notavis']))){
                               // $cos .= "</br><p>NOTAS :".$depot['notavis'].'</p>';
                               $cos .= '</br><p>NOTAS : '.utf8_encode(trim($depot['notavis'])).'</p>';
                             }
         //            $cos = str_replace(chr(10),'</br>',$cos);
                     $cos = '<div class="text-left">'.$cos.'</div>';
                     $arr = array ('item1'=>$_REQUEST['id'],'item2'=>  $tema,'item3'=>  $cos);
                 }
                break;
            default:
                     $arr = array ('item1'=>'NOT FOUND','item2'=>  'NOT FOUND','item3'=>  '<p>NOT FOUND</p>');
                break;
        }
     }
}
echo json_encode($arr);
?>