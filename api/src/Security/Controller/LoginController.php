<?php
/**
 * @author Jonathan Greco <jonathan@superextralab.com>
 * date 31/01/2019
 */
namespace App\Security\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController
{

    /**
     * @var FlashBagInterface
     */
    private FlashBagInterface $notifier;

    public function __construct(FlashBagInterface $notifier)
    {
        $this->notifier = $notifier;
    }
    
    /**
     * @Route("/api/login", name="login", methods={"GET", "POST"})
     * @param AuthenticationUtils $authUtils
     * @return Response
     */
    public function login(AuthenticationUtils $authUtils): Response
    {
        $exception = $authUtils->getLastAuthenticationError();

        if ($exception) {
            $this->notifier->add('danger', $exception->getMessage());
        }

        return new JsonResponse(["success" => !$exception, "message" => $exception ? $exception->getMessage(): null]);
    }
}
