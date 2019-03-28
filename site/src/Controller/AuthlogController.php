<?php

namespace App\Controller;

use App\Entity\Authlog;
use App\Form\AuthlogType;
use App\Repository\AuthlogRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/authlog")
 */
class AuthlogController extends AbstractController
{
    /**
     * @Route("/", name="authlog_index", methods={"GET"})
     */
    public function index(AuthlogRepository $authlogRepository): Response
    {
        return $this->render('authlog/index.html.twig', [
            'authlogs' => $authlogRepository->findAll(),
        ]);
    }

    /**
     * @Route("/delete", name="authlog_delete", methods={"DELETE"})
     */
    public function delete(Request $request, AuthlogRepository $authlogRepository): Response
    {
        if ($this->isCsrfTokenValid('delete_all_authlogs', $request->request->get('_token'))) {
            $authlogRepository->deleteAll();
        }

        return $this->redirectToRoute('authlog_index');
    }
}
