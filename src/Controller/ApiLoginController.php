<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class ApiLoginController extends AbstractController
{
    #[Route('/login', name: 'api_login')]
    public function login(#[CurrentUser] ?User $user, JWTTokenManagerInterface $JWTTokenManager): JsonResponse
    {
        if (null === $user) {
            return $this->json([
                'message' => 'missing credentials',
            ], Response::HTTP_UNAUTHORIZED);
        }

        $token = $JWTTokenManager->create($user);

        return $this->json([
            'user' => $user->getUserIdentifier(),
            'token' => $token,
        ]);
    }

    #[Route('/register', name: 'register', methods: ['POST'])]
    public function register(Request $request, UserRepository $userRepository)
    {
        $data = json_decode($request->getContent(), true);

        $user = new User();
        $user->setName($data['name']);
        $user->setLastName($data['last_name']);
        $user->setEmail($data['email']);
        $user->setPassword(md5($data['password']));
        $user->setIsAutor($data['is_autor']);

        $userRepository->add($user, true);

        return $this->json([
            'message' => 'User created!'
        ], 201);
    }
}
