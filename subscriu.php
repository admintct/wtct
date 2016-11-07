<div class="col-sm-3 footer-box wow fadeInDown">
    <h4><?php echo (($GLOBALS['$langles'])?'Email Updates':'Actualizaciones por email') ?></h4>
    <div class="footer-box-text footer-box-text-subscribe">
        <p><?php echo (($GLOBALS['$langles'])?"Enter your email and you'll be one of the first to get new updates":
                "Escriba su email y le avisaremos de las &uacute;ltimas novedades") ?> :</p>
        <form role="formsubscribe" action="suscribe.php" method="post">
            <div class="form-group">
                    <label class="sr-only" for="subscribe-email">Email address</label>
                    <input type="email" name="email" placeholder="Email..." class="subscribe-email" id="subscribe-email">
            </div>
            <button type="submit" class="btn"><?php echo (($GLOBALS['$langles'])?'Subscribe':'Solicitar') ?></button>
        </form>
        <p class="success-message"></p>
        <p class="error-message"></p>
    </div>
</div>

