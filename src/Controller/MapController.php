<?php

namespace App\Controller;

use App\Form\SearchTransactionType;
use App\Repository\CategoryRepository;
use App\Repository\CityRepository;
use App\Repository\FarmerRepository;
use App\Repository\ProductRepository;
use App\Repository\TransactionRepository;
use Symfony\Component\HttpFoundation\Request;
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
     * @param $request
     * @return Response
     */
    public function index(
        CategoryRepository $categoryRepository,
        FarmerRepository $farmerRepository,
        CityRepository $cityRepository,
        ProductRepository $productRepository,
        TransactionRepository $transactionRepository, Request $request
    ): Response
    {

        $form = $this->createForm(SearchTransactionType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $search = $form->getData()['search'];
            $transactions = $transactionRepository->findBy(['product' => $search->toArray()], [], 150 );
        } else {
            $transactions = $transactionRepository->findBy([], [], 25);
        }


        return $this->render('map/index.html.twig', [
            'categories'=>$categoryRepository->findAll(),
            'farmers'=>$farmerRepository->findBy([], [], 100),
            'products'=>$productRepository->findAll(),
            'cities'=>$cityRepository->findBy([], [], 100),
            'transactions'=>$transactions,
            'form' => $form->createView()
        ]);
    }
}
