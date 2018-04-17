<?php

namespace App\Controller;

use App\Entity\Books;
use App\Repository\BooksRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BiblController extends Controller
{
    /**
     * @Route("/", name="bibl")
     */
    public function index()
    {
        if (!empty($_REQUEST['name'])) {
            $entityManager = $this->getDoctrine()->getManager();
            $books = new Books();
            $books->setName($_REQUEST['name']);
            $books->setAuthor($_REQUEST['author'] ?? null);
            $books->setDiscription($_REQUEST['discription'] ?? null);
            $books->setIsbn($_REQUEST['isbn'] ?? null);
            $books->setYear($_REQUEST['year'] ?? null);
            $books->setAnnotation($_REQUEST['annotation'] ?? null);
            $entityManager->persist($books);
            $entityManager->flush();
        }
        return $this->render('bibl/index.html.twig', [
            'books' =>  $this->getDoctrine()
                ->getRepository(Books::class)->findAll()
        ]);
    }

    /**
     * @Route("/delete", name="delete")
     */
    public function delete()
    {
        if (!empty($_REQUEST['delete'])) {
            if (!is_array($_REQUEST['delete'])) {
                $_REQUEST['delete'] = [$_REQUEST['delete']];
            }
            foreach ($_REQUEST['delete'] as $id) {
                $entityManager = $this->getDoctrine()->getManager();
                $repository = $this->getDoctrine()->getRepository(Books::class);
                $entityManager->remove($repository->find((int)$id));
                $entityManager->flush();
            }
        }
        return $this->redirect('/',308);
    }
}
