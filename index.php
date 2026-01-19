<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tandatangan Digital</title>

    <!-- Signature Pad CDN -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mea+Culpa&display=swap" rel="stylesheet">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/signature_pad.umd.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            background-image: url("images/frame-buttom.jpg"), url("images/frame-top.jpg");
            background-repeat: no-repeat, no-repeat;
            background-size: cover, cover;
            background-position: center bottom, center top;
            background-size: auto, auto;
            background-color: #cccccc;
        }
        canvas {
            background-color: #fff;
            border: 1px solid #ccc;
            width: 100%;
            height: 150px;
        }
        .center {
            margin-left: auto;
            margin-right: auto;
        }
        .parisienne-regular {
            font-family: "Mea Culpa", cursive;
            font-weight: 400;
            font-style: normal;
            font-size: 120px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <table class="center" style="height: 100px;">
            <tbody>
                <tr>
                    <td class="align-middle">
                        <img src="images/jtm.png" class="mx-3"alt="logo JTM" style="height: 80px;">
                    </td>
                    <td class="align-middle">
                        <img src="images/jata.png" class="mx-3" alt="logo Jata Negara" style="height: 120px;">
                    </td>
                    <td class="align-middle">
                        <img src="images/JiMS.png" class="mx-5" alt="logo JiMS" style="height: 80px;">
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="text-center">
            <h1 class="parisienne-regular">Majlis Perasmian</h1>
            <h3 class="mb-0">SISTEM JTM INTEGRATED MANAGEMENT SYSTEM (JiMS)</h3>
            <h5 class="font-monospace">Gerbang Digital TVET JTM</h5>
            <p>Disempurnakan Oleh:</p>

            <canvas id="signature-pad"></canvas>

            <div class="btn-group">
                <button class="btn btn-warning btn-clear" onclick="clearPad()">Clear</button>
                <button class="btn btn-success btn-save" onclick="saveSignature()">Simpan Tandatangan</button>
            </div>

            <p class="fs-2 fw-bold mb-0">YBhg. Datuk Rospiagos Bin Taha</p>
            <p class="fs-4 fw-bold">KETUA PENGARAH
            <br>JABATAN TENAGA MANUSIA</p>
            <p>pada</p>
            <p class="fs-4 fw-bold">20 Januari 2026 bersamaan 1 Syaaban, 1447h</p>
            <p>&nbsp</p>
        </div>
    </div>

    <script>
        const canvas = document.getElementById('signature-pad');

        // auto resize canvas ikut screen
        function resizeCanvas() {
            const ratio = Math.max(window.devicePixelRatio || 1, 1);
            canvas.width = canvas.offsetWidth * ratio;
            canvas.height = canvas.offsetHeight * ratio;
            canvas.getContext("2d").scale(ratio, ratio);
        }
        window.onresize = resizeCanvas;
        resizeCanvas();

        const signaturePad = new SignaturePad(canvas);

        function clearPad() {
            signaturePad.clear();
        }

        function saveSignature() {
            if (signaturePad.isEmpty()) {
                alert('Sila tandatangan dahulu');
                return;
            }

            const dataURL = signaturePad.toDataURL('image/png');

            fetch('save_signature.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({
                    signature: dataURL,
                    document_id: 1   // contoh ID dokumen
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'ok') {
                    // alert('Tandatangan berjaya disimpan');
                    signaturePad.clear();
                    window.location.href = 'preview.php?id=' + data.id;
                } else {
                    alert('Gagal simpan tandatangan');
                }
            });
        }
    </script>
</body>
</html>