<?php
function taules_capsa($elar,$elmax=''){
    $elmax = ($elmax)?(($elmax-250 > 400)?($elmax-250):400):'';
    $ftorna = '<div  id="divatula" style="text-align:left;max-height:'.(($elmax)?$elmax:'400').'px; display: inline-block;overflow: auto;">'.
        '<table class="taules" border="solid 1px grey;"><tr>';
    foreach ($elar as $tmp) {
        $ftorna .= '<th style="display:'.(($tmp[1])?'yes':'none').';'.
                (($tmp[2])?'width:'.$tmp[2].'px;':'').
                (($tmp[3])?'text-align:center;':'').
                '">'.$tmp[0].'</th>';
    }
    $ftorna .= '</tr>';
    return $ftorna;
}
function taules_lina($elval='',$elar){
    $ftorna = '<tr onclick="zbus_fa(\''.$elval.'\',\''.$elar[0][0].'\');">';
    foreach ($elar as $tmp) {
        $ftorna .= '<td style="display:'.(($tmp[1]=='1')?'yes':'none').';'.(($tmp[2]=='1')?'text-align:right;':'').'">'.$tmp[0].'</td>';
    }
    $ftorna .= '</tr>';
    return $ftorna;
    
}
function taules_fi(){
    return '</table></div>';
}

?>