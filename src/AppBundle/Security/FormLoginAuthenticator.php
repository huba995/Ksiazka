<?php
/**
 * Created by PhpStorm.
 * User: hubert
 * Date: 13.06.17
 * Time: 23:19
 */

namespace AppBundle\Security;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;

class FormLoginAuthenticator extends AbstractFormLoginAuthenticator
{

    private $container;
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
    public function getCredentials(Request $request)
    {
        // TODO: Implement getCredentials() method.
    }
    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        // TODO: Implement getUser() method.
    }
    public function checkCredentials($credentials, UserInterface $user)
    {
        // TODO: Implement checkCredentials() method.
    }
    protected function getLoginUrl()
    {
        // TODO: Implement getLoginUrl() method.
    }
    protected function getDefaultSuccessRedirectUrl()
    {
        // TODO: Implement getDefaultSuccessRedirectUrl() method.
    }
}