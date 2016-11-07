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
        htmlestils('',1,0,0,0,0,0,1); // nom de pantalla, wow, 0 slide, 0 popup, 0 google maps
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
        <div class="portfolio-container">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 portfolio-filters wow fadeInLeft">
                        <a href="#" class="filter-all active">TODO</a> / 
                        <a href="#" class="filter-web-design">TCT</a> / 
                        <a href="#" class="filter-logo-design">COMUNICADOS</a> / 
                        <a href="#" class="filter-print-design">SERVICIOS</a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 portfolio-masonry">
                    <?php
//                        $quevol = "SELECT * FROM notiweb WHERE noticiaoflash=1 ORDER BY data DESC";
                        $quevol = "SELECT * FROM notiweb ORDER BY data DESC";
                        $conec = conexioi();
                        if ($conec){
                            $fconstmp = mysqli_query($conec,$quevol );
                            while ($news = mysqli_fetch_array($fconstmp)) {
                                echo '<div class="portfolio-box web-design">';
                                    echo '<div class="portfolio-box-container text-left">';
                                        echo '<a href="noticia.php?ref='.$news['codi'].'">';
                                            $lafoto = strtolower($news['foto']);
                                            $titol = (($langles)?$news['descripa']:$news['descrip']);
                                            $titol = utf8_encode($titol);
                                            echo '<img src="news/'.$lafoto.'" alt="'.$titol.'" data-at2x="news/'.$lafoto.'">';
                                            echo '<div class="portfolio-box-text">';
                                                    echo '<h3>'.$titol.'</h3>';
                                                    echo '<p><i>'.DTOC($news['data']).'</i></p>';
                                                    $eltexte = (($langles)?$news['rolloa']:$news['rollo']);
                                                    $eltexte = str_replace(chr(10),'</p><p>',utf8_encode($eltexte));
                                                    echo '<p>'.$eltexte.'</p>';
                                            echo '</div>';
                                        echo '</a>';
                                    echo '</div>';
                                echo '</div>';
                            }
                        }
                    ?>
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