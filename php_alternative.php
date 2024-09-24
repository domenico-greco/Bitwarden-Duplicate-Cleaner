<?php

$BITWARDEN_JSON_FILE_PATH = "./bitwardenPasswords.json"; // edit this
$OUTPUT_JSON_FILE = "./allNewPasswords"; // edit this



$passwords = json_decode(file_get_contents($BITWARDEN_JSON_FILE_PATH), true);
$uniquePasswords = array(
    "encrypted" => false,
    "folders" => array(),
    "items" => array()
);
foreach ($passwords['items'] as $currentPassword) {
    $isDuplicate = false;
    foreach ($uniquePasswords['items'] as $storedPassword) {
        if ($storedPassword['name'] === $currentPassword['name'] && 
            $storedPassword['login']['username'] === $currentPassword['login']['username']) {
            $isDuplicate = true;
            break;
        }
    }
    if (!$isDuplicate) {
        $uniquePasswords['items'][] = $currentPassword;
    }
}
$jsonData = json_encode($uniquePasswords, JSON_PRETTY_PRINT);
file_put_contents($OUTPUT_JSON_FILE, $jsonData);
