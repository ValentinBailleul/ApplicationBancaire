<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
/**
 * @ORM\Table(name="users")
 * @ORM\Entity
 */
class User implements UserInterface
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $password;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $civilite;

    /**
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $datedenaissance;

    /**
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $banque;

    /**
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $soldeducompte;

    /**
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $montant;

    /**
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $operation;


    public function __construct($nom, $prenom, $civilite, $datedenaissance, $adresse, $banque, $soldeducompte, $montant, $operation)
    {
        $this->isActive = true;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->civilite = $civilite;
        $this->datedenaissance = $datedenaissance;
        $this->adresse = $adresse;
        $this->banque = $banque;
        $this->soldeducompte = $soldeducompte;
        $this->montant = $montant;
        $this->operation = $operation;
    }

    public function getMontant()
    {
        return $this->montant;
    }

    public function getOperation()
    {
        return $this->operation;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function getDatedenaissance()
    {
        return $this->datedenaissance;
    }

    public function getAdresse()
    {
        return $this->adresse;
    }

    public function getCivilite()
    {
        return $this->civilite;
    }

    public function getPin()
    {
        return $this->pin;
    }

    public function getBanque()
    {
        return $this->banque;
    }

    public function getSoldeducompte()
    {
        return $this->soldeducompte;
    }

    public function setSoldeducompte($soldeducompte)
    {
        $this->soldeducompte = $soldeducompte;
    }

    public function getSalt()
    {
        return null;
    }
    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setNumeroCompte($username)
    {
        $this->username = $username;
    }

    public function getRoles()
    {
        return array('ROLE_USER');
    }
    public function eraseCredentials()
    {
    }
}