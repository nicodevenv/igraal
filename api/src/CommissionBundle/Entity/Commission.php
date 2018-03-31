<?php

namespace CommissionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use MerchantBundle\Entity\Merchant;
use UserBundle\Entity\User;

/**
 * Commission
 *
 * @ORM\Table(name="commission")
 * @ORM\Entity(repositoryClass="CommissionBundle\Repository\CommissionRepository")
 */
class Commission
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="string")
     */
    private $date;


    /**
     * @var Merchant
     *
     * @ORM\ManyToOne(targetEntity="merchant")
     * @ORM\Column(name="idMerchant")
     */
    private $merchant;


    /**
     * @var double
     *
     * @ORM\Column(name="cashback", type="decimal")
     */
    private $cashback;


    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\Column(name="idUser")
     */
    private $idUser;

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     * @return Commission
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return Merchant
     */
    public function getMerchant()
    {
        return $this->merchant;
    }

    /**
     * @param Merchant $merchant
     * @return Commission
     */
    public function setMerchant($merchant)
    {
        $this->merchant = $merchant;
        return $this;
    }

    /**
     * @return float
     */
    public function getCashback()
    {
        return $this->cashback;
    }

    /**
     * @param float $cashback
     * @return Commission
     */
    public function setCashback($cashback)
    {
        $this->cashback = $cashback;
        return $this;
    }

    /**
     * @return User
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * @param User $idUser
     * @return Commission
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
        return $this;
    }
}
