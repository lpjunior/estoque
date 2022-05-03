<?php
class Crypt
{
    private $options = 0;
    private $ciphering = "BF-CBC";
    private $encryption_iv;

    public function __construct() {
        # https://www.php.net/manual/pt_BR/function.random-bytes.php
        # https://www.php.net/manual/en/function.openssl-cipher-iv-length.php
        $this->encryption_iv = random_bytes(openssl_cipher_iv_length($this->ciphering));
    }
    
    /**
     * Criptografa
     * Retorna a string passada no método de criptografia MD5
     *
     * @param $plaintext - valor em string a ser criptografado
     * @return string
     */
    public function encrypt($plaintext)
    {
        # https://www.php.net/manual/en/function.openssl-digest.php
        # https://www.php.net/manual/en/function.php-uname.php
        $encryption_key = openssl_digest(php_uname(), 'MD5', TRUE);

        # https://www.php.net/manual/en/function.openssl-encrypt.php
        $encryption = openssl_encrypt(
            $plaintext,
            $this->ciphering,
            $encryption_key,
            $this->options,
            $this->encryption_iv
        );

        return array(
            'encryption' => $encryption, 
            'encryption_key' => base64_encode($this->encryption_iv)
        );
    }

    /**
     * Descriptografa uma string em MD5 para seu valor original.
     *
     * @param $encrypted - string criptografada do objeto
     * @param $encryption_iv - chave para descriptografia
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
