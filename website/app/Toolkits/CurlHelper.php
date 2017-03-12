<?php
namespace App\Toolkits;

class CurlHelper{
	private $curl_handle;
	private $result;
	public function __construct($url){
		$this->curl_handle=curl_init();
		curl_setopt($this->curl_handle, CURLINFO_HEADER_OUT, TRUE);
		curl_setopt($this->curl_handle, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($this->curl_handle, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($this->curl_handle,CURLOPT_URL,$url);
	}
	public function setTimeOut($sec){
        curl_setopt($this->curl_handle,CURLOPT_CONNECTTIMEOUT,$sec);
        return $this;
	}

	public function setPost(){
		curl_setopt($this->curl_handle, CURLOPT_POST, 1);
		return $this;
	}
	public function setReturnTransfer($option){
        curl_setopt($this->curl_handle,CURLOPT_RETURNTRANSFER,$option);
        return $this;
	}
	public function setHeader($header){
        curl_setopt($this->curl_handle, CURLOPT_HTTPHEADER, $header); 
        return $this;
	}
	public function setParameter($param){
		curl_setopt($this->curl_handle, CURLOPT_POSTFIELDS, $param); 
        return $this;
	}
	
	public function exec(){
        $this->result = curl_exec($this->curl_handle);
        curl_close($this->curl_handle);
        return $this;
	}

	public function toJson(){
        return json_decode($this->result);
	}

	public function getResult(){
		return $this->result;
	}
}


