<?php

namespace App\Service;

class GeoApi
{
	/**
	* @param string $argument
	* @return bool
  */
  
	public function getCommune($ville, $codePostal) {

    if (empty ($ville)) {
      $url = "https://geo.api.gouv.fr/communes?codePostal=".$codePostal."&fields=nom,code,codesPostaux,codeDepartement,codeRegion,population&format=json&geometry=centre";
    } else {
      $url ="https://geo.api.gouv.fr/communes?nom=".$ville."&fields=nom,code,codesPostaux,codeDepartement,codeRegion,population&format=json&geometry=centre";
    }

    $curl = curl_init($url);

    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 3);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    
    $data = json_decode(curl_exec($curl), true);
    return $data;
    
  }

}