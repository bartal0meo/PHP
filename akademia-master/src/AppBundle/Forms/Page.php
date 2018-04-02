<?php
/**
 * Created by PhpStorm.
 * User: bartek
 * Date: 10.03.17
 * Time: 15:09
 */

namespace AppBundle\Forms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

class Page extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title')->add('description',TextareaType::class)->add('save',SubmitType::class);
    }

}