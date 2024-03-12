<?php

// Base setup - load all files from folder
$folderPath = dirname(__FILE__).'/functions/';
$files = glob($folderPath . '*');
foreach ($files as $file) {
    require_once($file);
}