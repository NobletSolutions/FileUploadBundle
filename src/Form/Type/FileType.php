<?php
/**
 * Created by PhpStorm.
 * User: gnat
 * Date: 11/01/17
 * Time: 11:07 AM
 */

namespace NS\FileUploadBundle\Form\Type;

use Symfony\Component\Form\Extension\Core\Type\FileType as ParentFileType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;

class FileType extends ParentFileType
{
    /**
     * @inheritDoc
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $orgValue = $view->vars['value'];
        parent::buildView($view, $form, $options);
        $view->vars['file'] = $orgValue;
    }
}
