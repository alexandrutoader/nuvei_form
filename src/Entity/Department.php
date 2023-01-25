<?php


namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\DepartmentRepository;

/**
 * @ORM\Entity(repositoryClass=DepartmentRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Department
{
    public const STATUS_ACTIVE = 1;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $status;

    /**
     * @var DateTime $created
     * @ORM\Column(type="datetime")
     */
    private DateTime $created;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="department")
     */
    private $users;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Department
     */
    public function setId($id): Department
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Department
     */
    public function setName($name): Department
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     * @return Department
     */
    public function setStatus($status): Department
    {
        $this->status = $status;
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
     * @return Department
     */
    public function setCreated(DateTime $created): Department
    {
        $this->created = $created;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param mixed $users
     * @return Department
     */
    public function setUsers($users): Department
    {
        $this->users = $users;
        return $this;
    }
}