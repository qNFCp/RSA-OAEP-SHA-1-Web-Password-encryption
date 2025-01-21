# RSA-OAEP-SHA-1-Web-Password-encryption
Implementation of asymmetric encryption from html to PHP. 网页到PHP非对称加密实现

## 简介
使用 Web Crypto API + PHP openssl 实现的密码非对称加密实现。用于用户向服务器加密传输密码。

## 使用说明
> 根据使用场景需修改代码内容。本库仅为实现了一个简单的密码至服务端的案例，并会返回明文（前端控制台会显示）。

0. 访问gen_key.php 用于生成公钥私钥
1. index.html 向 rsa.php 获取公钥
2. index.html 使用公钥加密 密码
3. index.html 向 rsa.php 发送密文
4. rsa.php 解密密文并返回明文

## 开发环境
PHP 7.4.33

## PHP依赖
openssl

### License
This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
