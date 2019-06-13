<?php
/**
 * Created by PhpStorm.
 * User: davidlopez
 * Date: 6/11/19
 * Time: 9:05 PM
 */

namespace App\Controller;

use http\Env\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {

        return $this->render('home.html.twig');
    }
}