<?php
namespace ms\controller;

/**
 * Gere la communication avec Manage-Society
 */
class apictr
{
    //some variables for the object
    public $_app_id;
    public $_serveur;
    public $_method;
    public $_class;
    public $_valeur=[];
    private $_api_url="http://www.manage-society.com/index.php";

    //construct an ApiCaller object, taking an
    //APP ID, APP KEY and API URL parameter
    public function __construct($app_id, $serveur)
    {
        $this->_app_id = $app_id;
        $this->_serveur = $serveur;

    }

    /**
     * Recupere la class sur MS
     *
     * @param [type] $data
     * @return void
     */
    public function getclass($class){
        $this->_class="dev\app\\".$this->_app_id."\\".$class;
        return $this;
    }

     /**
     * Recupere la methode sur MS
     *
     * @param [type] $data
     * @return void
     */
    public function method($methode){
        $this->_method=$methode;
        return $this;
    }

    /**
     * Recupere les donne a mettre dans la requete
     *
     * @param [type] $data
     * @return void
     */
    public function value($data=null){
        $this->_valeur[]=$data;
       $reponse= $this->sendRequest();
        return $reponse;
    }

    /**
     * Envoie la requete
     *
     * @return void
     */
    public function sendRequest()
    {
       // $enc_request = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->_app_id, json_encode($request_params), MCRYPT_MODE_ECB));

        $params = array();
        $params['controller'] = $this->_method;
        $params['controllerrequest'] =$this->_class;
        $params['data'] = json_encode($this->_valeur);
        $params['type_requete'] = "app_ext";
        $params['serveur'] =  $this->_serveur;
        $params['nom_app'] =  $this->_app_id;
       

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $this->_api_url);

    curl_setopt($ch, CURLOPT_POST, count($params));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
curl_setopt($ch, CURLOPT_USERAGENT, 'PHP');
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($ch);
        $first_reponse=$result;
    $result = @json_decode($result,true);
   
		if (curl_errno($ch)) {
		    var_dump($result); echo '<br>';
   		    print curl_error($ch);
		}

      

        if( $result == false || isset($result['success']) == false ) {
            var_dump($first_reponse);
        }


        if( $result['success'] == false ) {
            var_dump($first_reponse);
        }

       return $result['data'];
    }
}
