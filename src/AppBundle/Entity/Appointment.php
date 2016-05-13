<?php
/**
 * Created by PhpStorm.
 * User: miguelplazas
 * Date: 12/05/16
 * Time: 22:48
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * AppBundle\Entity\Appointment
 *
 * @ORM\Table(name="tb_appointment")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\AppointmentRepository")
 *
 * @ExclusionPolicy("all")
 */
 

class Appointment {

    /**
     * @var integer $id
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */

    protected $id;

    /**
     * @ORM\Column(type="date")
     * @Assert\Date(
     *      message = "La fecha ingresada no es válida. El formato de la fecha debe ser AAAA-MM-DD"
     *      )
     * @Expose
     */
    protected $date;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Assert\Length( max = "100" )
     * @Expose
     */
    protected $rental_property;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Assert\Length( max = "100" )
     * @Expose
     */
    protected $owner;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     * @Assert\Length(min = 0, max = 100)
     * @Expose
     */
    protected $notes;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Customer", inversedBy="appointments")
     * @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
     */
    protected $customer;
    

    /**
     * @var datetime $created
     *
     * @ORM\Column( type="datetime")
     * @Gedmo\Timestampable(on="create")
     *
     */
    private $created_at;


    /**
     * @var datetime $updated
     *
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    private $update_at;

    

    


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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Appointment
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set rentalProperty
     *
     * @param string $rentalProperty
     *
     * @return Appointment
     */
    public function setRentalProperty($rentalProperty)
    {
        $this->rental_property = $rentalProperty;

        return $this;
    }

    /**
     * Get rentalProperty
     *
     * @return string
     */
    public function getRentalProperty()
    {
        return $this->rental_property;
    }

    /**
     * Set owner
     *
     * @param string $owner
     *
     * @return Appointment
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get owner
     *
     * @return string
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set notes
     *
     * @param string $notes
     *
     * @return Appointment
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;

        return $this;
    }

    /**
     * Get notes
     *
     * @return string
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Get updateAt
     *
     * @return \DateTime
     */
    public function getUpdateAt()
    {
        return $this->update_at;
    }

    /**
     * Set customer
     *
     * @param \AppBundle\Entity\Customer $customer
     *
     * @return Appointment
     */
    public function setCustomer(\AppBundle\Entity\Customer $customer = null)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return \AppBundle\Entity\Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }
}
