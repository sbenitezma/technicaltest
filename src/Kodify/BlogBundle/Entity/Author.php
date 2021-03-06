<?php

namespace Kodify\BlogBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Author
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Kodify\BlogBundle\Repository\AuthorRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Author extends AbstractBaseEntity
{
    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Post", mappedBy="author", cascade={"persist"})
     */
    protected $posts;
    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="author", cascade={"persist"})
     */
    protected $comments;
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=150)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * Constructor
     */
    public function __construct($name)
    {
        $this->posts = new ArrayCollection();
        $this->comments = new ArrayCollection();

        $this->setName($name);
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Author
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Add a post if it's not already associated with this author
     *
     * @param Post $post
     * @return Author
     */
    public function addPost(Post $post)
    {
        if (!$this->posts->contains($post)) {
            $this->posts->add($post);
        }

        return $this;
    }

    /**
     * Remove a post if it's associated with this author
     *
     * @param Post $post
     * @return Author
     */
    public function removePost(Post $post)
    {
        if ($this->posts->contains($post)) {
            $this->posts->removeElement($post);
        }

        return $this;
    }

    /**
     * Get all post associated with this author
     *
     * @return ArrayCollection
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * Add a comment if it's not already associated with the author
     *
     * @param Comment $comment
     * @return Author
     */
    public function addComment(Comment $comment)
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
        }

        return $this;
    }

    /**
     * Remove a comment if it's associated with this author,
     *
     * @param Comment $comment
     * @return Author
     */
    public function removeComment(Comment $comment)
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
        }

        return $this;
    }

    /**
     * Get all comments associated with this author
     *
     * @return ArrayCollection
     */
    public function getComments()
    {
        return $this->comments;
    }
}
