<?php

namespace Home\Server;

use Home\Model\GoodsModel;

class CartServer
{
	// �õ�redis����
	public function __construct()
	{
		$this->redis = new \Redis();
		$this->redis->connect(C('REDIS_HOST'), C('REDIS_PORT'));
	}

	/**
	 * [handlerAddToCart ����δ��¼���¼����û��Ĺ��ﳵ��Ϣ�浽redis]
	 * @author    ŷ��ѧ
	 * @DateTime  2017-12-09
	 * @param     array      $data [��Ʒ���鴫������������Ϣ]
	 * @return     array      ���ش�������ȷ����Ϣ��ʾ
	 *
	 * redis���룺1��ͨ�� getCartGoodsData ������ȡ��Ʒ��Ϣ
	 */
	public function handlerAddToCart($data)
	{
		$goodsId = $data['gid'];
		$colorId = $data['cid'];
		$sizeId  = $data['sid'];
		$buyNumber = $data['number'];

		$res = new GoodsModel();
		$goodsData = $res->getCartGoodsData($goodsId, $colorId, $sizeId);

		// hash����
		$key = 'cart:'.session_id().':'.$goodsId.':'.$colorId.':'.$sizeId;

		// ���ϼ���
		$keyId = 'cart:ids:set:'.session_id();

		$info = $this->redis->exists($key);

		if (!$info) {

			$goodsData['number'] = $buyNumber;

			// ����redis(hash)
			$insertData = $this->redis->hmset($key, $goodsData);  // �˴�Ӧ�д����¼

			// ������Чʱ��
			$this->redis->expire($key, 3600*24*7);

			$dataId = $goodsId.':'.$colorId.':'.$sizeId;

			// �������
			$insertMuster = $this->redis->lPush($keyId, $dataId);

			// ������Чʱ��
			$this->redis->expire($keyId, 3600*24*7);
			$this->redis->expire($insertMuster, 3600*24*7);

			// ����cookie_id����Чʱ��
			$this->modifySessionIdTime();

			// �жϲ����Ƿ�ɹ�
			return $this->handlerInsertMusterInfo($insertMuster); exit;
		} else {

			$originNum = $this->redis->hget($key, 'number');

			$newNum = $originNum + $buyNumber;

			// �жϲ����Ƿ�ɹ�
			$modifyData = $this->redis->hset($key, 'number', $newNum);

			// �޸�redis��hash�뼯�ϵ���Чʱ��
			$this->redis->expire($key, 3600*24*7);
			$this->redis->expire($keyId, 3600*24*7);

			// ����cookie_id����Чʱ��
			$this->modifySessionIdTime();

			// �ж��Ƿ��޸ĳɹ�
			return $this->handlermodifyDataInfo($modifyData); exit;
		}
	}

	/**
	 * [handlerLoginCartData  �����¼���û����빺�ﳵ����Ϣ]
	 * @author    ŷ��ѧ
	 * @DateTime  2017-12-11
	 * @param     array      $data [��Ʒ���鴫������������Ϣ]
	 * @return    array            ���سɹ���ʧ�ܵ���Ϣ
	 *
	 * ���빺�ﳵ��1��ͨ�� getCartGoodsData ������ȡ��Ʒ��Ϣ
	 *             2��ͨ���ж� $userHashKey �Ƿ���֮ǰ��������ﳵ����Ʒ
	 */
	public function handlerLoginCartData($data)
	{
		$goodsId = $data['gid'];
		$colorId = $data['cid'];
		$sizeId  = $data['sid'];
		$buyNumber = $data['number'];

		$res = new GoodsModel();
		$goodsData = $res->getCartGoodsData($goodsId, $colorId, $sizeId);

		$keyId = 'cart:'.$_SESSION['user:data']['id'];
		$userKey = $keyId.':'.$goodsId.':'.$colorId.':'.$sizeId;

		$userHashKey = $this->redis->exists($userKey);

		// ����֮ǰ���redis��
		if ($userHashKey) {

			$originNum = $this->redis->hget($userKey, 'number');

			$newNum = $originNum + $buyNumber;

			$modifyData = $this->redis->hset($userKey, 'number', $newNum);

			// �޸�redis��hash�뼯�ϵ���Чʱ��
			$this->redis->expire($userKey, 3600*24*7);
			$this->redis->expire($keyId, 3600*24*7);

			// ����json��Ӧ����ʾ��Ϣ
			return $this->handlermodifyDataInfo($modifyData); exit;
		} else {

			$goodsData['number'] = $buyNumber;

			$insertData = $this->redis->hmset($userKey, $goodsData);   // �˴�Ӧ�д����¼

			$dataId = $goodsId.':'.$colorId.':'.$sizeId;

			$insertMuster = $this->redis->lPush($keyId, $dataId);

			// ����hash������Чʱ��
			$this->redis->expire($userKey, 3600*24*7);
			$this->redis->expire($keyId, 3600*24*7);

			// ����json��Ӧ����ʾ��Ϣ
			return $this->handlerInsertMusterInfo($insertMuster, $dataId);
		}
	}

	/**
	 * [loginModifyRedisData ����ҳ�ж��û���¼ʱ����Ƿ����δ��¼֮ǰ�ļ��ϼ�]
	 * @author    ŷ��ѧ
	 * @DateTime  2017-12-11
	 *
	 * �������֮ǰ�ļ�, ���޸�Ϊ���û�ID����ΪΨһ������׼
	 */
	public function loginModifyRedisData()
	{
		$musterKey = 'cart:ids:set:'.session_id();

		$musterKeyData = $this->redis->exists($musterKey);

		if ($musterKeyData) {

	        $newMusterKey = 'cart:'.$_SESSION['user:data']['id'];

	        // �鿴���еĳ���
	        $idArr =  $this->redis->lLen($musterKey);

	        for ($i=0; $i<$idArr; $i++) {

	        	$dataId = $this->redis->lIndex($musterKey, $i);

	        	$key = 'cart:'.session_id().':'.$dataId;

	        	$data = $this->redis->exists($key);

	        	if ($data) {

	        		$loginListKey = $newMusterKey.':'.$dataId;

	            	$this->redis->rename($key, $loginListKey);

	        		$this->redis->hset($loginListKey, 'uid', $_SESSION['user:data']['id']);

	        		$this->handlerInsertMusterId($dataId);

	            	// ����������Чʱ��
	            	$this->redis->expire($loginListKey, 3600*24*7);
	        	} else {
	        		continue;
	        	}
	        }

	        // �޸Ķ��еļ���
	        $modifyMusterKey = $this->redis->rename($musterKey, $newMusterKey);
	        $this->redis->expire($newMusterKey, 3600*24*7);
	    }
	}

	/**
	 * [loginHandlerCutAndAddCartNum �����޸Ĺ��ﳵ�Ĺ�����]
	 * @author    ŷ��ѧ
	 * @DateTime  2017-12-18
	 * @param     array      $data [��Ʒ��ID����]
	 * @return    array      1505���޸�ʧ��   1200���޸ĳɹ�  1606�������
	 *
	 * �޸Ĺ�������1��ͨ�� checkCartNum ������ѯ���ݿ⣬
	 *                �õ���Ʒ��ʵ�ʿ��$goodsNumber����������淵��1606
	 *             2���ѵ�¼��$data['spot'] == 1��
	 *                δ��¼��$data['spot'] == 2��
	 *             3��ͨ�� $modifyData �޸�redis�еĹ�����
	 *             4��ͨ�� handlermodifyDataInfo ������ʵ�ʿ������Ӧ���ж����ݷ���
	 */
	public function loginHandlerCutAndAddCartNum($data)
	{
		$modelObj = new GoodsModel;

		$info = $modelObj->checkCartNum($data);

		if ($info['code'] == 1404) {

			return [
				'code' => 1606, 
				'goodsNum' => $info['goodsNum'],
			];
			exit;
		}

		$goodsNumber = $info['goodsNum'];
		$dataID = $data['uid'].':'.$data['cid'].':'.$data['sid'];

		if ($data['spot'] == 1) {

			$key = 'cart:'.$_SESSION['user:data']['id'].':'.$dataID;
		} elseif ($data['spot'] == 2) {

			$key = 'cart:'.session_id().':'.$dataID;
		}

		$modifyData = $this->redis->hset($key, 'number', $data['number']);

		return $this->handlermodifyDataInfo($modifyData, $goodsNumber);
	}

	/**
	 * [handlerDelCartData ������ɾ��redis���ﳵ������]
	 * @author    ŷ��ѧ
	 * @DateTime  2017-12-18
	 * @param     array      $data [��ƷID����]
	 * @return    array      1200��ɾ���ɹ�  1404��ɾ��ʧ��
	 *
	 * δ��¼����$data['spot'] == 2��
	 * �ѵ�¼����$data['spot'] == 1��
	 *     1��$delInfo ɾ��redis����Ʒ�ļ�
	 *     2��$delMuster ɾ��redis�����е�Ԫ��
	 *     3������ handlerInsertMusterInfo ����������Ӧ����ʾ��Ϣ
	 */
	public function handlerDelCartData($data)
	{
		$member = $data['uid'].':'.$data['cid'].':'.$data['sid'];

		if ($data['spot'] == 2) {

			$key = 'cart:'.session_id().':'.$member;
			$musterKey = 'cart:ids:set:'.session_id();
		} elseif ($data['spot'] == 1) {

			$key = 'cart:'.$_SESSION['user:data']['id'].':'.$member;
			$musterKey = 'cart:'.$_SESSION['user:data']['id'];
		}

		$delInfo = $this->redis->del($key);                  // �˴�Ӧ�д����¼
		$delMuster = $this->redis->lRem($musterKey, $member, 0);

		return $this->handlerInsertMusterInfo($delMuster);
	}

	/**
	 * [handlerDelCartData �������ɾ��redis���ﳵ������]
	 * @author    ŷ��ѧ
	 * @DateTime  2017-12-18
	 * @param     array      $data [��ƷID����]
	 * @return    array      1200��ɾ���ɹ�  1404��ɾ��ʧ��
	 *
	 * δ��¼����$data['spot'] == 2��
	 * �ѵ�¼����$data['spot'] == 1��
	 *     1��$delInfo ɾ��redis����Ʒ�ļ�
	 *     2��$delMuster ɾ��redis�����е�Ԫ��
	 *     3������ handlerInsertMusterInfo ����������Ӧ����ʾ��Ϣ
	 */
	public function handlerDelAllCartData($data)
	{	
		$spot = 123;
		if ($data['spot'] == 2) {

			$musterKey = 'cart:ids:set:'.session_id();

			foreach ($data as $v) {

				$key = 'cart:'.session_id().':'.$v;

				$delInfo = $this->redis->del($key);          // �˴�Ӧ�ü�¼������Ϣ

				$delMuster = $this->redis->lRem($musterKey, $v, 0);
			}
		} elseif ($data['spot'] == 1) {

			$musterKey = 'cart:'.$_SESSION['user:data']['id'];

			foreach ($data as $v) {

				$key = 'cart:'.$_SESSION['user:data']['id'].':'.$v;

				$delInfo = $this->redis->del($key);          // �˴�Ӧ�ü�¼������Ϣ

				$delMuster = $this->redis->lRem($musterKey, $v, 0);
			}
		}
		
		if (!$delMuster) {
			return ['code' => 1200];exit;
		} else {
			return ['code' => 1404];exit;
		}
	}

	/**
	 * [getAllRedisData ��ȡδ��¼ʱ���ﳵredis�е�ȫ����Ϣ]
	 * @author    ŷ��ѧ
	 * @DateTime  2017-12-11
	 * @return    array       redis�еĹ��ﳵ��Ϣ
	 */
	public function getAllRedisData()
	{
		$musterKey = 'cart:ids:set:'.session_id();

		// �ȸ��ݼ����õ���ƷID
        $idArr =  $this->redis->lLen($musterKey);

        for ($i=0; $i<$idArr; $i++) {  

        	$dataId = $this->redis->lIndex($musterKey, $i);
  
            $key = 'cart:'.session_id().':'.$dataId;

            $data = $this->redis->exists($key);

            // ����Ϣ�����˴�ѭ��
            if (!$data) {
            	 continue;
            }

            $list[] = $this->redis->hGetAll($key);  
        }  

        return $list;
	}

	/**
	 * [loginGetAllUserCartData ��ȡ��¼��redis�еĹ��ﳵ��Ϣ]
	 * @author    ŷ��ѧ
	 * @DateTime  2017-12-18
	 * @return    array      redis�еĹ��ﳵ��Ϣ
	 */
	public function loginGetAllUserCartData()
	{
		$musterKey = 'cart:'.$_SESSION['user:data']['id'];

		// �鿴�����еĳ���
        $idArr =  $this->redis->lLen($musterKey);

		for ($i=0; $i<$idArr; $i++) {

			$dataId = $this->redis->lIndex($musterKey, $i);

			$key = 'cart:'.$_SESSION['user:data']['id'].':'.$dataId;

			$data = $this->redis->exists($key);

            if (!$data) {
            	 continue;
            }

            $list[] = $this->redis->hGetAll($key);
		}

		return $list;
	}

	/**
	 * [handlerOrderData �����û�����ҳ������]
	 * @author    ŷ��ѧ
	 * @DateTime  2017-12-18
	 * @param     array      $data  ajax�ύ����Ʒid��Ϣ
	 * @return    array      1200����ʾ���ݴ���ɹ�  1606����ʾ���Ϊ0�������ؿ��Ϊ0��id
	 */
	public function handlerOrderData($data)
	{
		$GoodsMod = new GoodsModel;

		// �õ���Ʒ��Ϣ
		$info = $GoodsMod->getOrderGoodsData($data);

		// ѭ���������޸�����
		foreach ($info as $v) {

			$key = 'cart:'.$_SESSION['user:data']['id'].':'.$v['id'];
			$arr = $this->redis->hmget($key, ['price', 'pic', 'number']);

			// ���¼۸�
			if ($v['price'] != $arr['price']) {
				$this->redis->hset($key, 'price', $v['price']);
			}

			// �жϿ��
			if ($v['num'] < $arr['number']) {
				$this->redis->hset($key, 'number', $v['num']);
			}

			if ($v['num'] == 0) {

				return [
					'code' => 1606,
					'id'   => $v['id'],
				];
				exit;
			}
		}

		return [
			'code' => 1200,
		];
	}

	/**
	 * [getOrderData ��ȡredis�е���Ʒ��������]
	 * @author    ŷ��ѧ
	 * @DateTime  2017-12-18
	 * @param     array      $data [��ƷID����]
	 * @return    array      �õ�����Ʒ����
	 */
	public function getOrderData($data)
	{
		for ($i=0; $i<count($data); $i++) {

			$key = 'cart:'.$_SESSION['user:data']['id'].':'.$data[$i];

			$keyInfo = $this->redis->exists($key);

            if (!$keyInfo) {
            	 continue;
            }

			$list[] = $this->redis->hGetAll($key);
		}

		return $list;
	}

	public function getCartCount()
	{
		return $this->redis->lLen('cart:'.$_SESSION['user:data']['id']);
	}

	// �����жϲ��뼯�ϵ���Ϣ
	public function handlerInsertMusterInfo($insertMuster, $dataId = '')
	{
		if ($insertMuster) {

			$this->handlerInsertMusterId($dataId);

			return [
				'code' => 1200,
			];
			exit;
		} else {

			return [
				'code' => 1404,
			];
		}
	}

	// �����޸Ĺ�������Ϣ
	public function handlermodifyDataInfo($modifyData, $goodsNumber = '')
	{
		if ($modifyData != 0) {

			return [
				'code' => 1505,
				'msg'  => '�������޸�ʧ��',
			];
			exit;
		} else {

			return [
				'code' => 1200,
				'msg'  => '�޸ĳɹ�',
				'goodsNum' => $goodsNumber,
			];
		}
	}

	// ����cookie_id����Чʱ��
	public function modifySessionIdTime()
	{
		setcookie(session_name(), session_id(), time()+3600*24*7, '/');
	}


	public function handlerInsertMusterId($dataId)
	{
		if ($_SESSION['user:data']['id']) {

			$goodsId = $_SESSION['user:data']['id'].':'.$dataId;

			$info = $this->redis->sIsMember('set:cart', $goodsId);

			if (!$info) {

				$this->redis->sAdd('set:cart', $goodsId);
			}
		}
	}
}