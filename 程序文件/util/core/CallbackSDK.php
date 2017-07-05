<?php

class CallbackSDK {
	const MSGTYPE_TEXT = 'text';
	const MSGTYPE_IMAGE = 'image';
	const MSGTYPE_LOCATION = 'position';
	const MSGTYPE_LINK = 'link';
	const MSGTYPE_EVENT = 'event';
	const MSGTYPE_MUSIC = 'music';
	const MSGTYPE_NEWS = 'news';
	const MSGTYPE_VOICE = 'voice';
	const MSGTYPE_VIDEO = 'video';
    private $app_secret = "";

    /**
     * 设置app_key对应的app_secret。
     * @param $app_secret
     */
    public function setAppSecret($app_secret) {
        $this->app_secret = $app_secret;
    }

    /**
     * 获取推送来的的数据
     * 必须使用 $GLOBALS['HTTP_RAW_POST_DATA']方法获取post过来的原始数据来解析.
     * @return mixed
     */
    public function getPostMsgStr() {
        return json_decode($GLOBALS['HTTP_RAW_POST_DATA'], true);
    }
	 
    /**
     * 获取推送来的信息
     */
	public function getRev()
	{
		$postStr = $this->getPostMsgStr();
		if (!empty($postStr)) {
			$this->_receive = $postStr;
		}
		return $this;
	}
	
	/**
	 * 获取微信服务器发来的信息
	 */
	public function getRevData()
	{
		return $this->_receive;
	}
		
	/**
	 * 获取消息发送者
	 */
	public function getRevFrom() {
		if ($this->_receive)
			return $this->_receive['sender_id'];
		else 
			return false;
	}
	
	/**
	 * 获取消息接受者
	 */
	public function getRevTo() {
		if ($this->_receive)
			return $this->_receive['receiver_id'];
		else 
			return false;
	}
	
	/**
	 * 获取接收消息的类型
	 */
	public function getRevType() {
		if (isset($this->_receive['type']))
			return $this->_receive['type'];
		else 
			return false;
	}
	
	/**
	 * 获取消息ID
	 */
	public function getRevID() {
		if (isset($this->_receive['MsgId']))
			return $this->_receive['MsgId'];
		else 
			return false;
	}
	
	/**
	 * 获取消息发送时间
	 */
	public function getRevCtime() {
		if (isset($this->_receive['created_at']))
			return $this->_receive['created_at'];
		else 
			return false;
	}
	
	/**
	 * 获取接收消息内容正文
	 */
	public function getRevContent(){
		if (isset($this->_receive['text']))
			return $this->_receive['text'];
		//else if (isset($this->_receive['Recognition'])) //获取语音识别文字内容，需申请开通
		//	return $this->_receive['Recognition'];
		else
			return false;
	}
	
	/**
	 * For weixin server validation 
	 * @param bool $return 是否返回
	 */
	public function valid($return=false)
    {
        $echoStr = isset($_GET["echostr"]) ? $_GET["echostr"]: '';
        if ($return) {
        		if ($echoStr) {
        			if ($this->checkSignature()) 
        				return $echoStr;
        			else
        				return false;
        		} else 
        			return $this->checkSignature();
        } else {
	        	if ($echoStr) {
	        		if ($this->checkSignature())
	        			die($echoStr);
	        		else 
	        			die('no access');
	        	}  else {
	        		if ($this->checkSignature())
	        			return true;
	        		else
	        			die('no access');
	        	}
        }
        return false;
    }

    /**
     * 验证签名
     * @param $signature
     * @param $timestamp
     * @param $nonce
     * @return bool
     */
    function checkSignature($signature, $timestamp, $nonce) {
        $tmpArr = array($this->app_secret, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = sha1(implode($tmpArr));
        if ($tmpStr == $signature) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 组装返回数据
     * @param $receiver_id
     * @param $sender_id
     * @param $data
     * @param $type
     * @return array
     */
    function buildReplyMsg($receiver_id, $sender_id, $data, $type) {
        return $msg = array(
            "sender_id" => $sender_id,
            "receiver_id" => $receiver_id,
            "type" => $type,
            //data字段需要进行urlencode编码
            "data" => urlencode(json_encode($data))
        );
    }

    /**
     * 生成text类型的回复消息内容
     * @param $text
     * @return array
     */
    function textData($text) {
        return $data = array("text" => $text);
    }

    /**
     * 生成article类型的回复消息内容
     * @param $article
     * @return array
     */
    function articleData($articles) {
        return $data = array(
            'articles' => $articles
        );
    }

    /**
     * 生成position类型的回复消息内容
     * @param $longitude
     * @param $latitude
     * @return array
     */
    function positionData($longitude, $latitude) {
        return $data = array(
            "longitude" => $longitude,
            "latitude" => $latitude
        );
    }
}