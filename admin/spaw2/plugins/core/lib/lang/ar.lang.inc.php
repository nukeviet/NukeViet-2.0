<?php 
// ================================================
// SPAW v.2.0
// ================================================
//
//
// Arabic language file
// Traslated: Mohammed Ahmed
// Gaza, Palestine
// http://www.maaking.com
// Email/MSN: m@maaking.com
//
// last update: 18-oct-2007
//
// ================================================
// Author: Alan Mendelevich, UAB Solmetra
// ------------------------------------------------
// www.solmetra.com
// ================================================
// v.2.0
// ================================================

// charset to be used in dialogs
$spaw_lang_charset = 'windows-1256';


// text direction for the language
$spaw_lang_direction = 'rtl';

// language text data array
// first dimension - block, second - exact phrase
// alternative text for toolbar buttons and title for dropdowns - 'title'

$spaw_lang_data = array(
  'cut' => array(
    'title' => '��'
  ),
  'copy' => array(
    'title' => '���'
  ),
  'paste' => array(
    'title' => '���'
  ),
  'undo' => array(
    'title' => '�����'
  ),
  'redo' => array(
    'title' => '����� �������'
  ),
  'image' => array(
    'title' => '����� ����'
  ),
  'image_prop' => array(
    'title' => '����',
    'ok' => '   �����   ',
    'cancel' => '�����',
    'source' => '������',
    'alt' => '�� ����',
    'align' => '��������',
    'left' => '����',
    'right' => '����',
    'top' => '����',
    'middle' => '���',
    'bottom' => '����',
    'absmiddle' => '�� �� �������',
    'texttop' => '�� �� ������',
    'baseline' => '�� �����',
    'width' => '�����',
    'height' => '��������',
    'border' => '����',
    'hspace' => '����� �����',
    'vspace' => '����� ������',
    'dimensions' => '�������', // <= new in 2.0.1
    'reset_dimensions' => '����� ��� �������', // <= new in 2.0.1
    'title_attr' => '�������', // <= new in 2.0.1
    'constrain_proportions' => '������ �����', // <= new in 2.0.1
    'error' => '���',
    'error_width_nan' => '����� ��� ���',
    'error_height_nan' => '�������� ��� ���',
    'error_border_nan' => '���� ��� ���',
    'error_hspace_nan' => '������ ������� ��� ���',
    'error_vspace_nan' => '������ ������� ��� ���',
  ),
  'flash_prop' => array(                // <= new in 2.0
    'title' => '����',
    'ok' => '   �����   ',
    'cancel' => '�����',
    'source' => '������',
    'width' => '�����',
    'height' => '��������',
    'error' => '���',
    'error_width_nan' => '������ ������� ��� ���',
    'error_height_nan' => '������ ������� ��� ���',
  ),
  'inserthorizontalrule' => array( // <== v.2.0 changed from hr
    'title' => '����� �� ����'
  ),
  'table_create' => array(
    'title' => '����� ����'
  ),
  'table_prop' => array(
    'title' => '����� ������',
    'ok' => '   �����   ',
    'cancel' => '�����',
    'rows' => '������',
    'columns' => '�������',
    'css_class' => 'CSS �����',
    'width' => '�����',
    'height' => '��������',
    'border' => '����',
    'pixels' => '����',
    'cellpadding' => '���� ������',
    'cellspacing' => '������� ��� �������',
    'bg_color' => '��� �������',
    'background' => '���� �������',
    'error' => '���',
    'error_rows_nan' => '������ ������� ��� ���',
    'error_columns_nan' => '������ ������� ��� ���',
    'error_width_nan' => '������ ������� ��� ���',
    'error_height_nan' => '������ ������� ��� ���',
    'error_border_nan' => '������ ������� ��� ���',
    'error_cellpadding_nan' => '������ ������� ��� ���',
    'error_cellspacing_nan' => '������ ������� ��� ���',
  ),
  'table_cell_prop' => array(
    'title' => '����� ������',
    'horizontal_align' => '������ �����',
    'vertical_align' => '������ ������',
    'width' => '�����',
    'height' => '��������',
    'css_class' => 'CSS ���',
    'no_wrap' => '��� ��',
    'bg_color' => '��� �������',
    'background' => '���� �������',
    'ok' => '   �����   ',
    'cancel' => '�����',
    'left' => '����',
    'center' => '���',
    'right' => '����',
    'top' => '����',
    'middle' => '���',
    'bottom' => '����',
    'baseline' => '�� �����',
    'error' => '���',
    'error_width_nan' => '������ ������� ��� ���',
    'error_height_nan' => '������ ������� ��� ���',
  ),
  'table_row_insert' => array(
    'title' => '����� ��'
  ),
  'table_column_insert' => array(
    'title' => '����� ����'
  ),
  'table_row_delete' => array(
    'title' => '��� ��'
  ),
  'table_column_delete' => array(
    'title' => '��� ����'
  ),
  'table_cell_merge_right' => array(
    'title' => '��� ��� ������'
  ),
  'table_cell_merge_down' => array(
    'title' => '��� ��� ������'
  ),
  'table_cell_split_horizontal' => array(
    'title' => '��� ������� ���� ����'
  ),
  'table_cell_split_vertical' => array(
    'title' => '����� ������� ���� �����'
  ),
  'style' => array(
    'title' => '�����'
  ),
  'fontname' => array( // <== v.2.0 changed from font
    'title' => '����'
  ),
  'fontsize' => array(
    'title' => '�����'
  ),
  'formatBlock' => array( // <= v.2.0: changed from paragraph
    'title' => '������'
  ),
  'bold' => array(
    'title' => '����'
  ),
  'italic' => array(
    'title' => '����'
  ),
  'underline' => array(
    'title' => '���� ��'
  ),
  'strikethrough' => array(
    'title' => '���� ��'
  ),
  'insertorderedlist' => array( // <== v.2.0 changed from ordered_list
    'title' => '����� ����'
  ),
  'insertunorderedlist' => array( // <== v.2.0 changed from bulleted list
    'title' => '����� ����'
  ),
  'indent' => array(
    'title' => '����� ������� �������'
  ),
  'outdent' => array( // <== v.2.0 changed from unindent
    'title' => '����� ������� �������'
  ),
  'justifyleft' => array( // <== v.2.0 changed from left
    'title' => '����'
  ),
  'justifycenter' => array( // <== v.2.0 changed from center
    'title' => '�����'
  ),
  'justifyright' => array( // <== v.2.0 changed from right
    'title' => '����'
  ),
  'justifyfull' => array( // <== v.2.0 changed from justify
    'title' => '���'
  ),
  'fore_color' => array(
    'title' => '��� ����'
  ),
  'bg_color' => array(
    'title' => '��� ����� ����'
  ),
  'design' => array( // <== v.2.0 changed from design_tab
    'title' => '��� �������'
  ),
  'html' => array( // <== v.2.0 changed from html_tab
    'title' => '��� ������'
  ),
  'colorpicker' => array(
    'title' => '������ ���',
    'ok' => '   �����   ',
    'cancel' => '�����',
  ),
  'cleanup' => array(
    'title' => '��� ���� ���������',
    'confirm' => ' ����� ��� ����� ����� ���� ��������� ���� ��� ������. ',
    'ok' => '   �����   ',
    'cancel' => '�����',
  ),
  'toggle_borders' => array(
    'title' => '����� ������',
  ),
  'hyperlink' => array(
    'title' => '���� �����',
    'url' => '������ URL',
    'name' => '���',
    'target' => '������ �����',
    'title_attr' => '�������',
  	'a_type' => '�����',
  	'type_link' => '������',
  	'type_anchor' => '����',
  	'type_link2anchor' => '��� ��� ����',
  	'anchors' => '�����',
    'ok' => '   �����   ',
    'cancel' => '�����',
  ),
  'hyperlink_targets' => array(
  	'_self' => '��� ������ (_self)',
  	'_blank' => '���� ����� (_blank)',
  	'_top' => '���� ������ (_top)',
  	'_parent' => '���� (_parent)'
  ),
  'unlink' => array( // <=== new v.2.0
    'title' => '����� ������ �������'
  ),
  'table_row_prop' => array(
    'title' => '����� ����',
    'horizontal_align' => '������ �����',
    'vertical_align' => '������ ������',
    'css_class' => 'CSS ���',
    'no_wrap' => '��� ��',
    'bg_color' => '��� �������',
    'ok' => '   �����   ',
    'cancel' => '�����',
    'left' => '����',
    'center' => '���',
    'right' => '����',
    'top' => '����',
    'middle' => '���',
    'bottom' => '����',
    'baseline' => '�� �����',
  ),
  'symbols' => array(
    'title' => '���� ����',
    'ok' => '   �����   ',
    'cancel' => '�����',
  ),
  'templates' => array(
    'title' => '�����',
  ),
  'page_prop' => array(
    'title' => '����� ������',
    'title_tag' => '�������',
    'charset' => '�������',
    'background' => '���� �������',
    'bgcolor' => '��� �������',
    'text' => '��� ����',
    'link' => '��� ������',
    'vlink' => '��� ������ �� ������',
    'alink' => '��� ������ ����',
    'leftmargin' => '���� ������',
    'topmargin' => '���� ������',
    'css_class' => 'CSS �����',
    'ok' => '   �����   ',
    'cancel' => '�����',
  ),
  'preview' => array(
    'title' => '������',
  ),
  'image_popup' => array(
    'title' => '���� �� �����',
  ),
  'zoom' => array(
    'title' => '�����',
  ),
  'subscript' => array(
    'title' => '�� ����',
  ),
  'superscript' => array(
    'title' => '�� ����',
  ),
);
?>
