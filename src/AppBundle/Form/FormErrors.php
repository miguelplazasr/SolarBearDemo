<?php
/**
 * Created by PhpStorm.
 * User: miguelplazas
 * Date: 13/05/16
 * Time: 18:54
 */

namespace AppBundle\Form;

use Symfony\Component\Form\Form;

class FormErrors
{

    /**
     * @param \Symfony\Component\Form\Form $form
     *
     * @return array $errors
     */
    public function getArray(Form $form)
    {
        return $this->getErrors($form, $form->getName());
    }

    /**
     * @param \Symfony\Component\Form\Form $baseForm
     * @param \Symfony\Component\Form\Form $baseFormName
     *
     * @return array $errors
     */
    private function getErrors($baseForm, $baseFormName) {
        $errors = array();
        if ($baseForm instanceof Form) {
            foreach($baseForm->getErrors() as $error) {
                $errors[] = array(
                    "mess"      => $error->getMessage(),
                    "key"       => $baseFormName
                );
            }

            foreach ($baseForm->all() as $key => $child) {
                if(($child instanceof Form)) {
                    $cErrors = $this->getErrors($child, $child->getName());
                    $errors = array_merge($errors, $cErrors);
                }
            }
        }
        return $errors;
    }

}