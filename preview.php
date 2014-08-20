<!DOCTYPE html>

<?php

require 'vendor/autoload.php';
include('config.php');

mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');

$results = [];

if (isset($_GET['id'])) {
    $fileId = filter_var($_GET['id'], FILTER_SANITIZE_STRING);

    $res = GuzzleHttp\post(
        "https://api.kloudless.com/v0/accounts/$accountId/links", [
            'headers' => [
                'Authorization' => "ApiKey $apiKey",
                'Content-Type' => 'application/json',
            ],
            'body' => json_encode([
                'file_id' => $fileId,
                'direct' => TRUE,
            ]),
        ]);

    if ($res->getStatusCode() == 201) {
        $results = $res->json();
    }
    else {
        echo var_dump($res->json());
    }
}
?>

<html>
  <head>
  <title>Search</title>

  <style>
    html, body, .preview-wrapper, iframe#preview {
      height: 100%;
    }
    iframe#preview {
      width: 100%;
      padding: 0px !important;
    }
  </style>

  </head>

  <body>
    <p>
      The file is displayed on the page in an IFRAME.
    </p>
    <div class="preview-wrapper">
<?php
        if (empty($results)) {
?>
          <p>Unable to display the file.</p>
<?php
        } else {
 ?>
          <iframe id="preview" src="<?= $results['url'] ?>?inline=true"></iframe>
<?php
        }
?>
    </div>
  </body>
</html>
