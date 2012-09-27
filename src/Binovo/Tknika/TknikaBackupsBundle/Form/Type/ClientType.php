<?php

namespace Binovo\Tknika\TknikaBackupsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name'        , 'text', array('label' => 'Name'))
                ->add('description' , 'textarea')
                ->add('url'         , 'text')
                ->add('preScript'   , 'text')
                ->add('postScript'  , 'text')
                ->add('jobs'        , 'collection', array('type'         => new JobShortType(),
                                                          'allow_delete' => true));
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Binovo\Tknika\TknikaBackupsBundle\Entity\Client',
        );
    }

    public function getName()
    {
        return 'Client';
    }
}