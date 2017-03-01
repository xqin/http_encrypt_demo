<?php
$private_key = '-----BEGIN RSA PRIVATE KEY-----
MIIEpAIBAAKCAQEAtpZGFbPBA37s8Z+iNm/3f0s9ia35izQaIh6OUJk/RYqtHP+M
NtfJzvgTV7186rPzBxVO6wh3sdEbXfDY64oW36KwLKSTmQLe6cmYLrI3k88RsDE3
Zx3y5oy1lv8K4hKM/WMDYP9GG79giywOQOxeVwEE9OOUbFL6ZGkFhAE2N727RUKw
Wwo+a+DQgCGimpq6HyYrMacxtzj0ZSsIJNK8WiOu6PuF0k9yBHPBI5QAIYxIC/gR
35GEOiO4i/AoPC7QYrZJrfQa1I2Crs7v2llKq5CBPwWTE813scZ4IO/E7xhFDTmG
/5TKcdUuoe8qV76QmVAH9z+mTqO6Hf8lC8JQ6wIDAQABAoIBACHwcPqbvSb/Mt//
AlIIIgNBYyDye85KUwlAkMeelMpCasdXISMYnWShbEcE6/FcnbIVXeQGYOlmqyWd
HVU7B+FuBj1mIiFxDSp71JPpgLcy6GDN5TR/tqTwRtjYc5duR1LaUsh26vtBaZq1
B7k9tpOJlvhGTVKNYgnEE8hjyUY25+5XG++gqB+g4AuU4t3NevvUm3U/R7CwsKT2
Zxw/dFDQi7CL4uOa7/EM2w7F9K5zHQNUFMn7BRlUADiqOYp4EgGWEmRefQRjZ2ry
tHY0usyopN6jsBBTYSne2/yEpFVsSNl4lGLSvlKTjumLKHj8+q5Fw8FVajDmc+rD
mByZpfECgYEA3leht6pEL1mkQ31RZa7dA3v8lxyhqEcOHsypEEe66fUM/daO997o
1XeZgEqASZyveD1LPOEzGIrMu3ds6h0uEGNFZrjsWBG6BiI8ejKTb/j1dkOzqT8Y
ehYwuHb/9Weh2q8mRTFAlXnjoQORB1bTVh56Tsr8mr7MjUajcuLcwAcCgYEA0joE
HNH23Cr4gyqjNxs6D7Y10us6pGEnp3R3dZn15HY37RvY9bCJNgqLkoS+vcgSU4SD
OHm6hqkN6MQZ9INrPfd0KlBB26p7ez0iYUtIlgjnQHU8K2Vs4RXuebK/6+XDXYL9
JxaC61j91iNN/0aSo0Y/N1JQ1zqXe9Si9YdMpv0CgYEAl0mHZ0J6rMFRDP8LUKYA
CqvlviikMq1OhVR6wPId062DDoFcvHo3cXC0yN9olS4BE06ZkC4np05iajijqlT6
j/oMMg4n+vDs49mNzxP00F7VHoiIieO90uygcBPArAm8zuEYqEIQEOVkJp4Xo6fH
mzSXwl9KLD0hUAu9kaGd1ScCgYAFPdEQbuO6xY+ApbWAEDu4XJCm+5pwssNsV2kL
E5Wf5pqqXMFiDs68/DJSquCelrhuQKWM6OwPo3NnVExZXlV0LBFHZMzfjzaY8gND
bb8Xjo1FfCbN5i96xTM28Y/7b7UZRcTODq+g8o0Ro7u0G6xYSc4VsQW2+A0C12Bg
wsjUeQKBgQCHzWPtVM3rIkMMTDDgEY3IGohmCXPP+oCxrdXFvUiSobWIRWc0JyeT
+YEdP2FSrlv2REUBqBrWZNG3aKzsyP5PaSfYpJuQen7l/OP90aHJe6yT3AMbDssM
IObpWTgP5ETkyZVbbArCVOu/eiVtXYlggL1vP//XRPXPAzDBsj4W6w==
-----END RSA PRIVATE KEY-----
';

$key = @$_GET['key'];


if (strlen($key) > 0) {
  $pi_key =  openssl_pkey_get_private($private_key);

  openssl_private_decrypt(hex2bin($key), $decrypted, $pi_key);//私钥解密

  if ($decrypted === NULL) {
    die();
  }

  require(__DIR__ . '/libs/QQTEA.php');

  $key = $decrypted;

  $data = 'Hello Client ' . date('Y-m-d H:i:s');

  echo json_encode(array('data'=> bin2hex(QQTEA::encrypt($key, $data))));
}
