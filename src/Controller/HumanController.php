<?php

namespace App\Controller;

use App\Entity\Human;
use App\Form\HumanType;
use App\Repository\HumanRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/human")
 */
class HumanController extends AbstractController
{
    /**
     * @Route("/", name="human_index", methods={"GET"})
     */
    public function index(HumanRepository $humanRepository): Response
    {
        return $this->render('human/index.html.twig', [
            'humans' => $humanRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="human_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $human = new Human();
        $form = $this->createForm(HumanType::class, $human);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($human);
            $entityManager->flush();

            return $this->redirectToRoute('human_index');
        }

        return $this->render('human/new.html.twig', [
            'human' => $human,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="human_show", methods={"GET"})
     */
    public function show(Human $human): Response
    {
        return $this->render('human/show.html.twig', [
            'human' => $human,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="human_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Human $human): Response
    {
        $form = $this->createForm(HumanType::class, $human);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('human_index', [
                'id' => $human->getId(),
            ]);
        }

        return $this->render('human/edit.html.twig', [
            'human' => $human,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="human_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Human $human): Response
    {
        if ($this->isCsrfTokenValid('delete'.$human->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($human);
            $entityManager->flush();
        }

        return $this->redirectToRoute('human_index');
    }
}
