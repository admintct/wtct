<?php
function grava_shipper($tipo='',$descrip='',$direc='',$pobla='',$zip='',$provin='',$pais='',$tel='',$mail='',$pic=''){
    // Cal guardar alguna cosa ?
    $codcli= $_SESSION['usr_codcli'];
    $xcon = conexioi();
    if ($xcon)
    if ($tipo && $descrip){
        // mirem si hi es 
        if ($descrip != 'The same as consignee'){
            $ante = tornacamp($xcon,'unic', 'shipper', 'descrip', $descrip, 'tipo="'.$tipo.'" AND codcli="'.$codcli.'"');
            if (empty($ante)){
                // Creem el nou i guardem el nou UNIC
                $quevol = "INSERT INTO shipper (`unic`) VALUES (NULL);";
                $fcons = mysqli_query($xcon,$quevol);
                $ante = $xcon->insert_id;
            }
            // Actualitzem el camp
            $quevol = 'UPDATE shipper SET tipo="'.$tipo.'", codcli="'.$codcli.'", descrip="'.$descrip.'",  direc="'.$direc.'", '.
                    ' pobla="'.$pobla.'", zip="'.$zip.'", provin="'.$provin.'", tel="'.$tel.'", pais="'.$pais.'", mail="'.$mail.'", pic="'.$pic.'"'.
                    ' WHERE unic="'.$ante.'"';
            $fcons = mysqli_query($xcon,$quevol);
        }
    }
}
?>