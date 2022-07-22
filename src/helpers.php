<?php
use Jiaxincui\Hashid\Exceptions\HashidException;
use Hashids\Hashids;

if (! function_exists('id_encode')) {

    /**
     * @param $int
     * @return string
     * @throws HashidException
     */
    function id_encode($int)
    {
        if (! config('hashid.enabled')) return $int;

        if (! is_numeric($int) || $int < 0 || ! is_int($int + 0)) {
            return $int;
        }

        $hashid = new Hashids(config('hashid.salt'), config('hashid.min_hash_length'), config('hashid.alphabet'));

        return $hashid->encode($int);
    }
}

if (! function_exists('id_decode')) {

    /**
     * @param $str
     * @return integer
     * @throws HashidException
     */
    function id_decode($str)
    {
	if (! config('hashid.enabled')) return $str;

        if (! preg_match('/^[0-9a-zA-Z]{2,18}$/', $str)) {
            return $str;
        }

        $hashid = new Hashids(config('hashid.salt'), config('hashid.min_hash_length'), config('hashid.alphabet'));
        $result = $hashid->decode(strval($str));

        if (count($result) !== 1) {
            return $str;
        }

        return $result[0];
    }
}
