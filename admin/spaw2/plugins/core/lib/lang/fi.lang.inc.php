<?php
// ================================================
// SPAW PHP WYSIWYG editor control
// ================================================
// Finnish language file
// ================================================
// Developed: Alan Mendelevich, alan@solmetra.lt
// Copyright: Solmetra (c)2003 All rights reserved.
// Finnish translation: Teemu Joensuu, teemu.joensuu@saunalahti.fi
// ------------------------------------------------
//                                www.solmetra.com
// ================================================
// v.2.0, 2007-06-27
// ================================================

// charset to be used in dialogs
$spaw_lang_charset = 'iso-8859-1';

// language text data array
// first dimension - block, second - exact phrase
// alternative text for toolbar buttons and title for dropdowns - 'title'

$spaw_lang_data = array(
  'cut' => array(
    'title' => 'Leikkaa'
  ),
  'copy' => array(
    'title' => 'Kopioi'
  ),
  'paste' => array(
    'title' => 'Liit�'
  ),
  'undo' => array(
    'title' => 'Kumoa'
  ),
  'redo' => array(
    'title' => 'Tee uudelleen'
  ),
  'hyperlink' => array(
    'title' => 'Linkki'
  ),
	'image' => array(
    'title' => 'Kuvan nopea lis�ys'
  ),
/*  'image_insert' => array(
    'title' => 'Lis�� kuva',
    'select' => 'Valitse',
    'cancel' => 'Peruuta',
    'library' => 'Kirjasto',
    'preview' => 'Esikatselu',
    'images' => 'Kuvat',
    'upload' => 'L�het� kuva palvelimelle',
    'upload_button' => 'L�het�',
    'error' => 'Virhe',
    'error_no_image' => 'Et valinnut kuvaa listalta.',
    'error_uploading' => 'Kuvan palvelimelle l�hetyksess� esiintyi virhe. Yrit� myöhemmin uudelleen.',
    'error_wrong_type' => 'L�hett�m�si tiedosto ei ollut tuettua tiedostomuotoa',
    'error_no_dir' => 'Kirjastoa ei ole fyysisesti olemassa.',
  ),
*/  'image_prop' => array(
    'title' => 'Kuvan ominaisuudet',
    'ok' => '   OK   ',
    'cancel' => 'Peruuta',
    'source' => 'Kuva',
    'alt' => 'Kuvaus (ALT)',
    'align' => 'Suhde tekstiin',
    'left' => 'kuva vasemmalla, teksti kiert��',
    'right' => 'kuva oikealla, teksti kiert��',
    'top' => 'teksti asettuu kuvan yl�reunaan',
    'middle' => 'teksti asettuu kuvan keskikork.',
    'bottom' => 'teksti asettuu kuvan alareunaan',
    'absmiddle' => 'absmiddle',
    'texttop' => 'texttop',
    'baseline' => 'baseline',
    'width' => 'Leveys',
    'height' => 'Korkeus',
    'border' => 'Reunus',
    'hspace' => 'Vaakas. tyhj� tila',
    'vspace' => 'Pystys. tyhj� tila',
    'dimensions' => 'Mitat', // <= new in 2.0.1
    'reset_dimensions' => 'Aseta alkuper�inen kuvakoko', // <= new in 2.0.1
    'title_attr' => 'Otsake', // <= new in 2.0.1
    'constrain_proportions' => 'S�ilyt� kuvasuhde', // <= new in 2.0.1
    'error' => 'Virhe',
    'error_width_nan' => 'Leveyden arvo ei ole numero',
    'error_height_nan' => 'Korkeuden arvo ei ole numero',
    'error_border_nan' => 'Reunuksen arvo ei ole numero',
    'error_hspace_nan' => 'Vaakasuoran tyhj�n tilan arvo ei ole numero',
    'error_vspace_nan' => 'Pystysuoran tyhj�n tilan arvo ei ole numero',
  ),
  'flash_prop' => array(                // <= new in 2.0
    'title' => 'Flash-objektin liitt�minen',
    'ok' => '   OK   ',
    'cancel' => 'Peruuta',
    'source' => 'L�hde',
    'width' => 'Leveys',
    'height' => 'Korkeus',
    'error' => 'Virhe',
    'error_width_nan' => 'Leveyden arvo ei ole numero',
    'error_height_nan' => 'Korkeuden arvo ei ole numero',
  ),	
	
  'inserthorizontalrule' => array(
    'title' => 'Vaakaviiva'
  ),
  'table_create' => array(
    'title' => 'Luo taulukko'
  ),
  'table_prop' => array(
    'title' => 'Taulukon ominaisuudet',
    'ok' => '   OK   ',
    'cancel' => 'Peruuta',
    'rows' => 'Rivej�',
    'columns' => 'Sarakkeita',
    'width' => 'Leveys',
    'height' => 'Korkeus',
    'border' => 'Reunaviiva',
    'pixels' => 'kuvapistett�',
    'css_class' => 'Tyyli',
    'cellpadding' => 'Tekstin et�isyys solun reunasta',
    'cellspacing' => 'Solujen v�linen tyhj� tila',
    'bg_color' => 'Taustav�ri',
    'background' => 'Taustakuva',
    'error' => 'Virhe',
    'error_rows_nan' => 'Rivim��r�n arvo ei ole numero',
    'error_columns_nan' => 'Sarakem��r�n arvo ei ole numero',
    'error_width_nan' => 'Leveyden arvo ei ole numero',
    'error_height_nan' => 'Korkeuden arvo ei ole numero',
    'error_border_nan' => 'Reunuksen arvo ei ole numero',
    'error_cellpadding_nan' => 'Tekstin et�isyys solun reunasta -kent�n arvo ei ole numero',
    'error_cellspacing_nan' => 'Solujen v�linen tyhj� tila -arvo ei ole numero',
  ),
  'table_cell_prop' => array(
    'title' => 'Taulukon solun ominaisuudet',
    'horizontal_align' => 'Tasaus vaakasuunnassa',
    'vertical_align' => 'Tasaus pystysuunnassa',
    'width' => 'Leveys',
    'height' => 'Korkeus',
    'css_class' => 'Tyyli',
    'no_wrap' => 'No wrap',
    'bg_color' => 'Taustav�ri',
    'background' => 'Taustakuva',
    'ok' => '   OK   ',
    'cancel' => 'Peruuta',
    'justifyleft' => 'Vasen',
    'justifycenter' => 'Keskit�',
    'justifyright' => 'Oikea',
    'top' => 'Ylös',
    'middle' => 'Keskelle',
    'bottom' => 'Alas',
    'baseline' => 'Baseline',
    'error' => 'Virhe',
    'error_width_nan' => 'Leveyden arvo ei ole numero',
    'error_height_nan' => 'Korkeuden arvo ei ole numero',
    
  ),
  'table_row_insert' => array(
    'title' => 'Lis�� rivi taulukkoon'
  ),
  'table_column_insert' => array(
    'title' => 'Lis�� sarake taulukkoon'
  ),
  'table_row_delete' => array(
    'title' => 'Poista rivi taulukosta'
  ),
  'table_column_delete' => array(
    'title' => 'Poista sarake taulukosta'
  ),
  'table_cell_merge_right' => array(
    'title' => 'Yhdist� oikealla puolella olevaan soluun'
  ),
  'table_cell_merge_down' => array(
    'title' => 'Yhdist� alapuolella olevaan soluun'
  ),
  'table_cell_split_horizontal' => array(
    'title' => 'Jaa solu vaakasuunnassa'
  ),
  'table_cell_split_vertical' => array(
    'title' => 'Jaa solu pystysuunnassa'
  ),
  'style' => array(
    'title' => 'Tyyli'
  ),
  'fontname' => array(
    'title' => 'Fontti'
  ),
  'fontsize' => array(
    'title' => 'Koko'
  ),
  'formatBlock' => array(
    'title' => 'Kappale'
  ),
  'bold' => array(
    'title' => 'Lihavoi'
  ),
  'italic' => array(
    'title' => 'Kursivoi'
  ),
  'underline' => array(
    'title' => 'Alleviivaa'
  ),
  'insertorderedlist' => array(
    'title' => 'Numeroitu luettelo'
  ),
  'insertunorderedlist' => array(
    'title' => 'Luettelomerkit'
  ),
  'indent' => array(
    'title' => 'Sisenn�'
  ),
  'outdent' => array(
    'title' => 'Poista sisennyst�'
  ),
  'justifyleft' => array(
    'title' => 'Tasaa vasempaan reunaan'
  ),
  'justifycenter' => array(
    'title' => 'Keskit�'
  ),
  'justifyright' => array(
    'title' => 'Tasaa oikeaan reunaan'
  ),
  'justifyfull' => array( // <== v.2.0 changed from justify
    'title' => 'Tasaa molemmat reunat'
  ),
  'fore_color' => array(
    'title' => 'Tekstin v�ri'
  ),
  'bg_color' => array(
    'title' => 'Tekstin taustav�ri'
  ),
  'design' => array(
    'title' => 'Vaihda sis�lt�editorin tekstink�sittelyn kaltaiseen  WYSIWYG (design) -tilaan.'
  ),
  'html' => array(
    'title' => 'Vaihda HTML-kooditilaan'
  ),
  'colorpicker' => array(
    'title' => 'V�rivalitsin',
    'ok' => '   OK   ',
    'cancel' => 'Peruuta',
  ),
	  'cleanup' => array(
    'title' => 'HTML-koodin puhdistus (poistaa tyylim��rittelyt)',
    'confirm' => 'T�m� toiminto poistaa t�m�n sivun sis�ll�st� kaikki tyylim��rittelyt, fonttim��rittelyt ja tarpeettomat komennot. Kaikki tekstin muotoilu tai osa muotoilusta voi kadota.',
    'ok' => '   OK   ',
    'cancel' => 'Peruuta',
  ),
  'toggle_borders' => array(
    'title' => 'N�yt�/Piilota reunuksettomien taulukkojen reunat',
  ),
  'hyperlink' => array(
    'title' => 'Linkki',
    'url' => 'Kohdeosoite (URL)',
    'name' => 'Nimi',
    'target' => 'Ikkuna, johon linkki avautuu',
    'title_attr' => 'Otsikko',
  	'a_type' => 'Linkin tyyppi',
  	'type_link' => 'Tavallinen linkki',
  	'type_linktoownpage' => 'Linkki omalle sivulle',
  	'type_linktofile' => 'Linkki tiedostoon palvelimella',
  	'type_anchor' => 'Ankkuri',
  	'type_link2anchor' => 'Linkki ankkuriin',
  	'anchors' => 'Ankkurit',
    'ok' => '   OK   ',
    'cancel' => 'Peruuta',
  ),
  'hyperlink_targets' => array(
  	'_self' => 'Sama ikkuna (_self)',
  	'_blank' => 'Uusi tyhj� ikkuna (_blank)',
  	'_top' => 'top frame (_top)',
  	'_parent' => 'parent frame (_parent)'
  ),
  'unlink' => array( // <=== new v.2.0
    'title' => 'Poista linkki'
  ),
  'table_row_prop' => array(
    'title' => 'Taulukon rivin ominaisuudet',
    'horizontal_align' => 'Tasaus vaakasuunnassa',
    'vertical_align' => 'Tasaus Pystysuunnassa',
    'css_class' => 'CSS tyyli',
    'no_wrap' => 'No wrap',
    'bg_color' => 'Taustav�ri',
    'ok' => '   OK   ',
    'cancel' => 'Peruuta',
    'justifyleft' => 'Vasen',
    'justifycenter' => 'Keskit�',
    'justifyright' => 'Oikea',
    'top' => 'Yl�s',
    'middle' => 'Keskelle',
    'bottom' => 'Alas',
    'baseline' => 'Alareunaan',
  ),
  'symbols' => array(
    'title' => 'Erikoismerkit',
    'ok' => '   OK   ',
    'cancel' => 'Peruuta',
  ),
  'templates' => array(
    'title' => 'Ulkoasupohjat',
  ),
  'page_prop' => array(
    'title' => 'Sivun ominaisuudet',
    'title_tag' => 'Otsikko (Title)',
    'charset' => 'Charset',
    'background' => 'Taustakuva',
    'bgcolor' => 'Taustav�ri',
    'text' => 'Tekstin v�ri',
    'link' => 'Linkin v�ri',
    'vlink' => 'Vieraillun linkin v�ri',
    'alink' => 'Aktiivisen linkin v�ri',
    'leftmargin' => 'Vasen reunus',
    'topmargin' => 'Yl�reunus',
    'css_class' => 'CSS luokka',
    'ok' => '   OK   ',
    'cancel' => 'Peruuta',
  ),
  'preview' => array(
    'title' => 'Esikatselu',
  ),
  'image_popup' => array(
    'title' => 'Ponnahduskuva',
  ),
  'zoom' => array(
    'title' => 'Zoomaa',
  ),
	'subscript' => array(
    'title' => 'Subscript',
  ),
  'superscript' => array(
    'title' => 'Superscript',
  ),

);
?>