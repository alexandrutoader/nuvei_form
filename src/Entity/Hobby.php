<?php


namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\HobbyRepository;

/**
 * @ORM\Entity(repositoryClass=HobbyRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Hobby
{
    public const DEFAULT_PRIORITY = 0;
    public const MAX_PRIORITY = 9999;
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
     * @ORM\Column(type="integer")
     */
    private int $priority = self::DEFAULT_PRIORITY;

    /**
     * @var DateTime $created
     * @ORM\Column(type="datetime")
     */
    private DateTime $created;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Hobby
     */
    public function setId($id): Hobby
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
     * @return Hobby
     */
    public function setName($name): Hobby
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
     * @return Hobby
     */
    public function setStatus($status): Hobby
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * @param int $priority
     * @return Hobby
     */
    public function setPriority(int $priority): Hobby
    {
        $this->priority = $priority;
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
     * @return Hobby
     */
    public function setCreated(DateTime $created): Hobby
    {
        $this->created = $created;
        return $this;
    }
}