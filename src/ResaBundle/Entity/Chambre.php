<?php

namespace ResaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Chambre
 *
 * @ORM\Table(name="Chambre", indexes={@ORM\Index(name="FK_Chambre_Id_Hotel", columns={"Id_Hotel"})})
 * @ORM\Entity
 */
class Chambre
{
    /**
     * @var integer
     *
     * @ORM\Column(name="numChambre", type="integer", nullable=false)
     */
    private $numchambre;

    /**
     * @var integer
     *
     * @ORM\Column(name="Places", type="integer", nullable=false)
     */
    private $places;

    /**
     * @var boolean
     *
     * @ORM\Column(name="Reservee", type="boolean", nullable=true)
     */
    private $reservee;

    /**
     * @var boolean
     *
     * @ORM\Column(name="Clim", type="boolean", nullable=false)
     */
    private $clim;

    /**
     * @var boolean
     *
     * @ORM\Column(name="TV", type="boolean", nullable=false)
     */
    private $tv;

    /**
     * @var boolean
     *
     * @ORM\Column(name="Internet", type="boolean", nullable=false)
     */
    private $internet;

    /**
     * @var boolean
     *
     * @ORM\Column(name="Animaux", type="boolean", nullable=false)
     */
    private $animaux;

    /**
     * @var integer
     *
     * @ORM\Column(name="Id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \ResaBundle\Entity\Hotel
     *
     * @ORM\ManyToOne(targetEntity="ResaBundle\Entity\Hotel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Id_Hotel", referencedColumnName="Id")
     * })
     */
    private $idHotel;



    /**
     * Set numchambre
     *
     * @param integer $numchambre
     *
     * @return Chambre
     */
    public function setNumchambre($numchambre)
    {
        $this->numchambre = $numchambre;

        return $this;
    }

    /**
     * Get numchambre
     *
     * @return integer
     */
    public function getNumchambre()
    {
        return $this->numchambre;
    }

    /**
     * Set places
     *
     * @param integer $places
     *
     * @return Chambre
     */
    public function setPlaces($places)
    {
        $this->places = $places;

        return $this;
    }

    /**
     * Get places
     *
     * @return integer
     */
    public function getPlaces()
    {
        return $this->places;
    }

    /**
     * Set reservee
     *
     * @param boolean $reservee
     *
     * @return Chambre
     */
    public function setReservee($reservee)
    {
        $this->reservee = $reservee;

        return $this;
    }

    /**
     * Get reservee
     *
     * @return boolean
     */
    public function getReservee()
    {
        return $this->reservee;
    }

    /**
     * Set clim
     *
     * @param boolean $clim
     *
     * @return Chambre
     */
    public function setClim($clim)
    {
        $this->clim = $clim;

        return $this;
    }

    /**
     * Get clim
     *
     * @return boolean
     */
    public function getClim()
    {
        return $this->clim;
    }

    /**
     * Set tv
     *
     * @param boolean $tv
     *
     * @return Chambre
     */
    public function setTv($tv)
    {
        $this->tv = $tv;

        return $this;
    }

    /**
     * Get tv
     *
     * @return boolean
     */
    public function getTv()
    {
        return $this->tv;
    }

    /**
     * Set internet
     *
     * @param boolean $internet
     *
     * @return Chambre
     */
    public function setInternet($internet)
    {
        $this->internet = $internet;

        return $this;
    }

    /**
     * Get internet
     *
     * @return boolean
     */
    public function getInternet()
    {
        return $this->internet;
    }

    /**
     * Set animaux
     *
     * @param boolean $animaux
     *
     * @return Chambre
     */
    public function setAnimaux($animaux)
    {
        $this->animaux = $animaux;

        return $this;
    }

    /**
     * Get animaux
     *
     * @return boolean
     */
    public function getAnimaux()
    {
        return $this->animaux;
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
     * Set idHotel
     *
     * @param \ResaBundle\Entity\Hotel $idHotel
     *
     * @return Chambre
     */
    public function setIdHotel(\ResaBundle\Entity\Hotel $idHotel = null)
    {
        $this->idHotel = $idHotel;

        return $this;
    }

    /**
     * Get idHotel
     *
     * @return \ResaBundle\Entity\Hotel
     */
    public function getIdHotel()
    {
        return $this->idHotel;
    }
}
