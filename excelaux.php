<?php
function lletres_excel($quina){
    $ftorna = "A";
    if ($quina < 27){
        $ftorna = chr(64+$quina);
    }
    else{
        $n = $quina % 27;
        $a = (int)($quina/27);
        $ftorna =chr($a+64).chr($n+65);
    }
    return $ftorna;
}
