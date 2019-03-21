<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BackgroundRepository;
use App\Repository\EventRepository;
use App\Repository\MemberRepository;
use App\Repository\ContentRepository;
use App\Repository\VideoRepository;
use App\Repository\AlbumRepository;
use App\Entity\Background;


class FrontController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(BackgroundRepository $backgroundRepository,
                          EventRepository $eventRepository,
                          MemberRepository $memberRepository,
                          ContentRepository $contentRepository,
                          VideoRepository $videoRepository,
                          AlbumRepository $albumRepository)
    {

        // Backgrounds
        $backgrounds = array();
        foreach (Background::$sectionTypeList as $sectionType) {
            $background = $backgroundRepository->findOneBy(array("section" => $sectionType));
            $backgrounds[$sectionType] = $background;
        }

        // Agenda
        $events = $eventRepository->findBy(array(), array('date' => 'ASC'));

        // Galerie
        $videos = $videoRepository->findAll();
        $albums = $albumRepository->findAll();

        // Présentation du groupe
        $members = $memberRepository->findBy(array(), array('lastname' => 'ASC'));
        $bio = $contentRepository->findOneBy(array('section' => 'bio'));

        $contact = $contentRepository->findOneBy(array('section' => 'contact'));

        return $this->render('front/index.html.twig', [
            "backgrounds" => $backgrounds,
            "events" => $events,
            "videos" => $videos,
            "albums" => $albums,
            "members" => $members,
            "bio" => $bio,
            "contact" => $contact
        ]);
    }
}
