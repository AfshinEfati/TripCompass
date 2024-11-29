<?php

namespace App\Traits;

trait StatusTrait
{
    public function getStatus($status)
    {
        return $status?[
            'title'=>'active',
            'title_fa'=>'فعال',
            'code'=>1
        ]:[
            'title'=>'inActive',
            'title_fa'=>'غیرفعال',
            'code'=>0
        ];
    }
}
