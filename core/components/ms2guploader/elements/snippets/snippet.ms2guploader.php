<?php
$ms2guploader = $modx->getService('ms2guploader', 'ms2guploader', $modx->getOption('ms2guploader_core_path', null, $modx->getOption('core_path') . 'components/ms2guploader/') . 'model/ms2guploader/', $scriptProperties);
//$ms2Gallery = $modx->getService('ms2gallery', 'ms2Gallery', MODX_CORE_PATH . 'components/ms2gallery/model/ms2gallery/');


// Проверка на сущестование ресурса
if(empty($pid)) $pid = !empty($_REQUEST['id']) ? (integer)$_REQUEST['id'] : 0;
if($pid != 0) $resource = $modx->getObject($class, $pid);

// Поиск и подсчет уже созданных файлов
$q = $modx->newQuery('msResourceFile');
if($resource && !$resource->deleted){
    $q->where(array('resource_id' => $pid , 'parent' => 0 /* , 'createdby' => $modx->user->id */ ));
}else{
    $q->where(array('resource_id' => 0, 'parent' => 0, 'createdby' => $modx->user->id));
}
$q->sortby('rank', 'ASC');
$q->limit($uploadLimit);
$collection = $modx->getIterator('msResourceFile', $q);
$count = $modx->getCount('msResourceFile', $q);
$data = $ms2guploader->initialize($modx->context->key, $count);
if($count >= $uploadLimit) $data['disabled'] = 'disabled';
$files = '';
foreach ($collection as $item) {
    $item = $item->toArray();
    $thumb = $modx->getObject('msResourceFile', array('parent' => $item['id'], 'path' => $item['path'].$thumbSize.'/'));
    $item['thumb'] = $thumb->url;
    $files .= $ms2guploader->getChunk($tpl, $item);
}
$data['files'] = $ms2guploader->getChunk($tplFiles, array('files' => $files));

//output
$output = $ms2guploader->getChunk($tplOuter, $data);

return $output;