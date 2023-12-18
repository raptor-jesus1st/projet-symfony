<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommanderController extends AbstractController
{
    #[Route('/commander', name: 'app_commander')]
    public function buyArticle($articleId): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $article = $entityManager->getRepository(Article::class)->find($articleId);

        if (!$article) {
            throw $this->createNotFoundException('Article not found');
        }

        $order = new Order();
        $order->setArticle($article);

        // Add logic for associating the order with the current user, setting quantity, etc.

        $entityManager->persist($order);
        $entityManager->flush();

        // Add logic for displaying a success message, redirecting to a confirmation page, etc.

        return $this->redirectToRoute('confirmation_page');
    }
}
