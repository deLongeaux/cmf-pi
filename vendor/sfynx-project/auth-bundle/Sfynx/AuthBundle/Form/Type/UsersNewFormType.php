<?php
/**
 * This file is part of the <Auth> project.
 *
 * @subpackage   Auth
 * @package    Form
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-11-14
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Sfynx\AuthBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Constraints;

class UsersNewFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('enabled', 'checkbox', array(
            		'data'  => true,
            		'label'	=> 'pi.form.label.field.enabled',
            ))      
            ->add('username', 'text', array(
                    'label' => 'pi.form.label.field.username'
            ))
            ->add('email', 'email', array(
                    'label' => 'pi.form.label.field.email'
            ))
            ->add('langCode', 'entity', array(
             		'class' => 'SfynxAuthBundle:Langue',
             		'query_builder' => function(EntityRepository $er) {
             			return $er->createQueryBuilder('k')
             			->select('k')
             			->where('k.enabled = :enabled')
             			->orderBy('k.label', 'ASC')
             			->setParameter('enabled', 1);
             		},
             		'property' => 'label',
             		"label"    => "pi.form.label.field.language",
             		"attr" => array(
             				"class"=>"pi_simpleselect",
             		),
            ))     
            ->add('name', 'text', array(
                    'label' => 'pi.form.label.field.name'
            ))
            ->add('nickname', 'text', array(
                    'label' => 'pi.form.label.field.nickname'
            ))
            ->add('groups','entity', array(
                    'label' => 'pi.form.label.field.usergroup',
 					'class' => 'SfynxAuthBundle:Group',
 					'query_builder' => function(EntityRepository $er) {
 						return $er->createQueryBuilder('k')
 						->select('k')
 						->where('k.enabled = :enabled')
 						->orderBy('k.name', 'ASC')
 						->setParameter('enabled', 1);
 					},
 					'property' => 'name',
 					'multiple'	=> true,
                    'expanded'  => false,
 					'required'  => true,
            ))
            ->add('permissions', 'sfynx_security_permissions', array( 'multiple' => true, 'required' => false))
            ->add('plainPassword', 'repeated', array(
                    'type' => 'password',
                    'options' => array('translation_domain' => 'FOSUserBundle'),
                    'first_options' => array('label' => 'form.password'),
                    'second_options' => array('label' => 'form.password_confirmation'),
                    'invalid_message' => 'fos_user.password.mismatch',
                    'constraints' => array(
                        new Constraints\NotBlank(),
                    ),
            ))
        ;
              
    }


    public function getName()
    {
        return 'fos_user_registration';
    }
}
