<?php

namespace NS\FileUploadBundle\Form\Type;

use Symfony\Component\Form\Extension\Core\Type\FileType as ParentFileType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;

class FileType extends ParentFileType
{
    public function buildView(FormView $view, FormInterface $form, array $options): void
    {
        $orgValue = $view->vars['value'];
        parent::buildView($view, $form, $options);
        $view->vars['file'] = $orgValue;
    }
}
