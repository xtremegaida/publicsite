<?php
if (!file_exists('site.zip')) {
  http_response_code(500);
  echo 'Nothing to unpack';
  exit();
}
$zip = new ZipArchive;
if ($zip->open('site.zip') === TRUE) {
  $zip->extractTo('.');
  $zip->close();
  unlink('site.zip');
  echo 'Unpacked OK';
  exit();
} else {
  http_response_code(500);
  echo 'Failed';
  exit();
}
?>
