<?php

namespace App\Controller;

use App\Entity\Book;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BookRepository;
use Doctrine\Persistence\ManagerRegistry;

class BookController extends AbstractController
{
    #[Route('/books', name: 'book_list', methods: ['GET'])]
    public function index(BookRepository $bookRepository): JsonResponse
    {
        // Verify if the books exists

        if (!$bookRepository->findAll()) {
            // if not found
            return $this->json([
                'message' => 'Books not found'
            ], 404);
        } else {
            //if find
            return $this->json([
                'data' => $bookRepository->findAll()
            ], 200);
        }
    }

    #[Route('/book/{book}', name: 'book_sigle', methods: ['GET'])]
    public function sigle(int $book,BookRepository $bookRepository): JsonResponse
    {
        // Verify if the book exists

        if (!$bookRepository->find($book)) {
            // if not found
            return $this->json([
                'message' => 'Book not found'
            ], 404);
        } else {
            //if find
            return $this->json([
                'data' => $bookRepository->find($book)
            ], 200);
        }
    }

    #[Route('/book', name: 'book_create', methods: ['POST'])]
    public function create(Request $request, BookRepository $bookRepository): JsonResponse
    {
        // Convert the request to json and get the content
        $data = json_decode($request->getContent(), true);

        // Add new book to database
        $book = new Book();
        $book->setTitle($data['title']);
        $book->setIsbn($data['isbn']);
        $book->setCreatedAt(new \DateTimeImmutable('now', new \DateTimeZone('America/Sao_Paulo')));
        $book->setUpdatedAt(new \DateTimeImmutable('now', new \DateTimeZone('America/Sao_Paulo')));

        // finish the controller
        $bookRepository->add($book, true);

        return $this->json([
            'message' => 'Book created successfully!',
            'book' => $book
        ], 201);
    }

    #[Route('/book/{book}/update', name: 'book_update', methods: ['PUT', 'PATCH'])]
    public function update(int $book, Request $request, ManagerRegistry $doctrine, BookRepository $bookRepository): JsonResponse
    {
        // Find if the book exist
        if (!$bookRepository->find($book)) {
            // if not found
            return $this->json([
                'message' => 'Book not found'
            ], 404);
        } else {
            //if find
            $book = $bookRepository->find($book);
        }

        // Convert the request to json and get the content
        $data = json_decode($request->getContent(), true);

        // Update book to database
        $book->setTitle($data['title']);
        $book->setIsbn($data['isbn']);
        $book->setUpdatedAt(new \DateTimeImmutable('now', new \DateTimeZone('America/Sao_Paulo')));

        // Update the book
        $doctrine->getManager()->flush();

        // Return the response
        return $this->json([
            'message' => 'Book update successfully!',
            'book' => $book
        ], 200);
    }

    #[Route('/book/{book}/delete', name: 'book_delete', methods: ['DELETE'])]
    public function delete(int $book, BookRepository $bookRepository): JsonResponse
    {
        // Verify if the book exists
        $book = $bookRepository->find($book);
        if (!$book) {
            // if not found
            return $this->json([
                'message' => 'Book not found'
            ], 404);
        } else {
            //if find
            $bookRepository->remove($book, true);
            return $this->json([
                'message' => 'Book removed'
            ], 200);
        }
    }
}
