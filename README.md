## Das Modul // Codename: _Gensfleisch 1468_ 

Dieses AddOn installiert das Modul **0000 - Standard** und die zugehörigen Dateien.

Auf einer Einstellungsseite im Modul kann die jeweile Anordung der Inhalte ausgewählt werden (jederzeit änderbar). Hier gibt es auch die Möglichkeit für diese Section eine individuelle ID und Klassen zu vergeben. Zudem kann für jede Col eine Klasse vergeben werden. Es besteht die Möglichkeit zu wählen ob der Container Fluid sein soll.


---

### Installation / Benutzung

- Bei den Ausgaben im Frontend wird das Bootstrap4 Grid benutzt.

---
### Module (eigentlich Funktionen)

**0010 - Überschrift** (headline_input / headline_output) 
Hier kann eine Überschrift eingepflegt werden. Zusätzlich ist die Angabe der "Größe" (H1-H6) ist möglich.

**0020 - Text** (textarea_input / textarea_output)
Es wird eine Textarea bereitgestellt. Je nach installiertem Editor wird dieser eingebunden. Aktuell funktionieren leider nur die AddOns: _MarkitUp_ und _Tinymce4_ (siehe: https://github.com/FriendsOfREDAXO/redactor2/issues/134)<br/>_Sollten schon Inhalte eingepflegt sein können bei einem Wechsel des Editors alle Formtierungen verloren gehen._


**0030 - Bild** (image_input / image_output)<br/>
Hier kann ein Bild ausgewählt und intern verlinkt werden.<br/>
*CSS: ./assets/addons/das_modul/css/image.css*  

**0040 - Download** (downloads_input / downloads_output)
**Funktioniert grad nicht**.  
 
**0050 - Film (extern)** (video_input / video_output)
Durch die Angebe eine YouTube bz. Vimeo Film ID kann das Video im Fornten dargestellt werden. Hier sollte noch eine DSGVO gerechte Lösung gefunden werden.
*CSS: ./assets/addons/das_modul/css/video.css*


**0060 - Link (intern / extern)** (link_input / link_output)
Durch die Angebe eine YouTube bz. Vimeo Film ID kann das Video im Fornten dargestellt werden. Hier sollte noch eine DSGVO gerechte Lösung gefunden werden. **CSS benötigt**.

**0070 - Card (Teaser)**
Ermöglicht es eine CARD auszugeben (Bild, Text, interner Link). **CSS benötigt**.  

**0080 - Abstand einfügen**

**0090 - Artikel im Modal öffnen**

**0100 - Gallery / Carousel**



### Sonstige Funktionen

- **check Editor**
Hier wird geprüft welcher Editor installiert ist. _Leider unterstützt MBlock den Redactor2 Editor nicht mehr._ Aktuell funktionieren nur "MarkItUp" und "Tinymce4". Die Unterstützung für den "CKEditor 5" wird evtl. noch eingebaut. 

- **container_input / container_output**
Funktion um die "Breite" des Containers zu definieren. 

- **id_class_input**
Funktion für die Eingaben der Klassen und IDs

---

> **Warum _Gensfleisch 1468_**
>
> Nun WordPress bekommt jetzt demnächst den "Gutenberg" Editor und die freuen sich grad ´n Ast. Das was der supertolle Gutenberg Editor können wird ist schon lange die Funktionsweise von REDAXO. Nur nicht ganz so fancy. Dieses Modul ermöglicht es dem Redakteur Inhalte modular wie beim Gutenberg Editor zu pflegen. Nur einfacher.  
>
> Gutenberg heisst eigentlich "Johannes Gensfleisch" und ist 1468 gestorben...




---
<br/>

Test Template:

```
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/addons/das_modul/css/frontend.css">
</head>
<body>

REX_ARTICLE[]

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
</html>
```