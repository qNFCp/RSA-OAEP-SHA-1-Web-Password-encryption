<?php
// 设置响应头
header('Content-Type: application/json');

// 路由逻辑
$action = $_GET['action'] ?? null;

if ($action === 'getPublicKey') {
    // 发送公钥
    $publicKeyPem = file_get_contents('public_key.pem');
    if (!$publicKeyPem) {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to load public key.']);
        exit;
    }
    echo json_encode(['publicKey' => $publicKeyPem]);
} elseif ($action === 'decrypt') {
    /*  PHP 脚本中 $_POST 只适用于 application/x-www-form-urlencoded 或 multipart/form-data 类型。
        使用 JSON 时通过 file_get_contents("php://input") 获取原始请求内容。 
        */
    // 获取 JSON 载荷
    $rawData = file_get_contents('php://input');
    $payload = json_decode($rawData, true);

    if (!isset($payload['encryptedData'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Missing encryptedData']);
        exit;
    }

    // 获取前端传递的加密数据
    $encryptedData = $payload['encryptedData'];

    
    // Base64 解码
    $decodedData = base64_decode($encryptedData, true);
    if ($decodedData === false) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid encryptedData.']);
        exit;
    }

    // 加载私钥
    $privateKeyPem = file_get_contents('private_key.pem');
    if (!$privateKeyPem) {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to load private key.']);
        exit;
    }
    $privateKey = openssl_pkey_get_private($privateKeyPem);
    if (!$privateKey) {
        http_response_code(500);
        echo json_encode(['error' => 'Invalid private key.']);
        exit;
    }

    // 解密数据
    $decrypted = '';
    $success = openssl_private_decrypt($decodedData, $decrypted, $privateKey, OPENSSL_PKCS1_OAEP_PADDING);
    
    if ($success) {
        echo json_encode(['decryptedMessage' => $decrypted]);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to decrypt data. '.$decrypted]);
    }

    

} else {
    http_response_code(404);
    echo json_encode(['error' => 'Invalid action']);
}
?>
