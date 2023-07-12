<!DOCTYPE html>
<html>
<head>
    <title>Evaluación Denver</title>
    <style>
        body {
            background-color: #f8f8f8;
            font-family: Arial, sans-serif;
        }

        .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('{{ asset('img/login2.jpg') }}');
            background-size: cover;
            background-position: center;
            position: relative;
            margin-bottom: 30px; /* Agregado espacio inferior */
        }

        .form-content {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 600px;
            width: 100%;
            height: auto;
            margin-top: 30px;
            margin-right: 30px; /* Agregado margen derecho */
            margin-bottom: 30px; /* Agregado espacio inferior */
        }

        .form-title {
            font-size: 28px;
            margin-bottom: 30px;
            color: #333;
        }

        .question {
            margin-bottom: 30px;
            text-align: left;
        }

        .question h3 {
            margin-bottom: 10px;
            font-size: 18px;
            color: #333;
        }

        .options {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: center;
        }

        .options li {
            margin-right: 10px;
        }

        .options label {
            display: inline-block;
            background-color: #f1f1f1;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            color: #333;
        }

        .options input[type="radio"] {
            display: none;
        }

        .options label:hover,
        .options input[type="radio"]:not(:disabled):checked + label {
            background-color: #36a0f3;
            color: #ffffff;
        }

        .form-button {
            margin-top: 30px;
            background-color: #36a0f3;
            color: #ffffff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        .form-decor {
            position: absolute;
            top: -30px;
            left: -30px;
            background-color: #36a0f3;
            width: 60px;
            height: 60px;
            border-top-left-radius: 50%;
            border-bottom-right-radius: 50%;
        }

        #video {
            max-width: 100%;
            height: auto;
        }

        .video-container {
            width: 50%; /* Ajusta el ancho de la webcam */
        }

        .form-container form {
            flex: 1;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
<body>
<div class="form-container">
    <div class="video-container">
        <video src="" id="video"></video>
    </div>
    <div id="emotion-container">
        <div id="response-container"></div>
    </div>
    <div class="form-content">
        <h1 class="form-title">Evaluación Denver</h1>
         <form action="{{ route('guardar_respuestas', ['evaluacionId' => $evaluacionId]) }}" method="POST">
            @csrf
            <h2>{{ $area->nombre }}</h2>
            @foreach ($preguntas as $pregunta)
                <div class="question">
                    <h3>{{ $pregunta->pregunta }}</h3>
                    <ul class="options">
                        @foreach ($denverEscala as $opcion)
                            <li>
                                <input type="radio" name="pregunta_{{ $pregunta->id }}" value="{{ $opcion->etiqueta }}" id="opcion_{{ $pregunta->id }}_{{ $opcion->id }}">
                                <label for="opcion_{{ $pregunta->id }}_{{ $opcion->id }}">{{ $opcion->etiqueta }}</label>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
            <!-- Agregar un campo oculto para enviar los resultados -->
            <input type="hidden" name="emotion_results" value="{{ htmlspecialchars(json_encode($emotionResults)) }}">
            <button type="submit" name="guardar_respuestas" class="btn btn-primary form-button" onclick="stopCaptureAndSubmit()">Guardar respuesta</button>
        </form> 
        @if (isset($emotion))
            <div class="emotion-result">
                Emoción detectada: {{ $emotion }}
            </div>
        @endif
        
    </div>
</div>


<script src="https://sdk.amazonaws.com/js/aws-sdk-2.965.0.min.js"></script>
<script>
  var emotionResults = {!! json_encode($emotionResults) !!};
  var bucketName = 'denver-emotion';

  AWS.config.update({
    accessKeyId: 'AKIAT5WDOTWE7UDWPY3G',
    secretAccessKey: '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',
    region: 'us-east-1'
  });

  var s3 = new AWS.S3();

  navigator.mediaDevices.getUserMedia({ video: true })
    .then(function (stream) {
      var videoElement = document.getElementById('video');
      videoElement.srcObject = stream;
      videoElement.play();

      var canvas = document.createElement('canvas');
      var context = canvas.getContext('2d');

      // Capturar y enviar automáticamente cada cierto intervalo de tiempo
      var captureInterval = setInterval(function () {
        context.drawImage(videoElement, 0, 0, canvas.width, canvas.height);
        canvas.toBlob(function (blob) {
          var fileName = 'captura-' + Date.now() + '.jpg';

          var params = {
            Bucket: bucketName,
            Key: fileName,
            Body: blob,
            ACL: 'public-read'
          };

          s3.upload(params, function (error, data) {
            if (error) {
              console.log('Error al cargar la imagen en Amazon S3:', error);
             
            } else {
              console.log('Imagen cargada exitosamente en Amazon S3:', data.Location);
             
              // Enviar la URL de la imagen al endpoint /predict_emotion
              var imageUrl = data.Location;
              sendImageUrlToEndpoint(imageUrl);
            }
          });
        }, 'image/jpeg');
      }, 10000); // Capturar y enviar cada 10 segundos

      // Detener la captura después de cierto tiempo (opcional)
      var stopCaptureTimeout = setTimeout(function () {
        clearInterval(captureInterval);
      }, 60000); // Detener la captura después de 1 minuto (ajusta el tiempo según tus necesidades)
    })
    .catch(function (error) {
      console.log('Error al acceder a la cámara:', error);
    });

  function sendImageUrlToEndpoint(imageUrl) {
  fetch('http://localhost:5000/predict_emotion', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({ imageUrl: imageUrl })
  })
    .then(function (response) {
      return response.json();  // Parseamos la respuesta como JSON
    })
    .then(function (data) {
      // Manipular la respuesta del servidor, si es necesario
      console.log('Respuesta del servidor:', data);
      document.getElementById('api-response-container').textContent = 'Respuesta del servidor: ' + JSON.stringify(data);
      
      // Verificar si la respuesta contiene los datos esperados
      if (data.results && data.results.length > 0) {
        var emotionClass = data.results[0].emotion_class;
        var emotionProb = data.results[0].emotion_prob;

        // Almacenar en el array emotionResults
        
        emotionResults.push({ emotion_class: emotionClass, emotion_prob: emotionProb });
        console.log('Resultados de emociones:', emotionResults);
         document.querySelector('input[name="emotion_results"]').value = JSON.stringify(emotionResults);
         console.log('Valor actual de emotion_results:', document.querySelector('input[name="emotion_results"]').value);
      } else {
        console.log('Error: la respuesta del servidor no contiene los datos esperados');
      }
    })
    .catch(function (error) {
      console.log('Error al enviar la URL de la imagen al servidor:', error);
    });
}
</script>
</body>
</html>