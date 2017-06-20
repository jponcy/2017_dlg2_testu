<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Barbecue;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Barbecue controller.
 *
 * @Route("barbecue")
 */
class BarbecueController extends Controller
{
    /**
     * Lists all barbecue entities.
     *
     * @Route("/", name="barbecue_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $barbecues = $em->getRepository('AppBundle:Barbecue')->findAll();

        return $this->render('barbecue/index.html.twig', array(
            'barbecues' => $barbecues,
        ));
    }

    /**
     * Creates a new barbecue entity.
     *
     * @Route("/new", name="barbecue_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $barbecue = new Barbecue();
        $form = $this->createForm('AppBundle\Form\BarbecueType', $barbecue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($barbecue);
            $em->flush();

            return $this->redirectToRoute('barbecue_show', array('id' => $barbecue->getId()));
        }

        return $this->render('barbecue/new.html.twig', array(
            'barbecue' => $barbecue,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a barbecue entity.
     *
     * @Route("/{id}", name="barbecue_show")
     * @Method("GET")
     */
    public function showAction(Barbecue $barbecue)
    {
        $deleteForm = $this->createDeleteForm($barbecue);

        return $this->render('barbecue/show.html.twig', array(
            'barbecue' => $barbecue,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing barbecue entity.
     *
     * @Route("/{id}/edit", name="barbecue_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Barbecue $barbecue)
    {
        $deleteForm = $this->createDeleteForm($barbecue);
        $editForm = $this->createForm('AppBundle\Form\BarbecueType', $barbecue);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('barbecue_edit', array('id' => $barbecue->getId()));
        }

        return $this->render('barbecue/edit.html.twig', array(
            'barbecue' => $barbecue,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a barbecue entity.
     *
     * @Route("/{id}", name="barbecue_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Barbecue $barbecue)
    {
        $form = $this->createDeleteForm($barbecue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($barbecue);
            $em->flush();
        }

        return $this->redirectToRoute('barbecue_index');
    }

    /**
     * Creates a form to delete a barbecue entity.
     *
     * @param Barbecue $barbecue The barbecue entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Barbecue $barbecue)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('barbecue_delete', array('id' => $barbecue->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
