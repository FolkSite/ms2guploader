<?php

$properties = array();

$tmp = array(
  'uploadLimit' => array(
    'type' => 'numberfield',
    'value' => 4,
  ),
  'thumbSize' => array(
    'type' => 'textfield',
    'value' => '300x200',
  ),
  'class' => array(
    'type' => 'textfield',
    'value' => 'Ticket',
  ),
  'tplOuter' => array(
    'type' => 'textfield',
    'value' => 'tpl.ms2guploader.uploader',
  ),
  'tplFiles' => array(
    'type' => 'textfield',
    'value' => 'tpl.ms2guploader.files',
  ),
  'tpl' => array(
    'type' => 'textfield',
    'value' => 'tpl.ms2guploader.image',
  ),
  'source' => array(
    'type' => 'numberfield',
    'value' => '',
  ),
);

foreach ($tmp as $k => $v) {
  $properties[] = array_merge(
    array(
      'name' => $k,
      'desc' => PKG_NAME_LOWER . '_prop_' . $k,
      'lexicon' => PKG_NAME_LOWER . ':properties',
    ), $v
  );
}

return $properties;