<?php

namespace App\Entity;

use App\Repository\VoyageurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VoyageurRepository::class)
 */
class Voyageur
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
     * @ORM\Column(type="string", length=255)
     */
    private $compagnieDeVoyage;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateHeureDepart;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateHeureArrivee;

    /**
     * @ORM\Column(type="integer")
     */
    private $numero;

    /**
     * @ORM\Column(type="integer")
     */
    private $kiloDisponible;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity=Expediteur::class, mappedBy="transporteurDuColis")
     */
    private $proprietaireDuColis;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $prixAchat;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $notification;

    public function __construct()
    {
        $this->proprietaireDuColis = new ArrayCollection();
    }

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

    public function getCompagnieDeVoyage(): ?string
    {
        return $this->compagnieDeVoyage;
    }

    public function setCompagnieDeVoyage(string $compagnieDeVoyage): self
    {
        $this->compagnieDeVoyage = $compagnieDeVoyage;

        return $this;
    }

    public function getDateHeureDepart(): ?\DateTimeInterface
    {
        return $this->dateHeureDepart;
    }

    public function setDateHeureDepart(\DateTimeInterface $dateHeureDepart): self
    {
        $this->dateHeureDepart = $dateHeureDepart;

        return $this;
    }

    public function getDateHeureArrivee(): ?\DateTimeInterface
    {
        return $this->dateHeureArrivee;
    }

    public function setDateHeureArrivee(\DateTimeInterface $dateHeureArrivee): self
    {
        $this->dateHeureArrivee = $dateHeureArrivee;

        return $this;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getKiloDisponible(): ?int
    {
        return $this->kiloDisponible;
    }

    public function setKiloDisponible(int $kiloDisponible): self
    {
        $this->kiloDisponible = $kiloDisponible;

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

    public function isStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(?bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, Expediteur>
     */
    public function getProprietaireDuColis(): Collection
    {
        return $this->proprietaireDuColis;
    }

    public function addProprietaireDuColi(Expediteur $proprietaireDuColi): self
    {
        if (!$this->proprietaireDuColis->contains($proprietaireDuColi)) {
            $this->proprietaireDuColis[] = $proprietaireDuColi;
            $proprietaireDuColi->setTransporteurDuColis($this);
        }

        return $this;
    }

    public function removeProprietaireDuColi(Expediteur $proprietaireDuColi): self
    {
        if ($this->proprietaireDuColis->removeElement($proprietaireDuColi)) {
            // set the owning side to null (unless already changed)
            if ($proprietaireDuColi->getTransporteurDuColis() === $this) {
                $proprietaireDuColi->setTransporteurDuColis(null);
            }
        }

        return $this;
    }

    public function getPrixAchat(): ?float
    {
        return $this->prixAchat;
    }

    public function setPrixAchat(?float $prixAchat): self
    {
        $this->prixAchat = $prixAchat;

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

}
