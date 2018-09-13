<?php

/*
MM TYpen werden noch nicht berücksichtigt...
*/

$grid                       = 'REX_VALUE[20]';
$zaehler                    = '1';
$nummer                     = '';
$fullwidth                  = '';
$sectionclass               = '';

$container_id               = '';
$row_class                  = '';
$col_class                  = '';

$values                     = array();
$out                        = '';
$outback                    = array();
$html_block                 = array();

$html_block[1]              = '';
$html_block[2]              = '';
$html_block[3]              = '';
$html_block[4]              = '';

$individuelle_css_klasse[1] = '';
$individuelle_css_klasse[2] = '';
$individuelle_css_klasse[3] = '';
$individuelle_css_klasse[4] = '';

$individuelle_css_id[1]     = '';
$individuelle_css_id[2]     = '';
$individuelle_css_id[3]     = '';
$individuelle_css_id[4]     = '';

$values[1]                  = rex_var::toArray( 'REX_VALUE[1]' );
$values[2]                  = rex_var::toArray( 'REX_VALUE[2]' );
$values[3]                  = rex_var::toArray( 'REX_VALUE[3]' );
$values[4]                  = rex_var::toArray( 'REX_VALUE[4]' );
$values[5]                  = rex_var::toArray( 'REX_VALUE[5]' );

$dm_output                 = NEW rex_das_modul_helper();

$debug                     = false;

if ( rex::isBackend() ) {
    $coreVersion = rex_config::get( 'core', 'version' );
    if ( $debug ) {
        if ( $coreVersion < '5.3.0' ) {
            echo '<pre>';
            print_r( rex_var::toArray( "REX_VALUE[1]" ) );
            print_r( rex_var::toArray( "REX_VALUE[20]" ) );
            echo '</pre>';
        } else {
            echo '<pre>';
            dump( rex_var::toArray( "REX_VALUE[1]" ) );
            dump( rex_var::toArray( "REX_VALUE[2]" ) );
            dump( rex_var::toArray( "REX_VALUE[3]" ) );
            dump( rex_var::toArray( "REX_VALUE[4]" ) );
            dump( rex_var::toArray( "REX_VALUE[20]" ) );
            echo '</pre>';
        }
    }
}

if ( $grid == '12' ) {
    unset( $values[2] );
    unset( $values[3] );
    unset( $values[4] );
}

if ( $grid == '6_6' || $grid == '8_4' || $grid == '4_8' ) {
    unset( $values[3] );
    unset( $values[4] );
}

if ( $grid == '4_4_4' || $grid == '6_3_3' || $grid == '3_6_3' || $grid == '3_3_6' ) {
    unset( $values[4] );
}

if ( $grid == '3_3_3_3' ) {
}

if ( 'REX_VALUE[19]' ) {
    $reihenfolge = explode( ',', 'REX_VALUE[19]' );
} else {
    $reihenfolge = array( '1', '2', '3', '4' );
}

foreach ( $reihenfolge as $nummer ) {
    if ( isset( $values[ $nummer ]) ) {
        $value = $values[ $nummer ];

        if ( $debug ) {
            dump($value);
        }

        $outback[] = '
      <div class="outback das_modul_wrapper">
        <legend>Bereich ' . $zaehler . '</legend>
        <fieldset class="form-horizomtal ">';
        foreach ( $value as $val ) {
            switch ( $val['element'] ) {
                case 'headline':
                    $html_block[$zaehler] .= $dm_output->headline_output( $val['headline_text'], $val['headline_size'] );
                    $outback[]             = $dm_output->headline_output( $val['headline_text'], $val['headline_size'] );
                    break;
                case 'textarea':
                    $html_block[$zaehler] .= $dm_output->textarea_output( $val['textarea_content'] );
                    $outback[]             = $dm_output->textarea_output( $val['textarea_content'] );
                    break;
                case 'downloads':
                    $html_block[$zaehler] .= $dm_output->downloads_output( $val['downloads_headline'],$val['REX_MEDIALIST_1'] );
                    $outback[]             = $dm_output->downloads_output( $val['downloads_headline'],$val['REX_MEDIALIST_1'] );
                    break;
                case 'link':
                    $html_block[$zaehler] .= $dm_output->link_output( $val['link_name'],$val['link_extern'],$val['REX_LINK_1'],$val['link_type'],$val['link_class'] );
                    $outback[]             = $dm_output->link_output( $val['link_name'],$val['link_extern'],$val['REX_LINK_1'],$val['link_type'],$val['link_class'] );
                    break;
                case 'video':
                    $html_block[$zaehler] .= $dm_output->video_output( $val['video_id'],$val['video_service'] );
                    $outback[]             = $dm_output->video_output( $val['video_id'],$val['video_service'] );
                    break;
                case 'card':
                    $html_block[$zaehler] .= $dm_output->card_output( $val['REX_MEDIA_1'],$val['card_title'],$val['card_content'],$val['REX_LINK_3'],$val['card_link_title'] );
                    $outback[]             = $dm_output->card_output( $val['REX_MEDIA_1'],$val['card_title'],$val['card_content'],$val['REX_LINK_3'],$val['card_link_title'] );
                    break;
                case 'image':
                    $html_block[$zaehler] .= $dm_output->image_output( $val['REX_MEDIA_2'],$val['REX_LINK_2'] );
                    $outback[]             = $dm_output->image_output( $val['REX_MEDIA_2'],$val['REX_LINK_2'] );
                    break;
                case 'space':
                    $html_block[$zaehler] .= $dm_output->space_output( $val['space_size'],$val['space_line'],$val['space_image'] );
                    $outback[]             = $dm_output->space_output( $val['space_size'],$val['space_line'],$val['space_image'] );
                    break;
                case 'artikel_modal':
                    $html_block[$zaehler] .= $dm_output->modal_output( $val['modal_headline'],$val['REX_LINK_1'],$val['modal_link_bezeichnung'],$val['modal_link_type'], $val['modal_print']);
                    $outback[]             = $dm_output->modal_output( $val['modal_headline'],$val['REX_LINK_1'],$val['modal_link_bezeichnung'],$val['modal_link_type'], $val['modal_print'] );
                    break;
                case 'unite_gallery':
                    $html_block[$zaehler] .= $dm_output->unite_gallery_output( $val['REX_MEDIALIST_2'],$val['unite_gallery_art'],$val['unite_gallery_img_width'],$val['unite_gallery_img_height']);
                    $outback[]             = $dm_output->unite_gallery_output( $val['REX_MEDIALIST_2'],$val['unite_gallery_art'],$val['unite_gallery_img_width'],$val['unite_gallery_img_height']);
                    break;
            }
        }

        foreach ( $value as $val ) {

            if (isset($val['col_class'])) {
                if ($val['col_class'] != '') {
                    $individuelle_css_klasse[$zaehler] = ' ' . $val['col_class'];
                } else {
                    $individuelle_css_klasse[$zaehler] = '';
                }
            }
            if (isset($val['col_id'])) {
                if ($val['col_id'] != '') {
                    $individuelle_css_id[$zaehler] = ' id="' . $val['col_id'] . '"';
                } else {
                    $individuelle_css_id[$zaehler] = '';
                }
            }

            if ( isset( $val['col_id'], $val['col_class'] ) ) {
                if ( $val['col_id'] != '' OR $val['col_class'] != '' ) {
                    $outback[] = '<legend>Individuelle Einstellungen</legend>';
                }
                if ( $val['col_id'] != '' ) {

                    $outback[] = '
                  <div class="form-group container">
                  <label class="col-sm-3 label_left">Col ID</label>
                      <div class="col-sm-9">
                        ' . $val['col_id'] . '
                      </div>
                  </div>
              ';
                }
                if ( $val['col_class'] != '' ) {
                    $outback[] = '
                  <div class="form-group container">
                  <label class="col-sm-3 label_left">Col Klasse(n)</label>
                      <div class="col-sm-9">
                        '.$val['col_class'].' 
                      </div>
                  </div>';
                }
            }

        }
        $outback[] = '
        </fieldset>
      </div>';
        $zaehler ++;
    }
}

$outback[] = '
  <div class="das_modul_wrapper outback more_settings">
    <legend>Weitere Modul Einstellungen</legend>
    <fieldset class="form-horizontal">';
foreach ( $values[5] as $val ) {
    if ( $val['container'] != '' ) {
        $fullwidth = $val['container'];
        $outback[] = '
          <div class="form-group">
            <label class="col-sm-3 label_left">Breite des Inhaltes</label>
            <div class="col-sm-9">
              Volle Browserbreite
            </div>
          </div>
        ';
    }
    if ($val['container_id']!='') {
        $container_id = 'id="'.$val['container_id'].'"';
        $outback[] = '
          <div class="form-group">
            <label class="col-sm-3 label_left">Container ID</label>
            <div class="col-sm-9">
              ' . $val['container_id'] . '
            </div>
          </div>
        ';
    }
    if ($val['row_class']!='') {
        $row_class = $val['row_class'];
        $outback[] = '
         <div class="form-group">
         <label class="col-sm-3 label_left">Row Klasse(n)</label>
           <div class="col-sm-9">
             ' . $val['row_class'] . '
           </div>
         </div>
       ';
    }
    if ($val['col_class']!='') {
        $col_class = $val['col_class'];
        $outback[] = '
         <div class="form-group">
         <label class="col-sm-3 label_left">Col Klasse(n)</label>
           <div class="col-sm-9">
             ' . $col_class. '
           </div>
         </div>
       ';
    }
}

$outback[] = '
    <div class="form-group" >
      <label class="col-sm-3 label_left">Raster</label>
      <div class="col-sm-9" id="bootstrap_helper_modul_grid">
        <div class="gridimage img' . $grid . '"></div>
      </div>
    </div>
  </fieldset>
</div>
';

switch ($grid) {
    case '12':
        $out .= '
      <div class="col-12 '.$col_class.' '.$individuelle_css_klasse[1].'" '.$individuelle_css_id[1].'>
        '.$html_block[1].'
      </div>'.PHP_EOL;
        break;
    case '6_6':
        $out .= '
      <div class="col-xs-12 col-md-6 '.$col_class.' '.$individuelle_css_klasse[1].'" '.$individuelle_css_id[1].'>
        '.$html_block[1].'
      </div>
      <div class="col-xs-12 col-md-6 '.$col_class.' '.$individuelle_css_klasse[2].'" '.$individuelle_css_id[2].'>
        '.$html_block[2].'
      </div>'.PHP_EOL;
        break;
    case '4_4_4':
        $out .= '
      <div class="col-xs-12 col-md-4 col-lg-4 '.$col_class.' '.$individuelle_css_klasse[1].'" '.$individuelle_css_id[1].'>
        '.$html_block[1].'
      </div>
      <div class="col-xs-12 col-md-4 col-lg-4 '.$col_class.' '.$individuelle_css_klasse[2].'" '.$individuelle_css_id[2].'>
        '.$html_block[2].'
      </div>
      <div class="col-xs-12 col-md-4 col-lg-4 '.$col_class.' '.$individuelle_css_klasse[3].'" '.$individuelle_css_id[3].'>
        '.$html_block[3].'
      </div>'.PHP_EOL;
        break;
    case '3_3_3_3':
        $out .= '
      <div class="col-xs-12 col-md-6 col-lg-3 '.$col_class.' '.$individuelle_css_klasse[1].'" '.$individuelle_css_id[1].'>
        '.$html_block[1].'
      </div>
      <div class="col-xs-12 col-md-6 col-lg-3 '.$col_class.' '.$individuelle_css_klasse[2].'" '.$individuelle_css_id[2].'>
        '.$html_block[2].'
      </div>
      <div class="col-xs-12 col-md-6 col-lg-3 '.$col_class.' '.$individuelle_css_klasse[3].'" '.$individuelle_css_id[3].'>
        '.$html_block[3].'
      </div>
      <div class="col-xs-12 col-md-6 col-lg-3 '.$individuelle_css_klasse[4].'" '.$individuelle_css_id[4].'>
        '.$html_block[4].'
      </div>'.PHP_EOL;
        break;

    case '6_3_3':
        $out .= '
      <div class="col-xs-12 col-md-12 col-lg-6 '.$col_class.' '.$individuelle_css_klasse[1].'" '.$individuelle_css_id[1].'>
        '.$html_block[1].'
      </div>
      <div class="col-xs-12 col-md-6 col-lg-3 '.$col_class.' '.$individuelle_css_klasse[2].'" '.$individuelle_css_id[2].'>
        '.$html_block[2].'
      </div>
      <div class="col-xs-12 col-md-6 col-lg-3 '.$col_class.' '.$individuelle_css_klasse[3].'" '.$individuelle_css_id[3].'>
        '.$html_block[3].'
      </div>'.PHP_EOL;
        break;


    case '3_6_3':
        $out .= '
      <div class="col-xs-12 col-md-6 col-lg-3 '.$col_class.' '.$individuelle_css_klasse[1].'" '.$individuelle_css_id[1].'>
        '.$html_block[1].'
      </div>
      <div class="col-xs-12 col-md-12 col-lg-6 '.$col_class.' '.$individuelle_css_klasse[2].'" '.$individuelle_css_id[2].' >
        '.$html_block[2].'
      </div>
      <div class="col-xs-12 col-md-6 col-lg-3 '.$col_class.' '.$individuelle_css_klasse[3].'" '.$individuelle_css_id[3].'>
        '.$html_block[3].'
      </div>'.PHP_EOL;
        break;

    case '3_3_6':
        $out .= '
      <div class="col-xs-12 col-md-6 col-lg-3 '.$col_class.' '.$individuelle_css_klasse[1].'" '.$individuelle_css_id[1].'>
        '.$html_block[1].'
      </div>
      <div class="col-xs-12 col-md-6 col-lg-3 '.$col_class.' '.$individuelle_css_klasse[2].'" '.$individuelle_css_id[2].'>
        '.$html_block[2].'
      </div>
      <div class="col-xs-12 col-md-12 col-lg-6 '.$col_class.' '.$individuelle_css_klasse[3].'" '.$individuelle_css_id[3].'>
        '.$html_block[3].'
      </div>'.PHP_EOL;
        break;
    case '8_4':
        $out .= '
      <div class="col-xs-12 col-md-8 '.$col_class.' '.$individuelle_css_klasse[1].'" '.$individuelle_css_id[1].'>
        '.$html_block[1].'
      </div>
      <div class="col-xs-12 col-md-4 '.$col_class.' '.$individuelle_css_klasse[2].'" '.$individuelle_css_id[2].'>
        '.$html_block[2].'
      </div>'.PHP_EOL;
        break;
    case '4_8':
        $out .= '
      <div class="col-xs-12 col-md-4 '.$col_class.' '.$individuelle_css_klasse[1].'" '.$individuelle_css_id[1].'>
        '.$html_block[1].'
      </div>
      <div class="col-xs-12 col-md-8 '.$col_class.' '.$individuelle_css_klasse[2].'" '.$individuelle_css_id[2].'>
        '.$html_block[2].'
      </div>'.PHP_EOL;
        break;
}
if ( rex::isBackend() ) {
    echo implode( $outback );
} else {
    echo  '<section '.$container_id.' class="das_modul '.$fullwidth.' "><div class="row '.$row_class.'">'.$out.'</div></section>';
}
