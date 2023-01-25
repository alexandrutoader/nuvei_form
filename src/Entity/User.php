<?php


namespace App\Entity;


use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Repository\UserRepository;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class User implements \Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface
{
    public const STATUS_ACTIVE = 1;
    public const STATUS_INACTIVE = 0;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", unique=true)
     * @Assert\NotBlank()
     */
    private $userName;

    /**
     * @var string
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    private string $password;

    /**
     * @ORM\Column(type="string", unique=true)
     * @Assert\NotBlank()
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity=Department::class, inversedBy="users")
     * @Assert\NotBlank()
     */
    private $department;

    /**
     * @ORM\Column(type="json")
     * @Assert\NotBlank()
     */
    private $categories;

    /**
     * @ORM\Column(type="json")
     * @Assert\NotBlank()
     */
    private $hobbies;

    /**
     * @var DateTime $created
     * @ORM\Column(type="datetime")
     */
    private DateTime $created;

    /**
     * @var DateTime $modified
     * @ORM\Column(type="datetime")
     */
    private DateTime $modified;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return User
     */
    public function setId($id): User
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param mixed $userName
     * @return User
     */
    public function setUserName($userName): User
    {
        $this->userName = $userName;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return User
     */
    public function setPassword(string $password): User
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return User
     */
    public function setEmail($email): User
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * @param mixed $department
     * @return User
     */
    public function setDepartment($department): User
    {
        $this->department = $department;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param mixed $categories
     * @return User
     */
    public function setCategories($categories): User
    {
        $this->categories = $categories;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHobbies()
    {
        return $this->hobbies;
    }

    /**
     * @param mixed $hobbies
     * @return User
     */
    public function setHobbies($hobbies): User
    {
        $this->hobbies = $hobbies;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreated(): DateTime
    {
        return $this->created;
    }

    /**
     * @param DateTime $created
     * @return User
     */
    public function setCreated(DateTime $created): User
    {
        $this->created = $created;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getModified(): DateTime
    {
        return $this->modified;
    }

    /**
     * @param DateTime $modified
     * @return User
     */
    public function setModified(DateTime $modified): User
    {
        $this->modified = $modified;
        return $this;
    }
}