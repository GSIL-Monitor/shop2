<?php

namespace Home\Server;

class PhotosServer
{
    //分类数据存在
    const FOUND_PHOTO_CODE = 1200;

    //分类数据不存在
    const NOT_FOUND_PHOTO_CODE = 1404;


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

    public function checkAdDataExists($key)
    {

        $bool = S($key);
        
        if ($bool) {

            return [
                'code' => self::FOUND_PHOTO_CODE,
                'msg'  => 'Photo Found',
                'data' => $bool
            ];

        }


        return [
            'code' => self::NOT_FOUND_PHOTO_CODE,
            'msg'  => 'Photo Not Found'
        ];



    }


     public function checkLbtDataExists($key)
    {

        $bool = S($key);
        
        if ($bool) {

            return [
                'code' => self::FOUND_PHOTO_CODE,
                'msg'  => 'Photo Found',
                'data' => $bool
            ];

        }


        return [
            'code' => self::NOT_FOUND_PHOTO_CODE,
            'msg'  => 'Photo Not Found'
        ];



    }


  

}