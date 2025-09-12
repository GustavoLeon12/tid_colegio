<?php
function saveImage()
{
  try {
    if (isset($_FILES['image'])) {
      $imagenTempPath = $_FILES['image']['tmp_name'];
      $nombreOriginal = $_FILES['image']['name'];

      $apiUrl = 'https://campus-colegiosorion.net.pe/apiimagenes-colegioorion/usuarios.php';
      $curl = curl_init($apiUrl);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_POST, true);

      $postData = array(
        'image' => new CURLFile($imagenTempPath, 'image/jpeg', $nombreOriginal)
      );
      curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
      $response = curl_exec($curl);

      if (!$response) {
        throw new Exception(curl_error($curl));
      }
      return $response;
    } else {
      throw new Exception("Image file not found in $_FILES");
    }
  } catch (Exception $e) {
    return "ERROR";
  } finally {
    if ($curl) {
      curl_close($curl);
    }
  }
}

?>