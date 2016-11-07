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
            pagetitle("Contacte con nosotros","","Contact us","",'contact'); 
        ?>
        <!-- CONTACT US TEMPLATE -->
        <div class="contact-us-container">
        	<div class="container">
	            <div class="row">
	                <div class="col-sm-7 contact-form wow fadeInLeft">
	                    <p>
                                <?php echo texteweb("CONTACT");?>
	                    </p>
	                    <form role="form" action="manaemail.php?aqui=TCT" method="post">
	                    	<div class="form-group">
	                    		<label for="contact-name"><?php echo (($langles)?'Name':'Nombre');?></label>
	                        	<input type="text" name="name" placeholder="<?php echo (($langles)?'Enter your name':'Su nombre');?>..." class="contact-name" id="contact-name">
	                        </div>
	                    	<div class="form-group">
	                    		<label for="contact-email">Email</label>
	                        	<input type="text" name="email" placeholder="<?php echo (($langles)?'Enter your email':'Su email');?>..." class="contact-email" id="contact-email">
	                        </div>
	                        <div class="form-group">
	                        	<label for="contact-subject"><?php echo (($langles)?'Subject':'Tema');?></label>
	                        	<input type="text" name="subject" placeholder="<?php echo (($langles)?'Enter your subject':'Motivo de la consulta');?>..." class="contact-subject" id="contact-subject">
	                        </div>
	                        <div class="form-group">
	                        	<label for="contact-message"><?php echo (($langles)?'Message':'Mensaje');?></label>
	                        	<textarea name="message" placeholder="<?php echo (($langles)?'Enter your message':'Su consulta');?>..." class="contact-message" id="contact-message"></textarea>
	                        </div>
	                        <button type="submit" class="btn"><?php echo (($langles)?'Send':'Envía');?></button>
	                    </form>
	                </div>
	                <div class="col-sm-5 contact-address wow fadeInUp">
	                    <h3><?php echo (($langles)?'We Are Here':'Estamos aqu&iacute;');?></h3>
	                    <div id="map-container" class="map"></div>
	                    <h3><?php echo (($langles)?'Address':'Direcci&oacute;n');?></h3>
	                    <p>Carrer de l'Atlàntic, 112 - 120 (Z.A.L) 08040 - Barcelona, Spain</p>
	                    <p><?php echo (($langles)?'Phone':'Tel&eacute;fono');?>: +34 93 268 40 25</p>
	                </div>
	            </div>
        <?php
        include 'skypechat.php';
        ?>
	        </div>
        </div>
        <div class="container">
            <div class="container" style="margin:40px 0px 40px 0px">
                    <div class="row">
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