<?php
/**
 * Created by PhpStorm.
 * User: miguelplazas
 * Date: 23/04/16
 * Time: 11:50
 */

namespace AppBundle\Handler;


use AppBundle\Form\InvalidFormException;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormFactoryInterface;

class EntityHandler implements HandlerInterface
{

    protected $em;
    protected $entityClass;
    protected $repository;
    protected $formFactory;
    protected $formType;

    function __construct($entityClass, $formType)
    {
        $this->entityClass = $entityClass;
        $this->formType = $formType;
    }

    public function setEntityManager(EntityManager $em)
    {
        $this->em = $em;
        $this->repository = $this->em->getRepository($this->entityClass);
    }

    public function setFormFactory(FormFactoryInterface $formFactory)
    {
        $this->formFactory = $formFactory;
    }

    public function all()
    {
        return $this->repository->findAll();
    }

    public function get($id)
    {
        return $this->repository->find($id);
    }

    public function delete($id)
    {
        $entity = $this->get($id);

        try {
            $this->em->remove($entity);
            $this->em->flush();

            return true;

        } catch (\Exception $e) {

            return $e;

        }
    }

    public function post(array $parameters)
    {
        $entity = $this->createEntityClass();

        return $this->process($entity, $parameters, $method = 'POST');
    }

    public function put($id, array $parameters)
    {
        $entity = $this->get($id);

        return $this->process($entity, $parameters, $method = 'PUT');
    }

    public function patch($entity, array $parameters)
    {
        return $this->process($entity, $parameters, $method = 'PATCH');
    }

    public function process($entity, array $parameters, $method = "PUT")
    {

        $form = $this->formFactory->create($this->createEntityType(), $entity, array('method' => $method));

        $form->submit($parameters, "PATCH" !== $method);

        dump($form);

        if ($form->isValid()) {

            $entity = $form->getData();

            $this->em->persist($entity);
            $this->em->flush($entity);

            return $entity;

        }

        throw new InvalidFormException('Invalid submitted data', $form);

    }

    public function createEntityClass()
    {
        $class = $this->entityClass;
        $entity = new $class;

        return $entity;
    }

    public function createEntityType()
    {
        $type = $this->formType;
        $entityType = new $type;

        return $entityType;
    }

    public function entityPrefix()
    {
        $prefix = explode('\\', $this->entityClass);
        return strtolower(end($prefix));
    }

    public function entityName()
    {
        $prefix = explode('\\', $this->entityClass);
        return end($prefix);
    }

}