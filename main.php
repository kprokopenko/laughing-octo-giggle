<?php

spl_autoload_register(function ($class_name) {
    include __DIR__ . '/models/' . $class_name . '.php';
});

$rules = new Rules();

$rules->loadConfig([
    'General Admission' => 'General Admission',
    '[\s-]GA' => 'General Admission',
    'G\/A' => 'General Admission',
    'Algemene Toegang' => 'General Admission',
    'All Day' => 'General Admission',
    'General (admit|Admission|admin)' => 'General Admission',
    'Tier (\d+)' => 'Tier $1',
    '([^\d]|^)(\d+)-\d+' => '$2',
    ' Ave' => 'Parking',
    ' St[. ]' => 'Parking',
    'Parking' => 'Parking',
    'from venue' => 'Parking',
    ' Dr' => 'Parking',
    'Floor (\d+)' => 'Floor $1',
    'Loge (\d+)' => 'Loge $1',
    'Flr(\d+)' => 'Floor $1',
    'Floor' => 'Floor',
    'Bal' => 'Balcony',
    'MEZZANINE' => 'Mezzanine',
    'Balcony (\d+)\s*' => 'Balcony 2',
    'flr (\d+)' => 'Floor $1',
    'VIP BOX (\d+)' => 'VIP Box $1',
    'BOX (\d+)' => 'Box $1',
], 'RegexAnyPlace');

$rules->loadConfig([
    '\s?0*([1-9]+)[`\s]?' => '$1',
    '([^\d]0*[1-9]\d+)' => '$1',
    'Reserved (.+)' => '$1',
    'FLR' => 'Floor'
], 'RegexFull');

$db = new Db();

while (($section = $db->next()) !== false) {
    $section = trim($section);

    $grpName = $rules->replace($section);
    if (null !== $grpName) {
        $db->update($grpName);
    }
}