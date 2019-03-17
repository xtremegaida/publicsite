<?php

$new_name = 'archive/' . date('Y-m-d_G-i-s') . '.zip';
if (!file_exists('archive')) { mkdir('archive'); }

if (file_exists('site.zip')) {

  rename('site.zip', $new_name);

} else {

  if ($_GET['key'] !== file_get_contents('secret.key')) {
    http_response_code(500);
    echo 'Key mismatch';
    exit();
  }

  if (!isset($_FILES['sitefile']['error']) ||
      is_array($_FILES['sitefile']['error']) ||
      $_FILES['sitefile']['error'] != UPLOAD_ERR_OK) {
    http_response_code(500);
    echo 'Nothing to unpack';
    exit();
  }

  $tmp_name = $_FILES['sitefile']['tmp_name'];
  move_uploaded_file($tmp_name, $new_name);

}

$zip = new ZipArchive;
if ($zip->open($new_name) === TRUE) {
  $zip->extractTo('.');
  $zip->close();
  echo 'Unpacked OK';
  exit();
} else {
  http_response_code(500);
  echo 'Failed';
  exit();
}

?>
