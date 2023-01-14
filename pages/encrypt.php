<?php
require('../vendor/autoload.php');

use Encryption\Encryption;
use Encryption\Exceptions\EncryptException;

$text = !empty($_POST['plain']) ? $_POST['plain'] : '';
$key  = !empty($_POST['key']) ? $_POST['key'] : '';
$mode = !empty($_POST['mode']) ? $_POST['mode'] : '';
$warn = '';

if (isset($_POST['btn'])) {
  try {
    if ($mode != '' && $text != '' && $key != '') {
      if ($mode == 'cbc') {
        $encryption = Encryption::getEncryptionObject('rc2-cbc');
        $iv = $encryption->generateIv();
        $encryptedText = $encryption->encrypt($text, $key, $iv);
      } else{
        $encryption = Encryption::getEncryptionObject('rc2-ecb');
        $encryptedText = $encryption->encrypt($text, $key);
      }
    } else{
      $warn = 'Ooops, plainteks or key or mode is required';
    }
}
catch (EncryptException $e) {
    echo $e;
}
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <link
      rel="apple-touch-icon"
      sizes="180x180"
      href="../assets/icon/apple-touch-icon.png"
    />
    <link
      rel="icon"
      type="image/png"
      sizes="32x32"
      href="../assets/icon/favicon-32x32.png"
    />
    <link
      rel="icon"
      type="image/png"
      sizes="16x16"
      href="../assets/icon/favicon-16x16.png"
    />
    <link rel="manifest" href="../assets/icon/site.webmanifest" />
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kelompok 2</title>
    <link rel="stylesheet" href="../assets/style.css" />
  </head>
  <body>
    <section class="container">
      <a href="../index.html" name="back" class="back" style="position: absolute; left: 20px; top: 20px;  background-color: white;color: black; padding: 13px; border-radius: 5px;">Back</a>
      <div class="login-container">
        <div class="circle circle-one"></div>
        <div class="form-container">
          <h1 class="opacity">RC 2 Encryption</h1>
          <form method="post" action="">
            <input type="text" name="plain" placeholder="Plainteks" value="<?= $text; ?>" />
            <input type="text" name="key" placeholder="Key" value="<?= $key; ?>" />
            <select name="mode" >
              <option value="" selected>Choose Mode</option>
              <option value="ecb">ECB</option>
              <option value="cbc">CBC</option>
            </select>
            <input type="submit" name="btn" class="btn opacity" value="Encrypt"></input>
          </form>
          <div class="opacity">
            <?php if ($warn != '' || $mode == '') {
              echo $warn;
            } else if($mode == 'cbc'){
              echo "Mode: <hr>";
              echo $encryption->getName()."<br><br>";
              echo "iv: <hr>";
              echo bin2hex($iv) . "<br><br>";
              echo "Encrypted: <hr>";
              echo $encryptedText;
            } else{
              echo "Mode: <hr>";
              echo $encryption->getName()."<br><br>";
              echo "Encrypted: <hr>";
              echo $encryptedText;
            } ?>
          </div>
        </div>
        <div class="circle circle-two"></div>
      </div>
      <div class="theme-btn-container"></div>
    </section>
    <script src="../assets/script.js"></script>
  </body>
</html>