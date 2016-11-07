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
            pagetitle("BREAKING NEWS","","BREAKING NEWS","","noticias"); 
        ?>
        <!-- NEWS -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12 portfolio-masonry">
                    <?php
                        $ref = retvar('ref');
                        $quevol = 'SELECT * FROM notiweb WHERE codi="'.$ref.'"';
                        $conec = conexioi();
                        if ($conec){
                            $fconstmp = mysqli_query($conec,$quevol );
                            if($news = mysqli_fetch_array($fconstmp)) {
                                $laref = ($news['unicweb'])?(($news['ie']=='I')?'bookingi':'bookinge').'.php?punt='.trim($news['descpunt']).'&refsche='.trim($news['unicweb']):'javascript:history.back()';
                                echo '<a href="'.$laref.'">';
                                    echo '<div class="text-left">';                                        
                                    $lafoto = strtolower($news['foto']);
                                    if ($lafoto){
                                        echo '<img src="news/'.$lafoto.'" alt="" data-at2x="news/'.$lafoto.'">';
                                    }
                                        echo '<div class="portfolio-box-text">';
                                                $titol = (($langles)?$news['descripa']:$news['descrip']);
                                                $titol = utf8_encode($titol);
                                                echo '<h3>'.$titol.'</h3>';
                                                echo '<p><i>'.DTOC($news['data']).'</i></p>';
                                                $eltexte = (($langles)?$news['rolloa']:$news['rollo']);
                                                $eltexte = utf8_encode($eltexte);
                                                echo '<p>'.$eltexte.'</p>';
                                        echo '</div>';

                                    echo '</div>';
                                echo '</a>';
                                if ($news['unicweb']){
                                    echo '<div class="row>"';
                                        echo '<div class="col-sm-12 col-md-4  col-md-offset-1 formulari">';
                                            echo '<form role="form" action="'.$laref.'" method="POST">';
                                                echo '<input type="submit" class="btn btn-lg btn-primary btn-block" value="BOOKING">';
                                            echo '</form>';
                                        echo '</div>';
                                    echo '</div>';
                                }
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