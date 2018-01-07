<?php

namespace Common\Server;

use \XS;

/**
 * 搜索服务类
 * @author Linz <[gzphper@163.com]>
 * @date(2017/11/30)
 */
class Search
{
	protected $xs;

    //模糊搜索
    protected $fuzzy;

    //同义词搜索
    protected $synonyms;

	public function __construct( 
		$projectName,
		$fuzzy = true,
		$synonyms = true
	)
	{
		if (empty($projectName)) {
			throw new \Exception("没有传递xunsearch项目名");	
		}

		$this->xs = new \XS($projectName);
        $this->fuzzy = $fuzzy;
        $this->synonyms = $synonyms;

        //获取搜索对象
        $this->search = $this->xs->search;
	}

	/**
	 * 在xunsearch进行搜索
	 * @param  string $keyword 要搜索的内容
	 * @return array           搜索的结果，搜索不到:返回array()
	 */
	public function find($keyword)
	{
		//获取搜索对象
		$this->search
        ->setFuzzy($this->fuzzy)
        ->setAutoSynonyms($this->synonyms);

        //设置搜索语句
        $this->search->setQuery($keyword);

        //执行搜索，将搜索结果文档保存在 $docs 数组中
        $docs =  $this->search->search();

        if (count($docs) == 0) {

        	// 没有找到搜索结果
        	return array();
        }

        //将结果一一取出
		foreach ($docs as $k => $doc) {
    	    if (!empty($doc)) {
    		    //取出搜索结果
    		    $searchRes[] = $doc->getFields();
    		    //获取每个词的权重
    		    $searchRes[$k]['weight'] = $doc->weight();
    	    }
		}

        return $searchRes;
	}

	/**
     * addDocumentData 添加数据到xunsearch索引服务器
     * @param array $data 如果需要将商品名加入搜索服务器，就传递
     * $data = ['gname' => '你的商品名'], gname需要与xunsearch配置文件中一致
     *
     * @return  void
     */
    public function addDocumentData( $data = array() )
    {
        if ( empty($data) ) {

          throw new \Exception('请输入插入数据');
        }
        $doc = new \XSDocument;

        $doc->setFields($data);

        //添加索引到xunsearch中
        $this->xs->index->add($doc);
    }

    /**
     * editDocument  修改xunsearch索引服务器的数据
     * @param  array  $data [description]
     * @return void
     */
     public function editDocumentData( $data = array() )
    {
        if ( empty($data) ) {

          throw new \Exception('请输入要修改的数据');
        }
        $doc = new \XSDocument;

        $doc->setFields($data);

        //添加索引到xunsearch中
        $this->xs->index->update($doc);
    }
    // 如果索引数据库中已存在主键值相同的文档，那么相当于先删除原有的文档，再用当前文档替换它。 如果未存在主键值相同的文档，则效果和添加文档完全一致。
    // 出于性能优化设计，所有的索引操作（包含添加、删除、修改文档）均是异步的 行为。也就是说在 PHP-SDK 的相关 API 返回后，只是说明已经将索引变动提交到操作队列中， 而并不是已经立即更新到磁盘上的索引数据库文件。因此，搜索结果将不能立即体现出您的变动。
    



    /**
     * editDocument  删除xunsearch索引服务器的数据
     * @param  array or string  $data [description]
     * @return void
     */
     public function delDocumentData( $data = array() ) 
    {
        if ( empty($data) ) {

          throw new \Exception('请输入要修改的数据');
        }
   
        //添加索引到xunsearch中
        $this->xs->index->del($data);

      /*  比如：
        1.$index->del('123');  // 删除主键值为 123 的记录
        $index->del(array('123', '789', '456')); // 同时删除主键值为 123, 789, 456 的记录传入参数必须是 要删除的文档的主键值，或一系列主键值组成的数组。
        2. 按特定字段上的索引词删除
        特别注意是根据索引词删除而不是该字段的值，索引词是指该字段值经过分词器处理后得到的词汇。 对于索引方式为 mixed 的，如需删除，请把字段名设为类型为 body 的字段的名称。如果您删除时指定的主键或字段索引词包含中文字符，则它的编码必须与整个项目的 默认字符集 XS::defaultCharset 一致。
        $index->del('abc', 'subject'); // 删除字段 subject 上带有索引词 abc 的所有记录
        $index->del(array('abc', 'def'), 'subject'); 
        // 删除字段 subject 上带有索引词 abc 或 def 的所有记录
        XS::defaultCharset 项目默认字符集 影响范围包括使用时的输入数据以及搜索结果的输出数据，该属性默认由配置文件中的 project.default_charset 指定，如有必要可以自行修改，但要确保在使用索引、搜索对象之前*/
    }



    /**
     * 清空索引
     * @return [type] [description]
     */
    public function delDocumentAllData()
    {
         $this->xs->index->update($doc);
    }
    // 清空索引是一个同步操作，一旦执行立即生效，并且不可恢复。如果采用这种 方式重建索引，由于原有索引被立即清空了，可能会有一小段时间无法搜索到数据
    
    /**
     * 获取展开的搜索词列表
     * @param  string  $query 需要展开的前缀, 可为拼音、英文、中文
     * @param  integer $limit 需要返回的搜索词数量上限, 默认为 10, 最大值为 20
     * @return array          返回搜索词组成的数组
     */
    public function getExpandedQuery($query, $limit = 10)
    {
        $ret = array();
        $limit = max(1, min(20, intval($limit)));

        try {
            $buf = XS::convert($query, 'UTF-8', $this->_charset);
            $cmd = array('cmd' => XS_CMD_QUERY_GET_EXPANDED, 'arg1' => $limit, 'buf' => $buf);
            $res = $this->execCommand($cmd, XS_CMD_OK_RESULT_BEGIN);

            // echo "Raw Query: " . $res->buf . "\n";
            // get result documents
            while (true) {
                $res = $this->getRespond();
                if ($res->cmd == XS_CMD_SEARCH_RESULT_FIELD) {
                    $ret[] = XS::convert($res->buf, $this->_charset, 'UTF-8');
                } elseif ($res->cmd == XS_CMD_OK && $res->arg == XS_CMD_OK_RESULT_END) {
                    // got the end
                    // echo "Parsed Query: " . $res->buf . "\n";
                    break;
                } else {
                    $msg = 'Unexpected respond in search {CMD:' . $res->cmd . ', ARG:' . $res->arg . '}';
                    throw new XSException($msg);
                }
            }
        } catch (XSException $e) {
            if ($e->getCode() != XS_CMD_ERR_XAPIAN) {
                throw $e;
            }
        }

        return $ret;
    }


}