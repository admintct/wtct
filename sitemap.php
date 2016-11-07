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
        htmlestils('',1,0,0,0,0,0); // nom de pantalla, wow, 0 slide, 0 popup, 0 google maps
        ?>
    </head>
    <body>
        <?php 
            // <!-- Top menu -->
            menutct();
            // -- Page Title -->
            pagetitle("MAPA DEL SITIO","","SITEMAP","","sitemap"); 
        ?>
        <!-- NEWS -->
        <div class="container">
            <div class="container" style="margin:40px 0px 80px 0px">
                    <div class="row">
                        <div class="col-xm-8 col-sm-6 col-lg-2 col-centered  wow fadeIn">
                            <div class="text-left">
                                <div class="container">
                                    <h1><?php echo ($langles)?'Sitemap':'Mapa del sitio';?></h1>
                                    <p></p>
                                    <ul>
                                        <?php
                                            $hies = (isset($_SESSION['usr_codi']) && $_SESSION['usr_codi'])?1:0;
                                            $ltct = false;
                                            $ladmin = false;
                                            if ($hies){
                                                $ltct = $_SESSION['usr_tct'];
                                                $ladmin = $_SESSION['usr_admin'];
                                            }
                                            echo '<li><a href="index.php">'.(($langles)?'Homepage':'Home').'</a></li>';
                                            echo '<li>Schedule & Booking</li>';
                                            echo '<ul>';
                                                echo '<li><a href="export.php">Export</a></li>';
                                                    echo '<ul>';
                                                        echo '<li><a href="allexport.php">Lista</a></li>';
                                                    echo '</ul>';
                                                echo '<li><a href="import.php">Import</a></li>';
                                                    echo '<ul>';
                                                        echo '<li><a href="allimport.php">Lista</a></li>';
                                                    echo '</ul>';
                                            echo '</ul>';
                                            echo '<li><a href="news.php">'.(($langles)?'News':'Noticias').'</a></li>';
                                            echo '<li><a href="login.php">Login</a></li>';
                                            echo '<li><a href="aboutus.php">'.(($langles)?'About us':'Quienes somos').'</a></li>';
                                            echo '<li><a href="explain_skype.php">Skype Chat</a></li>';
                                            echo '<li><a href="distancia.php">'.(($langles)?'Distance Calculation':'C&aacute;lculo de distancias').'</a></li>';
                                            echo '<li><a href="cntrsize.php">'.(($langles)?'CNTRs dimensions':'Dimensiones de CNTRs').'</a></li>';
                                            echo '<li><a href="incoterms.php">Links</a></li>';
                                            echo '<li><a href="links.php">Links</a></li>';
                                            echo '<li><a href="cookies.php">Cookies</a></li>';
                                            echo '<li><a href="notalegal.php">'.(($langles)?'Legal Notes':'Cl&aacute;usulas legales').'</a></li>';
                                            echo '<li style="padding:10px 0px; 0px 0px">'.(($langles)?'Other utilities':'Otras utilidades');
                                                echo '<ul>';
                                                echo '<li>'.(($langles)?'Public area':'&Aacute;rea p&uacute;blica');
                                                echo '<ul>';
                                                    echo '<li><a href="contact.php">'.(($langles)?'Contact':'Contacto').'</a></li>';
                                                    echo '<li><a href="sitemap.php">'.(($langles)?'Links of interest':'Enlaces de interés').'</a></li>';
                                                    echo '<li><a href="sitemap.php">'.(($langles)?'Sitemap':'Mapa del sitio').'</a></li>';
                                                    echo '<li><a href="registre.php">'.(($langles)?'Register':'Registro').'</a></li>';
                                                echo '</ul>';
                                                echo '<li>'.(($langles)?'Registered users':'Usuarios registrados');;
                                                echo '<ul>';
                                                    echo '<li><a href="'.(($hies)?'index.php':"#").'">'.(($langles)?'My':'Mis').' Bookings</a></li>';
                                                    echo '<ul>';
                                                        echo '<li><a href="'.(($hies)?'import_my_bookings.php':"#").'">IMPORT Bookings</a></li>';
                                                        echo '<li><a href="'.(($hies)?'export_my_bookings.php':"#").'">EXPORT Bookings</a></li>';
                                                    echo '</ul>';
                                                    echo '<li><a href="'.(($hies)?'moduser.php':"#").'">'.(($langles)?'My profile':'Mi perfil').'</a></li>';
                                                    echo '<li><a href="'.(($hies)?'nopass.php':"#").'">'.(($langles)?'Password recovery':'Recuperación de Password').'</a></li>';
                                                echo '</ul>';
                                                if ($ltct){
                                                    echo '<li>SISCON';
                                                    echo '<ul>';
                                                        echo '<li><a href="selempre.php">Sel. Empresa</a></li>';
                                                        echo '<li><a href="#">Otros</a></li>';
                                                    echo '</ul>';
                                                }
                                                if ($ladmin){
                                                    echo '<li>CONFIG';
                                                    echo '<ul>';
                                                        echo '<li><a href="wusuaris.php">Usuarios</a></li>';
                                                        echo '<li><a href="#">Preferncias</a></li>';
                                                    echo '</ul>';
                                                }
                                            echo '</li>';
                                         ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    	</div>
        <!-- NEWS -->
        <?php 
            // <!-- Footer -->
            include 'footer.php';
            include_once 'htmljavascript.php';
            htmljavascript('','wow');
        ?>
    </body>
</html>