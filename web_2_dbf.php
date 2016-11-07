<?php
include_once 'sempre.php';
    function web_2_dbf($xcodi='',$xref='',$xcalif=''){
        $db = dbase_open('xweb/xweb.dbf', 0);
        texok('SI***DB');
        if ($db) {
            dbase_close($db);
        }
    }
    web_2_dbf('','','');
?>