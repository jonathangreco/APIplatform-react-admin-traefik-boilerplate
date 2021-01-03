<?php
/**
 * @author Jonathan Greco <jonathan@superextralab.com>
 * date 09/04/2019
 */
declare(strict_types=1);

namespace App\Repository\Doctrine;

use App\Domain\User\Query\RoleViewInterface;
use App\Domain\User\Repository\RoleRepositoryInterface;
use App\Domain\User\Role;
use App\Repository\DoctrineRepository;
use Doctrine\ORM\EntityManagerInterface;

final class RoleRepository extends DoctrineRepository implements RoleRepositoryInterface
{

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->class = Role::class;
        parent::__construct($entityManager);
    }

    /**
     * @param \App\Domain\User\ValueObject\Role $role
     * @return \App\Domain\User\Query\RoleViewInterface
     * @throws \App\Domain\Share\Query\Exception\NotFoundException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function oneByName(\App\Domain\User\ValueObject\Role $role): RoleViewInterface
    {
        $queryBuilder = $this->repository->createQueryBuilder("role");
        $qb = $queryBuilder
            ->where('role.name = :name')
            ->setParameter('name', $role->toString())
        ;

        return $this->oneOrException($qb);
    }
}
