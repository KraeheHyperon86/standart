<?php
include_once "./include/autoloader.php";

?>
<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"> 
    <title><?php echo Config::TITLE?></title>
    <link rel="stylesheet" href="./styles/variable.css">
    <script src="https://kit.fontawesome.com/515d599e21.js" crossorigin="anonymous"></script>
    <script  defer src="./scripts/howler.js"></script>
    <script  defer src="./scripts/jquery-3.7.1.js"></script>
    <link rel="manifest" href="./manifest.json">
    <meta name="mobile-web-app-capable" content="yes">
  </head>
  <body>

    <script defer>
      const ROOT = <?php echo Config::ROOT?>
      if("serviceWorker" in navigator) {
        navigator.serviceWorker.register(`/${ROOT}/scripts/sw.js`, { scope:` /${ROOT}/` })
        .then(function(registration) {
          console.log("ServiceWorker registration successful with scope: ", registration.scope);
        })
        .catch(function(err) {
          console.log("ServiceWorker registration failed: ", err);
        });
      }
    </script>
  </body>
</html>
