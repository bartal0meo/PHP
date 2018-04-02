<?php
/**
 * Created by PhpStorm.
 * User: bartek
 * Date: 11.03.17
 * Time: 09:27
 */

namespace AppBundle\Forms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class Calculate extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('liczba_1')->add('liczba_2')->add('wyslij',SubmitType::class);

    }

}