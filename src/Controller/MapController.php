<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\CityRepository;
use App\Repository\FarmerRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MapController extends AbstractController
{
    /**
     * @Route("/map", name="map")
     * @param CategoryRepository $categoryRepository
     * @param FarmerRepository $farmerRepository
     * @param CityRepository $cityRepository
     * @param ProductRepository $productRepository
     * @return Response
     */
    public function index(
        CategoryRepository $categoryRepository,
        FarmerRepository $farmerRepository,
        CityRepository $cityRepository,
        ProductRepository $productRepository
    ): Response
    {
        return $this->render('map/index.html.twig', [
            'categories'=>$categoryRepository->findAll(),
            'farmer'=>$farmerRepository->findAll(),
            'products'=>$productRepository->findAll(),
            'cities'=>$cityRepository->findBy([], [], 100),

        ]);
    }
}
