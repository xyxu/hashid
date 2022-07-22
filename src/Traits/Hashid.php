<?php

namespace Jiaxincui\Hashid\Traits;


trait Hashid
{
    /**
     * 访问器，对模型ID加密
     * @param $value
     * @return null|string
     */
    public function getHashidAttribute()
    {
        return config('hashid.enabled') ? id_encode($this->getKey()) : $this->getKey();
    }
}
