<?php
namespace AppBundle\Handler;


use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

class LoginSuccessHandler implements AuthenticationSuccessHandlerInterface
{

    /** @var RouterInterface  */
    private $router;

    /** @var AuthorizationChecker  */
    private $authorizationChecker;

    public function __construct(RouterInterface $router, AuthorizationChecker $authorizationChecker)
    {
        $this->router = $router;
        $this->authorizationChecker = $authorizationChecker;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        if($this->authorizationChecker->isGranted("ROLE_INSTRUCTOR")){
            return new RedirectResponse($this->router->generate("adminHome"));
        }

       if($this->authorizationChecker->isGranted("ROLE_MEMBER")){
           return new RedirectResponse($this->router->generate("memberHomepage"));
       }
        return new RedirectResponse($this->router->generate("homepage"));

    }
}