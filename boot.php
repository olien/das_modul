<?php

$this->setProperty('author', 'Oliver Kreischer');

if (rex::isBackend() && rex::getUser()) {

    rex_perm::register('das_modul[]');

    rex_extension::register('PACKAGES_INCLUDED', function () {
        if (rex::getUser() && $this->getProperty('compile')) {

            $compiler = new rex_scss_compiler();
            $scss_files = rex_extension::registerPoint(new rex_extension_point('BE_STYLE_SCSS_FILES', [$this->getPath('scss/master.scss')]));
            $compiler->setScssFile($scss_files);
            $compiler->setCssFile($this->getPath('assets/css/styles.css'));
            $compiler->compile();
            rex_file::copy($this->getPath('assets/css/styles.css'), $this->getAssetsPath('css/styles.css'));
        }
    });
    rex_view::addCssFile($this->getAssetsUrl('css/styles.css'));


    rex_extension::register('PACKAGES_INCLUDED', function () {
        if (rex::getUser() && $this->getProperty('compile')) {

            $compiler = new rex_scss_compiler();
            $scss_files = rex_extension::registerPoint(new rex_extension_point('BE_STYLE_SCSS_FILES', [$this->getPath('scss/frontend.scss')]));
            $compiler->setScssFile($scss_files);
            $compiler->setCssFile($this->getPath('assets/css/frontend.css'));
            $compiler->compile();
            rex_file::copy($this->getPath('assets/css/frontend.css'), $this->getAssetsPath('css/frontend.css'));
        }
    });


    /** Image **/
    rex_extension::register('PACKAGES_INCLUDED', function () {
        if (rex::getUser() && $this->getProperty('compile')) {
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
        if (rex::getUser() && $this->getProperty('compile')) {
            $compiler = new rex_scss_compiler();
            $scss_files = rex_extension::registerPoint(new rex_extension_point('BE_STYLE_SCSS_FILES', [$this->getPath('scss/video.scss')]));
            $compiler->setScssFile($scss_files);
            $compiler->setCssFile($this->getPath('assets/css/video.css'));
            $compiler->compile();
            rex_file::copy($this->getPath('assets/css/video.css'), $this->getAssetsPath('css/video.css'));
        }
    });

}


