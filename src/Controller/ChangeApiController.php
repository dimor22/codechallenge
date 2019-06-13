<?php
/**
 * Created by PhpStorm.
 * User: davidlopez
 * Date: 6/11/19
 * Time: 11:15 PM
 */

namespace App\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\MoneyChange;

class ChangeApiController extends AbstractController
{

    /**
     * @var MoneyChange
     */
    public $change;

    /**
     * @var
     */
    public $request;

    /**
     * ChangeApiController constructor.
     * @param MoneyChange $change
     */
    public function __construct(MoneyChange $change)
    {
        $this->change = $change;
    }

    /**
     * @Route("/getChange", name="api_get_change", methods={"GET"})
     *
     * @param $cost
     * @param $paid
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function index(Request $request)
    {
        $result = $this->change->getChange($request->get('cost'), $request->get('paid'));

        return $this->json(['change' => $result]);
    }
}