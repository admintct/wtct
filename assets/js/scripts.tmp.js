
/* Recuperem les variables de PHP */     
var elwow = $("#elwow").val();
var vollagrid = $("#vollagrid").val();
var elslide = $("#elslide").val();
var elpopup = $("#elpopup").val();
var elgooglemaps = $("#elgooglemaps").val();
var volmasonry = $("#volmasonry").val();
var cookiePromptTest = false; //change this to true to test the message
var theLanguage = $('html').attr('lang');
theLanguage = theLanguage.toUpperCase(); 
/* AL lio ... */


jQuery(document).ready(function() {
    
    // $( "#datepicker" ).datepicker();
    $.datepicker.regional['es'] = {
     closeText: 'Cerrar',
     prevText: '<Ant',
     nextText: 'Sig>',
     currentText: 'Hoy',
     monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
     monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
     dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
     dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
     dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
     weekHeader: 'Sm',
     dateFormat: 'dd/mm/yy',
     firstDay: 1,
     isRTL: false,
     showMonthAfterYear: false,
     yearSuffix: ''
     };
    if (theLanguage=='ES'){
        $.datepicker.setDefaults($.datepicker.regional['es']);
    }
    else{
        $.datepicker.setDefaults($.datepicker.regional['en']);
    }
//    if(document.getElementById('fechaentrega')){
        $("input[name='fechaentrega']").datepicker({
            minDate: 0,
            maxDate:($('#elbarco').val().length === 1)?'+360D':dtoc($('#cutoff').val()),
            numberOfMonths: 1,
            onSelect: function(selected) {
                $("input[name='fechaentrega']").datepicker("option","maxDate", selected);
            }
        });
 //   };
    $("input[name='datarecull']").datepicker({
        minDate: 0,
        maxDate:dtoc($('#cutoff').val()),
        numberOfMonths: 1,
        onSelect: function(selected) {
            $("input[name='datarecull']").datepicker("option","maxDate", selected);
        }
    });
    $("input[name='dataentrega']").datepicker({
        minDate: dtoc($('#laeta').val()),
        numberOfMonths: 1,
        onSelect: function(selected) {
            $("input[name='dataentrega']").datepicker("option","maxDate", selected);
        }
    });
    
    $('#datepicker0').datepicker();
    $('#datepicker1').datepicker();
    $('#datepicker2').datepicker();
    $('#datepicker3').datepicker();

    $('#controlefe').on('click', function() { 
        $("#skypechat").hide();
        if(!searchAndHighlight($('#search-term').val())) {
            alert("No results found");
        }    
        $("#skypechat").show();
    });

    $('.fade_news').inewsticker({
            speed       : 3000,
            effect      : 'fade',
            dir         : 'ltr',
            font_size   : 13,
            color       : '#103f75',
            font_family : 'arial',
            delay_after : 1000		
    });

    if ($(".newsscroll").length){
        $(".newsscroll").bootstrapNews({
            newsPerPage: 4,
            autoplay: true,
            pauseOnHover: true,
            navigation: true,
            direction: 'down',
            newsTickerInterval: 4500,
            onToDo: function () {
                //console.log(this);
            }
        });
    }



    if (cookiePromptTest || checkCookie("cookiePrompt") != "on") {
            //header is the id of the element the message will appear before
            var quediu = "This website uses cookies. By continuing we assume your permission to deploy cookies, as detailed in our";
            var lapolitica = "cookies policy";
            if (theLanguage=='ES'){
                quediu = "Este sitio utiliza cookies. Si sigue en el sitio, asumimos da su permiso para aceptarlas, tal como se detalla en nuestra ";
                lapolitica = "política de cookies";
            }
            $("#navbar").before('<div id="cookie-prompt" class="alert alert-danger"><button type="button" class="close" aria-label="Close" onclick="closeCookiePrompt()"><span aria-hidden="true">×</span></button>'+quediu+' <a href="cookies.php" target="_blank" class="alert-link" rel="nofollow" title="Cookies Policy">'+lapolitica+'</a>.</div>');
    }

    $('input').keydown( function (event) { //event==Keyevent
        if ($( ".entersubmit" ).length){
        }
        else{
            switch(event.which) {
            case 13: 
                if ($(this).hasClass('autocompletar')){
                }
                else{
                    var inputs = $(this).closest('form').find(':input:visible');
                    inputs.eq( inputs.index(this)+ 1 ).focus();
                    event.preventDefault(); //Disable standard Enterkey action
                }
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
        var cambiafondo = 0;
        var paging = true;
        var numrowstable = 10;
        var elsearch = true;
        // CONSULTAR https://www.datatables.net/
        switch(quevol[0]){
            case 'agr_ptdas':
                lesdates  = [{"data":"container"},{"data":"client"},{"data":"bultos","sClass":"text-right"},{"data":"tipobult"},{"data":"mercancia"},{"data":"imo"},
                            {"data":"pes","sClass":"text-right"},{"data":"cbmreal","sClass":"text-right"},{"data":"cbmmax","sClass":"text-right"},
                            {"data":"descpunt"},{"data":"admitase"},{"data":"dua"},{"data":"codi"},{"data":"precoex"}];
                quinaretorna = 12;
                elordre = [[1,"asc"]];
                paging = false;
                elsearch = false;
                numrowstable = 100;
                break
            case 'agrupa':
                lesdates  = [{"data":"ref"},{"data":"descpod"},{"data":"ets"},{"data":"eta"},{"data":"fcl"},{"data":"descbarco"},{"data":"nomage"},
                            {"data":"ptdas1","sClass":"text-right"},{"data":"cocarga","searchable":false,"visible":false},
                            {"data":"ptdas2","searchable":false,"visible":false},{"data":"ptdas3","searchable":false,"visible":false}]
                quinaretorna = 0;
                elordre = [[2,"desc"]];
                break
            case 'viae_ptdas':
                lesdates  = [{"data":"ncontaine"},{"data":"client"},{"data":"bultos","sClass":"text-right"},{"data":"tipobult"},{"data":"mercancia"},{"data":"pes","sClass":"text-right"},{"data":"cbm","sClass":"text-right"}
                        ,{"data":"cbmmax","sClass":"text-right"},{"data":"descdesti"},{"data":"bl"},{"data":"npart"},{"data":"codi"},{"data":"preco"}];
                quinaretorna = 11;
                elordre = [[1,"asc"]];
                paging = false;
                elsearch = false;
                numrowstable = 100;
                break
            case 'viae':
                lesdates  = [{"data":"ref"},{"data":"descpol"},{"data":"eta"},{"data":"ets"},{"data":"fcl"},{"data":"nombarco"},{"data":"descage"},{"data":"ptdasb","sClass":"text-right"},{"data":"cocarga","searchable":false,"visible":false}];
                quinaretorna = 0;
                elordre = [[2,"desc"]];
                break
            case 'lcl':
                lesdates  = [{"data":"bl"},{"data":"descpunt"},{"data":"descbarco"},{"data":"ets","sType": "date"},{"data":"eta"},{"data":"bultos","sClass":"text-right"},{"data":"pes","sClass":"text-right"},{"data":"cbm","sClass":"text-right"},{"data":"refcil"},{"data":"codi"},{"data":"status"},{"data":"statusa","visible":false},{"data":"refade","searchable":false,"visible":false},{"data":"bl_barco","searchable":false,"visible":false},{"data":"bl_ets","searchable":false,"visible":false},{"data":"dataedad","searchable":false,"visible":false},{"data":"imo","searchable":false,"visible":false},{"data":"op","searchable":false,"visible":false}];
                quinaretorna = 9;
                cambiafondo = 18;
                elordre = [[3,"desc"]];
                break
            case 'lcle':
//                lesdates  = [{"data":"codi"},{"data":"bl"},{"data":"descpol"},{"data":"bultos"},{"data":"pes"},{"data":"refcli"}];
                lesdates  = [{"data":"codi","visible": false},{"data":"lpor","visible": false},{"data":"bl"},{"data":"cntr"},{"data":"descpol"},{"data":"nombarco"},{"data":"ets"},{"data":"eta"},{"data":"bultos","sClass":"text-right"},{"data":"pes","sClass":"text-right"},{"data":"prevvuit"},{"data":"vuit"},{"data":"codi"}];
                quinaretorna = 10;
                elordre = [[7,"desc"]];
                break
            case 'wusuaris':
                lesdates  = [{"data":"codi","sClass":"text-center"},{"data":"clientoagent","sClass":"text-center","searchable":false},{"data":"usuari"},{"data":"email"},{"data":"nomcli"},{"data":"nomuser"},
                            {"data":"tct","sClass":"text-center","render" : function ( data, type, full, meta ) {return (data=='1')?'<i class="glyphicon glyphicon-remove"></i>':'';}},
                            {"data":"admin","sClass":"text-center","render" : function ( data, type, full, meta ) {return (data=='1')?'<i class="glyphicon glyphicon-remove"></i>':'';}},
                            {"data":"codi","sClass":"text-center","render": function ( data, type, full, meta ) {return '<a class="a-rojo delete-post" id="'+data.trim()+'" ><i class="glyphicon glyphicon-remove"></i></a>';}}
                            ];
                borrahref = "wusuaris.php"
                quinaretorna = 0;
                elordre = [[2,"asc"]];
                break
            case 'selempre':
                lesdates  = [{"data":"codi"},{"data":"nomcli"},{"data":"pobcli"}];
                elordre = [[1,"asc"]];
                quinaretorna = 0;
                paramb = "2";
                break
        }
        mesparam = $('#siscon_param').val();
        $('#lagrid tfoot th').each( function () {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
        } );
        var table = $('#lagrid').DataTable( {
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            "paging": paging,
            "bFilter": elsearch,
            "iDisplayLength": numrowstable,
            "ajax": "server_json.php?langles="+theLanguage+"&ambque="+tquevol+"&mesparam="+mesparam,
            "language": traduccio,
            "columns": lesdates,
            "order": elordre,
//            "dom": '<"toolbar">frtip',
            "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                    // Bold the grade for all 'A' grade browsers
                switch(quevol[0]){
                    case 'lcl':
                        switch( aData['op']){
                            case '1':{$('td:eq(10)', nRow).css('background-color', 'lightblue');}break;
                            case '2':{$('td:eq(10)', nRow).css('background-color', 'darkorange');}break;
                            case '3':{$('td:eq(10)', nRow).css('background-color', 'gold');}break;
                            case '4':{$('td:eq(10)', nRow).css('background-color', 'greenyellow');}break;
                            }
                        break;
                    }
                }
            });
        // Apply the search
        table.columns().every( function () {
            var that = this;
            $( 'input', this.footer() ).on( 'keyup change', function () {
                if ( that.search() !== this.value ) {
                    that
                        .search( this.value )
                        .draw();
                }
            } );
        } );


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
                autoFocus:true,
                dataType: 'json',
                select: function(event,ui){
                    if (ui.item) {
    //                   alert("LABEL:"+ui.item.label);
    //                   alert("ID:"+ui.item.id);
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
                    }
                    else{
                    }
                    return false;
                }
            });
        });
//        $( ".autocompletar" ).on( "autocompletechange", function( event, ui ) {
//            if (! ui.item) {
//                $(this).val('').attr('placeholder','try again - choose from the list');
//                event.preventDefault();
//            }
//        });
        
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
function wemailcli(que) {
    //alert('si');
    $.getJSON('wemailtrack.php?id='+que, function(data) {
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
    if (que.substr(0,1) == "#"){que = $(que).val();}
    if (que2.substr(0,1) == "#"){que2 = $(que2).val();}
    //alert('si'+xtab+que+que2);
    $.getJSON('zbus.php?com=1&xtab='+xtab+'&id='+que+'&id2='+que2, function(data) {
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
            if (key.substr(0,1) == "*"){
                // Select
                que = key.substr(1);
                //alert(que);
                $("#"+que+" option[value=" + valor + "]").prop("selected",true);
            }
            else{
                if (key.substr(0,1) == "+"){
                   que = key.substr(1);
//                   alert(que+"*"+valor);
                   $("#"+que).text(valor);
               }
               else{
    //            $("select[name='"+key+"']").val(valor);
                   $("[name='"+key+"']").val(valor);
                }
            }
        });
    });
}

function closeCookiePrompt() {
	if (!cookiePromptTest) {
		createCookie("cookiePrompt", "on", 360); //don't show message for 30 days once closed (change if required)
	}
	$("#cookie-prompt").remove();
}

function createCookie(name, value, days) {
	if (days) {
		var date = new Date();
		date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
		var expires = "; expires=" + date.toGMTString();
	}
	else var expires = "";
	document.cookie = name + "=" + value + expires + "; path=/";
}

function checkCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for (var i = 0; i < ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) == ' ') c = c.substring(1, c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
	}
	return null;
}

function eraseCookie(name) {
	createCookie(name, "", -1);
}

function searchAndHighlight(searchTerm, selector) {
    if(searchTerm) {    
        searchTerm = searchTerm.toUpperCase();
        var selector = selector || "body";                             //use body as selector if none provided
        var searchTermRegEx = new RegExp(searchTerm,"ig");
        var matches = $(selector).text().match(searchTermRegEx);
        if(matches) {
            $('.highlighted').removeClass('highlighted');     //Remove old search highlights
                $(selector).html($(selector).html()
                    .replace(searchTermRegEx, "<span class='highlighted'>"+searchTerm+"</span>"));
            if($('.highlighted:first').length) {             //if match found, scroll to where the first one appears
                $(window).scrollTop($('.highlighted:first').position().top);
            }
            return true;
        }
    }
    return false;
}