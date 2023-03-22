<?php

namespace App\Controller;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GuestController extends AbstractController
{
    #[Route("/", name: "menu")]
    public function menu(ManagerRegistry $doctrine): Response
    {
        $category = $doctrine->getRepository(Category::class)->findAll();
        return $this->render("menu.html.twig", [
            "category" => $category
        ]);
    }

    #[Route("/contact", name: "contact")] public function showContact()
    {
        return $this->render("contact.html.twig");
    }

    #[Route("/pizzas/{id}", name: "pizzas")] public function showPizzas(EntityManagerInterface $entityManager, int $id)
    {
        $category = $entityManager->getRepository(Category::class)->find($id);
        return $this->render("pizzas.html.twig", ['category' => $category]);
    }

}