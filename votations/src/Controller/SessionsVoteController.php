<?php

namespace App\Controller;

use App\Entity\SessionsVote;
use App\Form\SessionsVoteType;
use App\Repository\SessionsVoteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/sessions/vote')]
class SessionsVoteController extends AbstractController
{
    #[Route('/', name: 'app_sessions_vote_index', methods: ['GET'])]
    public function index(SessionsVoteRepository $sessionsVoteRepository): Response
    {
        return $this->render('sessions_vote/index.html.twig', [
            'sessions_votes' => $sessionsVoteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_sessions_vote_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $sessionsVote = new SessionsVote();
        $form = $this->createForm(SessionsVoteType::class, $sessionsVote);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($sessionsVote);
            $entityManager->flush();

            return $this->redirectToRoute('app_sessions_vote_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('sessions_vote/new.html.twig', [
            'sessions_vote' => $sessionsVote,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_sessions_vote_show', methods: ['GET'])]
    public function show(SessionsVote $sessionsVote): Response
    {
        return $this->render('sessions_vote/show.html.twig', [
            'sessions_vote' => $sessionsVote,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_sessions_vote_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SessionsVote $sessionsVote, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SessionsVoteType::class, $sessionsVote);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_sessions_vote_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('sessions_vote/edit.html.twig', [
            'sessions_vote' => $sessionsVote,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_sessions_vote_delete', methods: ['POST'])]
    public function delete(Request $request, SessionsVote $sessionsVote, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sessionsVote->getId(), $request->request->get('_token'))) {
            $entityManager->remove($sessionsVote);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_sessions_vote_index', [], Response::HTTP_SEE_OTHER);
    }
}
