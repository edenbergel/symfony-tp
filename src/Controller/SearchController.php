<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\GeoApi;
use App\Service\EtablissementPublicApi;

class SearchController extends AbstractController
{
    /**
     * @Route("/", name="search")
     * @param GeoApi $GeoApi
     * @param EtablissementPublicApi $etablissementPublicApi
     */
    public function index(GeoApi $GeoApi, EtablissementPublicApi $etablissementPublicApi)
    {
        $returnCity = [];
        $returnEtablissement = [];

        if (isset($_GET['send'])) {
            $ville = $_GET['ville'];
            $code_postal = $_GET['codepostal'];
            $type = $_GET['type'];
            $citys = $GeoApi->getCommune($ville, $code_postal);


            if (!empty($citys)) {
                $etablissements = $etablissementPublicApi->getEtablissement($citys[0]['code'], $_GET["type"]);
                if ($etablissements != null) {
                    $city["etablissement"] = $etablissements;
                } else {
                    die('error');
                }

                array_push($returnCity, $citys);
                array_push($returnEtablissement, $etablissements);
            } else {
                echo '<a href="/">Retour</a> <br/>';
                die('Cette ville n\'existe pas');
            }

            if (empty($returnEtablissement[0]['features'])) {
                return $this->render('search/index.html.twig', [
                    'controller_name' => 'SearchController',
                    'citys' => $returnCity[0][0],
                ]);
            } else {
                return $this->render('search/index.html.twig', [
                    'controller_name' => 'SearchController',
                    'citys' => $returnCity[0][0],
                    'etablissements' => $returnEtablissement
                ]);
            }
        } else {
            return $this->render('search/index.html.twig', [
                'controller_name' => 'SearchController',
            ]);
        }
    }
}