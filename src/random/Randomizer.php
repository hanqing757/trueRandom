<?php

namespace random;

class Randomizer{
	//请求接口
	protected $url="https://api.random.org/json-rpc/1/invoke";

	//api keys
	protected $apikey;
	//
	private $id=1;

	public $client;

	public function __construct($apikey){
		if(is_null($apikey)){
			throw new InvalidArgumentException('you should input a api keys');
		}else{
			$this->apikey=$apikey;
		}
		$this->client=new \GuzzleHttp\Client();
	}
	//
	public function get_rst($method,$params){
		$params['apiKey']=$this->apikey;
		$body=array(
			'jsonrpc'=>'2.0',
			'method'=>$method,
			'params'=>$params,
			'id'=>$this->id
		);
		$res=$this->client->request('POST',$this->url,['json'=>$body]);        
		$code=$res->getStatusCode();
		$ret=$res->getBody();
		$this->id++;
		$data=json_decode($ret->getContents());
		if($code==200){
			if(isset($data->result)){
				return $data->result;
			}else{
				return $data->error;
			}
		}else{
			return $data;
		}
	}

	/**
	*生成一系列整数
	*
	*@params quantity      随机数个数
	*@params min           最小值
	*@params max           最大值
	*@params base          结果以几进制展现
	*@params replacement   true表示结果可能出现重复值，false则是唯一的
	*/
	public function integers($quantity,$min,$max,$base=10,$replacement=true){
		$method='generateIntegers';
		$params=array(
			'n'=>$quantity,
			'min'=>$min,
			'max'=>$max,
			'base'=>$base,
			'replacement'=>$replacement
		);
		$ret=$this->get_rst($method,$params);
		return $ret;
	}

	/**
	*生成指定位数的随机的0-1之间的小数
	*@params quantity 随机数个数
	*@params decimalPlaces 小数位数
	*@params replacement 
	*/
	public function decimalFractions($quantity,$decimalPlaces,$replacement=true){
		$method='generateDecimalFractions';
		$params=array(
			'n'=>$quantity,
			'decimalPlaces'=>$decimalPlaces,
			'replacement'=>$replacement
		);
		$ret=$this->get_rst($method,$params);
		return $ret;
	}

	/**
	 * 生成高斯分布随机数
	 * @param    quantity
	 * @param    mean 均值
	 * @param    standardDeviation 标准差
	 * @param    significantDigits 有效数字
	 * @return   
	 */
	public function gaussians($quantity,$mean,$standardDeviation,$significantDigits){
		$method='generateGaussians';
		$params=array(
			'n'=>$quantity,
			'mean'=>$mean,
			'standardDeviation'=>$standardDeviation,
			'significantDigits'=>$significantDigits
		);
		$ret=$this->get_rst($method,$params);
		return $ret;
	}

	/**生成随机字符串
	 * @param    quantity
	 * @param    length  字符串长度
	 * @param    characters 字符集
	 * @param    replacement
	 * @return   
	 */
	public function strings($quantity,$length,$characters,$replacement=true){
		$method='generateStrings';
		$params=array(
			'n'=>$quantity,
			'length'=>$length,
			'characters'=>$characters,
			'replacement'=>$replacement
		);
		$ret=$this->get_rst($method,$params);
		return $ret;
	}

	/**生成随机的uuid
	 * @param    quantity  uuids的个数
	 * @return   
	 */
	public function uuids($quantity){
		$method='generateUUIDs';
		$params=array(
			'n'=>$quantity
		);
		$ret=$this->get_rst($method,$params);
		return $ret;
	}
	/**生成二进制大对象 blob 一般用来存储图片或者声音
	 * @param    quantity
	 * @param    size blob的长度 bit 可被8整除
	 * @param    format 数据返回格式
	 * @return   [type]
	 */
	public function blobs($quantity,$size,$format='base64'){
		$method='generateBlobs';
		$params=array(
			'n'=>$quantity,
			'size'=>$size,
			'format'=>$format
		);
		$ret=$this->get_rst($method,$params);
		return $ret;
	}

	/**
	 * 查看 API key 当前信息状态
	 * @return   
	 */
	public function usage(){
		$method='getUsage';
		$params=array();
		$ret=$this->get_rst($method,$params);
		return $ret;
	}


}