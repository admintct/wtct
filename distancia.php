<?php
    include_once 'sempre.php';
    include 'htmldoctipe.php';
?>
<html lang="<?php echo(($langles)?'en':'es');?>">
    <head>
        <?php
        // Meta
        include_once 'htmlmeta.php';
        htmlmeta('login');
        // CSS
        include_once 'htmlestils.php';
        htmlestils('',1,0,0,1); // nom de pantalla, wow, 0 slide, 0 popup, 0 google maps
        ?>
    </head>
    <body>
        <?php 
            // <!-- Top menu -->
            menutct();
            // -- Page Title -->
            pagetitle("Cálculo de Distancias","","Distance Calculation","",'index'); 
        ?>
        <!-- CONTACT US TEMPLATE -->
        <div class="contact-us-container">
        	<div class="container">
	            <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div style="overflow:hidden;width:100%;height:450px;resize:none;max-width:100%;"><div id="google-maps-display" style="height:100%; width:100%;max-width:100%;"><iframe style="height:100%;width:100%;border:0;" frameborder="0" src="https://www.google.com/maps/embed/v1/directions?origin=Barcelona,+España&destination=Valencia,+España&key=AIzaSyAN0om9mFmy1QN6Wf54tXAowK4eT0ZUPrU"></iframe></div><a class="google-maps-code" href="https://www.hostingreviews.website/" id="grab-map-data">best hosting</a><style>#google-maps-display img{max-width:none!important;background:none!important;font-size: inherit;}</style></div><script src="https://www.hostingreviews.website/google-maps-authorization.js?id=30c27c93-b82f-8945-0384-b7aef35748b3&c=google-maps-code&u=1454419322" defer="defer" async="async"></script>
                        </div>
	            </div>
	        </div>
        </div>
        <?php 
            // <!-- Footer -->
            include 'footer.php';
            include_once 'htmljavascript.php';
            htmljavascript('','wow');
        ?>
    </body>
</html>