<?php
require('../vendor/autoload.php');

use Encryption\Encryption;
use Encryption\Exceptions\EncryptException;

$cipher = !empty($_POST['cipher']) ? $_POST['cipher'] :'';
$key  = !empty($_POST['key']) ? $_POST['key'] : '';

if (isset($_POST['btn'])) {
  try {
    if ($cipher != '' && $key != '') {
      $encryption = Encryption::getEncryptionObject('rc2-ecb');
      $decryptedText = $encryption->decrypt($cipher, $key);
    } else{
      $warn = 'Ooops, cipherteks or key is required';
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
          <h1 class="opacity">RC 2 Decryption</h1>
          <form method="post" action="">
            <input type="text" name="cipher" placeholder="Chiperteks" value="<?= $cipher; ?>" />
            <input type="text" name="key" placeholder="Key" value="<?= $key; ?>" />
            <input type="submit" name="btn" class="btn opacity" value="Decrypt"></input>
          </form>
          <div class="opacity">
            <?php if ($cipher == '' && $key == '') {
              echo @$warn;
            } else{
              echo "Decrypted: <hr>";
              echo $decryptedText;
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