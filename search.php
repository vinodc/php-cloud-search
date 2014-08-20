<!DOCTYPE html>

<?php

require 'vendor/autoload.php';
include('config.php');

mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');

$errors = '';
$results = [];
$isPost = isset($_POST['submit']);

if ($isPost) {
    $query = filter_var($_POST['query'], FILTER_SANITIZE_STRING);

    $res = GuzzleHttp\get(
        "https://api.kloudless.com/v0/accounts/$accountId/search", [
            'headers' => ['Authorization' => "ApiKey $apiKey"],
            'query' => ['q' => $query]
        ]);

    if ($res->getStatusCode() == 200) {
        $results = $res->json();
    }
    else {
        $errors = "An error occured making the search request.";
    }
}

?>

<html>
  <head>
    <title>Search</title>
  </head>
  <body>

    <div>
      <form method="POST">
        <p>
          Search:
          <input type="text" name="query" required />
          <input type="submit" name="submit" value="Search" />
        </p>
      </form>
    </div>

<?php
if ($isPost) {
    echo "<p>Search Results for '$query':</p>";
}
?>
    
    <div class="results">
<?php
if ($errors != '') {
    echo '<p class="errors">' + $errors + '</p>';
}

if ($isPost && !empty($results)) {
   echo "<p class='result-count'>Found {$results['count']} results.</p>";

   foreach ($results['objects'] as &$file) {
     echo <<<END
      <div class="result">
        <a href="/preview.php?id={$file['id']}">
        {$file['name']}
        </a>
      </div>
END;
   }
}
?>
    </div>
    
  </body>
</html>
