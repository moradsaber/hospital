<?php

namespace App\Controller;

use App\Entity\Bed;
use App\Form\BedType;
use App\Repository\BedRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bed")
 */
class BedController extends AbstractController
{
    /**
     * @Route("/", name="bed_index", methods={"GET"})
     */
    public function index(BedRepository $bedRepository): Response
    {
        return $this->render('bed/index.html.twig', [
            'beds' => $bedRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="bed_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $bed = new Bed();
        $form = $this->createForm(BedType::class, $bed);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($bed);
            $entityManager->flush();

            return $this->redirectToRoute('bed_index');
        }

        return $this->render('bed/new.html.twig', [
            'bed' => $bed,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="bed_show", methods={"GET"})
     */
    public function show(Bed $bed): Response
    {
        return $this->render('bed/show.html.twig', [
            'bed' => $bed,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bed_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Bed $bed): Response
    {
        $form = $this->createForm(BedType::class, $bed);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bed_index');
        }

        return $this->render('bed/edit.html.twig', [
            'bed' => $bed,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="bed_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Bed $bed): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bed->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($bed);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bed_index');
    }
}
