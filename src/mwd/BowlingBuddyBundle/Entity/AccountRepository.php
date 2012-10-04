<?php

namespace mwd\BowlingBuddyBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

class AccountRepository extends EntityRepository implements UserProviderInterface {

    public function loadUserByUsername($username) {
        $q = $this
                ->createQueryBuilder('a')
                ->select('u, g')
                ->leftJoin('u.groups', 'g')
                ->where('a.username = :username OR a.email = :email')
                ->setParameter('username', $username)
                ->setParameter('email', $username)
                ->getQuery();

        try {
            $account = $q->getSingleResult();
        } catch (NoResultException $e) {
            throw new UsernameNotFoundException(
                    sprintf('Unable to find an account identified by "%s".', $username),
                    null, 0, $e);
        }

        return $account;
    }

    public function refreshUser(UserInterface $user) {
        $class = get_class($user);
        if (!$this->supportsClass($class)) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $class));
        }

        return $this->loadAccountByUsername($user->getUsername());
    }

    public function supportsClass($class) {
        return $this->getEntityName() === $class
                || is_subclass_of($class, $this->getEntityname());
    }

}

