
function okbl(quin) {
    var theLanguage = $('html').attr('lang');
    theLanguage = theLanguage.toUpperCase(); 
    bootbox.confirm({
        title: "<small>"+((theLanguage=='ES')?'CONFIRMAR EL BL':'CONFIRM BL')+'</small>',
        message:'<h4>'+((theLanguage=='ES')?"CONFIRMA el BL ?":"Are you sure ?")+'</h4>',
        buttons: {
                'cancel': {
                    label: 'NO',
                    className: 'btn-default pull-left'
                },
                'confirm': {
                    label: 'OK',
                    className: 'btn-danger pull-right'
                }
            },
        callback:function(result) {
            if (result) {
                $("#modificabl").hide();
                $("#valida").hide();
                $.get("okbl.php?id="+quin);
//    alert('si');
            } 
        }
    });            
    
}