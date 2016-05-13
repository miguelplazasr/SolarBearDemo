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

    

    

}