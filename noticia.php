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
        htmlestils('',1,0,0,0,0,0,0); // nom de pantalla, wow, 0 slide, 0 popup, 0 google maps
        ?>
    </head>
    <body>
        <?php 
            // <!-- Top menu -->
            menutct();
            // -- Page Title -->
            pagetitle("NOTICIAS","","NEWS","","noticias"); 
        ?>
        <!-- NEWS -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12 portfolio-filters wow fadeInLeft">
                        <a href="news.php" class="filter-all active">TODO</a> / 
                        <a href="news.php" class="filter-web-design">TCT</a> / 
                        <a href="news.php" class="filter-logo-design">COMINICADOS</a> / 
                        <a href="news.php" class="filter-print-design">SERVICIOS</a>
                </div>
            </div>
            <div style="padding:20px 0px 20px 0px;" class="row">
                <div class="col-sm-12">
                    <?php
                        $ref = retvar('ref');
                        $quevol = 'SELECT * FROM notiweb WHERE codi="'.$ref.'"';
                        $conec = conexioi();
                        if ($conec){
                            $fconstmp = mysqli_query($conec,$quevol );
                            if($news = mysqli_fetch_array($fconstmp)) {
                                $llarg = strlen($news['descrip']);
                                echo '<div class="'.(($llarg >= 1024)?'col-sm-12':'col-sm-6').' col-centered">';
                                    echo '<a href="javascript:history.back()">';
                                        echo '<div class="text-left">';                                        
                                        $lafoto = strtolower($news['foto']);
                                        $titol = (($langles)?$news['descripa']:$news['descrip']);
                                        $titol = utf8_encode($titol);
                                        echo '<img src="news/'.$lafoto.'" alt="'.$titol.'" data-at2x="news/'.$lafoto.'">';
                                            echo '<div class="portfolio-box-text2">';
                                                    echo '<h3>'.$titol.'</h3>';
                                                    echo '<p><i>'.DTOC($news['data']).'</i></p>';
                                                    $eltexte = (($langles)?$news['rolloa']:$news['rollo']);
                                                    $eltexte = str_replace(chr(10),'</p><p>',utf8_encode($eltexte));
                                                    echo '<p>'.$eltexte.'</p>';
                                                    guardaquefan("NOTICIAS","CONSULTA",$ref,$news['descrip']);
                                            echo '</div>';

                                        echo '</div>';
                                    echo '</a>';
                                echo '</div>';
                            }
                        }
                    ?>
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