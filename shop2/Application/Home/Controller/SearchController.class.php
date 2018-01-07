<?php

namespace Home\Controller;

use Think\Controller;

class SearchController extends BaseController
{
	

	public function index()
	{
		 // //导入第三方类库
        vendor('xunsearch.lib.XS');
        //实例化
        $xs = new \XS('goods');
        $xsbrand = new \XS('brand');
        //得到搜索对象
        $sObj = $xs->search;
        //热门搜索词
        $hot = $sObj->getHotQuery(10,'currnum');
        //进行排序
        arsort($hot);
        $hots[] = $hot;
        //判断是否输入了内容
        if(strlen(trim(I('get.good'))) > 0){
            //品牌
            $xsbrand = new \XS('brand');
            $sObjBrand = $xsbrand->search;
            $cou = $sObjBrand->count(I('get.good'));
            // arsort($hotBrand);
            
            if ($sObjBrand->setQuery(I('get.good'))->setLimit($cou)->search()) {

                //中文处理
                $resBrand = $sObjBrand->setQuery(I('get.good'))->setLimit($cou)->search();
                

            } else {
                // dump($sObjBrand->getCorrectedQuery(I('get.good')));exit;
                //拼音
                // echo '123';exit;
                if($sObjBrand->getCorrectedQuery(I('get.good'))){
                    //纠错
                    $correct  = $sObjBrand->getCorrectedQuery(I('get.good'));
                    // dump($correct);exit;
                    //获取搜索匹配数量
                    $cous = $sObjBrand->count($correct[0]);
                    //根据纠错建议的中文进行商品搜索
                    $resBrand = $sObjBrand->setQuery($correct[0])->setLimit($cous)->search();
                    //如果有纠错建议
                    // dump(count($cous));exit;
                    
                } 
            }

            foreach ($resBrand as $v){
                $brandid = $v->id;
            }




            //导入第三方类库
            vendor('xunsearch.lib.XS');
            //实例化
            $xs = new \XS('goods');
            //得到搜索对象
            $sObj = $xs->search;
            //获取搜索匹配数量
            $count = $sObj->count(I('get.good'));
            //能直接搜索是中文
            if ($sObj->setQuery(I('get.good'))->setLimit($count)->search()) {

                //中文处理
                 $resed = $sObj->setQuery(I('get.good'))->setLimit($count)->search();

            } else {
                //输入了拼音
                
                if ($sObj->getCorrectedQuery(I('get.good'))) {
                    //纠错
                    $corrected  = $sObj->getCorrectedQuery(I('get.good'));
                    //获取搜索匹配数量
                    $count = $sObj->count($corrected[0]);
                    //根据纠错建议的中文进行商品搜索
                    $resed = $sObj->setQuery($corrected[0])->setLimit($count)->search();
                    // dump($corrected);exit;
                    //如果有纠错建议
                    if (count($corrected) !== 0)
                    {
                        //提示信息存进数据                       
                        foreach ($corrected as $v)
                        {
                          $prompt[] = "我们为您显示相关的商品:".$v;
                        }
                       
                    } 

                   
                } else {
                    //完全没这个商品或者有这个品牌
                    // dump($cous);exit;
                    if (count($cous) !== 0)
                    {
                        //提示信息存进数据                       
                        foreach ($correct as $v)
                        {
                          $prompt[] = "为你显示相关品牌:".$v;
                        }
                       
                    } else {

                        $prompt[] = "暂无此类商品，为您显示该品牌下的商品或者全部商品！";
                    }
                }
            }
            //拿一个空数据接受id
            $idss = [];
            //获取私有的商品id
            foreach ($resed as $v){
               $idss[] = $v->id;
            }
            // dump($idss);exit;
            //将id存进作为下标存进$search
            $search['id'] = ['in',$idss];
            //重定向传参数
            $this->redirect('List/index', array('idss' => json_encode($idss),'prompt'=>json_encode($prompt),'brandid'=>json_encode($brandid)));
        }

	}
}