<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientType;
use App\Form\ClientSearchType;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClientController extends AbstractController
{
    #[Route('/clients', name: 'client.index', methods: ['GET', 'POST'])]
    public function index(ClientRepository $clientRepository, Request $request): Response
    {
        $formSearch = $this->createForm(ClientSearchType::class);

        $formSearch->handleRequest($request);

        $page = $request->get('page', 1);
        $limit = 3;
        $maxPage = 0;


        if ($formSearch->isSubmitted() && $formSearch->isValid()) {
            $clients = $clientRepository->findBy(['telephone' => $formSearch->getData()['telephone']]);
        } else {
            $clients = $clientRepository->paginateClients($limit, $page);
            $maxPage = ceil($clients->count() / $limit);
        }

        return $this->render('client/index.html.twig', [
            'clients' => $clients,
            'formSearch' => $formSearch->createView(),
            "maxPage" => $maxPage,
        ]);
    }

    #[Route('/clients/store', name: 'client.store', methods: ['POST', 'GET'])]
    public function store(Request $request, EntityManagerInterface $entityManager): Response
    {
        $client = new Client();

        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // Si le Client a compte
           if ($client->getCompte()){
            // Set the client to the compte
            $compte = $client->getCompte();
            $compte->setClient($client);
            
            // Save Compte
            $entityManager->persist($compte);
           }

            // S'il n'a pas de compte
            $entityManager->persist($client);

            $entityManager->flush(); // Commit

            return $this->redirectToRoute('client.index'); // Redirection vers la liste des clients
        }
        return $this->render('client/store.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/clients/show/{id}', name: 'client.show', methods: ['POST', 'GET'])]
    public function show(int $id, ClientRepository $clientRepository): Response
    {
        $client = $clientRepository->find($id);

        return $this->render('client/detail.html.twig', [

            'client' => $client,
        ]);
    }
}
