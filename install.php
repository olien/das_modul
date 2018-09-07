<?php




$modul_name = '0000 - Standard';
$input      =  file_get_contents(rex_path::addon('das_modul','lib/modul/input.php'));


$modulinstall = rex_sql::factory();
$modulinstall->debugsql = 0;
$modulinstall->setTable('rex_module');
$modulinstall->setValue('input', $input);
$modulinstall->setValue('name', $modul_name);
$modulinstall->insert();
$modul_id = (int) $modulinstall->getLastId();


/*

\rex_extension::register('PAGE_TITLE_SHOWN', function (\rex_extension_point $ep) {
    return $ep->setSubject(\rex_view::error('<h4>Url Addon:</h4><p>Please install a rewriter addon or deactivate the Url AddOn.</p>'));
});
*/