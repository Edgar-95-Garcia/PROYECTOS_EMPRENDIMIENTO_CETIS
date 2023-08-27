<?php
class key
{

    function enc(string $data)
    {
        $ciphering = "AES-128-CTR";       
        $options   = 0;
        $encryption_iv = '1234567891011121';
        return strval(openssl_encrypt($data, $ciphering, md5("ECOTEC_CAMPUS_TLAHUAC"), $options, $encryption_iv));
    }

    function dec(string $data)
    {
        $ciphering = "AES-128-CTR";       
        $options   = 0;
        $decryption_iv = '1234567891011121';
        return strval(openssl_decrypt($data, $ciphering, md5("ECOTEC_CAMPUS_TLAHUAC"), $options, $decryption_iv));
    }
}
