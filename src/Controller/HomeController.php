<?php

namespace App\Controller;

use \Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HomeController
 * @package App\Controller
 * @Route("/home", name="homepage_")
 */
class HomeController extends AbstractController
{

    /**
     * @return Response
     * @Route("/", name="index")
     */
    public function index(): Response
    {

        return $this->render("Home/home.html.twig");
    }

}
