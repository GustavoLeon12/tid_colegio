<?php
function saveImage()
{
  try {
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
      $imagenTempPath = $_FILES['image']['tmp_name'];
      $nombreOriginal = basename($_FILES['image']['name']);
      $mimeType = mime_content_type($imagenTempPath); // Dynamically detect MIME type

      $apiUrl = 'https://campus-colegiosorion.net.pe/apiimagenes-colegioorion/noticias.php';
      $curl = curl_init($apiUrl);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_POST, true);

      $postData = array(
        'image' => new CURLFile($imagenTempPath, $mimeType, $nombreOriginal)
      );
      curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
      $response = curl_exec($curl);

      if ($response === false) {
        throw new Exception(curl_error($curl));
      }

      // Parse JSON response
      $responseData = json_decode($response, true);
      if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception("Invalid JSON response from API: $response");
      }

      // Check for API error
      if (isset($responseData['error'])) {
        throw new Exception("API error: " . $responseData['error']);
      }

      // Extract filename
      if (isset($responseData['filename'])) {
        return $responseData['filename'];
      } else {
        throw new Exception("No filename returned by API");
      }
    } else {
      return 'default.jpg'; // Fallback if no image is uploaded
    }
  } catch (Exception $e) {
    error_log("saveImage error: " . $e->getMessage()); // Log for debugging
    return 'default.jpg'; // Fallback on error
  } finally {
    if (isset($curl)) {
      curl_close($curl);
    }
  }
}
?>