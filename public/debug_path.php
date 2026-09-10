<?php
$dir = __DIR__ . '/storage/uploads/iku/Makan Minum';
echo "Dir exists: " . (file_exists($dir) ? 'YES' : 'NO') . "<br>";
echo "Dir writable: " . (is_writable($dir) ? 'YES' : 'NO') . "<br>";
echo "PHP version: " . phpversion() . "<br>";
echo "move_uploaded_file disabled: " . (in_array('move_uploaded_file', explode(',', ini_get('disable_functions'))) ? 'YES' : 'NO') . "<br>";
echo "upload_tmp_dir: " . ini_get('upload_tmp_dir') . "<br>";
echo "upload_max_filesize: " . ini_get('upload_max_filesize') . "<br>";
