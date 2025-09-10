<?php
// Path to your image
$imagePath = '/opt/lampp/htdocs/adminLTE/public/storage/blogs/1744111328.jpg'; // put your image in the same folder or give full path

if (!file_exists($imagePath)) {
    die("File does not exist!");
}

// Get file extension
$type = pathinfo($imagePath, PATHINFO_EXTENSION);

// Read file content
$data = file_get_contents($imagePath);

// Encode to base64 with proper data URI
$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

// Output the string
echo $base64;
