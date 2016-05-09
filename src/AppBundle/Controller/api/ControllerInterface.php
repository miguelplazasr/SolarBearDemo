<?php
/**
 * Created by PhpStorm.
 * User: miguelplazas
 * Date: 8/04/16
 * Time: 18:09
 */

namespace AppBundle\Controller\api;


use Symfony\Component\HttpFoundation\Request;

interface ControllerInterface
{

    public function getCategoryHandler();

    public function getCategoriesAction();

    public function getCategoryAction($id);

    public function postCategoryAction(Request $request);

    public function newCategoryAction();

    public function getOr404($id);

    public function deleteCategoryAction($id);

    public function putCategoryAction($id, Request $request);

    public function patchCategoryAction($id, Request $request);

}