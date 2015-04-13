<?php 
// ================================================
// SPAW File Manager plugin
// ================================================
// English language file
// ================================================
// Developed: Saulius Okunevicius, saulius@solmetra.com
// Translated: Szentgy�rgyi J�nos, info@dynamicart.hu
// Copyright: Solmetra (c)2006 All rights reserved.
// ------------------------------------------------
//                                www.solmetra.com
// ================================================
// v.1.0, 2006-11-20
// ================================================

// charset to be used in dialogs
$spaw_lang_charset = 'iso-8859-2';

// language text data array
// first dimension - block, second - exact phrase
// alternative text for toolbar buttons and title for dropdowns - 'title'

$spaw_lang_data = array(
  'spawfm' => array(
    'title' => 'SPAW F�jl menedzser',
    'error_reading_dir' => 'Hiba: Nem tudom olvasni a k�nyvt�r tartalm�t.',
    'error_upload_forbidden' => 'Hiba: F�jl felt�lt�s nem enged�jezett ebbe a mapp�ba.',
    'error_upload_file_too_big' => 'Felt�lt�si hiba: F�jl t�l nagy.',
    'error_upload_failed' => 'F�jl felt�lt�s nem siker�lt.',
    'error_upload_file_incomplete' => 'F�jl felt�lt�s nem fejez�d�tt be, pr�b�ld �jra.',
    'error_bad_filetype' => 'Hiba: Felt�ltend� f�jl tipusa nem enged�jezett.',
    'error_max_filesize' => 'A legnagyobb felt�ltend� f�jl m�rete:',
    'error_delete_forbidden' => 'Hiba: Ebben a mapp�ban nincs enged�jezve a t�rl�s.',
    'confirm_delete' => 'Biztosan akarod t�r�lni ezeket a f�jlokat "[*file*]"?',
    'error_delete_failed' => 'Hiba: F�jlt nem tudtam t�r�lni.',
    'error_no_directory_available' => 'Nincs el�rhet� tall�zhat� mappa.',
    'download_file' => '[F�jl let�lt�s]',
    'error_chmod_uploaded_file' => 'F�jl felt�lt�s sikeres, de a chmod\'ing nem siker�lt.',
    'error_img_width_max' => 'A legnagyobb megengedett k�psz�less�g: [*MAXWIDTH*]px',
    'error_img_height_max' => 'A legnagyobb megengedett k�pmagass�g: [*MAXHEIGHT*]px',
    'rename_text' => 'K�rem az �j nevet "[*FILE*]":',
    'error_rename_file_missing' => '�tnevez�s nem siker�lt - nem tal�lom a f�jlt.',
    'error_rename_directories_forbidden' => 'Hiba: Mappa �tnevez�s nem enged�jezett ebben a mapp�ban.',
    'error_rename_forbidden' => 'Hiba: F�jl �tneveze�s nem megengedett ebben a mapp�ban.',
    'error_rename_file_exists' => 'Hiba: "[*FILE*]" m�r l�tezik.',
    'error_rename_failed' => 'Hiba: �tnevez�s nem siker�lt. Nincs hozz� elegend� jog.',
    'error_rename_extension_changed' => 'Hiba: A f�jl kiterjeszt�s m�dos�t�sa nem megengedett!',
    'newdirectory_text' => 'K�rem a mappa nev�t:',
    'error_create_directories_forbidden' => 'Hiba: Mappa k�sz�t�s elutas�tva',
    'error_create_directories_name_used' => 'Ezt a nevet m�r haszn�lj�k, k�rlek pr�b�lj m�sikat.',
    'error_create_directories_failed' => 'Hiba: Mapp�t nem tudtam ml�trehozni. Nincs elegend� jogod.',
    'error_create_directories_name_invalid' => 'Ezeket a karaktereket nem haszn�lhatod mappan�vben: / \\ : * ? " < > |',
    'confirmdeletedir_text' => 'Biztos t�r�lni akarod a mapp�t "[*DIR*]"?',
    'error_delete_subdirectories_forbidden' => 'Mappa t�rl�se elutas�tva.',
    'error_delete_subdirectories_failed' => 'Mapp�t nem tudtam t�r�lni. Nincs elegend� jog.',
    'error_delete_subdirectories_not_empty' => 'Mappa nem �res.',
  ),
  'buttons' => array(
    'ok'        => '  OK  ',
    'cancel'    => 'M�gsem',
    'view_list' => 'N�zet: lista',
    'view_details' => 'N�zet: r�szletek',
    'view_thumbs' => 'N�zet: kisk�pek',
    'rename'    => '�tnevez�s',
    'delete'    => 'T�rl�s',
    'go_up'     => 'Fel',
    'upload'    =>  'Felt�lt�s',
    ''  =>  '',
  ),
  'file_details' => array(
    'name'  =>  'N�v',
    'type'  =>  'Tipus',
    'size'  =>  'M�ret',
    'date'  =>  'D�tum',
    'filetype_suffix'  =>  'F�jl',
    'img_dimensions'  =>  'K�p m�retei',
    ''  =>  '',
    ''  =>  '',
  ),
  'filetypes' => array(
    'any'       => 'Minden f�jl (*.*)',
    'images'    => 'K�p f�jlok',
    'flash'     => 'Flash mozik',
    'documents' => 'Dokumentumok',
    'audio'     => 'Zenei f�jlok',
    'video'     => 'Vide� f�jlok',
    'archives'  => 'Arh�v f�jlok',
    '.jpg'  =>  'JPG k�p f�jl',
    '.jpeg'  =>  'JPG k�p f�jl',
    '.gif'  =>  'GIF k�p f�jl',
    '.png'  =>  'PNG k�p f�jl',
    '.swf'  =>  'Flash mozi',
    '.doc'  =>  'Microsoft Word dokumentum',
    '.xls'  =>  'Microsoft Excel dokumentum',
    '.pdf'  =>  'PDF dokumentum',
    '.rtf'  =>  'RTF dokumentum',
    '.odt'  =>  'OpenDocument sz�veg',
    '.ods'  =>  'OpenDocument t�bl�zat',
    '.sxw'  =>  'OpenOffice.org 1.0 sz�veges dokumentum',
    '.sxc'  =>  'OpenOffice.org 1.0 t�bl�zat',
    '.wav'  =>  'WAV hang f�jl',
    '.mp3'  =>  'MP3 hang f�jl',
    '.ogg'  =>  'Ogg Vorbis hang f�jl',
    '.wma'  =>  'Windows hang f�jl',
    '.avi'  =>  'AVI vide� f�jl',
    '.mpg'  =>  'MPEG vide� f�jl',
    '.mpeg'  =>  'MPEG vide� f�jl',
    '.mov'  =>  'QuickTime vide� f�jl',
    '.wmv'  =>  'Windows vide� f�jl',
    '.zip'  =>  'ZIP t�m�r�t�s',
    '.rar'  =>  'RAR t�m�r�t�s',
    '.gz'  =>  'gzip t�m�r�t�s',
    '.txt'  =>  'Sz�veges dokumentum',
    ''  =>  '',
  ),
);
?>
