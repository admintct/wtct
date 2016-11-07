<?php
echo 'Generando sitemap ...</br>';
    if (file_exists("sitemap.xml")){
        unlink('sitemap.xml');
    }
    $file=fopen("sitemap.xml","w+");
    fwrite ($file,'<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">');
    //fwrite ($file,$buffer);
    fwrite ($file,'<url><loc>http://www.tct.es/index.php</loc><priority>0.8</priority></url>
<url><loc>http://www.tct.es/</loc><priority>0.8</priority></url>
<url><loc>http://www.tct.es/import.php</loc><priority>0.8</priority></url>
<url><loc>http://www.tct.es/import.php</loc><priority>0.8</priority></url>
<url><loc>http://www.tct.es/allexport.php</loc><priority>0.8</priority></url>
<url><loc>http://www.tct.es/allexport.php</loc><priority>0.8</priority></url>
<url><loc>http://www.tct.es/news.php</loc><priority>0.8</priority></url>
<url><loc>http://www.tct.es/login.php</loc><priority>0.8</priority></url>
<url><loc>http://www.tct.es/registre.php</loc><priority>0.8</priority></url>
<url><loc>http://www.tct.es/contact.php</loc><priority>0.8</priority></url>
<url><loc>http://www.tct.es/bookingi.php</loc><priority>0.8</priority></url>
<url><loc>http://www.tct.es/bookinge.php</loc><priority>0.8</priority></url>
<url><loc>http://www.tct.es/aboutus.php</loc><priority>0.8</priority></url>
<url><loc>http://www.tct.es/notalegal.php</loc><priority>0.8</priority></url>
<url><loc>http://www.tct.es/explain_skype.php</loc><priority>0.8</priority></url>
<url><loc>http://www.tct.es/distancia.php</loc><priority>0.8</priority></url>
<url><loc>http://www.tct.es/links.php</loc><priority>0.8</priority></url>
<url><loc>http://www.tct.es/sitemap.php</loc><priority>0.8</priority></url>');

fwrite ($file,'</urlset>');
fclose($file);

    echo 'sitemap.xml generado ...</br>';

?>