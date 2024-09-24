<?php

$BITWARDEN_JSON_FILE_PATH = "./bitwardenPasswords.json"; // edit this
$OUTPUT_JSON_FILE = "./allNewPasswords"; // edit this



$passwords = json_decode(file_get_contents($BITWARDEN_JSON_FILE_PATH), true);
$newCredentials = $passwords;
$newCredentials['items'] = array();

foreach ($passwords['items'] as $currentCredential) {
    $isDuplicate = false;
    foreach ($newCredentials['items'] as $storedCredential) {
        if ($storedCredential['name'] === $currentCredential['name'] && 
            $storedCredential['login']['username'] === $currentCredential['login']['username']) {
            $isDuplicate = true;
            break;
        }
    }
    if (!$isDuplicate) {
        $newCredentials['items'][] = $currentCredential;
    }
}
$jsonData = json_encode($newCredentials, JSON_PRETTY_PRINT);
file_put_contents($OUTPUT_JSON_FILE, $jsonData);
echo "OK";
