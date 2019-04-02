<?php

namespace App\Controller;

use App\Entity\Dance;
use App\Form\DanceType;
use App\Repository\DanceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/dance")
 */
class DanceController extends AbstractController
{
    /**
     * @Route("/", name="dance_index", methods={"GET"})
     */
    public function index(DanceRepository $danceRepository): Response
    {
        return $this->render('dance/index.html.twig', [
            'dances' => $danceRepository->findAll(array(), array('date' => 'DESC')),
        ]);
    }

    /**
     * @Route("/new", name="dance_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $dance = new Dance();
        $form = $this->createForm(DanceType::class, $dance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($dance);
            $entityManager->flush();

            return $this->redirectToRoute('dance_index');
        }

        return $this->render('dance/new.html.twig', [
            'dance' => $dance,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="dance_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Dance $dance): Response
    {
        $form = $this->createForm(DanceType::class, $dance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('dance_index', [
                'id' => $dance->getId(),
            ]);
        }

        return $this->render('dance/edit.html.twig', [
            'dance' => $dance,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="dance_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Dance $dance): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dance->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($dance);
            $entityManager->flush();
        }

        return $this->redirectToRoute('dance_index');
    }
}
