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
        htmlestils('',1,0,0,0); // nom de pantalla, wow, 0 slide, 0 popup, 0 google maps
        ?>
    </head>
    <body>
        <?php 
            // <!-- Top menu -->
            menutct();
            // -- Page Title -->
            $titol = "ERROR 404 !";
            $titolcuadro = $titol;
            pagetitle($titol,"",$titol,"","alert"); 
        ?>
        <div class="container">
            <div class="container" style="margin:40px 0px 40px 0px">
                    <div class="row">
                        <div class="col-sm-6 col-md-4 col-md-offset-4">
                            <div class="panel panel-default">
                                <?php 
                                    if ($titolcuadro){
                                        echo '<div class="panel-heading"><h4>';
                                        echo($titol);
                                        echo '</h4></div>';
                                    }
                                ?>
                                <div class="panel-body">
                                    <form role="form" action="index.php" method="POST">
                                        <fieldset>
                                            <div class="row">
                                                <div class="center-block">
                                                   <h1><i class="fa fa-warning"></i></h1>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 col-md-10  col-md-offset-1 ">
                                                    <div class="form-group">
                                                        <?php echo "ERROR 404 - ".(($langles)?'The page you are looking for is NOT FOUND. It may be a mistake to apply the page or it may be an outdated page.':'La Página que busca NO SE ENCUENTRA. Puede tratarse de un error al solicitar la página o puede tratarse de una página obsoleta.').'</br></br>'; ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="submit" class="btn btn-lg btn-primary btn-block" value="<?php echo ($langles)?'Go Home':'Ir a Inicio'; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
       		</div>
        <?php 
            // Trec la configuració del missatge ...
            // <!-- Footer -->
            include 'footer.php';
            include_once 'htmljavascript.php';
            htmljavascript('','wow');
        ?>
    </body>
</html>