<?php


namespace App\Services;


use App\Entity\User;
use App\Exceptions\EntityNotFoundException;
use App\Exceptions\ValidationException;
use App\Repository\UserRepository;
use App\RequestConstraints\UserRestConstraint;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserService
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var UserRepository
     */
    private $repository;
    /**
     * @var SerializerInterface
     */
    private $serializer;
    /**
     * @var ValidatorInterface
     */
    private $validator;

    public function __construct(
        EntityManagerInterface $entityManager,
        SerializerInterface $serializer,
        ValidatorInterface $validator
    )
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(User::class);
        $this->serializer = $serializer;
        $this->validator = $validator;
    }

    /**
     * Method for fetching user via doctrine
     *
     * @param string $id ID of user entity
     *
     * @return User
     * @throws EntityNotFoundException
     */
    public function fetchUser(string $id): ?User
    {
        $user = $this->repository->find($id);

        if ( $user === null ) {
            throw new EntityNotFoundException();
        }

        return $user;
    }

    /**
     * Method for creating user with validation and deserializer
     *
     * @param string $data JSON request data
     *
     * @return User
     * @throws ValidationException
     */
    public function createUser(string $data): User
    {
        $data = json_decode($data, true);

        $violations = $this->validator->validate(
            $data,
            UserRestConstraint::getPostMethodConstraint()
        );

        if ($violations->count() !== 0) {
            throw new ValidationException($violations);
        }

        /** @var User $user */
        $user = $this->serializer->denormalize(
            $data,
            User::class,
            'json'
        );

        $this->entityManager->persist($user);
        $this->entityManager->flush($user);

        return $user;
    }

    /**
     * Method for partial update of entity
     *
     * @param string $id ID of user entity
     * @param string $data JSON request data
     *
     * @return User
     * @throws EntityNotFoundException
     * @throws ValidationException
     */
    public function updateUser(string $id, string $data)
    {
        $data = json_decode($data, true);

        $violations = $this->validator->validate(
            $data,
            UserRestConstraint::getPutMethodConstraint()
        );

        if ($violations->count() !== 0) {
            throw new ValidationException($violations);
        }

        /** @var User|null $user */
        $user = $this->repository->find($id);

        if ( $user === null ) {
            throw new EntityNotFoundException();
        }

        $this->serializer->denormalize(
            $data,
            User::class,
            'json',
            ['object_to_populate' => $user]
        );

        $this->entityManager->flush($user);

        return $user;
    }

    /**
     * Method for removal of entity
     *
     * @param string $id ID of user entity
     *
     * @return string ID of user entity
     * @throws EntityNotFoundException
     */
    public function deleteUser(string $id)
    {
        /** @var User|null $user */
        $user = $this->repository->find($id);

        if ( $user === null ) {
            throw new EntityNotFoundException();
        }

        $this->entityManager->remove($user);
        $this->entityManager->flush($user);

        return $id;
    }
}