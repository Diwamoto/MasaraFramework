<?php
declare(strict_types=1);

namespace Masara\Config;

class Config{
	
	private $config = [];
	
	/**
	 * configフォルダのsettings.phpとdb.phpを読み込み
	 */
	public static function loadAll($toArray = false){
		$config = new Config();
		require ROOT . '/app/config/db.php';
		require ROOT . '/app/config/settings.php';
		if($toArray){
			return $config->getAll();
		}else{
			return $config;
		}
	}
	
	public function set($config){
		$this->config = array_merge($this->config, $config);
	}
	
	public function getAll(){
		return $this->config;
	}
	
	public static function get($arg){
		$config = self::loadAll(true);
		return $config[$arg];
	}
}