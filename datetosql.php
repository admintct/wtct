<?php
function datetosql($val){
    $torna = null;
//    if (strpos($val,'/')){
    if (substr_count($val,'/') == 2){
        $date = str_replace('/', '-', $val);
        $torna = date("Y-m-d", strtotime($date) );
        if ($torna == '1970-01-01'){
            $torna = null;
        }
    }
    return $torna;
}