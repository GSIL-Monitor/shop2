<?php

namespace Home\Controller;

use Think\Controller;

use Home\Server\CartServer;

class OrderController extends BaseController  
{
	/**
	 * [handlerCartAjaxData 购物车结算操作]
	 * @author    欧阳学
	 * @DateTime  2017-12-18
	 * @return    json_encode      1404:没登录 1200:结算成功, 跳到结算页 1606:库存为0
	 *
	 * 购物车结算： 1、判断是否已登录 
	 *              2、根据id查询数据库与redis数据的price、num、pic是否符合，并修改redis数据
	 *                （handlerOrderData）
	 *              3、若购物车购买量大于数据库库存， 则将数据库库存设置为用户的购买量
	 *              4、若数据库库存为0时， 则不会跳到结算页面， 并在购物车页面提示
	 */
	public function handlerCartAjaxData()
	{

		if (empty($_SESSION['user:data']['id'])) {

			echo json_encode([
				'code' => 1404,
				'msg'  => '没登录',
			]);
			exit;
		}

		$data = I('post.data');

		foreach ($data as $v) {

			// 若是空数据则跳过本循环
			if (!$v) {
				continue;
			}

			$list[] = explode(':', $v);
		}

		$redisObj = new CartServer;

		$info = $redisObj->handlerOrderData($list);

		if ($info['code'] == 1200) {

			echo json_encode([
				'code' => 1200,
			]);
			exit;
		} elseif ($info['code'] == 1606) {

			echo json_encode([
				'code' => 1606,
				'id'   => $info['id'],
			]);
		}
	}

	/**
	 * [handlerGoodsDetailData 处理立即购买的操作]
	 * @author    欧阳学
	 * @DateTime  2017-12-18
	 * @return    json_encode     1404：表示没登录； 1606：表示库存不足； 1200：表示操作通过
	 *
	 * 立即购买：1、先判断用户是否已登录
	 *           2、若登录了则通过 setDataNum 方法判断商品库存是否小于购买量
	 *           3、数据处理通过返回1200
	 */
	public function handlerGoodsDetailData()
	{
		if (empty($_SESSION['user:data']['id'])) {

			echo json_encode([
				'code' => 1404,
				'msg'  => '没登录',
			]);
			exit;
		}

		// 判断商品库存
		$info = D('orders')->setDataNum(I('get.'));

		if ($info['code'] == 1404) {

			echo json_encode([
				'code' => 1606,
				'msg'  => '库存不足',
			]);
			exit;
		} else {

			echo json_encode([
				'code' => 1200,
				'msg'  => '数据通过',
			]);
			exit;
		}
	}

	/**
	 * [showOrderView 显示结算页面]
	 * @author    欧阳学
	 * @DateTime  2017-12-18
	 *
	 * 处理get数据，1、立即购买($data['det'])：通过 getOneGoodsData 方法
	 * 					                       查询数据库得到商品信息（mysql）
	 *              2、从购物车那结算的数据：通过 getOrderData 方法处理并得到数据（redis）
	 *              3、通过 getAllAddress 方法得到用户地址信息
	 */
	public function showOrderView()
	{
		if (!session('user:data')) {
            $this->error('请先登录',U('Login/index'));
            exit;
        }

		$data = I('get.');

		// 切割get数据
		foreach ($data as $v) {

			$list[] = explode(',', $v);
		}

		$redisObj = new CartServer;

		$cartCount = $redisObj->getCartCount();

		// 立即购买的
		if ($data['det']) {

			$info = D('orders')->getOneGoodsData($list[0]);
		} else {

			$info = $redisObj->getOrderData($list[0]);
		}

		// 显示用户地址
		$map['uid'] = $_SESSION['user:data']['id'];
        $map['status'] = 1;
        $ressData = D('district')->getAllAddress($map);
        $uid = $map['uid'];
    	$score = M('user')->field('score')->where("id = $uid")->find();
    	// dump($score);die;	

    	$this->assign('count', $cartCount);
		$this->assign('info', $info);
		$this->assign('score', $score['score']);
		$this->assign('data', $ressData);
		$this->display('order');
	}

	/**
	 * [getAddressData 获取地址信息]
	 * @author    欧阳学
	 * @DateTime  2017-12-18
	 * @return    json_encode      1200：查询成功，并把数据以json格式返回 1404：获取数据失败
	 */
	public function getAddressData()
	{
        $map['upid'] = @$_GET['upid']+0; 

        $data = D('district')-> getAddressDatas($map);

        // $this->handlerReturnJsonData($data, $data);
        if ($data) {

            echo json_encode([
                'code' => 1200,
                'data' => $data,
            ]);
            exit;
        }

        echo json_encode([
            'code' => 1404,
            'msg'  => '系统有误, 尽快联系程序员.....',
        ]);
	}

	/**
	 * [handlerAddress 添加地址操作]
	 * @author    欧阳学
	 * @DateTime  2017-12-18
	 * @return    json_encode      1200：表示地址添加成功 1404：表示地址添加失败
	 *
	 * 添加地址：1、通过 getAreaData 方法得到提交的地址信息
	 *           2、通过 addAddress 方法将用户地址信息添加到数据库
	 */
	public function handlerAddress()
	{
		// 得到省市区的信息
		$map['id'] = ['in',I('post.pro').','.I('post.city').','.I('post.area')];
        $data = D('district')->getAreaData($map);

        $arr['address'] = $data[0]['name'].' '.I('post.intro');
        $arr['uid'] = $_SESSION['user:data']['id'];
        $arr['name'] = I('post.name');
        $arr['phone'] = I('post.phone');

        $getInsertId = D('district')->addAddress($arr);

        $this->handlerReturnJsonData($getInsertId);
	}

	/**
	 * [handlerSubmitOrderData 生成订单]
	 * @author    欧阳学
	 * @DateTime  2017-12-18
	 * @return    json_encode    1505：订单生成失败  1200：订单详情插入成功  1404：订单详情插入失败
	 *
	 * 生成订单： 1、通过 insertOrdersModData 方法生成订单，返回得到订单ID
	 *            2、a、立即购买：通过 getOrderOneData 方法从mysql中获取订单详情的信息
	 *            				  通过 insertOrderDetailOneData 方法插入数据库
	 *            				  
	 *               b、从购物车：通过 getOrderData 方法从redis中获取订单信息
	 *                            通过 insertOrderDetailData 方法插入数据库
	 *                            订单生成成功后，通过 handlerDelAllCartData 方法将redis中的数据清除
	 *            3、handlerReturnAjaxData 方法是判断订单是否插入成功
	 */
	public function handlerSubmitOrderData()
	{
		$data['linkman'] = I('post.name');
		$data['phone'] = I('post.phone');
		$data['address'] = I('post.address'); 
		$data['total'] = I('post.total');
		$data['message'] = I('post.leave');
		$data['uid'] = $_SESSION['user:data']['id'];
		$momo = I('post.momo');
		
		if ($momo == 1) {

			$score = I('post.score');

			$mimi['uid'] = $data['uid'];
			$mimi['desc'] = '积分兑换';
			$mimi['score'] = '-'.$score;
			$mimi['state'] = 2;
			$rr = $mimi['uid'];
            $m = M('user_score');
            $m2 = M('user');
            $m->startTrans();//在第一个模型里启用就可以了，或者第二个也行
            $pp = $m->add($mimi);
            $aa = $m2->where("id = $rr")->setField('score',0);
            if($pp && $aa){
                $m->commit(); 
            } else {
   
                $m->rollback();//不成功，则回滚
               	$this->handlerReturnJsonData(0);
            }
		}

		$insertOrdersModData = D('orders')->insertOrdersModData($data);

		$this->handlerReturnAjaxData($insertOrdersModData);

		// 立即购买
		if (I('post.spot')) {

			foreach (I('post.data') as $v) {

				$list[] = explode(':', $v);
			}

			$dataId['gid'] = $list[0][0];
			$dataId['cid'] = $list[0][1];
			$dataId['sid'] = $list[0][2];

			$dataInfo = D('orders')->getOrderOneData($dataId);
			$dataInfo['oid'] = $insertOrdersModData;
			$dataInfo['gid'] = $dataId['gid'];
			$dataInfo['sid'] = $dataId['sid'];
			$dataInfo['num'] = I('post.spot');

			$insertOrdersDetailModData = D('orders')->insertOrderDetailOneData($dataInfo);
		} else {

			$redisData = I('post.data');
			$redisObj = new CartServer;
			$goodsDataInfo = $redisObj->getOrderData($redisData);

			$this->handlerReturnAjaxData($goodsDataInfo);

			$insertOrdersDetailModData = D('orders')->insertOrderDetailData($goodsDataInfo, $insertOrdersModData);

			$redisData['spot'] = 1;
			$delRedisData = $redisObj->handlerDelAllCartData($redisData);
		}

		// 判断订单详情数据是否插入成功
		$this->handlerReturnJsonData($insertOrdersDetailModData, $insertOrdersModData);
	}

	// 显示支付页面
	public function showDefrayView()
	{
		if (!session('user:data')) {
            $this->error('请先登录',U('Login/index'));
            exit;
        }

		if (empty(I('get.orderId'))) {

			echo json_encode(['code' => 1606]);
			exit;
		}

		$redisObj = new CartServer;
		$cartCount = $redisObj->getCartCount();

		$dataInfo = D('orders')->getTotalPriceData(I('get.orderId'));  

		$data['total'] = $dataInfo;
		$data['id'] = I('get.orderId');

		$this->assign('data', $data);
		$this->assign('count', $cartCount);
		$this->display('defray');
	}

	// 显示支付成功页
	public function showSuccessView() 
	{
		if (!session('user:data')) {
            $this->error('请先登录',U('Login/index'));
            exit;
        }
		
		if (empty(I('get.orderId'))) { 

			echo json_encode(['code' => 1606]);
			exit;
		}

		$dataField = 'linkman, address, phone, total, id';

		$dataInfo = D('orders')->getAddressData(I('get.orderId'), $dataField); 

		$redisObj = new CartServer;
		$cartCount = $redisObj->getCartCount();
		$num = $dataInfo['total']; 

		if ($num > 100) {
			
			if ($num > 100 || $num < 200) {
			    $content = "100-200";
			}	
			if ($num > 200 || $num < 500) {
			    $content = "200-500";
			}	
			if ($num > 500 || $num < 1000) {
			    $content = "500-1000";
			}	
			if ($num > 1000) {
			    $content = "1000以上";
			}

			$obj = M('score')->field('id,score')->where("content = '$content'")->find();
	
			$id = $obj['id'];
			$score = $obj['score'];
			$user = session('user:data');     
         	$uid = $user['id'];

			$data['uid'] = $uid;
			$data['sid'] = $id;

			$m=M('user_score');
            $m2=M('user');

            $m->startTrans();
            $pp = $m->add($data);//事务处理
            $aa = $m2->where("id = $uid")->setInc('score',$score);
        
            if($pp && $aa){

                $m->commit();

            } else {

               $m->rollback();//失败就回滚      
            }
		}

		$this->assign('info', $dataInfo);
		$this->assign('count', $cartCount);
		$this->display('success');
	}

	// 判断并返回相应的json信息
	public function handlerReturnJsonData($data, $info = '')
	{
		if ($data) {

			echo json_encode([
				'code' => 1200,
				'data' => $info,
			]);
			exit;
		} else {

			echo json_encode([
				'code' => 1404,
				'msg'  => '系统有误, 程序员修复中...',
			]);
			exit;
		}
	}

	// 处理判断订单是否插入成功
	public function handlerReturnAjaxData($data)
	{
		if (!$data) {

			echo json_encode([
				'code' => 1505,
				'msg'  => '系统有误, 程序员修复中...',
			]);
			exit;
		}
	}
}