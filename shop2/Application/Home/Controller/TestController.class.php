<?php

namespace Home\Controller;

use Think\Controller;
use Common\Server\Search;

class TestController extends Controller 
{
    public function index()
    {
        
    	$this->display('index');
       
    }

    public function show()
    {

    	$keyword = I('get.keyword');

    	// if (empty($keyword)) {
    		
    	// 	$this->error('没有搜索内容', U('index'));
    	// 	exit;
    	// }

    	$search = new Search('shop2');
    	$result = $search->find('name:'.$keyword);
        dump($result);die;
    	// dump($result);
    	
    	/*$count = count($result);
    	$page = new \Think\Page($count, 1);
    	$list = array_slice($result, $page->firstRow, $page->listRows);
    	$pageBtn = $page->show();
*/

    	// dump($pageBtn);
    	// $this->assign('pageBtn', $pageBtn);
    	$this->assign('result', $result);
    	$this->display('show');
       
    }

    public function showProductView()
    {


    	$this->display('add');
    }


    public function addProduct()
    {

    	$lastInsertId = M('product')->add([
    		'gname' => I('post.gname'),
    		'price' => I('post.price'),
    		'status' => 1,
    	]);

    	//插入mysql成功，将商品数据插入xunsearch
    	if ($lastInsertId) {

    		$search = new Search('shop');


    		try {


    			$search->addDocumentData([
	    			'id'    => $lastInsertId,
	    			'gname' => I('post.gname'),
	    			'price' => I('post.price'),
    			]);

    		} catch (Exception $e) {

    			// echo $e->getMessag();exit;

    			Think\Log::record($e->getMessag(), 'ERR');
    		}
    		    		
    	}

    	$this->success('添加成功', U('product/list'));

    }

    public function listProduct()
    {
    	$products = M('product')->field('id,gname,price')
    	->where('status = 1')
    	->select();

    	$this->assign('products', $products);
    	$this->display('Product/list');
    }
}