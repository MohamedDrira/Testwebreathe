<?php


namespace TestwebreatheBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;




/**
 * @ORM\Entity (repositoryClass="TestwebreatheBundle\Repository\Operationrepository")
 */
class Operations
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $datedebut;

    /**
     * @ORM\Column(type="date")
     */
    private $datefin;

    /**
     * @ORM\Column(type="string")
     */
    private $sujet;

    /**
     * @ORM\Column(type="string")
     */
    private $description;

    /**
     * @var array
     *
     * @ORM\Column(name="PiecesAffectees" ,type="string",length=255,nullable=true);
     */
    private $piecesaffectees;

    /**
     * @ORM\Column(type="string",length=255)
     * @Assert\NotBlank(message="")
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity="Vehicule",inversedBy="vehicules")
     * @ORM\JoinColumn(name="vehicule_id" ,referencedColumnName="id");
     */
    private $vehicule;


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
    public function getDatedebut()
    {
        return $this->datedebut;
    }

    /**
     * @param mixed $datedebut
     */
    public function setDatedebut($datedebut)
    {
        $this->datedebut = $datedebut;
    }

    /**
     * @return mixed
     */
    public function getDatefin()
    {
        return $this->datefin;
    }

    /**
     * @param mixed $datefin
     */
    public function setDatefin($datefin)
    {
        $this->datefin = $datefin;
    }

    /**
     * @return mixed
     */
    public function getSujet()
    {
        return $this->sujet;
    }

    /**
     * @param mixed $sujet
     */
    public function setSujet($sujet)
    {
        $this->sujet = $sujet;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $despription
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getPiecesaffectees()
    {
        return $this->piecesaffectees;
    }

    /**
     * @param mixed $piecesaffectees
     */
    public function setPiecesaffectees($piecesaffectees)
    {
        $this->piecesaffectees = $piecesaffectees;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getVehicule()
    {
        return $this->vehicule;
    }

    /**
     * @param mixed $vehicule
     */
    public function setVehicule($vehicule)
    {
        $this->vehicule = $vehicule;
    }
}