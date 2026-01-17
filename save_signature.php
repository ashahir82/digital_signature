<?php
session_start();

/*
|--------------------------------------------------------------------------
| DEMO USER
| Dalam JiMS sebenar → ambil dari login session
|--------------------------------------------------------------------------
*/
$_SESSION['user_id'] = 7;

/*
|--------------------------------------------------------------------------
| DATABASE CONNECTION
|--------------------------------------------------------------------------
*/
$db = new mysqli("localhost", "root", "pass", "digital_signature");

if ($db->connect_error) {
    http_response_code(500);
    echo json_encode(['status' => 'db_error']);
    exit;
}

/*
|--------------------------------------------------------------------------
| READ JSON INPUT
|--------------------------------------------------------------------------
*/
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['signature'])) {
    echo json_encode(['status' => 'invalid']);
    exit;
}

$signatureBase64 = $data['signature'];
$documentId = (int)$data['document_id'];
$userId = $_SESSION['user_id'];

/*
|--------------------------------------------------------------------------
| PROCESS BASE64 IMAGE
|--------------------------------------------------------------------------
*/
$signatureBase64 = str_replace('data:image/png;base64,', '', $signatureBase64);
$signatureBase64 = str_replace(' ', '+', $signatureBase64);
$imageData = base64_decode($signatureBase64);

if ($imageData === false) {
    echo json_encode(['status' => 'decode_failed']);
    exit;
}

/*
|--------------------------------------------------------------------------
| SAVE IMAGE FILE
|--------------------------------------------------------------------------
*/
$folder = __DIR__ . '/uploads/signatures/';
if (!is_dir($folder)) {
    mkdir($folder, 0777, true);
}

$filename = 'sign_' . $documentId . '_' . $userId . '_' . time() . '.png';
$filePath = $folder . $filename;

file_put_contents($filePath, $imageData);

/*
|--------------------------------------------------------------------------
| SAVE DATABASE RECORD
|--------------------------------------------------------------------------
*/
$stmt = $db->prepare("
    INSERT INTO document_signatures
    (document_id, user_id, signature_file, signed_at, ip_address)
    VALUES (?, ?, ?, NOW(), ?)
");

$ip = $_SERVER['REMOTE_ADDR'];
$stmt->bind_param("iiss", $documentId, $userId, $filename, $ip);
$stmt->execute();
$lastId = $stmt->insert_id;

$stmt->close();
$db->close();

/*
|--------------------------------------------------------------------------
| RESPONSE
|--------------------------------------------------------------------------
*/
echo json_encode(['status' => 'ok', 'id' => $lastId]);
