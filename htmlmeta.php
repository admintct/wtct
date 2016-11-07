<?php

function htmlmeta($quina=''){
    echo '<!-- Top menu -->'.$GLOBALS['$Kcrlf'];
    echo '<meta charset="utf-8">'.$GLOBALS['$Kcrlf'];
    echo '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
    // Pel SEO Pel SEO Pel SEO Pel SEO Pel SEO Pel SEO Pel SEO Pel SEO Pel SEO Pel SEO Pel SEO Pel SEO 
    if ($quina){
        $xcon = conexioi();
        $loque = 'SELECT * FROM tagsweb WHERE pantalla="'.$quina.'"';
        $fconstmp = mysqli_query($xcon,$loque);
        $artmp = mysqli_fetch_array($fconstmp);
        if ($artmp){
            echo '<title>'.$artmp[1].'</title>';
            if ($artmp[2]){
                echo '<meta name="description" content="'.$artmp[2].'"/>';
            }
            if ($artmp[3]){
                echo '<meta name="keywords" content="'.$artmp[3].'"/>';
            }
            echo '<meta name="Robots" content="all"/>';
        }
    }
    else{
        echo '<title>TCT SL</title>';
    }
    echo '<meta name="author" content="TCT SL"/>';
    echo '<meta http-equiv="Content-Language" content="'.(($GLOBALS['$langles'])?'en':'es').'"/><meta name="distribution" content="global"/>';
    // Fi del SEO *** Fi del SEO *** Fi del SEO *** Fi del SEO *** Fi del SEO ***
    echo $GLOBALS['$Kcrlf'];
}

?>
