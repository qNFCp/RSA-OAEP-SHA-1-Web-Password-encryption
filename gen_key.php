<?php
// 生成密钥对
$keyConfig = [
    'private_key_bits' => 2048, // 密钥长度
    'private_key_type' => OPENSSL_KEYTYPE_RSA,
];

$res = openssl_pkey_new($keyConfig);

// 提取私钥
openssl_pkey_export($res, $privateKeyPem);

// 提取公钥
$publicKeyPem = openssl_pkey_get_details($res)['key'];

// 保存密钥到文件（可选）
file_put_contents('private_key.pem', $privateKeyPem);
file_put_contents('public_key.pem', $publicKeyPem);

// 输出密钥
echo "Public Key:\n$publicKeyPem\n";
echo "Private Key:\n$privateKeyPem\n";
?>
