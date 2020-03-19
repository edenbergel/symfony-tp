<?php

namespace App\Service;

class EtablissementPublicApi
{
	/**
	* @param string $argument
	* @return bool
  */
  
	public function getEtablissement($code, $type) {

    $url = "https://etablissements-publics.api.gouv.fr/v3/communes/".$code."/".$type;

    $curl = curl_init($url);

    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 3);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    
    $data = json_decode(curl_exec($curl), true);
    return $data;
    
  }

}