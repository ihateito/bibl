<?php

namespace App\Controller;

use App\Entity\Books;
use App\Repository\BooksRepository;
use Symfony\Component\Debug\Debug;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class BiblController extends Controller
{
    /**
     * @Route("/", name="bibl")
     */
    public function indexAction()
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
        return $this->render('bibl/index.html.twig');
    }

    /**
     * @Route("/load", name="load")
     */
    public function loadAction() {

        return $this->json($this->getDoctrine()
            ->getRepository(Books::class)->findAll(),200);
    }

    /**
     * @Route("/insert", name="insert")
     * @param Request $request
     * @param ValidatorInterface $validator
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function insertAction(Request $request, ValidatorInterface $validator) {
        $entityManager = $this->getDoctrine()->getManager();
        $rawData = $request->request->all();
        $book = new Books();
        $book->setName($rawData['name']);
        $book->setAuthor($rawData['author']);
        $book->setDiscription($rawData['discription']);
        $book->setIsbn($rawData['isbn']);
        $book->setYear($rawData['year']);
        $book->setAnnotation($rawData['annotation']);
        if (empty($validator->validate($book))) {
            $entityManager->persist($book);
            $entityManager->flush();
            return $this->json($book, 200);
        } else {
            return $this->json([], 400);
        }
    }

    /**
     * @Route("/delete", name="delete")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function delete(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository(Books::class);
        $entityManager->remove($repository->find($request->get('id')));
        $entityManager->flush();
        return $this->json([], 200);
    }
}
