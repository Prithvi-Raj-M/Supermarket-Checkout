<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Barcode Scanner</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
  <h1>Barcode Scanner</h1>
  <div id="scanner-container">
    <video id="barcode-scanner" width="50%" height="30%" autoplay playsinline></video>
    <canvas id="canvas" style="display: none;"></canvas>
  </div>
  <div id="result"></div>
  <!--<button id="startScanner">Start Scanner</button> Button to start the scanner -->

  <!-- QuaggaJS library via CDN -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>

 <script>
  document.addEventListener('DOMContentLoaded', async () => {
    const videoElement = document.getElementById('barcode-scanner');
    const canvas = document.getElementById('canvas');
    const canvasContext = canvas.getContext('2d');
    let scannerStarted = false; // Track if the scanner has been started

    try {
      const stream = await navigator.mediaDevices.getUserMedia({ video: true });
      videoElement.srcObject = stream;

      const config = {
        inputStream: {
          name: 'Live',
          type: 'LiveStream',
          target: videoElement,
          constraints: {
            width: { min: 400 },
            height: { min: 400 },
            facingMode: 'environment',
          },
        },
        decoder: {
          readers: ['ean_reader', 'code_128_reader', 'code_39_reader', 'upc_reader'],
        },
      };

      Quagga.init(config, function (err) {
        if (err) {
          console.error(err);
          return;
        }
        Quagga.start();
        scannerStarted = true; // Set scannerStarted to true when the scanner starts

        Quagga.onProcessed((result) => {
          const drawingCanvas = Quagga.canvas.ctx.overlay;
          if (result) {
            if (result.boxes) {
              drawingCanvas.clearRect(0, 0, parseInt(drawingCanvas.canvas.width), parseInt(drawingCanvas.canvas.height));
              result.boxes.filter((box) => box !== result.box).forEach((box) => {
                Quagga.ImageDebug.drawPath(box, { x: 0, y: 1 }, drawingCanvas, { color: 'green', lineWidth: 2 });
              });
            }

            if (result.box) {
              Quagga.ImageDebug.drawPath(result.box, { x: 0, y: 1 }, drawingCanvas, { color: 'blue', lineWidth: 2 });
            }

            if (result.codeResult && result.codeResult.code) {
              document.getElementById('result').innerHTML += `Detected barcode: ${result.codeResult.code}`;
              window.location.href = "index.php?data=" + encodeURIComponent(result.codeResult.code);

              Quagga.stop();
              scannerStarted = false; // Reset scannerStarted to false when the scanner stops
            }
            
          }
        });
      });
    } catch (error) {
      console.error('Error accessing the camera:', error);
    }
  });
</script>

</body>
</html>
