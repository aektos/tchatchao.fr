<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AlbumRepository;
use App\Repository\VideoRepository;

/**
 * @Route("/admin/gallery")
 */
class GalleryController extends AbstractController
{
    /**
     * @Route("/", name="gallery_index", methods={"GET"})
     */
    public function index(AlbumRepository $albumRepository, VideoRepository $videoRepository): Response
    {
        return $this->render('gallery/index.html.twig', [
            'albums' => $albumRepository->findAll(),
            'videos' => $videoRepository->findAll(),
        ]);
    }
}
