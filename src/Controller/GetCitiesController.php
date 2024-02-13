<?php

namespace App\Controller;

use App\Entity\City;
use App\Repository\CityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetCitiesController extends AbstractController
{
    #[Route('/get/cities', name: 'app_get_cities')]
    public function index(
        CityRepository $cityRepository,
        Request $request,
    ): Response {


        $department = null;
        if ($request->isMethod('POST') && 
        $request->headers->get('Content-Type') === 'application/json') {

            $json = $request->getContent();
            $requestData = json_decode($json, true);

            $department = $requestData['department'];
        }

        if (!$department) {
            $department = 1;
        }
        $cities = $cityRepository->getCitiesFromDepartment($department);

        $citiesJson = [];
        foreach ($cities as $city) {
            $citiesJson[] = [
                'name' => $city->getName(),
                'zipCode' => $city->getZipCode(),
                'inseeeCode' => $city->getInseeCode(),
            ];
        }

        $response = new JsonResponse($citiesJson);

        return $response;
    }
}
