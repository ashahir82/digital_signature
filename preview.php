<?php
if (isset($_GET['id']) === true) {
    $signature_id = $_GET['id'];
    $db = new mysqli("localhost", "root", "pass", "digital_signature");
    $result = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM `document_signatures` WHERE `id` = '$signature_id'"));
} else {
    $URL = 'index.php';
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
    exit();
}
?>
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
            height: 200px;
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
        #videoModal{
            display:none;
            position:fixed;
            top:0;
            left:0;
            width:100%;
            height:100%;
            background:black;
            z-index:9999;
        }
        #launchVideo{
            width:100%;
            height:100%;
            object-fit:contain;
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

            <div class="text-center">
                <img src="<?= 'uploads/signatures/' . $result['signature_file'] ?>" class="img-fluid" alt="signature" id="signature-image">
            </div>

            <div class="btn-group">
                <button class="btn btn-warning btn-back" onclick="returnIndex()">Kembali</button>
                <button class="btn btn-success btn-save" onclick="playLaunchVideo()">Sila sahkan</button>
            </div>

            <div id="videoModal">
                <video id="launchVideo" autoplay playsinline>
                    <source src="videos/video_1.mp4" type="video/mp4">
                </video>
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
        function playLaunchVideo(){
            const modal=document.getElementById('videoModal');
            const video=document.getElementById('launchVideo');
            modal.style.display='block';
            video.currentTime=0;

            if(video.requestFullscreen) video.requestFullscreen();
            else if(video.webkitRequestFullscreen) video.webkitRequestFullscreen();
            else if(video.msRequestFullscreen) video.msRequestFullscreen();

            video.play();

            video.onended=function(){
                if(document.exitFullscreen) document.exitFullscreen();
                modal.style.display='none';
                window.location.reload(); // return page
            }
        }

        function returnIndex(){
            window.location.href = 'index.php';
        }
    </script>
</body>
</html>