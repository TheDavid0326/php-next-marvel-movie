<?php 

const API_URL ="https://whenisthenextmcufilm.com/api"; 
# Inicializamos una nueva sessión de cURL, ch = cURL handle

/* Alternativa a cURL si solo se quiere hacer un GET de una API
$response = file_get_contents(API_URL);
$data = json_decode($response, true);
echo $response;
*/

$ch = curl_init(API_URL);

//Recibir el resultado de la petición y no imprimirlo
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

// $result contiene una cadena de texto en formato JSON
$result = curl_exec($ch); 

/* PHP no puede trabajar directamente con cadenas JSON como si fueran arrays u objetos. 
json_decode decodifica la cadena JSON y la transforma en un array asociativo.*/ 
$data = json_decode($result, true); 

curl_close($ch);

?>

<head>
    <title>The next Marvel Movie</title>
    <meta name="description" content="La próxima película de Marvel">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.classless.min.css"
>
</head>

<?php  ?>


<body>
    <main>
        <section>
            <h2>The next Marvel Movie is <?=$data['title'] ?> </h2>
            <img src="<?=$data['poster_url'] ?>" alt='Poster de la película' />
            <p><?=$data['days_until'] ?> days until the premiere on day <?=$data["release_date"] ?> </p>
            <p><?=$data["overview"] ?> </p>
        </section>

        <section>
            <?php $nextProduction=$data["following_production"]  ?>
            <h2>The next Marvel Production is <?=$nextProduction['title'] ?> </h2>
            <img src="<?=$nextProduction['poster_url'] ?>" alt='Poster de la película' />
            <p><?=$nextProduction['days_until'] ?> days until the premiere on day <?=$nextProduction["release_date"] ?> </p>
            <p><?=$nextProduction["overview"] ?> </p>
        </section>
    </main>
</body>

<style>
    :root  {
        color-scheme: dark light;
    }
    main {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      min-height: 100vh; /* Altura completa de la pantalla */
      text-align: center; /* Centra el texto */
  }

  section {
      max-width: 600px; /* Para evitar que el contenido sea demasiado ancho */
  }
</style>

