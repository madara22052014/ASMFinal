<?php
namespace App\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Http\Authorization\AccessDeniedHandlerInterface;

class AccessDeniedHandler implements AccessDeniedHandlerInterface
{
   public function __construct(RouterInterface $router, SessionInterface $session)
   {
      $this->router = $router;
      $this->session = $session;
   }

   public function handle(Request $request, AccessDeniedException $accessDeniedException)
   {
      $this->session->getFlashBag()->add('Error', 'Unauthorized');
      return new RedirectResponse($this->router->generate('app_login'));
   }
}
?>