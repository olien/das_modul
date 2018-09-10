<?php
/**
 *
 * Das Modul
 *
 * @author kreischer[at]concedra[dot]de Oliver Kreischer
 *
 */

class rex_das_modul_helper
{

  /////////////////////////////////////////////////////////
  //
  //  check Editor (MarkitUp / Redactor 2 / CKE5 / Tinymce4)
  //
  //////////////////////////////////////////////////////////

    function check_editor()
    {
        if (!rex_addon::get('markitup')->isAvailable() && !rex_addon::get('redactor2')->isAvailable() && !rex_addon::get('cke5')->isAvailable() && !rex_addon::get('tinymce4')->isAvailable()) {
            echo rex_view::error('Dieses Modul ben&ouml;tigt das "MarkItUp", das "Redactor 2", das "CKEditor 5
" oder das "Tinymce4" Addon!');
        } else {
            if (rex_addon::get('markitup')->isAvailable()) {
                $return = 'markitup';
                if (!markitup::profileExists('simple')) {
                    markitup::insertProfile('simple', 'Angelegt durch das Addon: "Das Modul".', 'textile', 200, 800, 'relative', 'bold,italic,underline,deleted,quote,sub,sup,code,unorderedlist, orderedlist, grouplink[internal|external|mailto]');
                }
            }
            if (rex_addon::get('redactor2')->isAvailable()) {
                $return = 'redactor2';
                if (!redactor2::profileExists('simple')) {
                    redactor2::insertProfile('simple', 'Angelegt durch das Addon: "Das Modul".', '200', '800', 'relative', '0', '0', '0', '1', 'bold, italic, underline, deleted, quote, sub, sup, code, unorderedlist, orderedlist, grouplink[external|internal|email], cleaner', '');
                }
            }
            if (rex_addon::get('tinymce4')->isAvailable()) {
                $return = 'tinymce4';
            }
            return $return;
        }
    }


    ////////////////////////////////////
    // Container
    ////////////////////////////////////
    function container_input($id)
    {
        $mform = new MForm();
        $mform->addFieldset('Breite des Inhaltes <i class="module_help_link fa fa-exclamation-triangle" aria-hidden="true"></i>');
        $mform->addHtml('<div class="module_help_content">
                        <p>Hier kann die Breite des Modulinhaltes für die Frontendausgabe angegeben werden.</p>
                        <em>Im Backend wird diese Information nur ausgegeben sofern <i>"volle Browserbreite"</i> ausgewählt ist.</em>
                      </div>');
        $mform->addSelectField("$id.0.container", array(
            'container'  => 'so breit wie der Inhalt',
            'container-fluid'  => 'volle Browserbreite'
        ), array('label' => 'Breite'));
        echo $mform->show();
    }

    function container_output($container)
    {
        $fe_output = [];
        $be_output = [];

        $fe_output[] = $container;

        if ($container == 'container_fluid') {

            $be_output[] = '
      <legend>Breite des Inhaltes</legend>
      <div class="form-group">
        <div class="col-sm-4 label_left">Breite</div>
        <div class="col-sm-8">volle Browserbreite</div>
      </div>';
        }
        if (!rex::isBackend()) {
            return implode($fe_output);
        } else {
            return implode($be_output);
        }
    }


    ////////////////////////////////////
    //  ID / Class
    ////////////////////////////////////
    function id_class_input($id)
    {
        $mform = new MForm();
        $mform->addFieldset('ID / Klassen(n) <i class="module_help_link fa fa-exclamation-triangle" aria-hidden="true"></i>');
        $mform->addHtml('<div class="module_help_content">
                        <p>Hier können individuelle IDs und Klassen vergeben werden.</p>
                        <p><em>Sollten Sie nicht sehr genau wissen was damit gemeint ist fragen Sie Ihren Webentwickler.</em></p>
                      </div>');

        if ($id == "5") {
            $mform->addHtml('<div class="col-sm-12">');
            $mform->addTextField("$id.0.container_id", array('label' => 'Container ID'));
            $mform->addHtml('</div>');

            $mform->addHtml('<div class="col-sm-12">');
            $mform->addTextField("$id.0.row_class", array('label' => 'Row Klasse(n)'));
            $mform->addHtml('</div>');

        } else {
            $mform->addHtml('<div class="col-sm-12">');
            $mform->addTextField("$id.0.col_id", array('label' => 'Col ID'));
            $mform->addHtml('</div>');
        }

        $mform->addHtml('<div class="col-sm-12">');
        $mform->addTextField("$id.0.col_class", array('label' => 'Col Klasse(n)'));
        $mform->addHtml('</div>');
        echo $mform->show();
    }



////////////////////////////////////
//  Headline
////////////////////////////////////
    function headline_input($id, $mform)
    {
        $mform->addFieldset('Überschrift <i class="module_help_link fa fa-exclamation-triangle" aria-hidden="true"></i>', array(
            'class' => 'headline',
            'style' => 'display:none;'
        ));
        $mform->addHtml('<div class="module_help_content">
            <p>H1 wird für die Hauptüberschrift benutzt und darf nur einmal auf jeder Seite (am besten am Anfang) vorkommen. Die anderen Überschriften werden zur Gliederung des Dokumentes (wie bei einem Aufsatz) benutzt und folgen in logischer Reihenfolge.</p>
            <p>Zum Beispiel können auf eine H2 Überschrift also mehrere H3 Überschriften folgen, nicht aber eine H4. Diese sollen lediglich einen Abatz nach H3 kennzeichen.</p>
          </div>');
        $mform->addTextField("$id.0.headline_text", array('label' => 'Überschrift '));
        $mform->addSelectField("$id.0.headline_size", array(
            '' => 'Bitte wählen',
            1 => 'H1 - Nur einmal pro Seite nutzen!',
            2 => 'H2',
            3 => 'H3',
            4 => 'H4',
            5 => 'H5',
            6 => 'H6'
        ), array('label' => 'Art'));
    }

    function headline_output($headline_text, $headline_size)
    {
        $fe_output = [];
        $be_output = [];

        if ($headline_text == '' OR $headline_size == '') {
            $be_output[] = '<legend>Überschrift</legend>
              <div class="alert alert-danger">
                <p><strong>Die Überschrift wird auf der Webseite nicht angezeigt!</strong></p>
                <p>Bitte füllen Sie alle Felder aus!</p>
              </div>';
        } else {
            $be_output[] = '<legend>Überschrift</legend>
              <div class="form-group">
                <div class="col-sm-3 label_left">Überschrift</div>
                <div class="col-sm-9">' . $headline_text . '</div>
                <div class="col-sm-3 label_left">Art</div>
                <div class="col-sm-9">H' . $headline_size . '</div>
              </div>';
            $fe_output[] = '<h' . $headline_size . '>' . $headline_text . '</h' . $headline_size . '>';
        }
        if (!rex::isBackend()) {
            return implode($fe_output);
        } else {
            return implode($be_output);
        }
    }

    ////////////////////////////////////
    //  Textarea
    ////////////////////////////////////
    function textarea_input($id, $mform)
    {

        $bsh = NEW rex_das_modul_helper();
        $texteditor = $bsh->check_editor();

        $mform->addFieldset('Text <i class="module_help_link fa fa-exclamation-triangle" aria-hidden="true"></i>', array(
            'class' => 'textarea',
            'style' => 'display:none;'
        ));
        $mform->addHtml('<div class="module_help_content">
                            <p>Ja. Der Text in dem Editor wird nicht wie auf der Webseite dargestellt. Das ist Absicht :-).</p>
                            <p><em>Falls Sie Fragen zur Benutzung des Editors haben wenden Sie sich bitte an Ihren Webentwickler.</em></p>
                          </div>');
        $mform->setAttribute('default-class', false);
        if ($texteditor == 'markitup') {
            $mform->addTextAreaField("$id.0.textarea_content", array(
                'label' => 'Text',
                'class' => "markitupEditor-simple",
                'id' => 'value-00' . $id
            ));
        }
        if ($texteditor == 'redactor2') {
            $mform->addTextAreaField("$id.0.textarea_content", array(
                'label' => 'Text',
                'class' => "redactorEditor2-simple",
                'id' => 'redactor2_00' . $id
            ));
        }
        if ($texteditor == 'tinymce4') {
            $mform->addTextAreaField("$id.0.textarea_content", array(
                'label' => 'Text',
                'class' => "tinyMCEEditor",
                'id' => 'tinyMCEEditor_00' . $id
            ));
        }

    }

    function textarea_output($textarea)
    {
        $bsh = NEW rex_das_modul_helper();
        $texteditor = $bsh->check_editor();

        $fe_output = [];
        $be_output = [];
        $text = '';
        if ($textarea != '') {

            if ($texteditor == 'markitup') {
                $text = markitup::parseOutput('textile', $textarea);
            } else if ($texteditor == 'redactor2') {
                $text = html_entity_decode($textarea);
            } else if ($texteditor == 'tinymce4') {
                $text = html_entity_decode($textarea);
            }


            $fe_output[] = $text;
            $be_output[] = '
            <legend>Text</legend>
            <div class="form-group">
              <div class="col-sm-3 label_left">Text</div>
              <div class="col-sm-9">' . $text . '</div>
            </div>';
            if (!rex::isBackend()) {
                return implode($fe_output);
            } else {
                return implode($be_output);
            }
        }

    }


////////////////////////////////////
//  Video (extern)
////////////////////////////////////
    function video_input($id, $mform)
    {
        $mform->addFieldset('Film (extern) <i class="module_help_link fa fa-exclamation-triangle" aria-hidden="true"></i>', array(
            'class' => 'video',
            'style' => 'display:none;'
        ));
        $mform->addHtml('<div class="module_help_content">
            <p>In dem Eingabefeld "Film-ID" bitte nur die ID des Videos eingeben<br><br>
            Beispiel:</p>
            <ul>
            <li>YouTube: https://www.youtube.com/watch?v=<b>jsbhA64PvwA</b></li>
            <li>Vimeo: https://vimeo.com/<b>142260520</b></li>
            </ul>
            <br/>
            <p>Bitte beachten Sie die DSGVO. Bei den Youtube Filmen sollte der Punkt "Erweiterten Datenschutzmodus aktivieren" aktiviert sein. Hier wird der Film von dem youtube-nocookie.com Server geladen.</p><p>Vimeo: keine Ahnung :-)</p> 
          </div>');

        $mform->addTextField("$id.0.video_id", array('label' => 'Film-ID '));
        $mform->addSelectField("$id.0.video_service", array(
            '' => 'Bitte wählen',
            1 => 'YouTube',
            2 => 'Vimeo'
        ), array('label' => 'Anbieter'));
    }

    function video_output($video_id, $video_service)
    {
        $fe_output = [];
        $be_output = [];

        if ($video_id == '' OR $video_service == '') {
            $be_output[] = '<legend>Video</legend>
              <div class="alert alert-danger">
                <p><strong>Es wird kein Video auf der Webseite angezeigt!</strong></p>
                <p>Bitte füllen Sie alle Felder aus!</p>
              </div>';
        } else {
            if ($video_service == '1') {
                $fe_output[] = '
          <div class="responsive-video">
            <iframe src="https://www.youtube-nocookie.com/embed/' . $video_id . '?rel=0&amp;showinfo=0"
              width="1600" height="900" frameborder="0" webkitAllowFullScreen
              mozallowfullscreen allowFullScreen></iframe>
              </div>' . PHP_EOL;
                $video_service = 'YouTube';
            }
            if ($video_service == '2') {
                $fe_output[] = '
          <div class="responsive-video">
          <iframe src="//player.vimeo.com/video/' . $video_id . '?title=0&amp
          ;byline=0&amp;portrait=0&amp;autoplay=0"
          width="1600" height="900" frameborder="0" webkitAllowFullScreen
          mozallowfullscreen allowFullScreen></iframe>
          </div>' . PHP_EOL;
                $video_service = "Vimeo";
            }
            $be_output[] = '<legend>Video (extern)</legend>
              <div class="form-group">
                <div class="col-sm-3 label_left">Video ID</div>
                <div class="col-sm-9">' . $video_id . '</div>
                <div class="col-sm-3 label_left">Anbieter</div>
                <div class="col-sm-9">' . $video_service . '</div>
              </div>';
        }
        if (!rex::isBackend()) {
            return implode($fe_output);
        } else {
            return implode($be_output);
        }
    }


////////////////////////////////////
//  Downloads
////////////////////////////////////
    function downloads_input($id, $mform)
    {
        $mform->addFieldset('Downloads<i class="module_help_link fa fa-exclamation-triangle" aria-hidden="true"></i>', array(
            'class' => 'downloads',
            'style' => 'display:none;'
        ));
        $mform->addHtml('<div class="module_help_content">
            <p>Hier können mehrer Dateien zum Download ausgegeben werden. Für die Bezeichnung der Links wird der Inhalt aus dem Beschreibungsfeld des Medienpools benutzt.</p>
              </div>');

        $mform->addTextField("$id.0.downloads_headline", array('label' => 'Überschrift'));
        // $mform->addMedialistField(1, array('label' => 'Dateien'));
        $mform->addMedialistField(1, array('types'=>'gif,jpg','preview'=>1), 1, array('label'=>'Label Name'));


    }

    function downloads_output($downloads_headline, $REX_MEDIALIST_1)
    {
        $fe_output = [];
        $be_output = [];

        if ($REX_MEDIALIST_1 == '') {
            $be_output[] = '<legend>Downloads</legend>
              <div class="alert alert-danger">
                <p><strong>Es werden keine Downloads auf der Webseite zur Verfügung gestellt.</strong></p>
                <p>Bitte wählen Sie midestens eine Datei aus!</p>
              </div>';
        } else {
            if ($downloads_headline != '') {
                $fe_output[] = '
          Download Headline' . PHP_EOL;
            }
            if ($REX_MEDIALIST_1 != '') {


                if (!function_exists('datei_groesse')) {
                    function datei_groesse($URL)
                    {
                        $groesse = filesize($URL);
                        if ($groesse < 1000) {
                            return number_format($groesse, 0, ",", ".") . " Bytes";
                        } elseif ($groesse < 1000000) {
                            return number_format($groesse / 1024, 0, ",", ".") . " kB";
                        } else {
                            return number_format($groesse / 1048576, 0, ",", ".") . " MB";
                        }
                    }
                }

                if (!function_exists('parse_icon')) {
                    function parse_icon($ext)
                    {
                        switch (strtolower($ext)) {
                            case 'doc':
                                return '<i class="fa fa-file-word-o"></i>&nbsp;';
                            case 'pdf':
                                return '<i class="fa fa-file-pdf-o"></i>&nbsp;';
                            case 'zip':
                                return '<i class="fa fa-archive-pdf-o"></i>&nbsp;';
                            case 'jpg':
                                return '<i class="fa fa-file-image-o"></i>&nbsp;';
                            case 'png':
                                return '<i class="fa fa-file-image-o"></i>&nbsp;';
                            case 'gif':
                                return '<i class="fa fa-file-image-o"></i>&nbsp;';
                            default:
                                return '';
                        }
                    }
                }
                $arr = explode(",", $REX_MEDIALIST_1);
                $download_be_dateien = '';
                $download_fe_dateien = '';

                foreach ($arr as $value_dl) {
                    $extension = substr(strrchr($value_dl, '.'), 1);
                    $parsed_icon = parse_icon($extension);
                    $downloadmedia = rex_media::get($value_dl);
                    $file_desc = $downloadmedia->getValue('med_description');

                    $download_fe_dateien .= '<li><a href="index.php?rex_media_type=download&rex_media_file=' . $value_dl . '">' . $parsed_icon;
                    $download_be_dateien .= $value_dl . '<br/>';

                    if ($file_desc != "") {
                        $download_fe_dateien .= $file_desc;
                    } else {
                        $download_fe_dateien .= $value_dl;
                    }

                    $download_fe_dateien .= ' (' . datei_groesse(rex_path::media($value_dl)) . ')</a></li>';
                }
                $fe_output[] = '<ul class="download" >' . $download_fe_dateien . '</ul>';
            }
            $be_output[] = '<legend>Downloads</legend>
              <div class="form-group">
                <div class="col-sm-3 label_left">Überschrift</div>
                <div class="col-sm-9">' . $downloads_headline . '</div>
                <div class="col-sm-3 label_left">Dateie(n)</div>
                <div class="col-sm-9">' . $download_be_dateien . '</div>
              </div>';
        }
        if (!rex::isBackend()) {
            return implode($fe_output);
        } else {
            return implode($be_output);
        }
    }


////////////////////////////////////
//  Link
////////////////////////////////////
    function link_input($id, $mform)
    {
        $mform->addFieldset(
            'Link (intern / extern)<i class="module_help_link fa fa-exclamation-triangle" aria-hidden="true"></i>',
            array(
                'class' => 'link',
                'style' => 'display:none;'
            )
        );
        $mform->addHtml('<div class="module_help_content">
      <p>Es kann nur eine interner ODER ein externer Link angegeben werden.</p>
      <p><em>Sollten Sie nicht wissen, was mit "Darstellung" oder "CSS Klasse" gemeint ist fragen Sie Ihren Webentwickler.</em></p>
      </div>');
        $mform->addTextField("$id.0.link_name", array('label' => 'Bezeichnung'));
        $mform->addTextField("$id.0.link_extern", array('label' => 'Link extern'));
        $mform->addLinkField(1, array('label' => 'Link intern'));
        $mform->addSelectField(
            "$id.0.link_type",
            array(
                'Normal' => 'Normal',
                'Button' => 'Button'
            ),
            array(
                'label' => 'Darstellung'
            )
        );
        $mform->addTextField("$id.0.link_class", array('label' => 'CSS Klasse'));
    }

    function link_output($link_name, $link_extern, $REX_LINK_1, $link_type, $link_class)
    {
        $fe_output = [];
        $be_output = [];

        $be_output[] = '<legend>Link (intern / extern)</legend>';

        if ($link_name == '') {
            $be_output[] = '
              <div class="alert alert-danger">
                <p><strong>Bitte geben Sie unbedingt eine Link Bezeichnung an!</strong></p>
              </div>';
        }


        if ($link_extern == '' AND $REX_LINK_1 == '') {
            $be_output[] = '<div class="alert alert-danger">
                <p><strong>Es wird kein Link ausgegeben. Bitte geben Sie einen Link an!</strong></p>
              </div>';
        } else if ($link_extern != '' AND $REX_LINK_1 != '') {
            $be_output[] = '
              <div class="alert alert-danger">
                <p><strong>Es wird kein Link ausgegeben. Bitte geben Sie nur einen externen ODER einen internen Link an!</strong></p>
              </div>';

        } else {


            $be_output[] = '<div class="form-group">';

            if ($link_name != '') {
                $be_output[] = '
         <div class="col-sm-3 label_left">Bezeichnung</div>
         <div class="col-sm-9">' . $link_name . '</div>';
            }

            if ($link_extern != '') {
                $be_output[] = '
                <div class="col-sm-3 label_left">extern</div>
                <div class="col-sm-9">' . $link_extern . '</div>';

            }

            if ($link_class != '') {
                $linkclass = $link_class;
            } else {
                $link_class = '';
            }

            if ($link_extern != '') {
                $url = $link_extern;
            } else {
                $url = rex_geturl($REX_LINK_1, rex_clang::getCurrentId());
            }


            if ($link_type == 'Button') {
                $fe_output[] = '<a class="btn btn-primary ' . $link_class . '" href="' . $url . '" role="button" >' . $link_name . '</a>';
            } else {
                $fe_output[] = '<a class="' . $link_class . '" href="' . $url . '" >' . $link_name . '</a>';
            }


            if ($REX_LINK_1 != '') {
                $article = rex_article::get($REX_LINK_1);
                $name = $article->getName();
                $be_output[] = '
          <div class="col-sm-3 label_left">Link intern</div>
          <div class="col-sm-9">   <a href="index.php?page=content&article_id=' . $REX_LINK_1 . '&mode=edit">' . $name . ' (ID = ' . $REX_LINK_1 . ')</a> </div>';
            }
            $be_output[] = '
          <div class="col-sm-3 label_left">Darstellung</div>
          <div class="col-sm-9">' . $link_type . '</div>';

            if ($link_class != '') {
                $be_output[] = '
         <div class="col-sm-3 label_left">CSS Klasse</div>
         <div class="col-sm-9">' . $link_class . '</div>';
            }

            $be_output[] = '
       </div>';
        }
        if (!rex::isBackend()) {
            return implode($fe_output);
        } else {
            return implode($be_output);
        }
    }

////////////////////////////////////
//  Image
////////////////////////////////////
    function image_input($id, $mform)
    {
        $mform->addFieldset('Bild <i class="module_help_link fa fa-exclamation-triangle" aria-hidden="true"></i>', array(
            'class' => 'image',
            'style' => 'display:none;'
        ));
        $mform->addHtml('<div class="module_help_content">
            <p>Hier kann ein Bild (inkl. einem internen Link) ausgegeben werden. Der Alt Text für das Bild wird aus dem Titel Feld des Medienpools generiert. </p>
          </div>');

        $mform->addMediaField(2, array('label' => 'Bild'));
        $mform->addLinkField(2, array('label' => 'Link intern'));

    }

    function image_output($image, $link)
    {  // $image,$title, $alt, $link
        $fe_output = [];
        $be_output = [];

        if ($image == '') {
            $be_output[] = '<legend>Bild</legend>
              <div class="alert alert-danger">
                <p><strong>Es wird kein Bild auf der Webseite angezeigt.!</strong></p>
                <p>Bitte geben Sie ein Bild an!</p>
              </div>';
        } else {
            $be_output[] = '<legend>Bild</legend>
              <div class="form-group">
				<div class="col-sm-3 label_left">Bild</div>
				<div class="col-sm-9">' . $image . '
					<br/><br/>
             		<img src="index.php?rex_media_type=rex_mediapool_preview&rex_media_file=' . $image . '" />
             		</div>';

            if ($link != '') {
                $article = rex_article::get($link);
                $name = $article->getName();
                $be_output[] = '<div class="col-sm-3 label_left">Link</div>
                				<div class="col-sm-9"><a href="index.php?page=content&article_id=\'.$REX_LINK_1.\'&mode=edit">' . $name . ' (ID = ' . $link . ')</a> </div>
                				';
            }
            $be_output[] = '</div>';

            if ($link != '') {
                $link_start = '<a href="' . rex_geturl($link, rex_clang::getCurrentId()) . '">';
                $link_end = '</a>';
            } else {
                $link_start = '';
                $link_end = '';
            }

            $file = rex_media::get($image);
            $copyright = $file->getValue('copyright');

            if (rex_addon::get('media_manager_plus')->isAvailable()) {

                $mmpimage = media_manager_plus::generatePictureTag('standard', $image);
                $fe_output[] = $link_start . $mmpimage . $link_end;

            } else {
                $standardimg = '<img src="index.php?rex_media_type=standard&rex_media_file=' . $image . '">';
                $fe_output[] = $link_start . $standardimg . $link_end;
            }

            if ($copyright != '') {
                $fe_output[] = '<div class="copyright">{{ Copyright}} ' . $copyright . '</div>';
            }
        }
        if (!rex::isBackend()) {
            return implode($fe_output);
        } else {
            return implode($be_output);
        }
    }




    ////////////////////////////////////
    //  Space
    ////////////////////////////////////
    function space_input($id, $mform)
    {
        $mform->addFieldset('Abstand <i class="module_help_link fa fa-exclamation-triangle" aria-hidden="true"></i>', array(
            'class' => 'space',
            'style' => 'display:none;'
        ));
        $mform->addHtml('<div class="module_help_content">
	            <p>Hier kann ein Abstand in Pixel angegeben werden. Wird kein Wert eingegeben wird ein Wert von 30px benutzt.</p>
	          </div>');
        $mform->addTextField("$id.0.space_size", array('label' => 'Abstand in px'));
        $mform->addSelectField("$id.0.space_image", array(
            'nein' => 'nein',
            'ja' => 'ja'
        ), array('label' => 'Grafik'));
        $mform->addSelectField("$id.0.space_line", array(
            'nein' => 'nein',
            'ja' => 'ja'
        ), array('label' => 'Linie'));
    }

    function space_output($space_size,$space_linie,$space_image )
    {
        $fe_output = [];
        $be_output = [];
        $divider_class_line  = '';
        $divider_class_image = '';
        $lineandimage        = '';
        $image               = '';

        if ($space_size == '') {
            $space_size = '30';
        }
        $space_size2 = ($space_size/2)-17;

        if ($space_image == 'ja') {
            $divider_class_image = 'image';
            $image         = '<img src="index.php?rex_media_type=trenner&rex_media_file=trenner.png" width="30" height="30" alt="divider">';
        }
        if ($space_linie == 'ja') {
            $divider_class_line = ' line';
        }
        if ($space_image == 'ja' && $space_linie == 'ja') {
            $lineandimage = ' both';
        }

        $be_output[] = '<legend>Abstand</legend>
	              <div class="form-group">
	                <div class="col-sm-3 label_left">Abstand</div>
	                <div class="col-sm-9">' . $space_size . ' px</div>
	              </div>
	              <div class="form-group">
	                <div class="col-sm-3 label_left">Grafik anzeigen</div>
	                <div class="col-sm-9">' . $space_image . '</div>
                  </div>
	              <div class="form-group">
	                <div class="col-sm-3 label_left">Linie anzeigen</div>
	                <div class="col-sm-9">'.$space_linie.'</div>
	              </div>';
        $fe_output[] = '
                <div class="trenner '.$divider_class_image.$divider_class_line.$lineandimage.'" style="height: '.$space_size.'px;">
                    <span style="top: '.$space_size2.'px">'.$image.'</span>
                </div>
                ';

        if (!rex::isBackend()) {
            return implode($fe_output);
        } else {
            return implode($be_output);
        }
    }



////////////////////////////////////
//  Card
////////////////////////////////////
    function card_input($id, $mform)
    {

        $bsh = NEW rex_das_modul_helper();
        $texteditor = $bsh->check_editor();

        $mform->addFieldset('Card (Teaser) <i class="module_help_link fa fa-exclamation-triangle" aria-hidden="true"></i>', array(
            'class' => 'card',
            'style' => 'display:none;'
        ));
        $mform->addHtml('<div class="module_help_content">
            <p>In den Einstellungen des Moduls kann die Klasse <b>grid-equalHeight</b> vergeben. Dann werden alle Teaser gleich hoch ausgegeben.</p>
          </div>');

        $mform->addMediaField(1, array('label' => 'Bild'));
        $mform->addTextField("$id.0.card_title", array( 'label' => 'Überschrift'));

        if ($texteditor == 'markitup') {
            $mform->addTextAreaField("$id.0.card_content", array(
                'label' => 'Text',
                'class' => "markitupEditor-simple",
                'id' => 'value-00' . $id
            ));
        }
        if ($texteditor == 'redactor2') {
            $mform->addTextAreaField("$id.0.card_content", array(
                'label' => 'Text',
                'class' => "redactorEditor2-simple",
                'id' => 'redactor2_00' . $id
            ));
        }

        $mform->addLinkField(3, array('label' => 'Link intern'));
        $mform->addTextField("$id.0.card_link_title", array( 'label' => 'Bezeichnung'));
    }

    function card_output($image, $headline, $content, $link, $card_link_title)
    {
        $fe_output = [];
        $be_output = [];

        $bsh = NEW rex_das_modul_helper();
        $texteditor = $bsh->check_editor();

        if ($link != '') {
            $link_start = '<a href="' . rex_geturl($link, rex_clang::getCurrentId()) . '">';
            $link_end = '</a>';
        } else {
            $link_start = '';
            $link_end = '';
        }

        $be_output[] = '<legend>Card (Teaser)</legend>';
        $fe_output[] = '<div class="card">'.$link_start;


        if ($image != '') {

            $be_output[] = '
                    <div class="form-group">
				        <div class="col-sm-3 label_left">Bild</div>
				            <div class="col-sm-9">' . $image . '
					        <br/><br/>  
             		        <img src="index.php?rex_media_type=rex_mediapool_preview&rex_media_file=' . $image . '" />
             		    </div>
             		</div>';


            if (rex_addon::get('media_manager_plus')->isAvailable()) {
                $image = media_manager_plus::generatePictureTag('card', $image);
            } else {
                $image = '<img src="index.php?rex_media_type=card&rex_media_file=' . $image . '">';
            }

            $fe_output[] = '<div class="card-img">'.$image.'</div>';

            $noimage = '';
        } else {
            $noimage = ' noimage';
        }

        if ($headline != '' OR $content != '') {
            $fe_output[] = '<div class="card-caption'.$noimage.'">';
        }

        if ($headline != '') {
            $be_output[] = '
                    <div class="form-group">
                        <div class="col-sm-3 label_left">Überschrift</div>
                        <div class="col-sm-9">' . $headline . '</div>
                    </div>';
            $fe_output[] = '<h5>' . $headline . '</h5>';
        }

        if ($content != '') {
            if ($texteditor == 'markitup') {
                $text = markitup::parseOutput('textile', $content);
            } else if ($texteditor == 'redactor') {
                $text = html_entity_decode($content);
            }

            $be_output[] = '
                    <div class="form-group">
                        <div class="col-sm-3 label_left">Text</div>
                        <div class="col-sm-9">' . $content . '</div>
                     </div>';
            $fe_output[] = $text;
        }

        if ($headline != '' OR $content != '') {
            $fe_output[] = '</div>';
        }

        if ($link != '') {
            $article = rex_article::get($link);
            $name = $article->getName();
            $be_output[] = '
                    <div class="form-group">
                        <div class="col-sm-3 label_left">Link</div>
                		<div class="col-sm-9"><a href="index.php?page=content&article_id=\'.$REX_LINK_1.\'&mode=edit">'.$name.' (ID = ' . $link . ')</a></div>
                	</div>';
        }

        if ($card_link_title != '') {
            $be_output[] = '
                    <div class="form-group">
                        <div class="col-sm-3 label_left">Linkbezeichnung</div>
                        <div class="col-sm-9">' . $card_link_title . '</div>
                     </div>';
            $fe_output[] = '<div class="readmore">'.$card_link_title.'</div>';
        }



        $fe_output[] = $link_end.'</div>';


        if (!rex::isBackend()) {
            return implode($fe_output);
        } else {
            return implode($be_output);
        }
    }




////////////////////////////////////
//  Modal
////////////////////////////////////
    function modal_input($id, $mform)
    {
        $mform->addFieldset(
            'Artikel im Modal öffnen<i class="module_help_link fa fa-exclamation-triangle" aria-hidden="true"></i>',
            array(
                'class' => 'artikel_modal',
                'style' => 'display:none;'
            )
        );
        $mform->addHtml('<div class="module_help_content">
      <p>Modal</p>
      </div>');
        $mform->addTextField("$id.0.modal_headline", array('label' => 'Überschrift'));
        $mform->addLinkField(1, array('label' => 'Artikel'));
        $mform->addTextField("$id.0.modal_link_bezeichnung", array('label' => 'Linkbezeichnung'));
        $mform->addSelectField(
            "$id.0.modal_link_type",
            array(
                'Normal' => 'Normal',
                'Button' => 'Button'
            ),
            array(
                'label' => 'Darstellung des Links'
            )
        );
        $mform->addSelectField(
            "$id.0.modal_print",
            array(
                'ja'   => 'ja',
                'nein' => 'nein'
            ),
            array(
                'label' => 'Drucken Link anzeigen'
            )
        );
    }

    function modal_output($headline, $REX_LINK_1, $link_name, $modal_link_type, $print)
    {
        $fe_output = [];
        $be_output = [];
        $rand = '';

        $be_output[] = '<legend>Artikel im Modal öffnen</legend>';

        if ($REX_LINK_1 == '' OR $link_name == '') {
            $be_output[] = '
              <div class="alert alert-danger">
                <p><strong>Es wird kein Link ausgegeben. Bitte geben Sie einen Link und eine Linkbezeichnung an!</strong></p>
              </div>';

        }  else {

            $rand = rand(0,10000);
            $be_output[] = '<div class="form-group">';

            if ($link_name != '') {
                $be_output[] = '
                    <div class="col-sm-3 label_left">Bezeichnung</div>
                    <div class="col-sm-9">' . $link_name . '</div>';
            }

            $url = rex_geturl($REX_LINK_1, rex_clang::getCurrentId());

            if ($modal_link_type == 'Button') {
                $fe_output[] = '<a href="javascript:void(0);" class="btn btn-primary open-modal" data-modal="#modal-'.$rand.'">' . $link_name . '</a>';
            } else {
                $fe_output[] = '<a href="javascript:void(0);" class="open-modal" data-modal="#modal-'.$rand.'">' . $link_name . '</a>';
            }

            if (rex_article::get($REX_LINK_1) != '') {
                $art = rex_article::get($REX_LINK_1);
                $article = new rex_article_content($art->getId() , $art->getClang());
                $article_content = $article->getArticle(1);
            } else {
                $article_content = '';
            }
            if($headline != '') {
                $headline = '<div class="headline">'.$headline.'</div>';
            } else {
                $headline = '';
            }
            if($print == 'ja') {
                $print = '<li><a class="print-modal" data-modal="#modal" onclick="printDiv(\'print'.$rand.'\',\'Überschrift\')" ><span>Inhalt drucken</span></a></li>';
            } else {
                $print = '';
            }
            $fe_output[]  = '
            <div class="modal-overlay">
                <div class="modal" id="modal-'.$rand.'">
                    <div class="modalnav">
                        '.$headline.'
                    <ul>
                        '.$print.'
                        <li><a class="close-modal" data-modal="#modal" href="javascript:void(0);"><span>Fenster schließen</span></a></li>
                    </ul>
                </div>
                <div class="modal-content" id="print'.$rand.'">
                    '.$article_content.'
                </div>
                </div>
            </div>';

            if ($REX_LINK_1 != '') {
                if (rex_article::get($REX_LINK_1) !='') {

                    $article = rex_article::get($REX_LINK_1);
                    $name = $article->getName();
                }

                $be_output[] = '
          <div class="col-sm-3 label_left">Artikel</div>
          <div class="col-sm-9">   <a href="index.php?page=content&article_id=' . $REX_LINK_1 . '&mode=edit">' . $name . ' (ID = ' . $REX_LINK_1 . ')</a> </div>';
            }
            $be_output[] = '
          <div class="col-sm-3 label_left">Darstellung</div>
          <div class="col-sm-9">' . $modal_link_type . '</div>';

            $be_output[] = '
          <div class="col-sm-3 label_left">Drucken Link anzeigen</div>
          <div class="col-sm-9">' . $print . '</div>';


            $be_output[] = '
       </div>';
        }
        if (!rex::isBackend()) {
            return implode($fe_output);
        } else {
            return implode($be_output);
        }
    }


////////////////////////////////////
//  Unite Gallery
////////////////////////////////////
    function unite_gallery($id, $mform)
    {

        $bsh = NEW rex_das_modul_helper();

        $mform->addFieldset('Gallery / Carousel / Slider (Unite Gallery) <i class="module_help_link fa fa-exclamation-triangle" aria-hidden="true"></i>', array(
            'class' => 'unite_gallery',
            'style' => 'display:none;'
        ));
        $mform->addHtml('<div class="module_help_content">
            <p><b>Art der Galerie</b><br/>Einfach mal ausprobieren und angucken :-)</p>
            <p><b>Breite der Galerie</b><br/>Ändert die Breite der Galerie. 100% Browserbreite ist nicht möglich sofern es eine Seitenleiste (Inhalt / Navigation) im Content gibt.</p>
            <p><b>Breite der Bilder</b><br/>Aus dieser Angabe ergibt sich die Breite der Bilder. Sofern kein Wert angegeben wird wird eine Höhe von 200px benutzt.</p>
            <p><b>Höhe der Bilder</b><br/>Aus dieser Angabe ergibt sich die Höhe der Bilder. Sofern kein Wert angegeben wird wird eine Höhe von 200px benutzt.</p>
            <p><b>Carousel</b><br/>Gibt die Bilder in einem Carousell aus.</p>
          </div>');

        $mform->addMedialistField(1, array('label' => 'Bilder'));

        $mform->addSelectField(
            "$id.0.unite_gallery_art",
            array(
                'columns'=>'Tiles - Columns',
                'justified'=>'Tiles - Justified',
                'nested'=>'Tiles - Nested',
                'grid'=>'Tiles Grid',
                'carousel'=>'Carousel',
                'slider'=>'Slider'
            ),
            array(
                'label' => 'Art'
            )
        );

        $mform->addTextField("$id.0.unite_gallery_img_width", array( 'label' => 'Breite der Bilder'));
        $mform->addTextField("$id.0.unite_gallery_img_height", array( 'label' => 'Höhe der Bilder'));
    }

    function unite_gallery_output($REX_MEDIALIST_1,$art,$img_width,$img_height)
    {
        $fe_output = [];
        $be_output = [];

        $be_output[] = '<legend>Gallery / Carousel / Slider (Unite Gallery)</legend>';

        if ($REX_MEDIALIST_1 == '') {
            $be_output[] = '
              <div class="alert alert-danger">
                <p><strong>Es werden keine Bilder auf der Webseite ausgegeben.</strong></p>
                <p>Bitte wählen Sie midestens ein paar Bilder aus!</p>
              </div>';
        } else {

            $arr = explode(",", $REX_MEDIALIST_1);
            $galerie_be_dateien = '';
            $galerie_fe_dateien = '';

            foreach ($arr as $value_media) {
                $media      = rex_media::get($value_media);
                $file_desc  = $media->getValue('med_description');

                $galerie_be_dateien .= $value_media . '<br/>';
            }

            $be_output[] = '
              <div class="form-group">
                <div class="col-sm-3 label_left">Builder</div>
                <div class="col-sm-9">' . $galerie_be_dateien . '</div>
              </div>';

            if ($img_height  == '') { $img_height  = "200"; }
            if ($img_width == '')   { $img_width = "200"; }

            $art_output = '';
            $class      = '';
            $js         = '';
            switch ($art) {
                case 'columns':
                    $art_output = 'Tiles - Columns';
                    $img_height = 'Angabe wird ignoriert';
                    $class  = 'columns';
                    $js     = 'gallery_theme: "tiles",
                               tiles_col_width: '.$img_width.'';
                    break;
                case 'justified':
                    $art_output = 'Tiles - Justified';
                    $img_width = 'Angabe wird ignoriert';
                    $class  = 'justified';
                    $js     = 'gallery_theme: "tiles",
                               tiles_type: "justified",
                               tiles_justified_row_height: '.$img_height.'';
                    break;
                case 'nested':
                    $art_output = 'Tiles - Nested';
                    $img_height = 'Angabe wird ignoriert';
                    $class  = 'nested';
                    $js     = 'gallery_theme: "tiles",
                               tiles_type: "nested",
                               tiles_nested_optimal_tile_width: '.$img_width.'';
                    break;
                case 'grid':
                    $art_output = 'Tiles Grid';
                    $class  = 'grid';
                    $js     = 'gallery_theme: "tilesgrid",
                               tile_width: '.$img_width.',
                               tile_height: '.$img_height.'';
                    break;
                case 'carousel':
                    $art_output = 'Carousel';
                    $js     = 'gallery_theme: "carousel",
                               tile_width: '.$img_width.',
                               tile_height: '.$img_height.'';
                    break;
                case 'slider':
                    $art_output = 'Slider';
                    $img_width = 'Angabe wird ignoriert';
                    $img_height = 'Angabe wird ignoriert';
                    $js     = 'gallery_theme: "slider"';
                    break;
                default:
                    $art_output = 'Keine Angabe?';
            }


            $rand = '';
            $rand = rand(0,100000);
            $fe_output[] = '
                <div id="unite_gallery"><div id="galerie'.$rand.'" class="'.$class.'" style="display:block;">';

            foreach ($arr as $value_media) {
                $media = rex_media::get($value_media);
                $mediatitle  = $media->getValue('title');
                $mediadesc   = str_replace(array("\r\n", "\n", "\r"), ' ', $media->getValue('med_description'));
                $mediawidth  = $media->getValue('width');
                $mediaheight = $media->getValue('height');
                $fe_output[] = ' <img alt="' . $mediatitle . '" src="index.php?rex_media_type=galerie_thumb&rex_media_file='.$value_media.'" data-image="index.php?rex_media_type=galerie_big&rex_media_file='.$value_media.'" data-description="' . $mediadesc . '">';

            }

            $fe_output[] = '</div></div>';
            $fe_output[] = "
                <script type='text/javascript'>
                    $(document).ready(function(){
                        $('#galerie".$rand."').unitegallery({
                            ".$js."
                        });
                    });
                </script>";


            $be_output[] = '
              <div class="form-group">
                <div class="col-sm-3 label_left">Art</div>
                <div class="col-sm-9">' . $art_output . '</div>
              </div>';

            $be_output[] = '
              <div class="form-group">
                <div class="col-sm-3 label_left">Breite der Bilder</div>
                <div class="col-sm-9">'.$img_width.'</div>
              </div>';

            $be_output[] = '
              <div class="form-group">
                <div class="col-sm-3 label_left">Höhe der Bilder</div>
                <div class="col-sm-9">'.$img_height.'</div>
              </div>';
        }
        if (!rex::isBackend()) {
            return implode($fe_output);
        } else {
            return implode($be_output);
        }
    }
}
