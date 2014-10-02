<?php

namespace Shop\BackOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="Product")
 * @ORM\HasLifecycleCallbacks
 */
class Product {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    protected $ref;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $path;

    /**
     * @Assert\File(maxSize="6000000")
     */
    protected $file;

    /**
     * @ORM\Column(type="decimal", scale=2)
     * @Assert\Regex(
     *     pattern="/^\d+(.\d{1,2})?$/",
     *     match=true,
     *     message="La valeur {{ value }} n'est pas un prix."
     * )
     */
    protected $price;

    /**
     * @ORM\Column(type="text")
     */
    protected $description;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $dateCreate;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $dateUpdate;
    
    /**
     * @ORM\Column(name="active", type="boolean", nullable=false)
     */
    private $active;
    
    protected $caddies;

    function getId() {
        return $this->id;
    }
    
    function setRef($ref) {
        $this->ref = $ref;
    }

    function getRef() {
        return $this->ref;
    }

    function setName($name) {
        $this->name = $name;
    }

    function getName() {
        return $this->name;
    }

    public function getAbsolutePath() {
        return null === $this->path ? null : $this->getUploadRootDir() . '/' . $this->path;
    }

    public function getWebPath() {
        return null === $this->path ? null : $this->getUploadDir() . '/' . $this->path;
    }

    protected function getUploadRootDir() {
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }

    protected function getUploadDir() {
        return 'uploads/product';
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload() {
        if (null !== $this->file) {
            $this->path = sha1(uniqid(mt_rand(), true)) . '.' . $this->file->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload() {
        if (null === $this->file) {
            return;
        }

        $this->file->move($this->getUploadRootDir(), $this->path);

        unset($this->file);
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload() {
        if ($file = $this->getAbsolutePath()) {
            unlink($file);
        }
    }

    function getFile() {
        return $this->file;
    }

    function setFile($file) {
        $this->file = $file;
    }

    function setPrice($price) {
        $this->price = $price;
    }

    function getPrice() {
        return $this->price;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function getDescription() {
        return $this->description;
    }

    function setDateCreate($dateCreate) {
        $this->dateCreate = $dateCreate;
    }

    function getDateCreate() {
        return $this->dateCreate;
    }

    function setDateUpdate($dateUpdate) {
        $this->dateUpdate = $dateUpdate;
    }

    function getDateUpdate() {
        return $this->dateUpdate;
    }

    function getActive() {
        return $this->active;
    }

    function setActive($active) {
        $this->active = $active;
    }

    public function addCaddy(Caddy $caddies) {
        $this->caddies[] = $caddies;
        return $this;
    }

    public function removeCaddy(Caddy $caddies) {
        $this->caddies->removeElement($caddies);
    }

    function getCaddies() {
        return $this->caddies;
    }
}
