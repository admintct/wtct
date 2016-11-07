function cbmvalida(){
    $("[name='cbmmax']").val($("[name='totalcbm']").val());
}

function mesfitxer(){
//    tr= $("#taulamesura tr:last").html();
    var n = parseInt($('#nfitxers').val())+1;
    $('#nfitxers').val((n));
    var idx = n + 1; 
    $("#row_fitxer_").clone().attr("id","row_fitxer_"+n).appendTo( $("#row_fitxer_").parent() );
    $("#row_fitxer_"+n+" [name='fitxer1']").attr('name','fitxer'+idx);
    $("#row_fitxer_"+n+" [name='calif1']").attr('name','calif'+idx);
    
    $("#row_fitxer_"+n+" td:nth-child(2)").hide();
}

function borrafitxer(){
    var n = parseInt($('#nfitxers').val());
    punter = "#row_fitxer_"+n;
    if (n > 0){
        $('#taulafitxers tr:last').remove();
        $('#nfitxers').val((n-1));
    }
    else{
        $("[name='fitxer1']").val('');
    }
}

function mescntr(){
//    tr= $("#taulamesura tr:last").html();
    var n = parseInt($('#ncntr').val())+1;
    $('#ncntr').val((n));
    var idx = n + 1; 
    $("#row_fcl_").clone().attr("id","row_fcl_"+n).appendTo( $("#row_fcl_").parent() );
    $("#row_fcl_"+n+" [name='ucntr1']").attr('name','ucntr'+idx);
    $("#row_fcl_"+n+" [name='tipofcl1']").attr('name','tipofcl'+idx);
    
    $("#row_fcl_"+n+" td:nth-child(3)").hide();
}

function borrafcl(){
    var n = parseInt($('#ncntr').val());
    punter = "#row_fcl_"+n;
    if (n > 0){
        $('#taulafcl tr:last').remove();
        $('#ncntr').val((n-1));
    }
}

function funlclfcl(que) {
   if (que == '2')
        {$("#divfcl").show('slow');$("#divlcl").hide('slow');}
    else{$("#divfcl").hide('slow');$("#divlcl").show('slow');}
}

function mesmimo(){
    
//    tr= $("#taulamesura tr:last").html();
    var n = parseInt($('#nimos').val())+1;
    $('#nimos').val((n));
    var idx = n + 1; 
    $("#row_imo_").clone().attr("id","row_imo_"+n).appendTo( $("#row_imo_").parent() );
    $("#row_imo_"+n+" [name='classe1']").attr('name','classe'+idx);
    $("#row_imo_"+n+" [name='onu1']").attr('name','onu'+idx);
    $("#row_imo_"+n+" [name='pg1']").attr('name','pg'+idx);
    
    $("#row_imo_"+n+" td:nth-child(4)").hide();

    calmides();
}
function borraimos(){
    var n = parseInt($('#nimos').val());
    punter = "#row_imo_"+n;
    if (n > 0){
        $('#taulamimo tr:last').remove();
        $('#nimos').val((n-1));
    }
}

function mesmides(){
    
//    tr= $("#taulamesura tr:last").html();
    var n = parseInt($('#nmides').val())+1;
    $('#nmides').val((n));
    var idx = n + 1; 
    $("#row_mides_").clone().attr("id","row_mides_"+n).appendTo( $("#row_mides_").parent() );
    $("#row_mides_"+n+" [name='nbult1']").attr('name','nbult'+idx);
    $("#row_mides_"+n+" [name='l1']").attr('name','l'+idx);
    $("#row_mides_"+n+" [name='w1']").attr('name','w'+idx);
    $("#row_mides_"+n+" [name='h1']").attr('name','h'+idx);
    $("#row_mides_"+n+" [name='rm1']").attr('name','rm'+idx);
    $("#row_mides_"+n+" [name='tot1']").attr('name','tot'+idx);
    
    $("#row_mides_"+n+" td:nth-child(7)").hide();

    calmides();
}

function borramides(){
    var n = parseInt($('#nmides').val());
    punter = "#row_mides_"+n;
    if (n > 0){
        $('#taulamesura tr:last').remove();
        $('#nmides').val((n-1));
    }
    calmides();
}

function calmides(){
//    alert("SI");
    var n = parseInt($('#nmides').val())+1;
    var elres = 0;
    var fila = 0;
    var tot = 0;
    for (i = 1; i <= n; i++) { 
        fila = $("[name='nbult"+i+"']").val() * $("[name='l"+i+"']").val() * $("[name='w"+i+"']").val() * $("[name='h"+i+"']").val()/1000000;
        elres = fila.toFixed(3);
        tot = (tot * 1) + (elres * 1);
        $("[name='tot"+i+"']").val(elres);
//alert("calcula:"+n+"-"+fila+"-"+elres);
    }
    $("[name='totalcbm']").val(tot.toFixed(3));
}

function veumides() {
   if ($('#mesuressino').is(":checked"))
        {$("#commesura").show('slow');}
    else{$("#commesura").hide('slow');}
}

function entregsino() {
   if ($('#volentreg').is(":checked"))
        {$("#comentreg").show('slow');}
    else{$("#comentreg").hide('slow');}
}
function desglossino() {
   if ($('#voldesglos').is(":checked"))
        {$("#comdesglos").show('slow');}
    else{$("#comdesglos").hide('slow');}
}

function imosino() {
   if ($('#volimo').is(":checked"))
        {$("#comimo").show('slow');}
    else{$("#comimo").hide('slow');}
}

function cambiainco(){
    var elinco = $('#incoterm').val();
    if (elinco == 'EXW'){
        $("#comrecull").show('slow');
    }
    else{
        $("#comrecull").hide('slow');
    }
}

