<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\CityRepository;
use App\Repository\FarmerRepository;
use App\Repository\ProductRepository;
use App\Repository\TransactionRepository;
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
     * @param TransactionRepository $transactionRepository
     * @return void
     */
    public function index(
        CategoryRepository $categoryRepository,
        FarmerRepository $farmerRepository,
        CityRepository $cityRepository,
        ProductRepository $productRepository,
        TransactionRepository $transactionRepository
    ): Response
    {
        return $this->render('map/index.html.twig', [
            'categories'=>$categoryRepository->findAll(),
            'farmers'=>$farmerRepository->findBy([], [], 100),
            'products'=>$productRepository->findAll(),
            'cities'=>$cityRepository->findBy([], [], 100),
            'transaction'=>$transactionRepository->findAll(),

        ]);
    }
}
