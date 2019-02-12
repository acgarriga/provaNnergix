<?php

namespace WebCrawlerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class URLsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('url',TextType::class)
        ->add('profunditat',IntegerType::class,array('mapped'=>false))
        ->add('analitza',SubmitType::class,array('label'=>'Analiza'))
        ->add('headers',ChoiceType::class, array('choices'=>[
                                                array('Response'=>'0'),
                                                array('Response code'=>'response_code'),
                                                array('Date'=>'Date'),
                                                array('Server'=>'Server'),
                                                array('Content-Type'=>'Content-Type')
                                                ],'expanded'=>true,'multiple'=>true));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'WebCrawlerBundle\Entity\URLs'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'webcrawlerbundle_urls';
    }


}
