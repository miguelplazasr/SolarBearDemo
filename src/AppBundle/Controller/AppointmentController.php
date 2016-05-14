<?php
/**
 * Created by PhpStorm.
 * User: miguelplazas
 * Date: 13/05/16
 * Time: 0:31
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
use AppBundle\Form\AppointmentType;


class AppointmentController extends FOSRestController
{

    public function getEntityHandler()
    {
        return $this->get('app.handler.appointment');
    }

    /**
     * List all Appointment
     *
     * @ApiDoc(
     *  resource = true,
     *  output = "AppBundle\Entity\Appointment",
     *  section="Appointment",
     *  statusCodes={
     *      200 = "Returned when successful",
     *      400 = "Returned when errors"
     * }
     * )
     *
     * @return mixed
     */
    public function getAppointmentsAction()
    {

        $data = $this->getEntityHandler()->all();
        $view = $this->view($data, 200)
            ->setTemplate(":appointment:getAppointment.html.twig")
            ->setTemplateVar('entities')
        ;

        return $this->handleView($view);
    }

    /**
     * Get single Appointment
     *
     * @ApiDoc(
     *  resource = true,
     *  output = "AppBundle\Entity\Appointment",
     *  section="Appointment",
     *  statusCodes = {
     *      200 = "Returned when successful",
     *      400 = "Returned when the page is not found"
     *  }
     * )
     * @param $id
     * @return array
     */
    public function getAppointmentAction($id)
    {
        return $this->getEntityHandler()->get($id);

    }

    /**
     * Create a Appointment from the submitted data.
     *
     * @ApiDoc(
     *  resource = true,
     *  description = "Creates a new page from the submitted data.",
     *  input = "AppBundle\Form\AppointmentType",
     *  section="Appointment",
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
    public function postAppointmentAction(Request $request)
    {
        $newAppointment = $this->getEntityHandler()->post(
            $request->request->all()
        );

        return $newAppointment; //$this->routeRedirectView('post_category', $routeOptions, Codes::HTTP_CREATED);


    }

    /**
     * Presents the form to use to create a new Appointment.
     *
     * @ApiDoc(
     *   resource = true,
     *   section="Appointment",
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\View()
     *
     * @return FormTypeInterface
     */
    public function newAppointmentAction()
    {

        $form = $this->createForm(new AppointmentType());

        return $this->render(":appointment:newAppointment.html.twig", array(
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
     * Put Appointment.
     *
     * @ApiDoc(
     *  resource = true,
     *  section="Appointment",
     *  statusCodes={
     *      200 = "Returned when successful",
     *      400 = "Returned when errors"
     * }
     * )
     *
     * @param $id
     * @return bool|\Exception
     */
    public function deleteAppointmentAction($id)
    {
        return $this->getEntityHandler()->delete($id);

    }

    /**
     * Delete Appointment.
     *
     * @ApiDoc(
     *  resource = true,
     *  input = "AppBundle\Form\AppointmentType",
     *  section="Appointment",
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
    public function putAppointmentAction($id, Request $request)
    {
        $editAppointment = $this->getEntityHandler()->put(
            $id,
            $request->request->all()
        );

        return $editAppointment; //$this->routeRedirectView('post_category', $routeOptions, Codes::HTTP_CREATED);

    }

    /**
     * Patch Appointment.
     *
     * @ApiDoc(
     *  resource = true,
     *  section="Appointment",
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
    public function patchAppointmentAction($id, Request $request)
    {

        try {
            $newAppointment = $this->getEntityHandler()->patch(
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