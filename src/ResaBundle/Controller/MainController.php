<?php
/**
 * Created by PhpStorm.
 * User: Nico
 * Date: 27/06/2016
 * Time: 11:02
 */
namespace ResaBundle\Controller;

use ResaBundle\Entity\Hotel;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ResaBundle\Repository\HotelRepository;

Class MainController extends Controller
{
    /**
     * @param Request $request
     *
     * @Route("/main/{letter}", name="homepage", defaults={"letter" = "0"})
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function MainController(Request $request, $letter)
    {
        $alphabet = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");

        if ($letter == "0"){
            $hotels = $this->getDoctrine()->getManager()->getRepository(Hotel::class)->findAll();
        } else {
            $hotels = $this->getDoctrine()->getManager()->createQuery(
                'SELECT h.id, h.ville FROM ResaBundle:Hotel h WHERE h.ville LIKE \'' . $letter . '%\'')->getResult();
        }

        return $this->render("@Resa/Main/index.html.twig", array(
            "alaphabet" => $alphabet,
            "hotels" => $hotels,
        ));
    }
}