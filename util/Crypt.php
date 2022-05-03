<?php
class Crypt
{
    private $options = 0;
    private $ciphering = "BF-CBC";
    private $encryption_iv;

    public function __construct() {
        $this->encryption_iv = random_bytes(openssl_cipher_iv_length($this->ciphering));
    }
    
    /**
     * CRIPTOGRAFA
     * Retorna a string passada no método de criptografia MD5
     *
     * @param $plaintext
     * @return string
     */
    public function encrypt($plaintext)
    {
        $encryption_key = openssl_digest(php_uname(), 'MD5', TRUE);

        $encryption = openssl_encrypt(
            $plaintext,
            $this->ciphering,
            $encryption_key,
            $this->options,
            $this->encryption_iv
        );

        $encrypt_obj = array('encryption' => $encryption, 'encryption_key' => base64_encode($this->encryption_iv));
        return $encrypt_obj;
    }

    /**
     * Descriptografa uma string em MD5 para seu valor original.
     *
     * @param $encryptedSessionId
     * @return string
     */
    public function decrypt($encrypted, $encryption_iv)
    {
        $decryption_key = openssl_digest(php_uname(), 'MD5', TRUE);

        $decryption = openssl_decrypt(
            $encrypted,
            $this->ciphering,
            $decryption_key,
            $this->options,
            base64_decode($encryption_iv)
        );

        return $decryption;
    }
}
