<?php 

namespace CobrancaNet;

define("PRODUCAO", array(
	'token' => 'http://boleto.net/auth/token',
	'registro' => 'http://boleto.net/auth/validar'
));

define("HOMOLOGACAO", array(
	'token' => 'http://boleto.net/auth/token',
	'registro' => 'http://boleto.net/auth/validar'
));

class CobrancaNet{

	private $user_id;
	private $secret;
	private $ambiente;
	private $curl;
 	private $numeroDocumento;
 	private $descricaoTitulo;
 	private $dadosTitulo;

 	public function setNumeroDocumento( $val ){
 		$this->numeroDocumento = $val;
 		return $this;
 	}

 	public function getNumeroDocumento(){
 		return $this->numeroDocumento;
 	}


	public function __construct( $user_id, $secret ){
		$this->user_id = $user_id;
		$this->secret = $secret;
		$this->ambiente = PRODUCAO;
		$this->dadosTitulo = array();
	}

	public function set( $key , $value){
		$this->dadosTitulo[$key] = $value;
		return $this;
	}

	public function initCurl(){
		$this->curl = curl_init(); 
		curl_setopt($this->curl, CURLOPT_POST, true);
		curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
	}

	public function getToken(){
		$this->initCurl(); 
		curl_setopt($this->curl, CURLOPT_URL, $this->ambiente['token']);
		curl_setopt($this->curl, CURLOPT_HTTPHEADER, array(
			'Accept: application/json',
			'Authorization: Basic ' . base64_encode( $this->user_id . ":" . $this->secret)
		));

		$result = curl_exec($this->curl);
		curl_close( $this->curl );
		return json_decode($result);
	}
	public function executar( $function ){
		$token = $this->getToken();

		if( is_object( $token ) ){
			if( $token->type == 'success' ){
				$this->initCurl();
				curl_setopt($this->curl, CURLOPT_URL, $this->ambiente['registro']);
				curl_setopt($this->curl, 
					CURLOPT_POSTFIELDS, 
					$this->dadosTitulo
				);

				curl_setopt($this->curl, CURLOPT_HTTPHEADER, array(
				    "Accept: application/json" ,
				    "Authorization: Bearer " . $token->data->token  ,
				    "Origin: ". "http://". $_SERVER["HTTP_HOST"]
				)); 

				$request = curl_exec($this->curl); 
				 
				$request = json_decode($request);

				if( is_object( $request ) ){
					$function( $request);
				}else{
					$function( $request );
				}
			}else{
				$function( array(
					'type' => 'error',
					'message' => $token->msg,
					'data' => null
				));
			}
		}else{
			$function( array(
				'type' => 'error',
				'message' => 'Falha ao recuperar o token',
				'data' => null
			));
		 
		}
	}


}