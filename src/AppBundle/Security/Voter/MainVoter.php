<?php

namespace AppBundle\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class MainVoter extends Voter
{

    public function __construct()
    {

    }

    /**
     * @inheritDoc
     */
    protected function supports($attribute, $subject)
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        return true;
    }
}
