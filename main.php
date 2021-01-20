#!/usr/bin/php
<?php

$file = file_get_contents('./autologin');

$date = new DateTime();
$dateone = $date->modify('this week')->format('Y-m-d');
$datetwo = $date->modify('this week +6 days')->format('Y-m-d');

$link = "https://intra.epitech.eu/".$file."/planning/load?format=json&start=".$dateone."&end=".$datetwo;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $link);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, 0);

$oui = curl_exec($ch);

$oui_array = json_decode($oui, TRUE);
$filetwo = file_get_contents('./config.json');
$ouitwo = json_decode($filetwo, TRUE);

foreach($oui_array as $tab) {
    foreach ($tab as $key => $value) {
        foreach ($ouitwo as $s_key => $s_value) {
            if ($s_value == $key && ($tab["semester"] == $ouitwo["SEMESTER"][0] || $tab["semester"] == $ouitwo["SEMESTER"][1])) {
                print($value."\n");
            }
        }
    }
}

?>