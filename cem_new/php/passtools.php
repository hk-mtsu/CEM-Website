<?php

require "vars.php";

class PasswordTools
{
	public static function salt()
	{
		$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_DEV_URANDOM);
		$salt = base64_encode($iv);
		return $salt;		
	}
	public static function hash($password, $salt, $mode="sha1")
	{
		$salt = base64_decode($salt);
		$hashed = hash_hmac($mode, $password, $salt);
		return $hashed;
	}
	public static function check_hash($input_password, $hashed_password, $salt)
	{
		$hashed = self::hash($input_password, $salt);
		$res = strcmp($hashed,$hashed_password);
		$match = ($res == 0);
		return $match;
	}
	public static function encrypt($password, $key)
	{
	  $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
	  $iv = mcrypt_create_iv($iv_size, MCRYPT_DEV_URANDOM);
	  $crypt = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $password, MCRYPT_MODE_CBC, $iv);
	  $combo = $iv . $crypt;
	  $encoded = base64_encode($iv . $crypt);
	  return $encoded;
	}
	public static function decrypt($encoded_password, $key)
	{
	  $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
	  $combo = base64_decode($encoded_password);
	  $iv = substr($combo, 0, $iv_size);
	  $crypt = substr($combo, $iv_size, strlen($combo));
	  $plain_text = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $crypt, MCRYPT_MODE_CBC, $iv);
	  $plain_text = rtrim($plain_text,"\0"); // strip off padding
	  return $plain_text;
	}
    public static function ossl_encrypt($message, $key)
    {
        $ivsize = openssl_cipher_iv_length('aes-256-cbc');
        $iv = openssl_random_pseudo_bytes($ivsize);
        $ciphertext = openssl_encrypt($message,'aes-256-cbc',$key,OPENSSL_RAW_DATA,$iv);
        return $iv . $ciphertext;
    }
    public static function ossl_decrypt($message, $key)
    {
        $ivsize = openssl_cipher_iv_length('aes-256-cbc');
        $iv = mb_substr($message, 0, $ivsize, '8bit');
        $ciphertext = mb_substr($message, $ivsize, null, '8bit');
        return openssl_decrypt($ciphertext,'aes-256-cbc',$key, OPENSSL_RAW_DATA,$iv);
    }
}

/*
$password="c00lpassw0rd!";

// get new passwordtools class object
$passtools = new PasswordTools();
// generate salt
$salt = $passtools->salt();

echo $salt . "<br/>" . strlen($salt) . "<br/>";

// hash password with salt
$hashed_password = $passtools->hash($password, $salt);
// pepper is site wide and stored on server in vars file...
$encrypted_hash = $passtools->encrypt($hashed_password, $pepper);
// store encrypted hash and its corresponidng salt together

$decrypted_hash = $passtools->decrypt($encrypted_hash, $pepper);

// match salt stored with hash to user input hashed with the salt thats stored for the user..
$match = $passtools->check_hash($password, $decrypted_hash, $salt);

if ($match){echo "authorized<br/>";}
else{echo "not authorized<br/>";}
*/