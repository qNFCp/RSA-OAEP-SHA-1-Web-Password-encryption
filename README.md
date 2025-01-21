# RSA-OAEP-SHA-1-Web-Password-encryption
Implementation of asymmetric encryption from html to PHP. 网页到PHP非对称加密实现

## 说明
> 根据使用场景需修改代码内容。本库仅供实现参考。

0. 访问gen_key.php 用于生成公钥私钥
1. index.html 向 rsa.php 获取公钥
2. index.html 使用公钥加密 密码
3. index.html 向 rsa.php 发送密文
4. rsa.php 解密密文并返回明文
