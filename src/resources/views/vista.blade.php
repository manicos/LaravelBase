<?php

$query = "batman";
$apiKey = "c809e516f37fa7407b060cc0dd57bce4";
// API URL
$url = 'https://api.themoviedb.org/3/search/movie?query='.$query.'&api_key='.$apiKey;

// Create a new cURL resource
$ch = curl_init($url);

// Setup request to send json via POST
/*$data = array(
    'username' => 'codexworld',
    'password' => '123456'
);
$payload = json_encode(array("user" => $data));

// Attach encoded JSON string to the POST fields
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);*/

// Set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json;charset=utf-8','api_key:'.$apiKey));

// Return response instead of outputting
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute the POST request
$result = curl_exec($ch);

// Close cURL resource
curl_close($ch);

$response = json_decode($result, true);

?>

<div style="width:100%; height:auto; padding:20px">

  <h1>Numero de resultados: <?php echo count($response["results"]); ?></h1>

  <h2>Lista de resultados</h2>

  <table cellpadding=0 cellspacing=4 border:1px  style="width:90%; border:1px solid #666">
    <tr>
      <td><strong>Imagen</strong></td>
      <td><strong>Título</strong></td>
      <td><strong>Ficha técnica</strong></td>
      <td><strong>Fecha de lanzamiento</strong></td>
      <td><strong>Opciones</strong></td>
    </tr>
    <?php
    for($i=0;$i<count($response["results"]);$i++){
      ?>
      <tr>
        <td><img src="<?php echo "https://image.tmdb.org/t/p/w500".$response["results"][$i]["poster_path"]; ?>" height="200"></td>
        <td><?php echo $response["results"][$i]["title"]; ?></td>
        <td><?php echo $response["results"][$i]["overview"]; ?></td>
        <td><?php echo $response["results"][$i]["release_date"]; ?></td>
        <td><a href="#">Editar</a> <a href="#">Eliminar</a></td>
      </tr>
      <?php
    }
    ?>
  </table>

</div>
