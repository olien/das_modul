<?php

$this->setProperty('author', 'concedra GmbH / Oliver Kreischer');

$this->setProperty('stylescss' ,'0');
$this->setProperty('videocss'  ,'0');
$this->setProperty('abstandcss','0');
$this->setProperty('cardscss'  ,'0');
$this->setProperty('modalcss'  ,'0');
$this->setProperty('unitegallerycss'  ,'0');

if (rex::isBackend() && rex::getUser()) {

    rex_perm::register('das_modul[]');

    rex_extension::register('PACKAGES_INCLUDED', function () {
        if (rex::getUser() && $this->getProperty('compile') && $this->getProperty('stylescss')) {

            $compiler = new rex_scss_compiler();
            $scss_files = rex_extension::registerPoint(new rex_extension_point('BE_STYLE_SCSS_FILES', [$this->getPath('scss/master.scss')]));
            $compiler->setScssFile($scss_files);
            $compiler->setCssFile($this->getPath('assets/css/styles.css'));
            $compiler->compile();
            rex_file::copy($this->getPath('assets/css/styles.css'), $this->getAssetsPath('css/styles.css'));
        }
    });
    rex_view::addCssFile($this->getAssetsUrl('css/styles.css'));


    /** Image **/
    rex_extension::register('PACKAGES_INCLUDED', function () {
        if (rex::getUser() && $this->getProperty('compile') && $this->getProperty('imagecss')) {
            $compiler = new rex_scss_compiler();
            $scss_files = rex_extension::registerPoint(new rex_extension_point('BE_STYLE_SCSS_FILES', [$this->getPath('scss/image.scss')]));
            $compiler->setScssFile($scss_files);
            $compiler->setCssFile($this->getPath('assets/css/image.css'));
            $compiler->compile();
            rex_file::copy($this->getPath('assets/css/image.css'), $this->getAssetsPath('css/image.css'));
        }
    });

    /** Video **/
    rex_extension::register('PACKAGES_INCLUDED', function () {
        if (rex::getUser() && $this->getProperty('compile') && $this->getProperty('videocss')) {
            $compiler = new rex_scss_compiler();
            $scss_files = rex_extension::registerPoint(new rex_extension_point('BE_STYLE_SCSS_FILES', [$this->getPath('scss/video.scss')]));
            $compiler->setScssFile($scss_files);
            $compiler->setCssFile($this->getPath('assets/css/video.css'));
            $compiler->compile();
            rex_file::copy($this->getPath('assets/css/video.css'), $this->getAssetsPath('css/video.css'));
        }
    });

    /** Abstand **/
    rex_extension::register('PACKAGES_INCLUDED', function () {
        if (rex::getUser() && $this->getProperty('compile') && $this->getProperty('abstandcss')) {

            $compiler = new rex_scss_compiler();
            $scss_files = rex_extension::registerPoint(new rex_extension_point('BE_STYLE_SCSS_FILES', [$this->getPath('scss/abstand.scss')]));
            $compiler->setScssFile($scss_files);
            $compiler->setCssFile($this->getPath('assets/css/abstand.css'));
            $compiler->compile();
            rex_file::copy($this->getPath('assets/css/abstand.css'), $this->getAssetsPath('css/abstand.css'));
        }
    });

    /** Cards **/
    rex_extension::register('PACKAGES_INCLUDED', function () {
        if (rex::getUser() && $this->getProperty('compile') && $this->getProperty('cardscss')) {

            $compiler = new rex_scss_compiler();
            $scss_files = rex_extension::registerPoint(new rex_extension_point('BE_STYLE_SCSS_FILES', [$this->getPath('scss/cards.scss')]));
            $compiler->setScssFile($scss_files);
            $compiler->setCssFile($this->getPath('assets/css/cards.css'));
            $compiler->compile();
            rex_file::copy($this->getPath('assets/css/cards.css'), $this->getAssetsPath('css/cards.css'));
        }
    });

    /** Modal **/
    rex_extension::register('PACKAGES_INCLUDED', function () {
        if (rex::getUser() && $this->getProperty('compile') && $this->getProperty('modalcss')) {

            $compiler = new rex_scss_compiler();
            $scss_files = rex_extension::registerPoint(new rex_extension_point('BE_STYLE_SCSS_FILES', [$this->getPath('scss/modal.scss')]));
            $compiler->setScssFile($scss_files);
            $compiler->setCssFile($this->getPath('assets/css/modal.css'));
            $compiler->compile();
            rex_file::copy($this->getPath('assets/css/modal.css'), $this->getAssetsPath('css/modal.css'));
        }
    });

    /** Unite Gallery **/
    rex_extension::register('PACKAGES_INCLUDED', function () {
        if (rex::getUser() && $this->getProperty('compile') && $this->getProperty('unitegallerycss')) {
            $compiler = new rex_scss_compiler();
            $scss_files = rex_extension::registerPoint(new rex_extension_point('BE_STYLE_SCSS_FILES', [$this->getPath('scss/unitegallerycss.scss')]));
            $compiler->setScssFile($scss_files);
            $compiler->setCssFile($this->getPath('assets/css/unitegallerycss.css'));
            $compiler->compile();
            rex_file::copy($this->getPath('assets/css/unitegallerycss.css'), $this->getAssetsPath('css/unitegallerycss.css'));
        }
    });


}


