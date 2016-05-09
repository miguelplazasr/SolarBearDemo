<?php
/**
 * Created by PhpStorm.
 * User: miguelplazas
 * Date: 8/04/16
 * Time: 18:17
 */

namespace AppBundle\Controller\api;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\FOSRestController;

abstract class EntityController extends FOSRestController
{

    public function getCategoryHandler()
    {
        return $this->get('app.handler.category');
    }

    /**
     * List all Categories
     *
     * @ApiDoc(
     *  resource = true,
     *  statusCodes={
     *      200 = "Returned when successful",
     *      400 = "Returned when errors"
     * }
     * )
     *
     * @return mixed
     */
    public function getCategoriesAction()
    {

        return $this->getCategoryHandler()->all();
    }

    /**
     * Get single Category
     *
     * @ApiDoc(
     *  resource = true,
     *  output = "AppBundle\Document\Category",
     *  statusCodes = {
     *      200 = "Returned when successful",
     *      400 = "Returned when the page is not found"
     *  }
     * )
     * @param $id
     * @return array
     */
    public function getCategoryAction($id)
    {
        return $this->getCategoryHandler()->get($id);

    }

    /**
     * Create a Category from the submitted data.
     *
     * @ApiDoc(
     *  resource = true,
     *  description = "Creates a new page from the submitted data.",
     *  input = "AppBundle\Form\Type\CategoryType",
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
    public function postCategoryAction(Request $request)
    {
        $newCategory = $this->getCategoryHandler()->post(
            $request->request->all()
        );

        return $newCategory; //$this->routeRedirectView('post_category', $routeOptions, Codes::HTTP_CREATED);


    }

    /**
     * Presents the form to use to create a new category.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\View()
     *
     * @return FormTypeInterface
     */
    public function newCategoryAction()
    {

        return $this->createForm(new CategoryType());
    }

    protected function getOr404($id)
    {
        if (!($document = $this->getCategoryHandler()->get($id))) {
            throw new NotFoundHttpException(sprintf('The resource \'%s\' was not found.', $id));
        }

        return $document;
    }

    /**
     * Put Category.
     *
     * @ApiDoc(
     *  resource = true,
     *  statusCodes={
     *      200 = "Returned when successful",
     *      400 = "Returned when errors"
     * }
     * )
     *
     * @param $id
     * @return bool|\Exception
     */
    public function deleteCategoryAction($id)
    {
        return $this->getCategoryHandler()->delete($id);

    }

    /**
     * Delete Category.
     *
     * @ApiDoc(
     *  resource = true,
     *  input = "AppBundle\Form\Type\CategoryType",
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
    public function putCategoryAction($id, Request $request)
    {
        $editCategory = $this->getCategoryHandler()->put(
            $id,
            $request->request->all()
        );

        return $editCategory; //$this->routeRedirectView('post_category', $routeOptions, Codes::HTTP_CREATED);


        /*
        try {
            $newCategory = $this->getCategoryHandler()->put(
                $id,
                $request->request->all()
            );
            $routeOptions = array(
                '_format' => $request->get('_format'),
            );

            return $this->routeRedirectView('post_category', $routeOptions, Codes::HTTP_CREATED);
        } catch (\Exception $exception) {
            return $exception->getCode();
        }
        */

    }

    /**
     * Patch Category.
     *
     * @ApiDoc(
     *  resource = true,
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
    public function patchCategoryAction($id, Request $request)
    {

        try {
            $newCategory = $this->getCategoryHandler()->patch(
                $id,
                $request->request->all()
            );
            $routeOptions = array(
                '_format' => $request->get('_format'),
            );

            return $this->routeRedirectView('post_category', $routeOptions, Codes::HTTP_CREATED);
        } catch (\Exception $exception) {
            return $exception->getCode();
        }

    }




}