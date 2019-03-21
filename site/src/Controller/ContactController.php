<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Content;
use App\Repository\ContentRepository;

/**
 * @Route("/admin/contact")
 */
class ContactController extends AbstractController
{
    /**
     * @Route("/", name="contact_index", methods={"GET"})
     *
     * @param ContentRepository $contentRepository
     * @return Response
     */
    public function index(ContentRepository $contentRepository): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $content = $contentRepository->findOneBy(array('section' => 'contact'));

        if(!$content) {
            $content = new Content();
            $content->setSection("contact");
            $content->setBodytext("   ");

            $entityManager->persist($content);
            $entityManager->flush();
        }

        return $this->render('contact/index.html.twig', [
            'content' => $content
        ]);
    }
}
