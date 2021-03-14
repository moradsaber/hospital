<?php

namespace App\Controller;

use App\Entity\Bed;
use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Repository\ReservationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/reservation")
 */
class ReservationController extends AbstractController
{
    /**
     * @Route("/", name="reservation_index", methods={"GET"})
     * @param ReservationRepository $reservationRepository
     * @return Response
     */
    public function index(ReservationRepository $reservationRepository): Response
    {
        return $this->render('reservation/index.html.twig', [
            'reservations' => $reservationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="reservation_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $reservation = new Reservation();
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reservation);
            $entityManager->flush();

            return $this->redirectToRoute('reservation_index');
        }

        return $this->render('reservation/new.html.twig', [
            'reservation' => $reservation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/bed-available", name="reservation_Avalaible_Beds", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function availableBeds(Request $request): Response
    {

        $params = json_decode($request->getContent());
//        dd($params);
        // {"date_debut": "2021-03-14", "date_fin" : "2021-03-21", "sexe" : "M"}
        // faire une requete sql qui retourne la liste des bed disponible en se basant sur les parmetres envoyes
       // faire une requet sql pour afficher les dernier
        $data=$this->getDoctrine()->getRepository(Bed::class)->findByAvailableBeds($params);
//      dd($data);
        $arr= array();
        foreach ($data as $item){
        $arr[]= [
            "id" => $item['id'],
            "value" => $item['postion'],
            ];
        }
//        dd($arr);
        return new JsonResponse($arr
//            [
//                [
//                    'value' => random_int(1, 10),
//                    'text' => '225-fenetre' . random_int(1, 10)
//                ],
//                [
//                    'value' => random_int(1, 10),
//                    'text' => '226-porte' . random_int(1, 10)
//                ],
//                [
//                    'value' => random_int(1, 10),
//                    'text' => '226-fenetre' . random_int(1, 10)
//                ],
//                [
//                    'value' => random_int(1, 10),
//                    'text' => '227-fenetre' . random_int(1, 10)
//                ],
//                [
//                    'value' => random_int(1, 10),
//                    'text' => '228-porte' . random_int(1, 10)
//                ],
//            ]
        );

        //return  new JsonResponse([$params]);
    }

    /**
     * @Route("/{id}", name="reservation_show", methods={"GET"})
     */
    public function show(Reservation $reservation): Response
    {
        return $this->render('reservation/show.html.twig', [
            'reservation' => $reservation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="reservation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Reservation $reservation): Response
    {
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reservation_index');
        }

        return $this->render('reservation/edit.html.twig', [
            'reservation' => $reservation,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{id}", name="reservation_delete", methods={"DELETE"},requirements={"id"="\d+"})
     */
    public function delete(Request $request, Reservation $reservation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($reservation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('reservation_index');
    }





}
