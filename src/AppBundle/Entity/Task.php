<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 13/03/2017
 * Time: 14:24
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Task.
 *
 * @ORM\Table(name="task")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TaskRepository")
 */
class Task
{
    const STATUS_OPEN = 'open';
    const STATUS_CLOSED = 'closed';

    /**
     * Task constructor.
     */
    public function __construct()
    {
        $this->status = self::STATUS_OPEN;
    }
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(max=100, maxMessage = "Your task name cannot be longer than {{ limit }} characters")
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;
    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="description", type="string", length=160)
     */
    private $description;
    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(max=50)
     * @ORM\Column(name="status", type="string", length=50)
     */
    private $status;

    /**
     * @var Category
     *
     * @ORM\ManyToOne(
     *     targetEntity="AppBundle\Entity\Category",
     *     inversedBy="tasks"
     * )
     */
    private $category;
    /**
     * @param $id
     */
    public function setId($id){
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param $status
     */
    public function setStatus($status)
    {
        if(($status == Task::STATUS_OPEN) || ($status == Task::STATUS_CLOSED))
        {
            $this->status = $status;
        }
    }
    public function getStatus()
    {
        return $this->status;
    }
    /**
     * Set category
     *
     * @param \AppBundle\Entity\Category $category
     *
     * @return Task
     */
    public function setCategory(\AppBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }
    public function __toString()
    {
        return $this->getName();
    }
}
