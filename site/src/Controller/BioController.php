<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Content;
use App\Repository\ContentRepository;
use App\Repository\MemberRepository;

/**
 * @Route("/admin/bio")
 */
class BioController extends AbstractController
{
    /**
     * @Route("/", name="bio_index", methods={"GET"})
     *
     * @param MemberRepository $memberRepository
     * @param ContentRepository $contentRepository
     * @return Response
     */
    public function index(MemberRepository $memberRepository, ContentRepository $contentRepository): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $content = $contentRepository->findOneBy(array('section' => 'bio'));

        if(!$content) {
            $content = new Content();
            $content->setSection("bio");
            $content->setBodytext("   ");

            $entityManager->persist($content);
            $entityManager->flush();
        }

        return $this->render('bio/index.html.twig', [
            'members' => $memberRepository->findBy(array(), array('lastname' => 'ASC')),
            'content' => $content
        ]);
    }
}
