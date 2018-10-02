## ACHTUNG. Die Entwicklung hier pausiert.



> Wer vorab tetsen möchte kann das gerne wie folgt machen:
> Einige Sachen funktionieren noch nicht oder sind noch nicht getestet.
> Issues/Wünsche könnt Ihr trotzdem schon schreiben :-)


> Sollte das Backend (viel) zu langsam sein bitte in der .yml Datei **compile:** auf 0 stellen.


## Das Modul // Codename: _Gensfleisch 1468_

Dieses AddOn installiert das Modul **0000 - Standard** und die zugehörigen Dateien.

Auf einer Einstellungsseite im Modul kann die jeweile Anordung der Inhalte ausgewählt werden (jederzeit änderbar).
Hier gibt es auch die Möglichkeit für den Container, der Row und den Cols IDs und Klassen zu vergeben.
Es besteht zudem die Möglichkeit zu wählen ob der Container fluid sein soll.


---

### Installation / Benutzung

folgt...


---
### Module (eigentlich Funktionen)

**0010 - Überschrift** (headline_input / headline_output)
Hier kann eine Überschrift eingepflegt werden. Zusätzlich ist die Angabe der "Größe" (H1-H6) ist möglich.

---

**0020 - Text** (textarea_input / textarea_output)
Es wird eine Textarea bereitgestellt. Je nach installiertem Editor wird dieser eingebunden. Aktuell funktionieren leider nur die AddOns: _MarkitUp_ und _Tinymce4_ (siehe: https://github.com/FriendsOfREDAXO/redactor2/issues/134)<br/>_Sollten schon Inhalte eingepflegt sein können bei einem Wechsel des Editors alle Formtierungen verloren gehen._

---

**0030 - Bild** (image_input / image_output)
Hier kann ein Bild ausgewählt und intern verlinkt werden.
*CSS: ./assets/addons/das_modul/css/image.css*

---

**0040 - Download** (downloads_input / downloads_output
Dateien können zum Downlad bereitgestellt werden.

Wem der Download Pfad nicht gefällt, der wandelt die .htaccess noch ab:

    RewriteRule ^media/([^/]*)/([^/]*) %{ENV:BASE}/index.php?rex_media_type=$1&rex_media_file=$2&%{QUERY_STRING} [B]

Der Download erfolgt dann über /media/download/dateiname.pdf</p>

Oder:

    RewriteRule ^download/([^/]*) %{ENV:BASE}/index.php?rex_media_type=download&rex_media_file=$1&%{QUERY_STRING} [B]

Der Download erfolgt dann direkt über /download/dateiname.pdf

(Nochmal testen)

---

**0050 - Film (extern)** (video_input / video_output)
Durch die Angabe eine YouTube bz. Vimeo Film ID kann das Video im Fornten dargestellt werden. Hier sollte noch eine DSGVO gerechte Lösung gefunden werden.
*CSS: ./assets/addons/das_modul/css/video.css*

---

**0060 - Link (intern / extern)** (link_input / link_output)

---

**0070 - Card (Teaser)**
Ermöglicht es eine CARD auszugeben (Bild, Text, interner Link). *CSS: ./assets/addons/das_modul/css/cards.css*

---

**0080 - Abstand einfügen**
Es kann ein abstand mir/ohne Grafik/line ausgegeben werden.
*Die Grafiuk liegt hier: ./assets/addons/das_modul/images/divider.png*

---

**0090 - Artikel im Modal öffnen**

---

**0100 - Gallery / Carousel**
Einbindung der Unite Gallery


---

### Sonstige Funktionen

- **check Editor**
Hier wird geprüft welcher Editor installiert ist.<br/>
MarkitUp   - funktioniert
Tinymce4   - funktioniert
CKE5       - funktioniert
Redactor 2 - [funktioniert nicht](https://github.com/FriendsOfREDAXO/redactor2/issues/134)

---

- **container_input**
Funktion um die "Breite" des Containers zu definieren.

---

- **id_class_input**
Funktion für die Eingaben der Klassen und IDs

---

> **Warum _Gensfleisch 1468_**
>
> Nun WordPress bekommt jetzt demnächst den ["Gutenberg" Editor](https://de.wordpress.org/gutenberg/) und die freuen sich grad ´n Ast. Das was der supertolle Gutenberg Editor kann/können wird ist schon lange die Funktionsweise von REDAXO. Vielleicht nicht ganz so fancy. Dieses Modul ermöglicht es dem Redakteur Inhalte modular und im Grid wie beim Gutenberg Editor (geplant) zu pflegen. Nur einfacher :-)
>
> Gutenberg heisst eigentlich "Johannes Gensfleisch" und ist 1468 gestorben... (https://de.wikipedia.org/wiki/Johannes_Gutenberg)


---
<br/>

Test Template:

```<!doctype html>
   <html lang="en">
   <head>
       <meta charset="utf-8">
       <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

       <link rel="stylesheet" href="./assets/addons/das_modul/css/image.css">
       <link rel="stylesheet" href="./assets/addons/das_modul/css/video.css">
       <link rel="stylesheet" href="./assets/addons/das_modul/css/cards.css">
       <link rel="stylesheet" href="./assets/addons/das_modul/css/abstand.css">
       <link rel="stylesheet" href="./assets/addons/das_modul/css/modal.css">
       <!-- <link rel="stylesheet" href="./assets/addons/das_modul/css/unitegallerycss.css"> -->


       <script type='text/javascript' src='./assets/addons/das_modul/vendor/unitegallery/js/jquery-11.0.min.js'></script>
       <script type='text/javascript' src='./assets/addons/das_modul/vendor/unitegallery/js/unitegallery.min.js'></script>

       <link rel='stylesheet' href='./assets/addons/das_modul/vendor/unitegallery/css/unite-gallery.css' type='text/css' />

       <script type='text/javascript' src='./assets/addons/das_modul/vendor/unitegallery/themes/default/ug-theme-default.js'></script>


       <script type='text/javascript' src='./assets/addons/das_modul/vendor/unitegallery/themes/carousel/ug-theme-carousel.js'></script>
       <script type='text/javascript' src='./assets/addons/das_modul/vendor/unitegallery/themes/compact/ug-theme-compact.js'></script>


       <script type='text/javascript' src='./assets/addons/das_modul/vendor/unitegallery/themes/tiles/ug-theme-tiles.js'></script>
       <script type='text/javascript' src='./assets/addons/das_modul/vendor/unitegallery/themes/tilesgrid/ug-theme-tilesgrid.js'></script>
       <script type='text/javascript' src='./assets/addons/das_modul/vendor/unitegallery/themes/grid/ug-theme-grid.js'></script>

       <script type='text/javascript' src='./assets/addons/das_modul/vendor/unitegallery/themes/slider/ug-theme-slider.js'></script>


       <link rel='stylesheet' 		  href='./assets/addons/das_modul/vendor/unitegallery/themes/default/ug-theme-default.css' type='text/css' />


   </head>
   <body>

   REX_ARTICLE[]




   <script>
       $(".open-rex_modal").on('click', function(e){

           $(".close-rex_modal").click();


           e.preventDefault();
           e.stopImmediatePropagation;

           var $this = $(this),
               modal = $($this).data("modal");


           $(modal).parents(".rex_modal-overlay").addClass("open");
           $(modal).addClass("open");

           // $(modal).parents(".rex_modal-overlay").insertBefore( "#footer" );

           $(document).on('click', function(e){
               var target = $(e.target);

               if ($(target).hasClass("rex_modal-overlay")){
                   $(target).find(".rex_modal").each( function(){
                       $(this).removeClass("open");
                   });
                   $(target).removeClass("open");
               }
           });
       });

       $(".close-rex_modal").on('click', function(e){
           e.preventDefault();
           e.stopImmediatePropagation;

           var $this = $(this),
               modal = $($this).data("modal");

           $(modal).removeClass("open");
           $(".rex_modal-overlay").removeClass("open");

       });

       function printDiv(divId) {
           var content = document.getElementById(divId).innerHTML;
           var mywindow = window.open('', 'Print', 'height=10,width=10');

           mywindow.document.write('<html><head><title>Print</title>');
           mywindow.document.write('</head><body>');
           mywindow.document.write(content);
           mywindow.document.write('</body></html>');

           mywindow.document.close();
           mywindow.focus()
           mywindow.print();
           mywindow.close();
           return true;
       }
   </script>

   </body>
   </html>
```




___

### Credits

- [REDAXO](https://redaxo.org), [FriendsOfREDAXO](https://github.com/FriendsOfREDAXO)
- [MForm](https://github.com/FriendsOfREDAXO/mform) , [MBlock](https://github.com/FriendsOfREDAXO/mblock)
- [Bootstrap](https://getbootstrap.com/), [Unite Gallery](https://github.com/vvvmax/unitegallery/)
- [Tim](https://github.com/orgs/FriendsOfREDAXO/people/elricco),[Thomas](https://github.com/orgs/FriendsOfREDAXO/people/tbaddade),[Peter](https://github.com/polarpixel),[Gregor](https://github.com/orgs/FriendsOfREDAXO/people/gharlan) (und alle, die hier vergessen wurden :-))
