<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Evaluación Denver</title>
    <style>
        body {
            background-color: #f8f8f8;
            font-family: Arial, sans-serif;
        }

        .form-container {
            position: relative; /* Agregado posición relativa */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('{{ asset('img/login2.jpg') }}');
            background-size: cover;
            background-position: center;
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
            position: relative; /* Agregado posición relativa */
            width: 50%; /* Ajusta el ancho de la webcam */
        }

        .form-container form {
            flex: 1;
        }

       .emotion-icon-container {
        position: absolute;
        top: 20px;
        left: 20px;
        width: 80px;
        height: 80px;
        background-color: rgba(255, 255, 255, 0.9);
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        border: 2px solid #FF4545; /* Agregado borde rojo */
      }

      .emotion-icon-container i {
        font-size: 50px; /* Aumenta el tamaño del ícono */
      }

      .emotion-icon-container span {
        font-size: 16px; /* Aumenta el tamaño del texto de la probabilidad */
        color: #00FF00; /* Color verde fosforescente */
        text-align: center;
        margin-top: 10px; /* Ajusta el margen superior */
      }

      /* Estilos de color según la emoción */
      .emotion-icon-container.happy {
        background-color: #FFCE00; /* Amarillo */
      }

      .emotion-icon-container.sad {
        background-color: #0080FF; /* Azul */
      }

      .emotion-icon-container.angry {
        background-color: #FF4545; /* Rojo */
      }

      .emotion-icon-container.surprise {
        background-color: #FF8C00; /* Naranja */
      }

      .emotion-icon-container.fear {
        background-color: #00B000; /* Verde */
      }

      .emotion-icon-container.disgust {
        background-color: #800080; /* Morado */
      }

      .emotion-icon-container.neutral {
        background-color: #A0A0A0; /* Gris */
      }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div class="form-container">
    <div class="video-container">
        <video src="" id="video"></video>
        <div class="emotion-icon-container"></div>
    </div>
    <div id="emotion-container">
        <div id="response-container"></div>
    </div>
    <div class="form-content">
        <h1 class="form-title">Evaluación Denver</h1>
         <form action="{{ route('guardar_respuestas', ['evaluacionId' => $evaluacionId]) }}" method="POST" id="evaluacion-form">
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
            <div id="api-response-container" style="display: none;"></div>
            <input type="hidden" name="emotion_results" value="{{ htmlspecialchars(json_encode($emotionResults)) }}">
            <button type="submit" name="guardar_respuestas" class="btn btn-primary form-button">Guardar respuesta</button>
        </form>
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
 var captureInterval; 
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
      }, 2000); // Capturar y enviar cada 2 segundos

      // Detener la captura después de cierto tiempo (opcional)
      var stopCaptureTimeout = setTimeout(function () {
        clearInterval(captureInterval);
      }, 60000); // Detener la captura después de 1 minuto (ajusta el tiempo según tus necesidades)
    })
    .catch(function (error) {
      console.log('Error al acceder a la cámara:', error);
    });

  function sendImageUrlToEndpoint(imageUrl) {
  fetch('http://emocion.online/predict_emotion', {
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

        var emotionIcon = document.createElement('i');
        emotionIcon.className = 'far'; // Clase base de Font Awesome

        if (emotionClass === 'happy') {
          emotionIcon.classList.add('fa-smile'); // Clase de icono de Font Awesome para la felicidad
        } else if (emotionClass === 'sad') {
          emotionIcon.classList.add('fa-sad-tear'); // Clase de icono de Font Awesome para la tristeza
        } else if (emotionClass === 'angry') {
          emotionIcon.classList.add('fa-angry'); // Clase de icono de Font Awesome para el enojo
        } else if (emotionClass === 'surprise') {
          emotionIcon.classList.add('fa-surprise'); // Clase de icono de Font Awesome para la sorpresa
        } else if (emotionClass === 'fear') {
          emotionIcon.classList.add('fa-frown'); // Clase de icono de Font Awesome para el miedo
        } else if (emotionClass === 'disgust') {
          emotionIcon.classList.add('fa-flushed'); // Clase de icono de Font Awesome para el disgusto
        } else {
          emotionIcon.classList.add('fa-meh'); // Clase de icono de Font Awesome para la emoción neutral (por defecto)
        }

        var emotionProbSpan = document.createElement('span');
        emotionProbSpan.textContent = emotionProb.toFixed(2); // Ajusta la precisión decimal según tus necesidades

        // Agrega el ícono y la probabilidad al contenedor
        var emotionIconContainer = document.querySelector('.emotion-icon-container');
        emotionIconContainer.innerHTML = ''; // Limpia el contenido existente
        emotionIconContainer.appendChild(emotionIcon);

        // Agrega la clase de color correspondiente
        emotionIconContainer.classList.add(emotionClass);

         // Enviar los resultados de la emoción al servidor
        var formData = new FormData();
        formData.append('evaluacionId', {{ $evaluacionId }});
        formData.append('emocion', emotionClass);
        formData.append('probabilidad', emotionProb);
      } else {
        console.log('Error: la respuesta del servidor no contiene los datos esperados');
      }
    })
    .catch(function (error) {
      console.log('Error al enviar la URL de la imagen al servidor:', error);
    });
  }

  function stopCaptureAndSubmit(event) {
    event.preventDefault();
    clearInterval(captureInterval); // Detiene la captura de imágenes

    // Obtén el formulario y envíalo
    var form = document.getElementById('evaluacion-form');
    form.submit();
  }
  
  document.getElementById('evaluacion-form').onsubmit = stopCaptureAndSubmit;
</script>
</body>
</html>