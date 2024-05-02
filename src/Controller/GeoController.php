<?php

// src/Controller/Api/GeocodingController.php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class GeocodingController extends AbstractController
{
    private HttpClientInterface $httpClient;
    private string $googleMapsApiKey;

    public function __construct(HttpClientInterface $httpClient, string $googleMapsApiKey)
    {
        $this->httpClient = $httpClient;
        $this->googleMapsApiKey = $googleMapsApiKey;
    }

    #[Route('/api/geocode/{address}', name: 'api_geocode_address', methods: ['GET'])]
    public function geocodeAddress(string $address): JsonResponse
    {
        $response = $this->httpClient->request('GET', 'https://maps.googleapis.com/maps/api/geocode/json', [
            'query' => [
                'address' => $address,
                'key' => $this->googleMapsApiKey,
            ],
        ]);

        $data = $response->toArray();

        // Vérifiez si la requête a réussi et retournez les coordonnées géographiques
        if (isset($data['results'][0]['geometry']['location'])) {
            $location = $data['results'][0]['geometry']['location'];
            return new JsonResponse($location);
        }

        // Si la requête a échoué, retournez une erreur
        return new JsonResponse(['error' => 'Failed to geocode address'], JsonResponse::HTTP_BAD_REQUEST);
    }
}
