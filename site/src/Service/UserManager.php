<?php
// src/Service/UserManager.php
namespace App\Service;

use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class UserManager
 * @package App\Service
 */
class UserManager
{

    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * @var \App\Repository\UserRepository
     */
    private $userRepository;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * UserManager constructor.
     * @param ObjectManager $objectManager
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(ObjectManager $objectManager, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->objectManager = $objectManager;
        $this->userRepository = $this->objectManager->getRepository(User::class);
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * Create User
     *
     * @param String $username
     * @param String $password
     * @param String|null $email
     * @return bool
     */
    public function create(String $username, String $password, String $email = null) : bool
    {
//         check if user exists
        if (count($this->userRepository->findByUsername($username))) {
            return false;
        }

        $user = new User();
        $user->setUsername($username);
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            $password
        ));
        $user->setEmail($email);

        $this->objectManager->persist($user);
        $this->objectManager->flush();

        return true;
    }
}