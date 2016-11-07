


/* Recuperem les variables de PHP */     
var elwow = $("#elwow").val();
var vollagrid = $("#vollagrid").val();
var elslide = $("#elslide").val();
var elpopup = $("#elpopup").val();
var elgooglemaps = $("#elgooglemaps").val();
var volmasonry = $("#volmasonry").val();
var my_pg_offset = 0;
if( $('#my_pg_offset').length ){
    my_pg_offset = $("#my_pg_offset").val();
}  
//my_pg_offset = 20;
/* AL lio ... */


jQuery(document).ready(function() {

$('input[type=file]').bootstrapFileInput();

    var theLanguage = $('html').attr('lang');
    theLanguage = theLanguage.toUpperCase(); 

    $('input').keydown( function (event) { //event==Keyevent
        if ($( ".entersubmit" ).length){
        }
        else{
            switch(event.which) {
            case 13: 
                var inputs = $(this).closest('form').find(':input:visible');
                inputs.eq( inputs.index(this)+ 1 ).focus();
                event.preventDefault(); //Disable standard Enterkey action
                break;
            case 38: // Cursor Amunt
                var inputs = $(this).closest('form').find(':input:visible');
                inputs.eq( inputs.index(this)- 1 ).focus();
                event.preventDefault(); //Disable standard Enterkey action
                break;
            }
        }
        // event.preventDefault(); <- Disable all keys  action
    });

    /* Grid */
    if (vollagrid == 1){
/*        alert(vollagrid); */
        var paramb = 0
        var traduccio ={};
        var borrahref = "";
        var tquevol = $("#lagrid_datatable").val(); 
        var quevol = "";
        if (tquevol){
            quevol = tquevol.split(";");
        }
        if (true){
            if (theLanguage=='ES'){
                // "infoFiltered":"(filtrados de un total de _MAX_ registros)"
                traduccio ={"decimal":"","emptyTable":"No hay datos en la tabla","info":"Mostrando _START_ a _END_ de _TOTAL_ registros",
                     "infoEmpty":"Mostrando 0 a 0 de 0 registros","infoFiltered":"",
                     "infoPostFix":"","thousands":",","lengthMenu":"Mostrando _MENU_ registros","loadingRecords":"Cargando...",
                     "processing":"Procesando...","search":"Buscar:","zeroRecords":"No se encuentran coincidencias",
                     "paginate": {"first":"Primero","last":"&Uacute;ltimo","next":"Siguiente","previous":"Anterior"},
                     "aria": {"sortAscending":  ": marcar para ordenar la columna ascendente","sortDescending": ": marcar para ordenar la columna descendente"}
                };
            }
            else{
                // "infoFiltered":"(filtered from _MAX_ total entries)"
                traduccio = {"decimal":"","emptyTable":"No data available in table","info":"Showing _START_ to _END_ of _TOTAL_ entries",
                     "infoEmpty":"Showing 0 to 0 of 0 entries","infoFiltered":"","infoPostFix":"",
                     "thousands":",","lengthMenu":"Show _MENU_ entries","loadingRecords":"Loading...","processing":"Processing...",
                     "search":"Search:","zeroRecords":"No matching records found",
                     "paginate": {"first":"First","last":"Last","next":"Next","previous":"Previous"},
                     "aria": {"sortAscending":": activate to sort column ascending","sortDescending": ": activate to sort column descending"}
                };
            }
        }
        var lesdates = [];
        var elsbotons = [];
        var elordre = [];
        var quinaretorna = 0;
        // CONSULTAR https://www.datatables.net/
        switch(quevol[0]){
            case 'lcl':
                lesdates  = [{"data":"bl"},{"data":"descpunt"},{"data":"descbarco"},{"data":"ets"},{"data":"eta"},{"data":"bultos","sClass":"text-right"},{"data":"pes","sClass":"text-right"},{"data":"cbm","sClass":"text-right"},{"data":"refcil"},{"data":"codi"},{"data":"refade","searchable":false,"visible":false},{"data":"bl_barco","searchable":false,"visible":false},{"data":"bl_ets","searchable":false,"visible":false},{"data":"dataedad","searchable":false,"visible":false},{"data":"imo","searchable":false,"visible":false}];
                quinaretorna = 9;
                elordre = [[3,"desc"]];
                break
            case 'lcle':
//                lesdates  = [{"data":"codi"},{"data":"bl"},{"data":"descpol"},{"data":"bultos"},{"data":"pes"},{"data":"refcli"}];
                lesdates  = [{"data":"codi","visible": false},{"data":"bl"},{"data":"descpol"},{"data":"nombarco"},{"data":"ets"},{"data":"eta"},{"data":"bultos","sClass":"text-right"},{"data":"pes","sClass":"text-right"},{"data":"cbm","sClass":"text-right"},{"data":"refcli"},{"data":"codi"}];
                quinaretorna = 9;
                elordre = [[3,"desc"]];
                break
            case 'wusuaris':
                lesdates  = [{"data":"codi","sClass":"text-center"},{"data":"clientoagent","sClass":"text-center"},{"data":"usuari","sClass":"text-center"},{"data":"email"},{"data":"nomcli"},{"data":"nomuser"},
                            {"data":"tct","sClass":"text-center","render" : function ( data, type, full, meta ) {return (data=='1')?'<i class="glyphicon glyphicon-remove"></i>':'';}},
                            {"data":"admin","sClass":"text-center","render" : function ( data, type, full, meta ) {return (data=='1')?'<i class="glyphicon glyphicon-remove"></i>':'';}},
                            {"data":"codi","sClass":"text-center","targets":'no-sort',"orderable": false,"render": function ( data, type, full, meta ) {return '<a class="a-rojo delete-post" id="'+data.trim()+'" ><i class="glyphicon glyphicon-remove"></i></a>';}}
                            ];
                borrahref = "wusuaris.php"
                elordre = [[2,"asc"]];
                break
            case 'selempre':
                lesdates  = [{"data":"codi"},{"data":"nomcli"},{"data":"pobcli"}];
                paramb = "2";
                break
        }
//alert(my_pg_offset);
        var table = $('#lagrid').DataTable( {
            "processing": true,
            "serverSide": true,
            "ajax": {url:"server_json.php?langles="+theLanguage+"&ambque="+tquevol},
            "language": traduccio,
            "columns": lesdates,
            "order": elordre,
            "dom": '<"toolbar">frtip'
            });

//            "displayStart": my_pg_offset
//065572 
//    var table = $('#lagrid').DataTable();
 
//table.columns( 9 ).search( '065572' ).draw();

    // Bookmark
    $('#bookmark-this').on('click', function() { 
        CreateBookmarkLink();
    });


        /* Gestiona els clicks */
        if (quevol[1]){
            $('#lagrid tbody').on('click', 'td', function () {
                if ($(this).find("a").hasClass('delete-post')){
                        var elborra =($(this).find("a").attr('id'));
                        if (borrahref){
                            bootbox.confirm({
                                title: "<small>"+((theLanguage=='ES')?'ELIMINAR REGISTRO':'DELETE RECORD')+'</small>',
                                message:'<h4>'+((theLanguage=='ES')?"ELIMINA el registro ?":"Are you sure ?")+'</h4>',
                                buttons: {
                                        'cancel': {
                                            label: ((theLanguage=='ES')?"CANCELAR":"CANCEL"),
                                            className: 'btn-default pull-left'
                                        },
                                        'confirm': {
                                            label: ((theLanguage=='ES')?"ELIMINA":"DELETE"),
                                            className: 'btn-danger pull-right'
                                        }
                                    },
                                callback:function(result) {
                                    if (result) {
                                        $.redirectPost((borrahref),{'br':(elborra)}); 
                                    } 
                                }
                            });            
                        }
                    }
                    else
                    {
//                      var name = $(this).closest('tr').children('td:first').eq(0).text();
                        var name = $(this).closest('tr').children('td:nth-child('+(quinaretorna+1)+')').eq(0).text();
                        if (paramb > 0){
                            var tmpname = $(this).closest('tr').children('td:nth-child('+paramb+')').eq(0).text();
                            name = name + '</textarea><textarea name="siscon_paramb">'+tmpname;
                        }
                        $('<form class="hidden-form" action="'+quevol[1]+'" method="post" style="display: none;"><textarea name="siscon_param">'+name+'</textarea></form>').appendTo('body');
                        $('.hidden-form').submit();
                    }
            } );       
        }
        /* Autocompletar */
//        alert($('.autocompletar').attr('id'));
        $('.autocompletar').each(function(){
            var that = this;
            $(that).autocomplete({
                source:function(request, response) {
                    $.ajax({
                        url: 'autocompletar.php',
                        dataType: "json",
                        data: {
                            term : request.term,
                            id : $(that).attr('id'),
                            segon : function(){ 
                                var retorna = '';
                                switch($(that).attr('id')){
                                    case 'puntse_punt': retorna = $('#puntse_pais').val();break;
                                    case 'puntsi_punt': retorna = $('#puntsi_pais').val();break;
                                    default: break;
                                }
                                return retorna;
                            }
                        },
                        success: function(data) {
                            response(data);
                        }
                    });
                }, 
//                            segon : $('#puntse_pais').val()
                minLength:1,
                type: 'POST',
                dataType: 'json',
                select: function(event,ui){
                    // alert(ui.item.label);
                    // alert(ui.item.bo);
                    // Posem la resta de camps
                    $(that).val(ui.item.bo);
                    switch($(that).attr('id')){
                        case 'clients_codi': $('#clients_nomcli').val(ui.item.id); break;
                        case 'clients_nomcli': $('#clients_codi').val(ui.item.id); break;
                        case 'puntse_pais': $('#puntse_pais').val(ui.item.id); break;
                        case 'puntse_punt': $('#puntse_punt').val(ui.item.id); break;
                        case 'puntsi_pais': $('#puntsi_pais').val(ui.item.id); break;
                        case 'puntsi_punt': $('#puntsi_punt').val(ui.item.id); break;
                        default:
                            break;
                    }                    
                    return false;
                }
            });
        });
        
        /* Selecció de camps */
        if (quevol[2] == "1" && false){
            $('#lagrid tbody').on( 'click', 'tr', function () {
                if ( $(this).hasClass('selected') ) {
                    $(this).removeClass('selected');
                }
                else {
                    table.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }
            } );
        }
    }    
    /* End GRID  End GRID  End GRID  End GRID  End GRID */


    /* jqery.validate */
    $('form').validate({
        rules: {
            password: { 
                  required: true, minlength: 2, maxlength: 20
            }, 
            password_again: { 
                  required: true, equalTo: "#password", minlength: 2, maxlength: 20
            }, 
        },
        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error'); 
            $(element).closest('.mivalida').addClass('has-error'); 
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
            $(element).closest('.mivalida').removeClass('has-error'); 
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function(error, element) {
            if(element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        },
    });
    
    /* jqery.validate amb castellà */
    if (theLanguage=='ES'){
        jQuery.extend(jQuery.validator.messages, {
            required: "Este campo es obligatorio.",
            remote: "Por favor, rellena este campo.",
            email: "Por favor, escribe una dirección de correo válida",
            url: "Por favor, escribe una URL válida.",
            date: "Por favor, escribe una fecha válida.",
            dateISO: "Por favor, escribe una fecha (ISO) válida.",
            number: "Por favor, escribe un número entero válido.",
            digits: "Por favor, escribe sólo dígitos.",
            creditcard: "Por favor, escribe un número de tarjeta válido.",
            equalTo: "Por favor, escribe el mismo valor de nuevo.",
            accept: "Por favor, escribe un valor con una extensión aceptada.",
            maxlength: jQuery.validator.format("Por favor, no escribas más de {0} caracteres."),
            minlength: jQuery.validator.format("Por favor, no escribas menos de \{0\} caracteres."),
            rangelength: jQuery.validator.format("Por favor, escribe un valor entre {0} y {1} caracteres."),
            range: jQuery.validator.format("Por favor, escribe un valor entre {0} y {1}."),
            max: jQuery.validator.format("Por favor, escribe un valor menor o igual a {0}."),
            min: jQuery.validator.format("Por favor, escribe un valor mayor o igual a {0}.")
        });
    };

    if (elslide == 1){
        /* Slider*/
        $('.flexslider').flexslider({
            animation: "slide",
            controlNav: "thumbnails",
            prevText: "",
            nextText: ""
        });
        /* Slider 2	*/
        $('.slider-2-container').backstretch([
              "assets/img/slider/5.jpg"
            , "assets/img/slider/6.jpg"
            , "assets/img/slider/7.jpg"
            ], {duration: 3000, fade: 750
         });
    };
	
    if (elpopup == 1){
        /* Image popup (home latest work) */
        $('.view-work').magnificPopup({
            type: 'image',
            gallery: {
                    enabled: true,
                    navigateByImgClick: true,
                    preload: [0,1] // Will preload 0 - before current, and 1 after the current image
            },
            image: {
                    tError: 'The image could not be loaded.',
                    titleSrc: function(item) {
                            return item.el.parent('.work-bottom').siblings('img').attr('alt');
                    }
            },
            callbacks: {
                    elementParse: function(item) {
                            item.src = item.el.attr('href');
                    }
            }
        });
    }
	
    if (elgooglemaps == 1){
        /* Google maps */
        var position = new google.maps.LatLng(41.3862317, 2.1774983000000248);
        $('.map').gmap({'center': position,'zoom': 15, 'disableDefaultUI':true, 'callback': function() {
                var self = this;
                self.addMarker({'position': this.get('map').getCenter() });	
            }
        });
    };
    

    if (elwow == 1){
        /* Wow */
        new WOW().init();
    };


});
// end READY

jQuery(window).load(function() {

	/* Cookies */
	// $.cookieBar();  
	/*  Portfolio */
        if (volmasonry == 1){
            $('.portfolio-masonry').masonry({
                    columnWidth: '.portfolio-box', 
                    itemSelector: '.portfolio-box',
                    transitionDuration: '0.5s'
            });

            $('.portfolio-filters a').on('click', function(e){
                    e.preventDefault();
                    if(!$(this).hasClass('active')) {
                    $('.portfolio-filters a').removeClass('active');
                    var clicked_filter = $(this).attr('class').replace('filter-', '');
                    $(this).addClass('active');
                    if(clicked_filter != 'all') {
                            $('.portfolio-box:not(.' + clicked_filter + ')').css('display', 'none');
                            $('.portfolio-box:not(.' + clicked_filter + ')').removeClass('portfolio-box');
                            $('.' + clicked_filter).addClass('portfolio-box');
                            $('.' + clicked_filter).css('display', 'block');
                            $('.portfolio-masonry').masonry();
                    }
                    else {
                            $('.portfolio-masonry > div').addClass('portfolio-box');
                            $('.portfolio-masonry > div').css('display', 'block');
                            $('.portfolio-masonry').masonry();
                    }
                    }
            });

            $(window).on('resize', function(){ $('.portfolio-masonry').masonry(); });
        }
        
	// image popup	
        if (elpopup === 1){
	$('.portfolio-box img').magnificPopup({
		type: 'image',
		gallery: {
			enabled: true,
			navigateByImgClick: true,
			preload: [0,1] // Will preload 0 - before current, and 1 after the current image
		},
		image: {
			tError: 'The image could not be loaded.',
			titleSrc: function(item) {
				return item.el.siblings('.portfolio-box-text').find('h3').text();
			}
		},
		callbacks: {
			elementParse: function(item) {				
				if(item.el.hasClass('portfolio-video')) {
					item.type = 'iframe';
					item.src = item.el.data('portfolio-video');
				}
				else {
					item.type = 'image';
					item.src = item.el.attr('src');
				}
			}
		}
	});
        }
});
// end LOAD


$.extend(
{
    redirectPost: function(location, args)
    {
        var form = '';
        $.each( args, function( key, value ) {
            form += '<input type="hidden" name="'+key+'" value="'+value+'">';
        });
        $('<form action="'+location+'" method="POST">'+form+'</form>').appendTo('body').submit();
    }
});


function elemail (id, tema, cos){
    this.id = id;
    this.teama = tema;
    this.cos = cos;
}

function emailcli(que) {
    //alert('si');
    $.getJSON('emailtrack.php?id='+que, function(data) {
        //alert(data); //uncomment this for debug
        //alert ("A:"+data.item1+" B:"+data.item2+" C:"+data.item3); //further debug
        //$('#zzz').html("item1="+data.item1+" item2="+data.item2+" item3="+data.item3+"");
        bootbox.dialog({
            title: '<span><b>'+data.item2+'<b></span>',
            message: data.item3,
            buttons: {success: {label: "Ok",className: "btn-success"}}
        });
    });
}

function cons_fitxa(xtab,que,quin) {
    //alert('si'+que);
    $.getJSON('cons_fitxa.php?xtab='+xtab+'&id='+que+'&ie='+quin, function(data) {
        //alert(data); //uncomment this for debug
        //alert ("A:"+data.item1+" B:"+data.item2+" C:"+data.item3); //further debug
        //$('#zzz').html("item1="+data.item1+" item2="+data.item2+" item3="+data.item3+"");
        bootbox.dialog({
            title: '<span><b>'+data.item2+'<b></span>',
            message: data.item3,
            buttons: {success: {label: "OK",className: "btn-success"}}
        });
    });
}

function brow(xtab,que,que2) {
    bootbox.hideAll();
    var elmaxim = $(window).height();
    if (que.substr(0,1) == "#"){que = $(que).val();}
    if (que2.substr(0,1) == "#"){que2 = $(que2).val();}
    //alert('si'+xtab+que+que2);
    $.getJSON('zbus.php?com=1&xtab='+xtab+'&id='+que+'&id2='+que2+'&elmaxim='+elmaxim, function(data) {
        //alert(data); //uncomment this for debug
        //alert ("A:"+data.item1+" B:"+data.item2+" C:"+data.item3); //further debug
        //$('#zzz').html("item1="+data.item1+" item2="+data.item2+" item3="+data.item3+"");
        bootbox.dialog({
            title: '<span><b>'+data.item2+'<b></span>',
            message: data.item3,
            buttons: {success: {label: "CANCEL",className: "btn-warning"}},
        });
    });
}

function zbus_fa(deon,elcod){
//    alert('pp'+deon+elcod);
    bootbox.hideAll();
    $.getJSON('zbus.php?com=0&xtab='+deon+'&id='+elcod+'&id2=', function(data) {
        //alert(data.bultos+'*'+data.suref); //uncomment this for debug
        $.each(data, function(key, valor) {
            //alert(key+':'+valor); //uncomment this for debug
            $("[name='"+key+"']").val(valor);
//            $("select[name='"+key+"']").val(valor);
        });
    });
}