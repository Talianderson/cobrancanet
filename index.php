<?php
require_once __DIR__ . "/vendor/autoload.php";

use CobrancaNet\CobrancaNet;

session_start();
$user_id="APaQWlktYSkXNozkzDbFoZOuWLAoJpAKFbccMNXkgHIuwIfwMHBBhQxDdxsnmsysUbWhosSUBbPxkwtxDuzkMwopthdgbcawDxerpxNqZeoJaiGeeFPqCEhwmLdNoEKrBokqmziLdYUEGcjlizdlDL";
	$secret ="YcUtdFFjXtWwJTNbcErxaODDFzNAuRySuSMYZRIwMfsWzGycLqamFdqKcELYXJqRdEqCXAyjfqGfyFHKwhxBLnMosZMPiDiMIZOfaNPFFWlEbsPYbMamBmbtMnKursIASXgslwzqSkuueKSFYssagUUsIfoBZxCrUilGekyyWssAELGdFzDlTZfdETedRhWnPHtusrsOlmPqyWTEUYqpxWSCqygJfDxwLrrEjkTWYjNXFhbbGRQEokHfio";
$CobrancaNet = new CobrancaNet( $user_id, $secret);
$CobrancaNet->set('numeroDocumento', '014164')
->set('dataVencimentoTitulo', '06.11.2019')
->set('valorOriginalTitulo', '145.65')
->set('codigoTipoInscricaoPagador', '1')
->set('nomePagador','ALANA PRISCILLA')
->set('dataEmissaoTitulo', '06.11.2019')
->set('codigoTipoTitulo', '1')
->set('descricaoTitulo', 'CONTA DE INTERNET')
->set('codigoTipoDescontoTitulo',0)
->set('postarTituloCorreio', 0)
->set('textoEnderecoPagador','Q 5 ON D')
->set('fk_id_convenio',2)
->set('fk_id_taxa', 1)
->set('fk_id_cliente',1)
->set('dataCadastroTitulo','04.11.2019')
->set('codigoTipoInscricaoAvalista','1')
->set('numeroInscricaoAvalista','03734431107')
->set('nomeAvalistaTitulo','TALIANDERSON')
->set('codigoAceiteTitulo','N')
->set('numeroCepPagador','72726111')
->set('siglaUfPagador','DF')
->set('nomeMunicipioPagador','BRASILIA')
->set('nomeBairroPagador','BRAZLANDIA')
->set('permitirRecebimentoParcial','0') 
->set('dataDescontoTitulo','06.10.2019') 
->set('valorDescontoTitulo','2.00')
->set('percentualDescontoTitulo','2.00')
->set('codigoModalidadeTitulo','1')
->set('codigoTipoMulta','0')
->set('dataMultaTitulo','21.12.2019')
->set('valorMultaTitulo','2.00')
->set('percentualMultaTitulo','2.00')
->set('codigoTipoJuroMoraTitulo','0')
->set('dataJuroMoraTitulo','21.12.2019')
->set('valorJuroMoraTitulo','2.00')
->set('percentualJuroMoraTitulo','2.00')
->set('numeroInscricaoPagador', '03734431107');

$CobrancaNet->executar( function( $result ){
	var_dump($result);
});

/*
if( true ){ 
	$ch = curl_init();

	
	curl_setopt($ch, CURLOPT_URL, "http://boleto.net/auth/token");
	curl_setopt($ch, CURLOPT_POST, 1);
	 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Accept: application/json',
		'Authorization: Basic ' . base64_encode( $user_id . ":" . $secret)
	));

	$result = curl_exec( $ch );
 	
	//die($result);
	curl_close($ch);   
	$resposta = json_decode($result);

	 //die($result);

	if( $resposta->type == 'error'){
		die( $resposta->msg);
	}else{
		$_SESSION['TOKEN'] = $resposta;
	}
	  
}
// valida token


if( isset($_SESSION['TOKEN'])){
	$token = $_SESSION['TOKEN'];

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://boleto.net/auth/validar");
	curl_setopt($ch, CURLOPT_POST, 1); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS,[
		
			'fk_id_taxa' => 2,
			'fk_id_convenio' => 2,
			'fk_id_cliente' => 1,
			//'valorDocumento' => '56.90',

			'numeroDocumento' => '93900002',
			'descricaoTitulo' => 'COBRANÇA DE REMATRICULAAAAAAA',
			'dataCadastroTitulo' => '1.11.2019', 
			'dataVencimentoTitulo' => '15.11.2019', 
			'codigoModalidadeTitulo' => 1,
			'dataEmissaoTitulo' => '1.11.2019',
			'valorOriginalTitulo' => '95.60',

			'codigoTipoDescontoTitulo' => 1,
			'dataDescontoTitulo' => 'D',
			'valorDescontoTitulo' => '12.90',
			'percentualDescontoTitulo' => '3.3',


			'codigoTipoJuroMoraTitulo' => 1,
			'percentualJuroMoraTitulo' => '1',
			//'dataJuroMoraTitulo' => '11.11.2019',
			'dataJuroMoraTitulo' => 'D+1',
			'valorJuroMoraTitulo' => '10.00',


			'codigoTipoMulta' => 1,
			//'dataMultaTitulo' => '11.11.2019',
			'dataMultaTitulo' => 'D+1',
			'percentualMultaTitulo' => '3.5',
			'valorMultaTitulo' => '2.00',


			'codigoAceiteTitulo' => 'N',
			'codigoTipoTitulo' => 17,
			'permitirRecebimentoParcial' => 'N',
			'nossoNumeroTitulo' => 0,
			'textoMensagemBloquetoOcorrencia' => '',
			'codigoTipoInscricaoPagador' => 1,
			'numeroInscricaoPagador' => '03734431107',
			'nomePagador' => 'TALIANDERSON DIAS', 
			'postarTituloCorreio' => 1,
			'numeroCepPagador' => '72726111',
			'siglaUfPagador' => 'DF', 
			'nomeMunicipioPagador' => 'BRASILIA',
			'nomeBairroPagador' => 'BRAZLANDIA',
			'textoEnderecoPagador' => 'Q 5 CJ K', 
			'codigoTipoInscricaoAvalista' => '1',
			'numeroInscricaoAvalista' => '03734431107',
			'nomeAvalistaTitulo' => 'AVALISTA AQUI' 
		
	]);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	    "Accept: application/json" ,
	    "Authorization: Bearer " . $token->data->token  ,
	    "Origin: ". "http://".$_SERVER["HTTP_HOST"]
	));

	$result = curl_exec($ch); 
	 

	$resposta = json_decode( $result );
	//die($result);
	curl_close($ch); 
	var_dump($resposta);
}*/