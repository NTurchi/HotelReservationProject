<?php

namespace ResaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Hotel
 *
 * @ORM\Table(name="Hotel")
 * @ORM\Entity(repositoryClass="ResaBundle\Repository\HotelRepository")
 */
class Hotel
{
    /**
     * @var string
     *
     * @ORM\Column(name="Ville", type="string", length=25, nullable=false)
     */
    private $ville;

    /**
     * @var integer
     *
     * @ORM\Column(name="Id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Hotel
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
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
}
