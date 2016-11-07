<?php
function ptda_age($quina,$ie){
    $xcon = conexioi();
    $nl = strlen($quina);
    if (strtolower($ie) == 'i'){
        if ($n == 9){
            $loque = 'SELECT codage FROM viae WHERE ref="'.$quina.'"';
        }
        else{
            $loque = 'SELECT codage FROM lcleviae WHERE codi="'.$quina.'"';
        }
    }
    else{
        if ($n == 9){
            $loque = 'SELECT codage FROM agrupa WHERE codi="'.$quina.'"';
        }
        else{
            $loque = 'SELECT codage, codagero FROM lcleviae WHERE codi="'.$quina.'"';
        }
    }    
    $fconstmp = mysqli_query($xcon,$loque);
    if ($artmp = mysqli_fetch_array($fconstmp)){
        if (strtolower($ie) == 'i'){
            return ($artmp['codage'] == $_SESSION['usr_codage']);
        }
        else{
            if ($n == 9){
                return ($artmp['codage'] == $_SESSION['usr_codage']);
            }
            else{
                return (($artmp['codage'] == $_SESSION['usr_codage']) || ($artmp['codagero'] == $_SESSION['usr_codage']));
            }
        }
    }
    else{
        return false;
    }
}
function esagent(){
    $ftorna = false;
    if (hies()){
        $ftorna = ($_SESSION['usr_codage'])?:0;
    }
    return $ftorna;
}
function nom_usroagent(){
    $ftorna = 'TODAS LAS EMPRESAS';
    if (isset($_SESSION['usr_codcli']) && $_SESSION['usr_codcli']){
        $ftorna = $_SESSION['usr_nomcli'];
    }
    elseif(isset($_SESSION['usr_codage']) && $_SESSION['usr_codage']){
        $ftorna = $_SESSION['usr_nomage'];
    }
    return $ftorna;
}
function comanda($ordre, $tipus='',$codi=''){
    $xcon = conexioi();
    $loque = 'INSERT INTO `comanda` (`ordre`, `tipus`, `codi`, `codcli`, `wusuari`) VALUES ("'.$ordre.'","'.$tipus.'","'.$codi.'","'.$_SESSION['usr_codcli'].'", "'.$_SESSION['usr_codi'].'");';
    $fconstmp = mysqli_query($xcon,$loque);
}
function trackweb($descrip, $descripa='',$rollo='',$ptda='',$ie=''){
    $xcon = conexioi();
    $loque = 'INSERT INTO `trackweb` (`descrip`, `descripa`, `rollo`, `ptda`, `ie`, `codcli`) VALUES ("'.$descrip.'","'.$descripa.'","'.$rollo.'","'.$ptda.'","'.$ie.'","'.$_SESSION['usr_codcli'].'");';
    $fconstmp = mysqli_query($xcon,$loque);
}
function crtocr($que,$token){
    if ($que){return str_replace($token, '</br>', $que);}
    else{return '';}
}
function crtop($que,$token){
    if ($que){return '<p>'.  str_replace($token, '</p><p>', $que).'</p>';}
    else{return '';}
}
function posatr($eti,$desc,$condicio=false,$estil1='',$estil2='',$encode=1){
    $ftorna = '';
    if ($encode){
//        $eti = utf8_encode($eti);
//       $desc = utf8_encode($desc);
    }
    if (($condicio)?$desc:true){
        $ftorna = '<tr valign="top"><td'.(($estil1)?' style="'.$estil1.'"':'').'>'.$eti.'</td><td'.(($estil2)?' style="'.$estil2.'"':'').'>'.$desc.'</td></tr>';
    }
    return $ftorna;
}

function skip($step=1,$labase='',$elcodi='',$actcodi='',$quemes=''){
    $ftorna = $actcodi;
    if ($actcodi){
        $xcon = conexioi();
        $loque = 'SELECT '.$elcodi.' FROM '.$labase.' WHERE '.$elcodi.(($step>0)?'>':'<').'"'.$actcodi.'" '.$quemes.' ORDER BY '.$elcodi.' '.(($step>0)?'ASC':'DESC').' LIMIT 1';
        $fconstmp = mysqli_query($xcon,$loque);
        $artmp = mysqli_fetch_array($fconstmp);
        if ($artmp[0]){
            $ftorna = $artmp[0];
        }
    }
    return $ftorna;
}

function html_input_hidden($id,$val,$vuitzero=false){
    return '<input type="hidden" name="'.$id.'" id="'.$id.'" value="'.(($val)?$val:(($vuitzero)?'0':' ')).'"></input>';
}
function p_to_cr($que){
    $ftorna = str_replace('<p>','',$que);
    $ftorna = str_replace('</p>',chr(13),$ftorna);
    return $ftorna;
}

function cr_to_br($que,$vol_p=false){
    $ftorna = str_replace(chr(10),'',$que);
    $ftorna = str_replace(chr(13),'</br>',$ftorna);
    return (($vol_p)?'<p>':'').$ftorna.(($vol_p)?'<p>':'');
}

function sino($que){
    return ($que)?(($GLOBALS['$langles'])?'Yes':'Si'):'No';
}
function nocrlf($que=''){
    $ftorna = str_replace(chr(13),'',$que);
    $ftorna = str_replace(chr(10),'',$ftorna);
    return $ftorna;
}


function fa_radio_button($elnom='',$quin,$elval,$onchange=''){
    $ftorna = '';
    $n = 0;
//    $ftorna .= '<div class="col-xs-6 text-left">';
    foreach ($quin as $key => $tmp) {
        $ftorna .= '<label class="radio-inline" for="'.$elnom.'-'.$n.'">';
        $ftorna .= '<input '.(($onchange)?'onchange="'.$onchange.'('.($n+1).');"':'').' type="radio" name="'.$elnom.'" id="'.$elnom.'-'.$n.'" value="'.$tmp.'" '.(($elval==($n+1))?'checked="checked"':'').'>';
            $ftorna .= $key;
        $ftorna .= '</label>';
        $n++;
    }
//    $ftorna .= '<div>';
    return $ftorna;
}

// Retorna descripción del Camp seson l'idioma 
function ladesc($quin){
    $elidioma = ($GLOBALS['$langles'])?'en':'es';
    return $quin['desc'][$elidioma];
}

function fesupdate($quin){
    $ftorna = '';
    foreach ($quin as $clau => $tmp){
        switch ($tmp['tipo']) {
            case 'DT': // Datetime
                $datetime = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $tmp['val'])));
                $ftorna .= (($ftorna)?', ':'') . $clau.'="'.$datetime.'"';
                break;
            case 'D': // Date
                $date = date('Y-m-d', strtotime(str_replace('-', '/', $tmp['val'])));
                $ftorna .= (($ftorna)?', ':'') . $clau.'="'.$date.'"';
                break;
            case 'RB': // Radio Button
            case 'N': // numeric
                $ftorna .= (($ftorna)?', ':'') . $clau.'='.(($tmp['val'])?$tmp['val']:'0');
                break;
            case 'L': // Boolean
                $ftorna .= (($ftorna)?', ':'') . $clau.'='.(($tmp['val'])?'1':'0');
                break;
            default: // Altres
                $ftorna .= (($ftorna)?', ':'') . $clau.'="'.$tmp['val'].'"';
                break;
        }
    }
    return $ftorna;
}

// MOnta seqüència SQL per fer update
function retvar($lavar='',$com=false){
    $ftorna = (isset($_REQUEST[$lavar]))?$_REQUEST[$lavar]:'';
    if ($com){
        $ftorna = nohack($ftorna);
    }
    return $ftorna;
}

function fa_input_select($lataula='',$elcamp='',$lacondicio='',$valordef='',$elarray,$elnom='elselect',$onchange='',$required=false, $relatiu='0'){
    $ftorna = '<select '.(($onchange)?'onchange="'.$onchange.';" ':'').
            (($required)?' required ':'').
            'name="'.$elnom.'" id="'.$elnom.'" class="form-control-inline">';
    if ($lataula){
        if (empty($valordef)){
            $ftorna .='<option value=""></option>';
        }
        $xcon = conexioi();
        $loque = 'SELECT '.$elcamp.' FROM '.$lataula.(($lacondicio)?' WHERE '.$lacondicio:'').' ORDER BY '.$elcamp;
        $fconstmp = mysqli_query($xcon,$loque);
        while ($artmp = mysqli_fetch_array($fconstmp)) {
            $artmp[0] = utf8_encode($artmp[0]);
            $ftorna .='<option value="'.$artmp[0].'"'.((trim($artmp[0])==$valordef)?' selected':'').'>'.$artmp[0].'</option>';
        }
    }
    else{
        foreach ($elarray as $artmp) {
            $ftorna .='<option value="'.$artmp.'"'.((trim($artmp)==$valordef)?' selected':'').'>'.$artmp.'</option>';
        }
    }
    $ftorna .= '</select>';
    if ($relatiu || $required){
        $ftorna = '<div style="position: relative;top:'.$relatiu.'px;">'.$ftorna.(($required)?'<font color="#ff0000"><b>*</b></font>':'').'</div>';
    }
    return $ftorna;
}
function tornacamp($lacon, $elcamp, $lataula, $lcodi, $elvalor, $mescondi = ''){
    if (strpos($elvalor, '%')){
        $loque = 'SELECT `'.$elcamp.'` FROM '.$lataula.' WHERE '.$lcodi.' LIKE "'.$elvalor.'"'.(($mescondi)?' AND '.$mescondi:'');
    }
    else{
        $loque = 'SELECT `'.$elcamp.'` FROM '.$lataula.' WHERE '.$lcodi.'="'.$elvalor.'"'.(($mescondi)?' AND '.$mescondi:'');
    }
    $fconstmp = mysqli_query($lacon,$loque);
    if ($artmp = mysqli_fetch_array($fconstmp)) {
        return $artmp[0];
    }
    return '';
}

function candau(){return '<span><i class="fa fa-lock"></i> </span>';}
function miratct(){return '<span><i class="fa fa-eye-slash"></i> </span>';}

function un_doc($unic="",$laext="",$eldir="",$elnom="",$deon="",$primera_o_darrera="",$origen="DOCS",$eltag='',$veuextensio=true,$veunomfit=true){
    $ftorna = '';
    $petit = ''; $petitf = '';
    if (empty($laext)){
        $array = explode('.',$elnom);
        $laext = strtolower(end($array));
    }
    if (strpos($primera_o_darrera,"P")){
        $ftorna .= '<div class="row col-centered">';
        $ftorna .= '<table class="taula centered">';
    }
    if ($unic){
        $descarrega = 'downfile.php?fid='.trim($unic).'&deon='.$deon.'&elnom='.$elnom.'&origen='.$origen;
        $mostra = 'showfile.php?fid='.trim($unic).'&deon='.$deon.'&elnom='.$elnom.'&origen='.$origen;
        $ftorna .= '<tr><td>';
        $imatge = 'pdf.png';
        $textext = strtoupper($laext);
        $elcolor = 'red';
        $potveure = true;
        switch (strtolower($laext)) {
            case 'pdf':
                $elcolor = 'red';
                $imatge = 'pdf.png';
                break;
            case 'eml':
                $elcolor = 'orange';
                $imatge = 'eml.png';
                $potveure = false;
                break;
            case 'xls':
            case 'xlsx':
                $elcolor = 'green';
                $imatge = 'excel.png';
                $potveure = false;
                break;
            case 'ods':
            case 'doc':
            case 'docx':
                $elcolor = 'blue';
                $imatge = 'word.png';
                $potveure = false;
                break;
            case 'txt':
                $elcolor = 'grey';
                $imatge = 'txt.png';
                break;
            case 'csv':
                $elcolor = 'green';
                $imatge = 'csv.png';
                break;
            case 'xml':
                $elcolor = 'green';
                $imatge = 'xml.png';
                break;
            case 'jpg':
            case 'bmp':
            case 'gif':
            case 'png':
                $elcolor = 'orange';
                $imatge = 'jpg.png';
                break;
            default:
                $potveure = false;
                break;
        }
        if ($veuextensio){
            $ftorna .= '<font style="font-size:0.7em;color:white;background-color:'.$elcolor.';">&nbsp;'.$textext.'&nbsp;</font></td><td>';
        }
        $elestil = 'style="font-size:1.6em;"';
        $ftorna .= '<a href="'.$descarrega.'" data-toggle="tooltip" title="'.(($GLOBALS['$langles'])?'File Download':'Descargar Fichero').'"><i '.$elestil.' class="fa fa-download"></i></a>'.'</td><td>';
        if ($origen != 'DOCS'){
            $petit = '<small>';
            $petitf = '</small>';
            $elnom = substr($elnom,14);
        }
        if ($potveure){
            $ftorna .= '<a target="_blank" href="'.$mostra.'" data-toggle="tooltip" title="'.(($GLOBALS['$langles'])?'Show file':'Ver Fichero').'"><i '.$elestil.' class="fa fa-eye"></i></a>'.'</td><td>';
        }
        else{
            $ftorna .= '<span style="color:lightgrey;"><i '.$elestil.' class="fa fa-eye"></i></span>'.'</td><td>';
        }
        $quemostra = $elnom.(($laext)?'.'.$laext:'');
        // OJO : no tocar el literal !!!
        if (strpos($eltag,'ATOS DE DESPACHO')){
            if (substr($quemostra,0,1)=='F'){
                $quemostra = "FACTURA ".substr($quemostra,1);
                $quemostra = str_replace('.PDF', '', $quemostra);
            }
            else{
                switch (substr($quemostra,0,2)) {
                    case 'EN':
                        $quemostra = "ENTREGUESE";
                        break;
                    case 'CO':
                        $quemostra = "DATOS DE DESPACHO";
                        break;
                    case 'CU':
                        $quemostra = "CUENTA CORRIENTE";
                        break;
                    default:
                        break;
                }
            }
        } 
        if ($veunomfit){
            $ftorna .= '<a target="_blank" href="'.$mostra.'"  data-toggle="tooltip" title="'.(($GLOBALS['$langles'])?'Show file':'Ver Fichero').'"><b>'.$petit.$quemostra.$petitf.'</b></a>';
        }
        $ftorna .= '</td></tr>';
    }
    if (strpos($primera_o_darrera,"D")){
        $ftorna .='</table>';
        $ftorna .= '</div>';
    }
    return $ftorna;
}

function DTOC($que = '',$com=false,$volhora = true){
    $ftorna = '';
    $any = ($com)?"Y":"y";
    if (empty($que) || $que == "0000-00-00" || $que == "0000-00-00 00:00:00" || $que == "1970-01-01" ){
        return "";
    }
    else{
        $ftorna = date(($GLOBALS['langles'])?'m/d/'.$any:'d/m/'.$any, strtotime($que));
        if ($volhora){
            if (substr($que,10)){
                $ftorna .= substr($que,10);
            }
        }
        if ($ftorna == '01/01/70'){
            $ftorna = '';
        }
        return $ftorna;
    }
}

function hies(){
    return (isset($_SESSION['usr_codi']) && ($_SESSION['usr_codi'] > 0));
}

function estct(){
    return (isset($_SESSION['usr_tct']) && ($_SESSION['usr_tct']));
}
function actimpexp(){
    if (esagent()){
        $_SESSION['n_import'] = conta('lcleviae','codage="'.$_SESSION['usr_codage'].'"');
        $_SESSION['n_export'] = conta('lclagrupa','codage="'.$_SESSION['usr_codage'].'"');
        $_SESSION['n_export'] = 0;
    }
    elseif (empty($_SESSION['usr_codcli'])){
        $_SESSION['n_import'] = conta('lcleviae','');
        $_SESSION['n_export'] = conta('lclagrupa','');
    }
    else{
        $_SESSION['n_import'] = conta('lcleviae','codcli="'.$_SESSION['usr_codcli'].'"');
        $_SESSION['n_export'] = conta('lclagrupa','codcli="'.$_SESSION['usr_codcli'].'"');
    }
}

function conta($lataula,$lacondi){
    $ftorna = 0;
    if ($lataula){
        if ($fcon = conexioi()){
            if (empty($lacondi)){
                $loque = "SELECT COUNT(*) FROM ".$lataula;
            }
            else{
                $loque = "SELECT COUNT(*) FROM ".$lataula." WHERE ".$lacondi;
            }
            $ftmp = mysqli_query($fcon,$loque);
            if ($xfila = mysqli_fetch_array($ftmp)) {
               $ftorna = $xfila[0];  
            }
//            $fcon->close();
        }
    }
    return $ftorna;
}

function borra_reg($taula,$camp,$elid){
    $ftorna = NULL;
    if (($taula) and ($camp) and ($elid)){
        if ($conborra = conexioi()){
            $loque = "DELETE FROM ".$taula." WHERE ".$camp."=".$elid;
            $ftorna = mysqli_query($conborra,$loque);
            $conborra->close();
        }
    }
    return $ftorna;
}

function camp($tira,$n=1,$token=" "){
    if ($n < 1) {$n=1;}
    $c = explode($token,$tira);
    $son = sizeof($c);
    if($son < $n){
        return "";
    }
    else{
        return $c[$n-1];
    }
}

function cifra($que){
    $clau = "SITTRANSITGLORIAMUNDISI123TT45RANSITGLORIAM789UNDISITTRANSITGL9067867ORIAMUNDISI";
    $que = $que . "|" . generateRandomString(80);
    $c = "";
    for ($i = 0; $i <= 79; $i++) {
        $c = $c . chr((ord(substr($que,$i,1)) ^ ord(substr($clau,$i,1))));
    }
    return $c;
}

function guardaquefan($baseoplana="",$laacio="",$elvalor="",$atribut=""){
    $ftorna = null;
    $fip = ((isset($_SESSION['usr_ip']) && (! empty($_SESSION['usr_ip'])))?$_SESSION['usr_ip']:getIP());
    $elcodi = 0;
    if (isset($_SESSION['usr_codi']) && (! empty($_SESSION['usr_codi']))){
        $elcodi = $_SESSION['usr_codi'];
    }
    $loquefan = 'INSERT INTO `quefan` ( `codi`,`ip`,`pagina`,`accio`,`valor`,`atribut`) VALUES ( '.
                $elcodi.',"'.$fip.'","'.$baseoplana.'","'.$laacio.'","'.$elvalor.'","'.$atribut.'")';
    $confan = conexioi();
    if ($confan){
        $ftorna = mysqli_query($confan,$loquefan);
        $confan->close();
    }
    return $ftorna;
}

function getIP(){
    if( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] )) $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if( isset( $_SERVER ['HTTP_VIA'] ))  $ip = $_SERVER['HTTP_VIA'];
    else if( isset( $_SERVER ['REMOTE_ADDR'] ))  $ip = $_SERVER['REMOTE_ADDR'];
    else $ip = null ;
    return $ip;
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function validateemail($email) {
    // First, we check that there's one @ symbol, and that the lengths are right
    if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
        // Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
        return false;
    }
    // Split it into sections to make life easier
    $email_array = explode("@", $email);
    $local_array = explode(".", $email_array[0]);
    for ($i = 0; $i < sizeof($local_array); $i++) {
         if (!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])) {
            return false;
        }
    }    
    if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) { // Check if domain is IP. If not, it should be valid domain name
        $domain_array = explode(".", $email_array[1]);
        if (sizeof($domain_array) < 2) {
                return false; // Not enough parts to domain
        }
        for ($i = 0; $i < sizeof($domain_array); $i++) {
            if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i])) {
                return false;
            }
        }
    }
    return true;
}

function texteweb($quin="",$voleltitol=0){
    $ftorna = "";
    if ($voleltitol){
        $que = (($GLOBALS['$langles'])?'titoa':'titol');
    }
    else{
        $que = (($GLOBALS['$langles'])?'rolloa':'rollo');
    }
    $contmp = conexioi();
    $loque = 'SELECT '.$que.' FROM texteweb WHERE codi="'.$quin.'"';
    $fcons = mysqli_query($contmp,$loque);
    if ($xfila = mysqli_fetch_array($fcons)) {
       $ftorna = $xfila[0];  
    }
    $ftorna = str_replace(chr(13),'',$ftorna);
    $ftorna = str_replace(chr(10),'',$ftorna);
    return utf8_encode($ftorna);
}

function entrahide($xcamp,$xvalor){
    echo '<input type="hidden" name="'.$xcamp.'" id="'.$xcamp.'" value="'.$xvalor.'"></input>';
}

function etiqueta($eltitol="",$elque=""){
    $ftorna = '<div class="input-group">';
    $ftorna .= '<label control-label">'.$eltitol.' :</label><span> '.$elque.'</span>';
    $ftorna .= '</div>';
    echo $ftorna;
}

function eti_mas_dato($laeti="",$eldato="", $mesclasse="",$elestil="",$eltitol=''){
    $ftorna = '';
    if ($eltitol){
        $ftorna .= '<div class="row ptda_separa_titol"><b>'.$eltitol.'</b></div>';
    }
    $ftorna .= '<div class="row '.(($mesclasse)?$mesclasse:'ptda_separa').'"'.(($elestil)?'style="'.$elestil.'"':'').'>';
        $ftorna .= '<div class="col-xs-4 text-right"><label>'.trim($laeti).'</label></div>';
        $ftorna .= '<div class="col-xs-8 text-left">'.utf8_encode(trim($eldato)).'</div>';
    $ftorna .= '</div>'; 
    return $ftorna;
}

function entrada($laetiqueta='',$elnom='texto',$tipus='',$explicacio='',$elvalor='',$obliga=false,$elcom='',$lallargada=3,$meshtmlinput='',$ncols=0,$mesclase='',$onclick='', $iconlabel='',$ndata=1){
    $elestil = '';
    $ftorna = '<div class="mivalida">';
    $apretat = (strpos($elcom,"APRETAT|"))?1:0;
    $col_primera = (strpos($elcom,"NOPRIMERA|"))?0:3;
    if ($col_primera){
        $ftorna .= '<div class="row ptda-separa">';
        $ftorna .= '<div class="col-xs-'.$col_primera.(($apretat)?'':' milabel').' text-right">';
        $ftorna .='<label>'.$iconlabel.(($tipus != "CK")?$laetiqueta:'').(($obliga)?' <font color="'.$GLOBALS['red'].'";>*</font>':'').'</label>';
        $ftorna .= '</div>';
    }
    if (strpos($elcom,"RIGHT|")){
        $elestil .= 'text-align: right;';
    }
    if ($elestil){
        $elestil = ' style="'.$elestil.'" ';
    }
    $ftorna .='<div class="col-xs-'.((12-$col_primera)-$ncols).' text-left'.(($tipus == 'L')?' milliteral':'').'">';
        switch ($tipus) {
            case "L":
                    $ftorna .='<span>'.$elvalor.'</span>';
                    break;
            case "D":
                    $elid = (strpos($elcom,"DATECUSTOM|"))?'':'datepicker'.$ndata;
            case "T":
            case "E":
            case "P":
                $ftorna.= '<span><input '.$elestil.' class="form-control input-sm '.(($tipus == 'D')?'datepicker ':'').(($apretat)?'miform-apretat':'miform-control').(($mesclase)?' '.$mesclase:'').((strpos($elcom,"B|")?' autocompletar':'')).
                    '"'.
                    (($obliga)?' required':'').
                    ((empty($elid))?'':' id="'.$elid.'"').
                    ((empty($explicacio))?'':' placeholder="'.$explicacio.'"').
                    (($tipus==="E")?' email="true"':'').
                    (($tipus==="P")?' type="password"':'').
//                    (($tipus==="D")?' type="date"':'').
                    ((empty($elvalor))?'':(' value="'.$elvalor.'"')).
                    ((empty($mesobliga))?'':' '.$mesobliga).
                    ' name="'.$elnom.'" type="text" autofocus autocomplete="off"></span>'.
                    ((strpos($elcom,"X|"))?'<span id="searchclear" class="glyphicon glyphicon-remove-circle"></span>':'').
                    (($meshtmlinput && ($ncols == 0))?'<span>'.$meshtmlinput.'</span>':'');
                break;
            case "M":
                $ftorna.= '<textarea class="form-control miform-control'.(($obliga)?' required':'').'"'.((empty($elid))?'':' id="'.$elid.'"').
                    ((empty($explicacio))?'':' placeholder="'.$explicacio.'"').' name="'.$elnom.'"'.
                    (($obliga)?' class="required"':'').
                    ((empty($mesobliga))?'':' '.$mesobliga).
                    ' rows="'.$lallargada.'">'.((empty($elvalor))?'':($elvalor)).'</textarea>';
                break;
            case "RB": // RADIO BUTTON
                $ftorna .= '<div class="miform-control">'.$meshtmlinput.'</div>';
                break;
            case "SEL": // SELECT
                $ftorna .= '<div class="miform-control-sel">'.$meshtmlinput.'</div>';
                break;
            case "RI": // Radio inline
                break;
            case "CK":
                $ftorna.= '<div class="checkbox"><label><input '.(($onclick)?'onclick="'.$onclick.'" ':'').' id="'.$elnom.'" name="'.$elnom.'" type="checkbox" '.(($elvalor)?' checked="checked"':'').' value="'.$elvalor.'">'.$laetiqueta.'</label></div>';
                break;
            default:
                break;
        }
    $ftorna .='</div>';
    if ($ncols > 0){
        if ($meshtmlinput && ($tipus != 'RB')){
            $ftorna .= '<div class="col-xs-'.($ncols).' text-left">'.$meshtmlinput.'</div>'; // miform-control
        }
    }
    if ($col_primera){
    $ftorna .='</div>';
    }
    $ftorna .= '</div>';
    return $ftorna;
}

function entradeta($elcom="",$elnom="texto",$explicacio="",$laetiqueta="",$elid="",$elglyph="",$tipus="T",$obliga=false,$mesobliga="",$elvalor="",$lallargada=3,$xarray=null,$amplada=0,$meshtml=''){
    $elcom = '|'.$elcom;
    $tipus = strtoupper($tipus);
    $ftorna = "";
    $ftorna.= '<div class="'.(($amplada)?'col-sm-'.$amplada.' ':'').'form-group">';
        if ($tipus != "CK"){
            if (! empty($laetiqueta)){
                $ftorna.=  '<label'.((empty($elid))?'':' for="'.$elid.'"').'>'.$laetiqueta.(($obliga)?' <font color="'.$GLOBALS['red'].'";>*</font>':'').'</label>';
            }
        }
        $ftorna.= ($elglyph)?'<div class="input-group">':'';
            if (!empty($elglyph)){
                $ftorna.= '<span class="input-group-addon">';
                    $ftorna.= '<i class="glyphicon '.$elglyph.'"></i>';
                $ftorna.= '</span>';
            }
            switch ($tipus) {
                case "D":
                case "T":
                case "P":
                    $ftorna.= '<input class="form-control'.
                        ((strpos($elcom,"B|")?' autocompletar':'')).
                        (($obliga)?' required':'').'"'.((empty($elid))?'':' id="'.$elid.'"').
                        ((empty($explicacio))?'':' placeholder="'.$explicacio.'"').
                        (($tipus==="P")?' type="password"':'').
                        (($tipus==="D")?' type="date"':'').
                        ((empty($elvalor))?'':(' value="'.$elvalor.'"')).
                        ((empty($mesobliga))?'':' '.$mesobliga).
                        ' name="'.$elnom.'" type="text" autofocus autocomplete="off">'.
                           ((strpos($elcom,"X|"))?'<span id="searchclear" class="glyphicon glyphicon-remove-circle"></span>':'');
                    break;
                case "M":
                    $ftorna.= '<textarea class="form-control'.(($obliga)?' required':'').'"'.((empty($elid))?'':' id="'.$elid.'"').
                        ((empty($explicacio))?'':' placeholder="'.$explicacio.'"').' name="'.$elnom.'"'.
                        (($obliga)?' class="required"':'').
                        ((empty($mesobliga))?'':' '.$mesobliga).
                        ' rows="'.$lallargada.'">'.((empty($elvalor))?'':($elvalor)).'</textarea>';
                    break;
                case "RI": // Radio inline
                    $n = 0;
                    foreach($xarray as $row) {
                        $ftorna.= '<label class="radio-inline"><input name="'.$elnom.'" type="radio" '.(($n==$elvalor)?'checked="checked" ':'').'name="optradio" value="'.(++$n).'">'.$row.'</label>';
                    }
                    break;
                case "CK":
                    $ftorna.= '<div class="checkbox"><label><input name="'.$elnom.'" type="checkbox" '.(($elvalor)?' checked="checked"':'').' value="'.$elvalor.'">'.$laetiqueta.'</label></div>';
                    break;
                default:
                    break;
            }
        $ftorna .= $meshtml;
        $ftorna.= ($elglyph)?'</div>':'';
    $ftorna.= '</div>';
    echo $ftorna;
}

function nohack($que,$tipo=""){
    $tipo = strtolower($tipo);
    $que = strip_tags($que);  
    $que = stripslashes($que);  
    $que = htmlentities($que);  
    switch ($tipo) {
        case 'c':
            break;
        case 'n':
            break;
        default:
            break;
    }
    return $que;
}

function cargando(){echo '<div id="cargando" style="position: absolute; left: 0; top: 0; width: 100%; height: 100%; background: white url(images/ajax-loader.gif) no-repeat center center"></div>';}

function nocargando(){echo "<script>document.getElementById('cargando').style.display='none';</script>";}

// Va a un altra plana per javascript
function saltaa($on){$_SESSION['misatge_noborra']=(isset($_SESSION['misatge_noborra']) && ($_SESSION['misatge_noborra']=='*'))?'':'1';echo '<script language="javascript">location.href="'.$on.'";</script>';}

function tanca(){ echo '<script languaje="javascript" type="text/javascript">window.close();</script>';}

// Alerta amb javascript
function texok($deque,$eltitol=''){echo "<script>alert('$deque');</script>";ob_flush();}

function phptexok($misatge="Ok",$retorn = "Return to",$elnom="eTeum : ",$aon = "bindex.php",$margeupdown="",$centrat=true){
      $elestil = ($margeupdown)?"style=\"margin:".$margeupdown."px; \" ":"";
      $sicentrat = ($centrat)?" align='middle'":"";
      echo "<div $elestil $sicentrat>";
      echo "<div valign=\"center\" class=\"comunicat\">".$misatge."<br/><small>$retorn<a href='".$aon."'> $elnom</a></small></div>";
      echo "</div>";
  }

// Mira el idioma del navegador
function getUserLanguage() {
    $idioma =substr($_SERVER["HTTP_ACCEPT_LANGUAGE"],0,2);
   return $idioma;
  }

// MAINMENU
  
function menutct($volmenu=true){
    echo $GLOBALS['def_vas_javascript']; // Pas de variables a Javascript & Jquery

    $langles = $GLOBALS['$langles'];
    
    echo '<nav id="navbar" class="navbar" role="navigation"><div class="row">';
        // Logo inicial superiro esquerra
        echo '<div class="navbar-header">';
            echo '<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-navbar-1">';
                echo '<span class="sr-only">Toggle navigation</span>';
                echo '<span class="icon-bar"></span>';
                echo '<span class="icon-bar"></span>';
                echo '<span class="icon-bar"></span>';
            echo '</button>';
            echo '<a class="navbar-brand" href="index.php">TCT SL - NVOCC</a>';
	echo '</div>';
    //  Collect the nav links, forms, and other content for toggling -->
        if ($volmenu){
            echo '<div class="collapse navbar-collapse" id="top-navbar-1" style="margin-right:15px;">';
                echo '<ul class="nav navbar-nav navbar-right">';
        // Home
                    echo '<li><a href="index.php"><i class="fa fa-home"></i><br>'.(($GLOBALS['$onestara']=='local')?'*':'').((hies())?'My ':'').'Home</a></li>';
                    echo '<li><a href="aboutus.php"><i class="fa fa-info"></i><br>TCT SL</a></li>';
                    if (! hies()){
                        echo '<li><a href="cotiza.php"><i class="fa fa-euro"></i><br>'.(($langles)?'Quotations':'Cotizaciones').'</a></li>';
                    }
                    if (true){
                       echo '<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="500">';
                            echo '<i class="fa fa-tasks"></i><br>Schedule <span class="caret"></span></a>';
                            echo '<ul class="dropdown-menu dropdown-menu-left" role="menu">';
                                echo '<li><a href="import.php">Import</a></li>';
                                echo '<li><a href="export.php">Export</a></li>';
                            echo '</ul>';
                       echo '</li>';
                    }
                    if (hies() && ($_SESSION['usr_tct'] || $_SESSION['usr_codcli'] || $_SESSION['usr_codage'])){
                       echo '<li class="dropdown"><a href="index.php" class="dropdown-search" data-toggle="dropdown" data-hover="dropdown" data-delay="500">';
                            echo '<i class="fa fa-search"></i><br>'.(($langles)?'My':'Mis').' Bookings<span class="caret"></span></a>';
                            echo '<ul class="dropdown-menu dropdown-menu-left" role="menu">';
                                echo '<li><a href="import_my_bookings.php">Import</a></li>';
                                if (!esagent()){
                                    echo '<li><a href="export_my_bookings.php">Export</a></li>';
                                }
                            echo '</ul>';
                       echo '</li>';
                    }
                    if (true){
                        echo '<li><a href="news.php"><i class="fa fa-comments"></i><br>'.(($langles)?'News':'Noticias').'</a></li>';
                    }
                    if ((!isset($_SESSION['usr_usuari'])) || empty($_SESSION['usr_usuari'])){
                        echo '<li><a href="login.php"><i class="fa fa-user"></i><br>'.(($langles)?'Private Area':'Area Privada').'</a></li>';
                    }
                    else{
                        if ($_SESSION['usr_tct']){
                            echo '<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="500">';
                                 echo '<i class="fa fa-cloud"></i><br>SISCON<span class="caret"></span></a>';
                                 echo '<ul class="dropdown-menu dropdown-menu-left" role="menu">';
                                     echo '<li><a href="selempre.php">Sel. Empresa</a></li>';
                                     echo '<li><a href="selage.php">Sel. Agente</a></li>';
                                     echo '<li class="divider"></li>';
                                     echo '<li><a href="viae.php">Agr. Import</a></li>';
                                     echo '<li><a href="agrupa.php">Agr. Export</a></li>';
                                     echo '<li><a href="#">Visitas</a></li>';
                                 echo '</ul>';
                            echo '</li>';
                        }
                        if ($_SESSION['usr_admin']){
                            echo '<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="500">';
                                 echo '<i class="fa fa-wrench"></i><br>Config <span class="caret"></span></a>';
                                 echo '<ul class="dropdown-menu dropdown-menu-left" role="menu">';
                                     echo '<li><a href="moduser.php">'.(($langles)?'My profile':'Mi perfil').'</a></li>';
                                     echo '<li><a href="wusuaris.php">Usuarios</a></li>';
                                     echo '<li><a href="wquefan.php">Actividad de Usuarios</a></li>';
                                     echo '<li><a href="prefer.php">Preferencias</a></li>';
                                     echo '<li><a href="scheexcel.php">Generar schedules en excel</a></li>';
                                     echo '<li><a href="gen_sitemap.php">Generar <i>sitemap.xml</i></a></li>';
                                     echo '<li><a href="phpinf.php">PHP Info</a></li>';
                                     echo '<li><a href="https://www.google.com/webmasters/tools/home?hl=es" target="_blank">Google Webmasters</a></li>';
                                 echo '</ul>';
                            echo '</li>';
                        }
                        else{
                            echo '<li><a href="moduser.php"><i class="fa fa-wrench"></i><br>'.(($langles)?'My profile':'Mi perfil').'</a></li>';
                        }
                    }
                    if (true){
                        echo '<li><a href="contact.php"><i class="fa fa-envelope"></i><br>'.(($langles)?'Contact':'Contacto').'</a></li>';
                    }
                    $aonva = explode("?", filter_var($_SERVER["REQUEST_URI"],FILTER_SANITIZE_STRING));
//                    echo '<li><a href="#"><i class="fa fa-random"></i><br> ES<a href="'.$aonva[0].'?changelanguage=ES"><img src="assets/img/esp.png" alt="ESs"></a></li>'; // <span><a href="'.$aonva[0].'?changelanguage=ES"><img src="assets/img/esp.png" alt="ESs">ES</a>-<a href="'.$aonva[0].'?changelanguage=EN"><img src="assets/img/eng.png" alt="EN">EN</a></span>
                echo '</ul>';
            echo '</div>';
            echo '<div style="float:right;padding:0px 40px 10px 0px;"><span><a href="'.$aonva[0].'?changelanguage=ES"><img src="assets/img/esp.png" alt="ESs">&nbsp;</a>&nbsp;&nbsp;<a href="'.$aonva[0].'?changelanguage=EN"><img src="assets/img/eng.png" alt="EN"></a></span></div>';
        }
    echo '</div></nav>';
}
  
  
// PAGE TITLE 
function pagetitle($quina,$descripcio,$a_quina,$a_descripcio,$lapantalla,$quemes="",$elhref='',$volresul=true){
    $eldibuix = 'fa-cloud';
    $c = strtolower($quina);
    switch ($lapantalla) {
        case 'login':       $eldibuix = 'fa-user';break;
        case 'contact':     $eldibuix = 'fa-envelope';break;
        case 'index':       $eldibuix = 'fa-home';break;
        case 'schedule':    $eldibuix = 'fa-tasks';break;
        case 'edit':    $eldibuix = 'fa-edit';break;
        case 'bookings':    $eldibuix = 'fa-search';break;
        case 'notalegal':   $eldibuix = 'fa-tag';break;
        case 'noticias':    $eldibuix = 'fa-comments';break;
        case 'sitemap':     $eldibuix = 'fa-sitemap';break;
        case 'links':     $eldibuix = 'fa-link';break;
        case 'alert':     $eldibuix = 'fa-warning';break;
        case 'left':     $eldibuix = 'fa-arrow-left';break;

        default:            $eldibuix = 'fa-user';break;
    }
    if ($GLOBALS['$langles']){
        $quina = $a_quina;
        $descripcio = $a_descripcio;
    }
    
    echo '<div class="page-title-container"><div class="container"><div class="row">';
        echo '<div class="col-sm-12 wow fadeIn">';
        echo '<div class="col-xs-10 wow fadeIn"'.(($quemes)?$quemes:'').'>';
        echo '<i class="fa '.$eldibuix.'"></i>';
        if ($elhref){
            echo '<a href="'.$elhref.'">';
        }
        if ($GLOBALS['$langles']){
            echo '<h1>'.$a_quina.' '.(($a_descripcio)?'/':'').'</h1><p>'.$a_descripcio.(($a_descripcio)?'.':'').'</p>';  //<span style="text-align=right">Logout</span>
        }
        else{
            echo '<h1>'.$quina.' '.(($descripcio)?'/':'').'</h1><p>'.$descripcio.(($descripcio)?'.':'').'</p>';  //<span style="text-align=right">Logout</span>
        }
        if ($elhref){
            echo '</a>';
        }
        // Logout del usuari
        echo '</div>';
        if ($volresul){
            echo '<div id="pagetitle" class="col-md-2 wow fadeIn">';
                echo '<span class="link_amb_blau pull-right" style="white-space:nowrap;">';
                if (hies()){
                    if (estct()){
                        echo 'Sel. <a href="selempre.php">Empresa</a> / <a href="selage.php">Agente</a></small> / ';
                    }
                    if ($_SESSION['n_import'] > 0){
                        echo '<span><a href="import_my_bookings.php">Import '.((estct())?'<span class="badge">'.number_format($_SESSION['n_import']).'</span>':'').'</a></span> / ';
                    }
                    if ($_SESSION['n_export'] > 0){
                        echo '<span><a href="export_my_bookings.php">Export '.((estct())?'<span class="badge">'.number_format($_SESSION['n_export']).'</span>':'').'</a></span> / ';
                    }
                    echo '<span stype="padding-left:20px;"><a href="surt.php">Logout : '.$_SESSION['usr_nomuser'].'</a></span>';
                }
                else{
                    echo '<a href="login.php">Login</a>  -  <small> <a href="registre.php">'.(($GLOBALS['$langles'])?'Register':'Registro').'</a></small>';
                }
                echo '</span>';
            echo '</div>';
        }
    echo '</div></div></div></div>';
    include 'flash_banner.php';
}
  
// triaidioma
function triaidioma(){
  // Si no hi ha idioma determinat a la sessió
    if ((! isset($_SESSION['$idioma'])) || empty($_SESSION['$idioma'])){
        if (isset($_COOKIE["triaidioma"]) && false){
          $GLOBALS['$idioma'] = (($_COOKIE["triaidioma"]==="ES")?"ES":"EN");
          $_SESSION['$idioma'] = $GLOBALS['$idioma'];
//echo printf(">>>Global : %s Session %s Cookie ***%s*** \n",$GLOBALS['$idioma'],$_SESSION['$idioma'],$_COOKIE["triaidioma"]);
          }
        else
        {
            //Almacenamos dicho idioma en una variable
            $user_language=getUserLanguage();
            //De acuerdo al idioma hacemos una o varias redirecciones.
            if(($user_language=='es') || ($user_language=='ca')) {
                 $GLOBALS['$idioma'] = "ES";
            }
            else{
                 $GLOBALS['$idioma'] = "EN";
            }
        }
     }
     else
     {
         $GLOBALS['$idioma'] = $_SESSION['$idioma'];
//echo printf("@@@Global : %s Session %s Cookie ***%s*** /n",$GLOBALS['$idioma'],$_SESSION['$idioma'],$_COOKIE["triaidioma"]);
     }
}

function esangles(){
  triaidioma();
  $GLOBALS['$langles'] = ($GLOBALS['$idioma'] === "EN");
  return $GLOBALS['$langles'];
}

// Fa una conexió a la base de dades
function conexioi()
{
 if (! isset($GLOBALS['$pbase_user'])){
     require('lesvars.php');}
 //new mysqli("localhost", "my_user", "my_password", "world");
 $mysqli = new mysqli($GLOBALS['$pbase_host'],$GLOBALS['$pbase_user'],$GLOBALS['$pbase_clau'],$GLOBALS['$pbase_nom']);
 if ($mysqli->connect_errno) {
     printf("Connect failed: %s\n", $mysqli->connect_error);}
 return $mysqli;
}

function displayerror($sql) {
    global $CONFIG;
    if($CONFIG['debug'] == 'on') {
        echo mysql_error().'<br /><br />'.$sql;
        exit;
    }
}

function gim($laaccio="",$laactivitat=""){
    if ($laaccio or $laactivitat){
        conexio();
        // Registre de la activitat
        $loque = 'INSERT INTO `gim` ( `usuari`,`proces`, `accio`) VALUES ( "'.$_SESSION['username'].'","'.$laaccio.'", "'.$laactivitat.'")';
        $result=mysql_query($loque);
        return false; // the name was not valid, or the password, or the username did not exist

    }
    else{
        return false;
    }

}

?>