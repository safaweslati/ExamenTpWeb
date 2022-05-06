<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Form\EtudiantType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EtudiantController extends AbstractController
{
    #[Route('/Etudiants', name: 'listes_etudiant')]
    public function listeEtudiant(ManagerRegistry $manager): Response{
        $etudiants = $manager->getRepository(Etudiant::class)->findAll();
        return $this->render("etudiant/index.html.twig", ['etudiants' => $etudiants]);
    }

    #[Route('/EditEtudiant/{id<\d+>?0}', name: 'add_etudiant')]
    public function index(Etudiant $etudiant = null, ManagerRegistry $doctrine, Request $request): Response
    {
        if (!$etudiant) {
            $new = true;
            $etudiant = new Etudiant();
        } else {
            $new = false;
        }
        $form = $this->createForm(EtudiantType::class, $etudiant);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $manager = $doctrine->getManager();
            $manager->persist($etudiant);
            $manager->flush();
            $this->addFlash('succes', "l'etudiant a été ajouté avec succés");
           // $etudiants = $manager->getRepository(Etudiant::class)->findAll();
            return $this->redirectToRoute("listes_etudiant");
        } else {
            return $this->render("etudiant/add-etudiant.html.twig", ['form' => $form->createView()]);
        }
    }

    #[Route('/delete/{id<\d+>}', name: 'delete')]
    public function deletePersonne(Etudiant $etudiant = null, ManagerRegistry $doctrine): Response
    {
        if ($etudiant) {
            $manager = $doctrine->getManager();
            $manager->remove($etudiant);
            $manager->flush();
            $this->addFlash('succes', "la personne a été supprimé avec succés");
        } else {
            $this->addFlash('error', "la personne n'existe pas");
        }
        return $this->redirectToRoute("listes_etudiant");
    }
}