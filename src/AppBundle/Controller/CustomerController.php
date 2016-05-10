<?php
/**
 * Created by PhpStorm.
 * User: miguelplazas
 * Date: 9/05/16
 * Time: 20:57
 */
namespace AppBundle\Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Request\ParamFetcherInterface;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use AppBundle\Form\CustomerType;


class CustomerController extends FOSRestController
{

    public function getEntityHandler()
    {
        return $this->get('app.handler.customer');
    }

    /**
     * List all Customer
     *
     * @ApiDoc(
     *  resource = true,
     *  output = "AppBundle\Entity\Customer",
     *  section="Customer",
     *  statusCodes={
     *      200 = "Returned when successful",
     *      400 = "Returned when errors"
     * }
     * )
     *
     * @return mixed
     */
    public function getCustomersAction()
    {

        $data = $this->getEntityHandler()->all();
        $view = $this->view($data, 200)
            ->setTemplate(":customer:getCustomer.html.twig")
            ->setTemplateVar('entities')
        ;

        return $this->handleView($view);
    }

    /**
     * Get single Customer
     *
     * @ApiDoc(
     *  resource = true,
     *  output = "AppBundle\Entity\Customer",
     *  section="Customer",
     *  statusCodes = {
     *      200 = "Returned when successful",
     *      400 = "Returned when the page is not found"
     *  }
     * )
     * @param $id
     * @return array
     */
    public function getCustomerAction($id)
    {
        return $this->getEntityHandler()->get($id);

    }

    /**
     * Create a Customer from the submitted data.
     *
     * @ApiDoc(
     *  resource = true,
     *  description = "Creates a new page from the submitted data.",
     *  input = "AppBundle\Form\CustomerType",
     *  section="Customer",
     *  statusCodes = {
     *      200 = "Returned when successful",
     *      400 = "Returned when the form has errors"
     *  }
     * )
     *
     * @param Request $request the request object
     *
     * @return FormTypeInterface|View
     */
    public function postCustomerAction(Request $request)
    {
        $newCustomer = $this->getEntityHandler()->post(
            $request->request->all()
        );

        return $newCustomer; //$this->routeRedirectView('post_category', $routeOptions, Codes::HTTP_CREATED);


    }

    /**
     * Presents the form to use to create a new Customer.
     *
     * @ApiDoc(
     *   resource = true,
     *   section="Customer",
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\View()
     *
     * @return FormTypeInterface
     */
    public function newCustomerAction()
    {

        $form = $this->createForm(new CustomerType());

        return $this->render(":customer:newCustomer.html.twig", array(
            'form' => $form->createView()
        ));
    }

    protected function getOr404($id)
    {
        if (!($entity = $this->getEntityHandler()->get($id))) {
            throw new NotFoundHttpException(sprintf('The resource \'%s\' was not found.', $id));
        }

        return $entity;
    }

    /**
     * Put Customer.
     *
     * @ApiDoc(
     *  resource = true,
     *  section="Customer",
     *  statusCodes={
     *      200 = "Returned when successful",
     *      400 = "Returned when errors"
     * }
     * )
     *
     * @param $id
     * @return bool|\Exception
     */
    public function deleteCustomerAction($id)
    {
        return $this->getEntityHandler()->delete($id);

    }

    /**
     * Delete Customer.
     *
     * @ApiDoc(
     *  resource = true,
     *  input = "AppBundle\Form\CustomerType",
     *  section="Customer",
     *  statusCodes={
     *      200 = "Returned when successful",
     *      400 = "Returned when errors"
     * }
     * )
     *
     * @param Request $request
     * @return bool|\Exception
     * @internal param $id
     */
    public function putCustomerAction($id, Request $request)
    {
        $editCustomer = $this->getEntityHandler()->put(
            $id,
            $request->request->all()
        );

        return $editCustomer; //$this->routeRedirectView('post_category', $routeOptions, Codes::HTTP_CREATED);

    }

    /**
     * Patch Customer.
     *
     * @ApiDoc(
     *  resource = true,
     *  section="Customer",
     *  statusCodes={
     *      200 = "Returned when successful",
     *      400 = "Returned when errors"
     * }
     * )
     *
     * @param Request $request
     * @return bool|\Exception
     * @internal param $id
     */
    public function patchCustomerAction($id, Request $request)
    {

        try {
            $newCustomer = $this->getEntityHandler()->patch(
                $id,
                $request->request->all()
            );
            $routeOptions = array(
                '_format' => $request->get('_format'),
            );

            return $this->routeRedirectView('post_sensor_type', $routeOptions, Codes::HTTP_CREATED);
        } catch (\Exception $exception) {
            return $exception->getCode();
        }
    }
}