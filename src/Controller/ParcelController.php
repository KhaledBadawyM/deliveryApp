<?php

namespace App\Controller;

use App\Entity\Parcel;
use App\Form\ParcelType;
use App\Repository\ParcelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/parcel")
 */
class ParcelController extends AbstractController
{
    const PICKED = 'picked';
    const DELIVERED = 'delivered';
    const PENDING = 'pending';

    /**
     * @Route("/", name="app_parcel_index", methods={"GET"})
     */
    public function index(ParcelRepository $parcelRepository): Response
    {
        if ($this->isGranted('ROLE_BICKER')) {
            $pendingParcel = $parcelRepository->findBy(['status' => $this::PENDING]);
            $userParcel = $this->getUser()->getParcels()->getValues();;
            $parcels = array_merge($pendingParcel, $userParcel);
            return $this->render('parcel/index.html.twig', [
                'parcels' => $parcels
            ]);
        }

        return $this->render('parcel/index.html.twig', [
            'parcels' => $this->getUser()->getParcels(),
        ]);
    }

    /**
     * @Route("/new", name="app_parcel_new", methods={"GET", "POST"})
     * @IsGranted("ROLE_SENDER")
     */
    public function new(Request $request, ParcelRepository $parcelRepository): Response
    {
        $parcel = new Parcel();
        $form = $this->createForm(ParcelType::class, $parcel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $parcel->addUser($this->getUser());
            $parcelRepository->add($parcel, true);

            return $this->redirectToRoute('app_parcel_index', [], Response::HTTP_SEE_OTHER);
        }
        dump($form);
        return $this->renderForm('parcel/new.html.twig', [
            'parcel' => $parcel,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_parcel_show", methods={"GET"})
     * @IsGranted("ROLE_SENDER")
     */
    public function show(Parcel $parcel): Response
    {
        return $this->render('parcel/show.html.twig', [
            'parcel' => $parcel,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_parcel_edit", methods={"GET", "POST"})
     * @IsGranted("ROLE_SENDER")
     */
    public function edit(Request $request, Parcel $parcel, ParcelRepository $parcelRepository): Response
    {
        $form = $this->createForm(ParcelType::class, $parcel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $parcelRepository->add($parcel, true);

            return $this->redirectToRoute('app_parcel_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('parcel/edit.html.twig', [
            'parcel' => $parcel,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_parcel_delete", methods={"POST"})
     * @IsGranted("ROLE_SENDER")
     */
    public function delete(Request $request, Parcel $parcel, ParcelRepository $parcelRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$parcel->getId(), $request->request->get('_token'))) {
            $parcelRepository->remove($parcel, true);
        }

        return $this->redirectToRoute('app_parcel_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/{id}/pick", name="app_parcel_pick", methods={"GET"})
     * @IsGranted("ROLE_BICKER")
     */
    public function pick(Request $request, Parcel $parcel, ParcelRepository $parcelRepository): Response
    {
        $parcel->setPickedAt(new \DateTime());
        $parcel->setStatus($this::PICKED);
        $parcel->addUser($this->getUser());
        $parcelRepository->add($parcel, true);
        return $this->redirectToRoute('app_parcel_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/{id}/deliver", name="app_parcel_deliver", methods={"GET"})
     * @IsGranted("ROLE_BICKER")
     */
    public function deliver(Request $request, Parcel $parcel, ParcelRepository $parcelRepository): Response
    {
        $parcel->setDeliveredAt(new \DateTime());
        $parcel->setStatus($this::DELIVERED);
        $parcelRepository->add($parcel, true);
        return $this->redirectToRoute('app_parcel_index', [], Response::HTTP_SEE_OTHER);
    }
}
