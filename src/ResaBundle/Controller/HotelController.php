<?php

namespace ResaBundle\Controller;

use ResaBundle\Entity\Chambre;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ResaBundle\Entity\Hotel;
use ResaBundle\Form\HotelType;

/**
 * Hotel controller.
 *
 * @Route("/hotel")
 */
class HotelController extends Controller
{
    /**
     * Lists all Hotel entities.
     *
     * @Route("/", name="hotel_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $hotels = $em->getRepository('ResaBundle:Hotel')->findAll();

        return $this->render('@Resa/hotel/index.html.twig', array(
            'hotels' => $hotels,
        ));
    }

    /**
     * Creates a new Hotel entity.
     *
     * @Route("/new", name="hotel_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $hotel = new Hotel();
        $form = $this->createForm('ResaBundle\Form\HotelType', $hotel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($hotel);
            $em->flush();

            return $this->redirectToRoute('hotel_show', array('id' => $hotel->getId()));
        }

        return $this->render('@Resa/hotel/new.html.twig', array(
            'hotel' => $hotel,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Hotel entity.
     *
     * @Route("/{id}", name="hotel_show")
     * @Method("GET")
     */
    public function showAction(Hotel $hotel, $id)
    {
        $deleteForm = $this->createDeleteForm($hotel);
        $chambres = $this->getDoctrine()->getRepository(Chambre::class)->findByIdHotel($id);

        return $this->render('@Resa/hotel/show.html.twig', array(
            'hotel' => $hotel,
            'delete_form' => $deleteForm->createView(),
            'chambres' => $chambres,
        ));
    }

    /**
     * Displays a form to edit an existing Hotel entity.
     *
     * @Route("/{id}/edit", name="hotel_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Hotel $hotel)
    {
        $deleteForm = $this->createDeleteForm($hotel);
        $editForm = $this->createForm('ResaBundle\Form\HotelType', $hotel);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($hotel);
            $em->flush();

            return $this->redirectToRoute('hotel_edit', array('id' => $hotel->getId()));
        }

        return $this->render('@Resa/hotel/edit.html.twig', array(
            'hotel' => $hotel,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Hotel entity.
     *
     * @Route("/{id}", name="hotel_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Hotel $hotel)
    {
        $form = $this->createDeleteForm($hotel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($hotel);
            $em->flush();
        }

        return $this->redirectToRoute('hotel_index');
    }

    /**
     * Creates a form to delete a Hotel entity.
     *
     * @param Hotel $hotel The Hotel entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Hotel $hotel)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('hotel_delete', array('id' => $hotel->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }

    /**
     * @param Request $request
     * @param $id_Hotel
     *
     * @Route("/{id_Hotel}/chambres", name="chamberOfHotel")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showChambreLibreFromHotel(Request $request, $id_Hotel)
    {
        $em = $this->getDoctrine()->getManager();
        $chambresLibres = $em->createQuery('SELECT c.id, c.numchambre, c.places, c.reservee, c.clim, c.tv, c.internet, c.animaux FROM ResaBundle:Chambre c WHERE c.idHotel = :idHotel AND c.reservee = 0')->setParameter('idHotel', $id_Hotel)->getResult();
        $hotel = $em->getRepository(Hotel::class)->find($id_Hotel);

        return $this->render('@Resa/hotel/showChambreHotel.html.twig', array(
            "chambresLibres" => $chambresLibres,
            "hotel" => $hotel,
        ));
    }
}
