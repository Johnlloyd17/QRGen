<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>
    <div class="qr-generator">
        <div class="input-group">
            <label for="text-input">Enter Text or URL:</label>
            <textarea id="text-input" placeholder="Enter text or URL" rows="3"></textarea>
        </div>
        <div class="input-group">
            <label for="size-input">Size (px):</label>
            <input type="number" id="size-input" value="300" min="100" max="500">
        </div>
        <div class="input-group">
            <label for="bg-color-input">Background Color:</label>
            <input type="color" id="bg-color-input" value="#ffffff">
        </div>
        <div class="input-group">
            <label for="fg-color-input">Foreground Color:</label>
            <input type="color" id="fg-color-input" value="#000000">
        </div>
        <div class="input-group">
            <label for="error-correction">Error Correction Level:</label>
            <select id="error-correction">
                <option value="L">Low (L)</option>
                <option value="M">Medium (M)</option>
                <option value="Q">Quartile (Q)</option>
                <option value="H">High (H)</option>
            </select>
        </div>
        <div class="input-group">
            <label for="font-size-slider" class="slider-label">Font Size (for text embedded in QR):</label>
            <div class="slider-container">
                <input type="range" id="font-size-slider" min="8" max="24" value="16">
            </div>
        </div>
        <div class="input-group">
            <label for="border-radius-slider" class="slider-label">QR Code Border Radius:</label>
            <div class="border-radius-container">
                <input type="range

" id="border-radius-slider" min="0" max="50" value="0">
            </div>
        </div>

        <button id="generate-btn">Generate QR Code</button>
        <div id="qr-code">
            <canvas id="qr-canvas"></canvas>
            <button id="download-btn">Download QR Code</button>
            <div id="qr-info"></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/qrious/dist/qrious.min.js"></script>
    <script>
        const qr = new QRious({
            element: document.getElementById('qr-canvas'),
            size: 300,
            value: '',
            background: '#ffffff',
            foreground: '#000000',
            level: 'L'
        });

        document.getElementById('generate-btn').addEventListener('click', () => {
            const text = document.getElementById('text-input').value;
            const size = parseInt(document.getElementById('size-input').value);
            const bgColor = document.getElementById('bg-color-input').value;
            const fgColor = document.getElementById('fg-color-input').value;
            const errorCorrection = document.getElementById('error-correction').value;
            const fontSize = document.getElementById('font-size-slider').value;
            const borderRadius = document.getElementById('border-radius-slider').value;

            if (text.trim() === '') {
                alert('Please enter text or a URL');
                return;
            }

            qr.set({
                value: text,
                size: size,
                background: bgColor,
                foreground: fgColor,
                level: errorCorrection
            });

            // Show download button and info
            document.getElementById('download-btn').style.display = 'block';
            document.getElementById('qr-info').style.display = 'block';

            // Update QR Info
            document.getElementById('qr-info').innerHTML = `
                <strong>Text/URL:</strong> ${text}<br>
                <strong>Size:</strong> ${size}px<br>
                <strong>Background Color:</strong> ${bgColor}<br>
                <strong>Foreground Color:</strong> ${fgColor}<br>
                <strong>Error Correction Level:</strong> ${errorCorrection}<br>
                <strong>Font Size:</strong> ${fontSize}px<br>
                <strong>Border Radius:</strong> ${borderRadius}px
            `;
        });

        document.getElementById('download-btn').addEventListener('click', () => {
            const canvas = document.getElementById('qr-canvas');
            const link = document.createElement('a');
            link.href = canvas.toDataURL('image/png');
            link.download = 'qr-code.png';
            link.click();
        });
    </script>
</body>

</html>