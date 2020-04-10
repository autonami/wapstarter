<?php

namespace lib\core;

function formatter_md5($val, $salt = '') {
    return md5($val . $salt);
}

function formatter_sha1($val, $salt = '') {
    return sha1($val . $salt);
}

function formatter_sha256($val, $salt = '') {
    return hash('sha256', $val . $salt);
}

function formatter_sha512($val, $salt = '') {
    return hash('sha512', $val . $salt);
}

function formatter_encodeBase64($val) {
    return base64_encode($val);
}

function formatter_decodeBase64($val) {
    return base64_decode($val);
}

function formatter_encrypt($val, $password) {
    $key = hash('sha256', $password, TRUE);
    $iv = openssl_random_pseudo_bytes(16);
    if (($l = (strlen($val) & 15)) > 0) { $val .= str_repeat(chr(0), 16 - $l); }
    return base64_encode($iv . openssl_encrypt($val, 'AES-256-CBC', $key, OPENSSL_RAW_DATA|OPENSSL_ZERO_PADDING, $iv));
}

function formatter_decrypt($val, $password) {
    $key = hash('sha256', $password, TRUE);
    $val = base64_decode($val);
    return rtrim(openssl_decrypt(substr($val, 16), 'AES-256-CBC', $key, OPENSSL_RAW_DATA|OPENSSL_ZERO_PADDING, substr($val, 0, 16)), "\0");
}

function formatter_passwordHash($val, $algo = 'default') { // algo "default", "bcrypt", "argon2i" and "argon2id"
    if (version_compare(PHP_VERSION, '5.5.0', '<')) {
        throw new \Exception("passwordHash formatter requires at least PHP 5.5.0");
    }

    if ($algo == 'bcrypt') {
        $algo = PASSWORD_BCRYPT;
    } elseif ($algo == 'argon2i') {
        if (version_compare(PHP_VERSION, '7.2.0', '<')) {
            throw new \Exception("passwordHash formatter argon2i requires at least PHP 7.2.0");
        }
        $algo = PASSWORD_ARGON2I;
    } elseif ($algo == 'argon2id') {
        if (version_compare(PHP_VERSION, '7.3.0', '<')) {
            throw new \Exception("passwordHash formatter argon2id requires at least PHP 7.3.0");
        }
        $algo = PASSWORD_ARGON2ID;
    } else {
        $algo = PASSWORD_DEFAULT;
    }

    return password_hash($val, $algo);
}

function formatter_passwordVerify($val, $hash) {
    return password_verify($val, $hash);
}

function formatter_passwordNeedsRehash($val, $algo = 'default') {
    if (version_compare(PHP_VERSION, '5.5.0', '<')) {
        throw new \Exception("passwordHash formatter requires at least PHP 5.5.0");
    }

    if ($algo == 'bcrypt') {
        $algo = PASSWORD_BCRYPT;
    } elseif ($algo == 'argon2i') {
        if (version_compare(PHP_VERSION, '7.2.0', '<')) {
            throw new \Exception("passwordHash formatter argon2i requires at least PHP 7.2.0");
        }
        $algo = PASSWORD_ARGON2I;
    } elseif ($algo == 'argon2id') {
        if (version_compare(PHP_VERSION, '7.3.0', '<')) {
            throw new \Exception("passwordHash formatter argon2id requires at least PHP 7.3.0");
        }
        $algo = PASSWORD_ARGON2ID;
    } else {
        $algo = PASSWORD_DEFAULT;
    }

    return password_needs_rehash($val, $algo);
}
