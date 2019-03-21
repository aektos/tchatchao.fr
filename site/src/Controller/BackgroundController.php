<?php

namespace App\Controller;

use App\Entity\Background;
use App\Form\BackgroundType;
use App\Repository\BackgroundRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/background")
 */
class BackgroundController extends AbstractController
{
    /**
     * @Route("/", name="background_index", methods={"GET"})
     */
    public function index(Request $request, BackgroundRepository $backgroundRepository): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $backgrounds = array();
        foreach(Background::$sectionTypeList as $sectionType) {
            $background = $backgroundRepository->findOneBy(array("section" => $sectionType));

            if(!$background) {
                $background = new Background();
                $background->setSection($sectionType);
                $background->setImageName(null);

                $entityManager->persist($background);
                $entityManager->flush();
            }
            $backgrounds[] = $background;
        }

        $request->headers->addCacheControlDirective('no-cache', true);

        return $this->render('background/index.html.twig', [
            'backgrounds' => $backgrounds,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="background_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Background $background): Response
    {
        $form = $this->createForm(BackgroundType::class, $background);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('background_index', [
                'id' => $background->getId(),
            ]);
        }

        return $this->render('background/edit.html.twig', [
            'background' => $background,
            'form' => $form->createView(),
        ]);
    }
}
