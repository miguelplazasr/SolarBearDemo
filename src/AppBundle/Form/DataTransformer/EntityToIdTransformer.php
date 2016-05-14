<?php
/**
 * Created by PhpStorm.
 * User: miguelplazas
 * Date: 8/02/16
 * Time: 14:39
 */
namespace AppBundle\Form\DataTransformer;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;


class EntityToIdTransformer implements DataTransformerInterface
{

    private $manager;
    private $entityClass;

    public function __construct(ObjectManager $manager, $entityClass)
    {
        $this->manager = $manager;
        $this->entityClass = $entityClass;

    }

    /**
     * Transform a Object entity to Id
     *
     * @param mixed $entity
     * @return mixed The value in the transformed representation
     */
    public function transform($entity)
    {
        if(null == $entity) {
            return "";
        }

        return $entity->getId();
    }

    /**
     * Transform an Id to an entity Object
     *
     * @param mixed $id
     * @return mixed The value in the original representation
     */
    public function reverseTransform($id)
    {

        $entity = $this->manager->getRepository($this->entityClass)->find($id);

        if (null === $entity) {
            throw new TransformationFailedException(sprintf('There is no entity of %s with id %s', $this->entityClass, $id
            ));
        }

        return $entity;
    }
    
}