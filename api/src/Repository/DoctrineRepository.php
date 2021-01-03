<?php
/**
 * @author Jonathan Greco <jonathan@superextralab.com>
 * date 30/01/2019
 */
declare(strict_types=1);

namespace App\Repository;

use App\Domain\Share\Query\Exception\NotFoundException;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

/**
 * Class DoctrineRepository that apply some doctrine fixtures to an entity.
 * @package App\Infrastructure\Share\Query\Repository
 */
abstract class DoctrineRepository
{
    /**
     * @param $model
     */
    public function register($model): void
    {
        $this->entityManager->persist($model);
    }

    /**
     * @return array
     */
    public function listAll(): array
    {
        return $this->repository->findAll();
    }

    /**
     *
     */
    public function apply(): void
    {
        $this->entityManager->flush();
    }

    /**
     * @param \Doctrine\ORM\QueryBuilder $queryBuilder
     * @return mixed
     * @throws \App\Domain\Share\Query\Exception\NotFoundException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    protected function oneOrException(QueryBuilder $queryBuilder)
    {
        $model = $queryBuilder
            ->getQuery()
            ->getOneOrNullResult()
        ;

        if (null === $model) {
            throw new NotFoundException();
        }

        return $model;
    }

    /**
     * @param string $model
     */
    private function setRepository(string $model): void
    {
        /** @var EntityRepository $objectRepository */
        $objectRepository = $this->entityManager->getRepository($model);
        $this->repository = $objectRepository;
    }

    /**
     * DoctrineRepository constructor.
     * @param \Doctrine\ORM\EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->setRepository($this->class);
    }

    /** @var string */
    protected $class;

    /** @var EntityRepository */
    protected $repository;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
}
