<?php
/**
 * @author Jonathan Greco <jonathan@superextralab.com>
 * date 30/01/2019
 */
declare(strict_types=1);

namespace App\Repository\Doctrine;

use App\Domain\User\Query\UserViewInterface;
use App\Domain\User\Repository\UserReadModelRepositoryInterface;
use App\Domain\User\User;
use App\Domain\User\ValueObject\Email;
use App\Repository\DoctrineRepository;
use Doctrine\ORM\EntityManagerInterface;

final class UserReadRepository extends DoctrineRepository implements UserReadModelRepositoryInterface
{
    /**
     * @var string
     */
    protected $class;

    /**
     * @param int $id
     * @return \App\Domain\User\Query\UserViewInterface
     * @throws \App\Domain\Share\Query\Exception\NotFoundException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function oneById(int $id): UserViewInterface
    {
        $qb = $this->repository
            ->createQueryBuilder('user')
            ->where('user.id = :id')
            ->setParameter('id', $id)
        ;

        return $this->oneOrException($qb);
    }

    /**
     * Check if a user exist by its email, deleted should be null (its a user method)
     * @param \App\Domain\User\ValueObject\Email $email
     * @return \App\Domain\User\Query\UserViewInterface
     * @throws \App\Domain\Share\Query\Exception\NotFoundException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function oneByEmail(Email $email): UserViewInterface
    {
        $queryBuilder = $this->repository->createQueryBuilder("user");
        $qb = $queryBuilder
            ->where('user.email = :email')
            ->andWhere($queryBuilder->expr()->isNull('user.deleted'))
            ->setParameter('email', $email->toString())
        ;

        return $this->oneOrException($qb);
    }

    /**
     * Check if a user exist by its email, deleted should be null (its a user method)
     * @param \App\Domain\User\ValueObject\Email $email
     * @return int|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function existsEmail(Email $email): ?int
    {
        $queryBuilder = $this->repository->createQueryBuilder("user");
        $userId = $queryBuilder
            ->select('user.id')
            ->where('user.email = :email')
            ->andWhere($queryBuilder->expr()->isNull('user.deleted'))
            ->setParameter('email', (string) $email)
            ->getQuery()
            ->getOneOrNullResult()
        ;

        return $userId['id'] ?? null;
    }

    /**
     * @param \App\Domain\User\Query\UserViewInterface $userRead
     */
    public function add(UserViewInterface $userRead): void
    {
        $this->register($userRead);
        $this->apply();
    }

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->class = User::class;
        parent::__construct($entityManager);
    }
}
