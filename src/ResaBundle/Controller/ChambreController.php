<?php

namespace ResaBundle\Controller;

use ResaBundle\Entity\Hotel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ResaBundle\Entity\Chambre;
use ResaBundle\Form\ChambreType;

/**
 * Chambre controller.
 *
 * @Route("/chambre")
 */
class ChambreController extends Controller
{
    /**
     * Lists all Chambre entities.
     *
     * @Route("/", name="chambre_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $chambres = $em->getRepository('ResaBundle:Chambre')->findAll();

        return $this->render('@Resa/chambre/index.html.twig', array(
            'chambres' => $chambres,
        ));
    }

    /**
     * Creates a new Chambre entity.
     *
     * @Route("/new/{idHotel}", name="chambre_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, $idHotel)
    {
        $chambre = new Chambre();
        $chambre->setReservee(false);
        $hotel = $this->getDoctrine()->getManager()->getRepository(Hotel::class)->findOneById($idHotel);
        $chambre->setIdHotel($hotel);
        $form = $this->createForm('ResaBundle\Form\ChambreType', $chambre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($chambre);
            $em->flush();

            return $this->redirectToRoute('chambre_show', array('id' => $chambre->getId()));
        }

        return $this->render('@Resa/chambre/new.html.twig', array(
            'chambre' => $chambre,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Chambre entity.
     *
     * @Route("/{id}", name="chambre_show")
     * @Method("GET")
     */
    public function showAction(Chambre $chambre)
    {
        $deleteForm = $this->createDeleteForm($chambre);

        return $this->render('@Resa/chambre/show.html.twig', array(
            'chambre' => $chambre,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Chambre entity.
     *
     * @Route("/{id}/edit", name="chambre_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Chambre $chambre)
    {
        $deleteForm = $this->createDeleteForm($chambre);
        $editForm = $this->createForm('ResaBundle\Form\ChambreType', $chambre);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($chambre);
            $em->flush();

            return $this->redirectToRoute('chambre_edit', array('id' => $chambre->getId()));
        }

        return $this->render('@Resa/chambre/edit.html.twig', array(
            'chambre' => $chambre,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Chambre entity.
     *
     * @Route("/{id}", name="chambre_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Chambre $chambre)
    {
        $form = $this->createDeleteForm($chambre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($chambre);
            $em->flush();
        }

        return $this->redirectToRoute('chambre_index');
    }

    /**
     * Creates a form to delete a Chambre entity.
     *
     * @param Chambre $chambre The Chambre entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Chambre $chambre)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('chambre_delete', array('id' => $chambre->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
