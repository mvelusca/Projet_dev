<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=70)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $telephone;

    /**
     * @ORM\OneToMany(targetEntity=Trajet::class, mappedBy="conducteur")
     */
    private $trajets;

    /**
     * @ORM\OneToMany(targetEntity=Reservation::class, mappedBy="passager")
     */
    private $reservations;

    /**
     * @ORM\OneToMany(targetEntity=Commentaire::class, mappedBy="user")
     */
    private $commentaires;

    /**
     * @ORM\OneToMany(targetEntity=Note::class, mappedBy="passager")
     */
    private $notesDonnees;

    /**
     * @ORM\OneToMany(targetEntity=Note::class, mappedBy="conducteur")
     */
    private $notesRecues;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $motDePasse;

    public function __construct()
    {
        $this->trajets = new ArrayCollection();
        $this->reservations = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
        $this->notesDonnees = new ArrayCollection();
        $this->notesRecues = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * @return Collection<int, Trajet>
     */
    public function getTrajets(): Collection
    {
        return $this->trajets;
    }

    public function addTrajet(Trajet $trajet): self
    {
        if (!$this->trajets->contains($trajet)) {
            $this->trajets[] = $trajet;
            $trajet->setConducteur($this);
        }

        return $this;
    }

    public function removeTrajet(Trajet $trajet): self
    {
        if ($this->trajets->removeElement($trajet)) {
            // set the owning side to null (unless already changed)
            if ($trajet->getConducteur() === $this) {
                $trajet->setConducteur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations[] = $reservation;
            $reservation->setPassager($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getPassager() === $this) {
                $reservation->setPassager(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Commentaire>
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setUser($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getUser() === $this) {
                $commentaire->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Note>
     */
    public function getNotesDonnees(): Collection
    {
        return $this->notesDonnees;
    }

    public function addNotesDonnee(Note $notesDonnee): self
    {
        if (!$this->notesDonnees->contains($notesDonnee)) {
            $this->notesDonnees[] = $notesDonnee;
            $notesDonnee->setPassager($this);
        }

        return $this;
    }

    public function removeNotesDonnee(Note $notesDonnee): self
    {
        if ($this->notesDonnees->removeElement($notesDonnee)) {
            // set the owning side to null (unless already changed)
            if ($notesDonnee->getPassager() === $this) {
                $notesDonnee->setPassager(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Note>
     */
    public function getNotesRecues(): Collection
    {
        return $this->notesRecues;
    }

    public function addNotesRecue(Note $notesRecue): self
    {
        if (!$this->notesRecues->contains($notesRecue)) {
            $this->notesRecues[] = $notesRecue;
            $notesRecue->setConducteur($this);
        }

        return $this;
    }

    public function removeNotesRecue(Note $notesRecue): self
    {
        if ($this->notesRecues->removeElement($notesRecue)) {
            // set the owning side to null (unless already changed)
            if ($notesRecue->getConducteur() === $this) {
                $notesRecue->setConducteur(null);
            }
        }

        return $this;
    }

    public function getMotDePasse(): ?string
    {
        return $this->motDePasse;
    }

    public function setMotDePasse(string $motDePasse): self
    {
        $this->motDePasse = $motDePasse;

        return $this;
    }
}
