<?php

namespace Home\Server;

class TypesServer
{
    //分类数据存在
    const FOUND_TYPE_CODE = 1200;

    //分类数据不存在
    const NOT_FOUND_TYPE_CODE = 1404;


    // public function __construct()
    // {
    //     S([
    //         'type'=>'memcache',
    //         'host'=>'192.168.35.198',
    //         'port'=>'11211',
    //         // 'prefix'=>'think',
    //         'expire'=>60]
    //     );

    // }

    public function checkTypesDataExists($key)
    {

        $K = 'types:data:'.$key;

        $bool = S($K);
        
        if ($bool) {

            return [
                'code' => self::FOUND_TYPE_CODE,
                'msg'  => 'Type Found',
                'data' => $bool
            ];

        }


        return [
            'code' => self::NOT_FOUND_TYPE_CODE,
            'msg'  => 'Type Not Found'
        ];



    }

  

}