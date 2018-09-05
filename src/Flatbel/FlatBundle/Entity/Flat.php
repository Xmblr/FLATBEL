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
     * @ORM\Column(type="integer")
     */
    protected $userid;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $payornot;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Заполните это поле")
     */
    protected $flattype;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Заполните это поле")
     */
    protected $numberofbeds;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Заполните это поле")
     */
    protected $rooms;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Заполните это поле")
     */
    protected $street;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Заполните это поле")
     */
    protected $streettype;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Заполните это поле")
     */
    protected $home;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *     min="0",
     *     max="1000",
     *     invalidMessage="Введите цену в числовом виде"
     * )
     */
    protected $priceday;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *     min="0",
     *     max="1000",
     *     invalidMessage="Введите цену в числовом виде"
     * )
     */
    protected $pricehour;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Заполните это поле")
     */
    protected $floorhome;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Заполните это поле")
     */
    protected $floor;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Заполните это поле")
     */
    protected $metro;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $tv;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $lcdtv;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $wifi;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $parking;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $microwave;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $washer;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $bath;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $shower;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $jacuzzi;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $fridge;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $dishes;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $linens;

    /**
     * @ORM\Column(type="string")
     * @Assert\Regex(
     *     pattern     = "/^(\+375|80)(29|25|44|33)(\d{3})(\d{2})(\d{2})$/",
     *     htmlPattern = "^(\+375|80)(29|25|44|33)(\d{3})(\d{2})(\d{2})$",
     *     message="Введите телефон в виде: +375291234567 или 80291234567"
     *  )
     */
    protected $telnumber;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $viber;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $whatsapp;


    /**
     * @ORM\Column(type="boolean")
     */
    protected $telegram;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Заполните это поле")
     *
     */
    protected $about;

    /**
     * @ORM\Column(type="string",nullable=true)
     */
    protected $description;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $date;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Flatbel\FlatBundle\Entity\City")
     * @Assert\NotBlank(message="Заполните это поле")
     */
    protected $city;


    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"})
     *
     */
    protected $photo1;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"})
     *
     */
    protected $photo2;


    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"})
     *
     */
    protected $photo3;


    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"})
     */
    protected $photo4;


    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"})
     */
    protected $photo5;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"})
     */
    protected $photo6;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"})
     */
    protected $photo7;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"})
     */
    protected $photo8;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"})
     */
    protected $photo9;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"})
     */
    protected $photo10;


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
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * @param mixed $userid
     */
    public function setUserid($userid)
    {
        return $this->userid = $userid;
    }

    /**
     * @return mixed
     */
    public function getPayornot()
    {
        return $this->payornot;
    }

    /**
     * @param mixed $payornot
     */
    public function setPayornot($payornot)
    {
         return $this->payornot = $payornot;
    }

    /**
     * @return mixed
     */
    public function getFlattype()
    {
        return $this->flattype;
    }

    /**
     * @param mixed $flattype
     */
    public function setFlattype($flattype)
    {
        $this->flattype = $flattype;
    }

    /**
     * @return mixed
     */
    public function getNumberofbeds()
    {
        return $this->numberofbeds;
    }

    /**
     * @param mixed $numberofbeds
     */
    public function setNumberofbeds($numberofbeds)
    {
        $this->numberofbeds = $numberofbeds;
    }

    /**
     * @return mixed
     */
    public function getRooms()
    {
        return $this->rooms;
    }

    /**
     * @param mixed $rooms
     */
    public function setRooms($rooms)
    {
        $this->rooms = $rooms;
    }

    /**
     * @return mixed
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param mixed $street
     */
    public function setStreet($street)
    {
        $this->street = $street;
    }

    /**
     * @return mixed
     */
    public function getStreettype()
    {
        return $this->streettype;
    }

    /**
     * @param mixed $streettype
     */
    public function setStreettype($streettype)
    {
        $this->streettype = $streettype;
    }

    /**
     * @return mixed
     */
    public function getHome()
    {
        return $this->home;
    }

    /**
     * @param mixed $home
     */
    public function setHome($home)
    {
        $this->home = $home;
    }

    /**
     * @return mixed
     */
    public function getPriceday()
    {
        return $this->priceday;
    }

    /**
     * @param mixed $priceday
     */
    public function setPriceday($priceday)
    {
        $this->priceday = $priceday;
    }

    /**
     * @return mixed
     */
    public function getPricehour()
    {
        return $this->pricehour;
    }

    /**
     * @param mixed $pricehour
     */
    public function setPricehour($pricehour)
    {
        $this->pricehour = $pricehour;
    }

    /**
     * @return mixed
     */
    public function getFloorhome()
    {
        return $this->floorhome;
    }

    /**
     * @param mixed $floorhome
     */
    public function setFloorhome($floorhome)
    {
        $this->floorhome = $floorhome;
    }

    /**
     * @return mixed
     */
    public function getFloor()
    {
        return $this->floor;
    }

    /**
     * @param mixed $floor
     */
    public function setFloor($floor)
    {
        $this->floor = $floor;
    }

    /**
     * @return mixed
     */
    public function getMetro()
    {
        return $this->metro;
    }

    /**
     * @param mixed $metro
     */
    public function setMetro($metro)
    {
        $this->metro = $metro;
    }

    /**
     * @return mixed
     */
    public function getTv()
    {
        return $this->tv;
    }

    /**
     * @param mixed $tv
     */
    public function setTv($tv)
    {
        $this->tv = $tv;
    }

    /**
     * @return mixed
     */
    public function getLcdtv()
    {
        return $this->lcdtv;
    }

    /**
     * @param mixed $lcdtv
     */
    public function setLcdtv($lcdtv)
    {
        $this->lcdtv = $lcdtv;
    }

    /**
     * @return mixed
     */
    public function getWifi()
    {
        return $this->wifi;
    }

    /**
     * @param mixed $wifi
     */
    public function setWifi($wifi)
    {
        $this->wifi = $wifi;
    }

    /**
     * @return mixed
     */
    public function getParking()
    {
        return $this->parking;
    }

    /**
     * @param mixed $parking
     */
    public function setParking($parking)
    {
        $this->parking = $parking;
    }

    /**
     * @return mixed
     */
    public function getMicrowave()
    {
        return $this->microwave;
    }

    /**
     * @param mixed $microwave
     */
    public function setMicrowave($microwave)
    {
        $this->microwave = $microwave;
    }

    /**
     * @return mixed
     */
    public function getWasher()
    {
        return $this->washer;
    }

    /**
     * @param mixed $washer
     */
    public function setWasher($washer)
    {
        $this->washer = $washer;
    }

    /**
     * @return mixed
     */
    public function getBath()
    {
        return $this->bath;
    }

    /**
     * @param mixed $bath
     */
    public function setBath($bath)
    {
        $this->bath = $bath;
    }

    /**
     * @return mixed
     */
    public function getShower()
    {
        return $this->shower;
    }

    /**
     * @param mixed $shower
     */
    public function setShower($shower)
    {
        $this->shower = $shower;
    }

    /**
     * @return mixed
     */
    public function getJacuzzi()
    {
        return $this->jacuzzi;
    }

    /**
     * @param mixed $jacuzzi
     */
    public function setJacuzzi($jacuzzi)
    {
        $this->jacuzzi = $jacuzzi;
    }

    /**
     * @return mixed
     */
    public function getFridge()
    {
        return $this->fridge;
    }

    /**
     * @param mixed $fridge
     */
    public function setFridge($fridge)
    {
        $this->fridge = $fridge;
    }

    /**
     * @return mixed
     */
    public function getDishes()
    {
        return $this->dishes;
    }

    /**
     * @param mixed $dishes
     */
    public function setDishes($dishes)
    {
        $this->dishes = $dishes;
    }

    /**
     * @return mixed
     */
    public function getLinens()
    {
        return $this->linens;
    }

    /**
     * @param mixed $linens
     */
    public function setLinens($linens)
    {
        $this->linens = $linens;
    }

    /**
     * @return mixed
     */
    public function getTelnumber()
    {
        return $this->telnumber;
    }

    /**
     * @param mixed $telnumber
     */
    public function setTelnumber($telnumber)
    {
        $this->telnumber = $telnumber;
    }

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
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
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
     * @return mixed
     */
    public function getPhoto1()
    {
        return $this->photo1;
    }

    /**
     * @param mixed $photo1
     */
    public function setPhoto1($photo1)
    {
        $this->photo1 = $photo1;
    }

    /**
     * @return mixed
     */
    public function getPhoto2()
    {
        return $this->photo2;
    }

    /**
     * @param mixed $photo2
     */
    public function setPhoto2($photo2)
    {
        $this->photo2 = $photo2;
    }

    /**
     * @return mixed
     */
    public function getPhoto3()
    {
        return $this->photo3;
    }

    /**
     * @param mixed $photo3
     */
    public function setPhoto3($photo3)
    {
        $this->photo3 = $photo3;
    }

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
     * @return mixed
     */
    public function getPhoto6()
    {
        return $this->photo6;
    }

    /**
     * @param mixed $photo6
     */
    public function setPhoto6($photo6)
    {
        $this->photo6 = $photo6;
    }

    /**
     * @return mixed
     */
    public function getPhoto7()
    {
        return $this->photo7;
    }

    /**
     * @param mixed $photo7
     */
    public function setPhoto7($photo7)
    {
        $this->photo7 = $photo7;
    }

    /**
     * @return mixed
     */
    public function getPhoto8()
    {
        return $this->photo8;
    }

    /**
     * @param mixed $photo8
     */
    public function setPhoto8($photo8)
    {
        $this->photo8 = $photo8;
    }

    /**
     * @return mixed
     */
    public function getPhoto9()
    {
        return $this->photo9;
    }

    /**
     * @param mixed $photo9
     */
    public function setPhoto9($photo9)
    {
        $this->photo9 = $photo9;
    }

    /**
     * @return mixed
     */
    public function getPhoto10()
    {
        return $this->photo10;
    }

    /**
     * @param mixed $photo10
     */
    public function setPhoto10($photo10)
    {
        $this->photo10 = $photo10;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }



}
