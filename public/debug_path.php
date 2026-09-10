<?php
echo "public_path: " . realpath(__DIR__) . "<br>";
echo "storage/uploads/iku exists: " . (file_exists(__DIR__.'/storage/uploads/iku') ? 'YES' : 'NO') . "<br>";
echo "storage/uploads/iku/Makan Minum exists: " . (file_exists(__DIR__.'/storage/uploads/iku/Makan Minum') ? 'YES' : 'NO') . "<br>";
