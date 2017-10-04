<?php namespace ms\controller;

class config{

	private $settings =[];
	 private static $_instance;

    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new config();
        }
        return self::$_instance;
    }

	 public static function includeapp($file)
    {
			if(is_file($file)){
			  include($file);
			}

    }

	public function __construct($chemin=null){
		
if($chemin!="") if(is_file(''.$chemin))
		$this->settings= require ''.$chemin;

	}

	    public  function get($key)
    {
        if (!isset($this->settings[$key])) {
            return "";
        }
        return $this->settings[$key];
    }



}

?>
