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

