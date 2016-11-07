<?php
/* 
 * Pas de paràmetres a Datatable desde PHP
 * $ddbb nom de la base
 * $xexecuta : php de execució x clic
 * $selecciona : selecció de registre 1/0
 */

function lagrid_datatable($bbdd = "", $xexecuta = "", $selecciona = ""){
    $ftorna = $bbdd.";".$xexecuta.";".$selecciona;
    $GLOBALS['def_vas_javascript'] = $GLOBALS['def_vas_javascript'] .
            '<input type="hidden" id="lagrid_datatable" value='.$ftorna.'>';
}
