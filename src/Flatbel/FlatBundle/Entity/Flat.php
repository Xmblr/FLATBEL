<?php

namespace Flatbel\FlatBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use APY\DataGridBundle\Grid\Mapping as GRID;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * @ORM\Entity(repositoryClass="Flatbel\FlatBundle\Entity\Repository\FlatRepository")
 * @ORM\Table(name="Flat_new")
 * @ORM\HasLifecycleCallbacks()
 */
class Flat
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer", length=50, nullable=true)
     */
    protected $userid;

    /**
     * @ORM\Column(type="boolean", length=50, nullable=true)
     */
    protected $payornot;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $flattype;

    /**
     * @ORM\Column(type="integer", length=50)
     */
    protected $numberofbeds;

    /**
     * @ORM\Column(type="integer", length=50)
     */
    protected $rooms;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $street;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $streettype;

    /**
     * @ORM\Column(type="integer", length=50)
     */
    protected $home;

    /**
     * @ORM\Column(type="integer", length=50)
     */
    protected $priceday;

    /**
     * @ORM\Column(type="integer", length=50)
     */
    protected $pricehour;

    /**
     * @ORM\Column(type="integer", length=50)
     */
    protected $pricenight;


    /**
     * @ORM\Column(type="integer", length=50)
     */
    protected $floorhome;

    /**
     * @ORM\Column(type="integer", length=50)
     */
    protected $floor;

    /**
     * @ORM\Column(type="text", length=100)
     */
    protected $metro;

    /**
     * @ORM\Column(type="boolean", length=50)
     */
    protected $tv;

    /**
     * @ORM\Column(type="boolean", length=50)
     */
    protected $wifi;

    /**
     * @ORM\Column(type="boolean", length=50)
     */
    protected $parking;

    /**
     * @ORM\Column(type="boolean", length=50)
     */
    protected $microwave;

    /**
     * @ORM\Column(type="boolean", length=50)
     */
    protected $washer;

    /**
     * @ORM\Column(type="boolean", length=50)
     */
    protected $bath;

    /**
     * @ORM\Column(type="boolean", length=50)
     */
    protected $shower;

    /**
     * @ORM\Column(type="boolean", length=50)
     */
    protected $fridge;

    /**
     * @ORM\Column(type="boolean", length=50)
     */
    protected $dishes;

    /**
     * @ORM\Column(type="boolean", length=50)
     */
    protected $linens;

    /**
     * @ORM\Column(type="string", length=1000)
     * @Assert\Regex(
     *     pattern     = "/^(\+375|80)(29|25|44|33)(\d{3})(\d{2})(\d{2})$/",
     *     htmlPattern = "^(\+375|80)(29|25|44|33)(\d{3})(\d{2})(\d{2})$")
     */
    protected $telnumber;

    /**
     * @ORM\Column(type="boolean", length=50)
     */
    protected $viber;

    /**
     * @ORM\Column(type="boolean", length=50)
     */
    protected $whatsapp;

    /**
     * @return mixed
     */
    public function getViber()
    {
        return $this->viber;
    }

    /**
     * @param mixed $viber
     */
    public function setViber($viber)
    {
        $this->viber = $viber;
    }

    /**
     * @return mixed
     */
    public function getWhatsapp()
    {
        return $this->whatsapp;
    }

    /**
     * @param mixed $whatsapp
     */
    public function setWhatsapp($whatsapp)
    {
        $this->whatsapp = $whatsapp;
    }

    /**
     * @return mixed
     */
    public function getTelegram()
    {
        return $this->telegram;
    }

    /**
     * @param mixed $telegram
     */
    public function setTelegram($telegram)
    {
        $this->telegram = $telegram;
    }

    /**
     * @ORM\Column(type="boolean", length=50)
     */
    protected $telegram;

    /**
     * @ORM\Column(type="text", length=1000)
     *
     */
    protected $about;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $description;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Flatbel\FlatBundle\Entity\City")
     */
    protected $city;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"})
     *
     */
    protected $mainphoto;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"})
     */
//     * @ORM\Column(type="string", length=1000)
//     * @Assert\File(mimeTypes={ "image/jpeg" })

    protected $photo1;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"})
     */
//     * @ORM\Column(type="string", length=1000)
//     * @Assert\File(mimeTypes={ "image/jpeg" })

    protected $photo2;


    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"})
     */
//     * @ORM\Column(type="string", length=1000)
//     * @Assert\File(mimeTypes={ "image/jpeg" })

    protected $photo3;


    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"})
     */
//     * @ORM\Column(type="string", length=1000)
//     * @Assert\File(mimeTypes={ "image/jpeg" })

    protected $photo4;


    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"})
     */
//     * @ORM\Column(type="string", length=1000)
//     * @Assert\File(mimeTypes={ "image/jpeg" })

    protected $photo5;

    /**
     * @return mixed
     */
    public function getPhoto4()
    {
        return $this->photo4;
    }

    /**
     * @param mixed $photo4
     */
    public function setPhoto4($photo4)
    {
        $this->photo4 = $photo4;
    }

    /**
     * @return mixed
     */
    public function getPhoto5()
    {
        return $this->photo5;
    }

    /**
     * @param mixed $photo5
     */
    public function setPhoto5($photo5)
    {
        $this->photo5 = $photo5;
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
     * Set userid
     *
     * @param integer $userid
     *
     * @return Flat
     */
    public function setUserid($userid)
    {
        $this->userid = $userid;

        return $this;
    }

    /**
     * Get userid
     *
     * @return integer
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * Set payornot
     *
     * @param boolean $payornot
     *
     * @return Flat
     */
    public function setPayornot($payornot)
    {
        $this->payornot = $payornot;

        return $this;
    }

    /**
     * Get payornot
     *
     * @return boolean
     */
    public function getPayornot()
    {
        return $this->payornot;
    }

    /**
     * Set flattype
     *
     * @param string $flattype
     *
     * @return Flat
     */
    public function setFlattype($flattype)
    {
        $this->flattype = $flattype;

        return $this;
    }

    /**
     * Get flattype
     *
     * @return string
     */
    public function getFlattype()
    {
        return $this->flattype;
    }

    /**
     * Set numberofbeds
     *
     * @param integer $numberofbeds
     *
     * @return Flat
     */
    public function setNumberofbeds($numberofbeds)
    {
        $this->numberofbeds = $numberofbeds;

        return $this;
    }

    /**
     * Get numberofbeds
     *
     * @return integer
     */
    public function getNumberofbeds()
    {
        return $this->numberofbeds;
    }

    /**
     * Set rooms
     *
     * @param integer $rooms
     *
     * @return Flat
     */
    public function setRooms($rooms)
    {
        $this->rooms = $rooms;

        return $this;
    }

    /**
     * Get rooms
     *
     * @return integer
     */
    public function getRooms()
    {
        return $this->rooms;
    }

    /**
     * Set street
     *
     * @param string $street
     *
     * @return Flat
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set streettype
     *
     * @param string $streettype
     *
     * @return Flat
     */
    public function setStreettype($streettype)
    {
        $this->streettype = $streettype;

        return $this;
    }

    /**
     * Get streettype
     *
     * @return string
     */
    public function getStreettype()
    {
        return $this->streettype;
    }

    /**
     * Set home
     *
     * @param integer $home
     *
     * @return Flat
     */
    public function setHome($home)
    {
        $this->home = $home;

        return $this;
    }

    /**
     * Get home
     *
     * @return integer
     */
    public function getHome()
    {
        return $this->home;
    }

    /**
     * Set priceday
     *
     * @param integer $priceday
     *
     * @return Flat
     */
    public function setPriceday($priceday)
    {
        $this->priceday = $priceday;

        return $this;
    }

    /**
     * Get priceday
     *
     * @return integer
     */
    public function getPriceday()
    {
        return $this->priceday;
    }

    /**
     * Set pricehour
     *
     * @param integer $pricehour
     *
     * @return Flat
     */
    public function setPricehour($pricehour)
    {
        $this->pricehour = $pricehour;

        return $this;
    }

    /**
     * Get pricehour
     *
     * @return integer
     */
    public function getPricehour()
    {
        return $this->pricehour;
    }

    /**
     * Set pricenight
     *
     * @param integer $pricenight
     *
     * @return Flat
     */
    public function setPricenight($pricenight)
    {
        $this->pricenight = $pricenight;

        return $this;
    }

    /**
     * Get pricenight
     *
     * @return integer
     */
    public function getPricenight()
    {
        return $this->pricenight;
    }


    /**
     * Set floorhome
     *
     * @param integer $floorhome
     *
     * @return Flat
     */
    public function setFloorhome($floorhome)
    {
        $this->floorhome = $floorhome;

        return $this;
    }

    /**
     * Get floorhome
     *
     * @return integer
     */
    public function getFloorhome()
    {
        return $this->floorhome;
    }

    /**
     * Set floor
     *
     * @param integer $floor
     *
     * @return Flat
     */
    public function setFloor($floor)
    {
        $this->floor = $floor;

        return $this;
    }

    /**
     * Get floor
     *
     * @return integer
     */
    public function getFloor()
    {
        return $this->floor;
    }

    /**
     * Set metro
     *
     * @param string $metro
     *
     * @return Flat
     */
    public function setMetro($metro)
    {
        $this->metro = $metro;

        return $this;
    }

    /**
     * Get metro
     *
     * @return string
     */
    public function getMetro()
    {
        return $this->metro;
    }

    /**
     * Set tv
     *
     * @param boolean $tv
     *
     * @return Flat
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
     * Set wifi
     *
     * @param boolean $wifi
     *
     * @return Flat
     */
    public function setWifi($wifi)
    {
        $this->wifi = $wifi;

        return $this;
    }

    /**
     * Get wifi
     *
     * @return boolean
     */
    public function getWifi()
    {
        return $this->wifi;
    }

    /**
     * Set parking
     *
     * @param boolean $parking
     *
     * @return Flat
     */
    public function setParking($parking)
    {
        $this->parking = $parking;

        return $this;
    }

    /**
     * Get parking
     *
     * @return boolean
     */
    public function getParking()
    {
        return $this->parking;
    }

    /**
     * Set microwave
     *
     * @param boolean $microwave
     *
     * @return Flat
     */
    public function setMicrowave($microwave)
    {
        $this->microwave = $microwave;

        return $this;
    }

    /**
     * Get microwave
     *
     * @return boolean
     */
    public function getMicrowave()
    {
        return $this->microwave;
    }

    /**
     * Set washer
     *
     * @param boolean $washer
     *
     * @return Flat
     */
    public function setWasher($washer)
    {
        $this->washer = $washer;

        return $this;
    }

    /**
     * Get washer
     *
     * @return boolean
     */
    public function getWasher()
    {
        return $this->washer;
    }

    /**
     * Set bath
     *
     * @param boolean $bath
     *
     * @return Flat
     */
    public function setBath($bath)
    {
        $this->bath = $bath;

        return $this;
    }

    /**
     * Get bath
     *
     * @return boolean
     */
    public function getBath()
    {
        return $this->bath;
    }

    /**
     * Set shower
     *
     * @param boolean $shower
     *
     * @return Flat
     */
    public function setShower($shower)
    {
        $this->shower = $shower;

        return $this;
    }

    /**
     * Get shower
     *
     * @return boolean
     */
    public function getShower()
    {
        return $this->shower;
    }

    /**
     * Set fridge
     *
     * @param boolean $fridge
     *
     * @return Flat
     */
    public function setFridge($fridge)
    {
        $this->fridge = $fridge;

        return $this;
    }

    /**
     * Get fridge
     *
     * @return boolean
     */
    public function getFridge()
    {
        return $this->fridge;
    }

    /**
     * Set dishes
     *
     * @param boolean $dishes
     *
     * @return Flat
     */
    public function setDishes($dishes)
    {
        $this->dishes = $dishes;

        return $this;
    }

    /**
     * Get dishes
     *
     * @return boolean
     */
    public function getDishes()
    {
        return $this->dishes;
    }

    /**
     * Set linens
     *
     * @param boolean $linens
     *
     * @return Flat
     */
    public function setLinens($linens)
    {
        $this->linens = $linens;

        return $this;
    }

    /**
     * Get linens
     *
     * @return boolean
     */
    public function getLinens()
    {
        return $this->linens;
    }

    /**
     * Set telnumber
     *
     * @param integer $telnumber
     *
     * @return Flat
     */
    public function setTelnumber($telnumber)
    {
        $this->telnumber = $telnumber;

        return $this;
    }

    /**
     * Get telnumber
     *
     * @return integer
     */
    public function getTelnumber()
    {
        return $this->telnumber;
    }

    /**
     * Set about
     *
     * @param string $about
     *
     * @return Flat
     */
    public function setAbout($about)
    {
        $this->about = $about;

        return $this;
    }

    /**
     * Get about
     *
     * @return string
     */
    public function getAbout($length = null)
    {
        if (false === is_null($length) && $length > 0)
            return substr($this->about, 0, $length);
        else
            return $this->about;

//        return $this->about;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Flat
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * Set mainphoto
     *
     * @param string $mainphoto
     *
     * @return Flat
     */
    public function setMainphoto($mainphoto)
    {
        $this->mainphoto = $mainphoto;

        return $this;
    }

    /**
     * Get mainphoto
     *
     * @return string
     */
    public function getMainphoto()
    {
        return $this->mainphoto;
    }

    /**
     * Set photo1
     *
     * @param string $photo1
     *
     * @return Flat
     */
    public function setPhoto1($photo1)
    {
        $this->photo1 = $photo1;

        return $this;
    }

    /**
     * Get photo1
     *
     * @return string
     */
    public function getPhoto1()
    {
        return $this->photo1;
    }

    /**
     * Set photo2
     *
     * @param string $photo2
     *
     * @return Flat
     */
    public function setPhoto2($photo2)
    {
        $this->photo2 = $photo2;

        return $this;
    }

    /**
     * Get photo2
     *
     * @return string
     */
    public function getPhoto2()
    {
        return $this->photo2;
    }

    /**
     * Set photo3
     *
     * @param string $photo3
     *
     * @return Flat
     */
    public function setPhoto3($photo3)
    {
        $this->photo3 = $photo3;

        return $this;
    }

    /**
     * Get photo3
     *
     * @return string
     */
    public function getPhoto3()
    {
        return $this->photo3;
    }


}
