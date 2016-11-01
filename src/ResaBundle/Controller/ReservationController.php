<?php

namespace ResaBundle\Controller;

use ResaBundle\Entity\Chambre;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ResaBundle\Entity\Reservation;
use ResaBundle\Form\ReservationType;

/**
 * Reservation controller.
 *
 * @Route("/reservation")
 */
class ReservationController extends Controller
{
    /**
     * Lists all Reservation entities.
     *
     * @Route("/", name="reservation_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $reservations = $em->getRepository('ResaBundle:Reservation')->findAll();

        return $this->render('@Resa/reservation/index.html.twig', array(
            'reservations' => $reservations,
        ));
    }

    /**
     * Creates a new Reservation entity.
     *
     * @Route("/new/{idChambre}", name="reservation_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, $idChambre)
    {
        $reservation = new Reservation();
        $chambre = $this->getDoctrine()->getManager()->getRepository(Chambre::class)->find($idChambre);
        $reservation->setId($chambre);

        $thisDay = new \DateTime(date('Y-m-d'));
        $reservation->setDatearrivee($thisDay);
        $reservation->setDatedepart($thisDay);

        $form = $this->createForm('ResaBundle\Form\ReservationType', $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && ($reservation->getDatearrivee() < $reservation->getDatedepart()) && ($reservation->getDatedepart() > $thisDay && $reservation->getDatearrivee() >= $thisDay)) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($reservation);
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', 'Réservation effectué');
            return $this->redirectToRoute('homepage');

        } else if (($reservation->getDatearrivee() > $reservation->getDatedepart()) || ($reservation->getDatedepart() < $thisDay || $reservation->getDatearrivee() < $thisDay)){
            $request->getSession()->getFlashBag()->add('notice', 'Erreur dans la date !');
        }

        return $this->render('@Resa/reservation/new.html.twig', array(
            'chambre' => $chambre,
            'reservation' => $reservation,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Reservation entity.
     *
     * @Route("/{id}", name="reservation_show")
     * @Method("GET")
     */
    public function showAction($id)
    {
        $reservation = $this->getDoctrine()->getRepository(Reservation::class)->find($id);

        return $this->render('@Resa/reservation/show.html.twig', array(
            'reservation' => $reservation
        ));
    }

    /**
     * Displays a form to edit an existing Reservation entity.
     *
     * @Route("/{id}/edit", name="reservation_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Reservation $reservation)
    {
        $deleteForm = $this->createDeleteForm($reservation);
        $editForm = $this->createForm('ResaBundle\Form\ReservationType', $reservation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($reservation);
            $em->flush();

            return $this->redirectToRoute('reservation_edit', array('id' => $reservation->getIdreservation()));
        }

        return $this->render('@Resa/reservation/edit.html.twig', array(
            'reservation' => $reservation,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Reservation entity.
     *
     * @Route("/{id}", name="reservation_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Reservation $reservation)
    {
        $form = $this->createDeleteForm($reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($reservation);
            $em->flush();
        }

        return $this->redirectToRoute('reservation_index');
    }

    /**
     * Creates a form to delete a Reservation entity.
     *
     * @param Reservation $reservation The Reservation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Reservation $reservation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('reservation_delete', array('id' => $reservation->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
