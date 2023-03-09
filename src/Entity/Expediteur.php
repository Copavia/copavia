<?php

namespace App\Entity;

use App\Repository\ExpediteurRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExpediteurRepository::class)
 */
class Expediteur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $villeDepart;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $villeArrivee;

    /**
     * @ORM\Column(type="integer")
     */
    private $nombreKilogramme;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $descriptionColis;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numero;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="date")
     */
    private $dateDeVoyageSouhaiter;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity=Voyageur::class, inversedBy="proprietaireDuColis")
     */
    private $transporteurDuColis;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $prixEnvoie;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $notification;

    /**
     * @ORM\Column(type="integer")
     */
    private $etat;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numeroCarteIdentite;


    public function __toString()
    {
        return $this->getNom();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVilleDepart(): ?string
    {
        return $this->villeDepart;
    }

    public function setVilleDepart(string $villeDepart): self
    {
        $this->villeDepart = $villeDepart;

        return $this;
    }

    public function getVilleArrivee(): ?string
    {
        return $this->villeArrivee;
    }

    public function setVilleArrivee(string $villeArrivee): self
    {
        $this->villeArrivee = $villeArrivee;

        return $this;
    }

    public function getNombreKilogramme(): ?int
    {
        return $this->nombreKilogramme;
    }

    public function setNombreKilogramme(int $nombreKilogramme): self
    {
        $this->nombreKilogramme = $nombreKilogramme;

        return $this;
    }

    public function getDescriptionColis(): ?string
    {
        return $this->descriptionColis;
    }

    public function setDescriptionColis(?string $descriptionColis): self
    {
        $this->descriptionColis = $descriptionColis;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getDateDeVoyageSouhaiter(): ?\DateTimeInterface
    {
        return $this->dateDeVoyageSouhaiter;
    }

    public function setDateDeVoyageSouhaiter(\DateTimeInterface $dateDeVoyageSouhaiter): self
    {
        $this->dateDeVoyageSouhaiter = $dateDeVoyageSouhaiter;

        return $this;
    }

    public function isStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(?bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getTransporteurDuColis(): ?Voyageur
    {
        return $this->transporteurDuColis;
    }

    public function setTransporteurDuColis(?Voyageur $transporteurDuColis): self
    {
        $this->transporteurDuColis = $transporteurDuColis;

        return $this;
    }

    public function getPrixEnvoie(): ?float
    {
        return $this->prixEnvoie;
    }

    public function setPrixEnvoie(?float $prixEnvoie): self
    {
        $this->prixEnvoie = $prixEnvoie;

        return $this;
    }

    public function getNotification(): ?string
    {
        return $this->notification;
    }

    public function setNotification(?string $notification): self
    {
        $this->notification = $notification;

        return $this;
    }

    public function getEtat(): ?int
    {
        return $this->etat;
    }

    public function setEtat(int $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getNumeroCarteIdentite(): ?string
    {
        return $this->numeroCarteIdentite;
    }

    public function setNumeroCarteIdentite(string $numeroCarteIdentite): self
    {
        $this->numeroCarteIdentite = $numeroCarteIdentite;

        return $this;
    }

}
