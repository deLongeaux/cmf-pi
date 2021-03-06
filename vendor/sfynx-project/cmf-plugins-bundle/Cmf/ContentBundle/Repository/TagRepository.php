<?php
/**
 * This file is part of the <Gedmo> project.
 *
 * @category   Gedmo_Repositories
 * @package    Repository
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-07-31
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Cmf\ContentBundle\Repository;

use Doctrine\ORM\EntityRepository;
use BootStrap\TranslationBundle\Repository\TranslationRepository;

/**
 * Team Repository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 * 
 * @category   Gedmo_Repositories
 * @package    Repository
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class TagRepository extends TranslationRepository
{
    /**
     * List of all elements with this tag
     *
     * @var $tag
     * @access  public
     */
    public function listElementWithThisTag($title) {
        // recupération du tag par son title
    }

    public function getTagByTitle($title) {
        return $this->createQueryBuilder('p')
                    ->where('p.title = :title')
                    ->andWhere('p.isEnabled = :enabled')
                    ->setParameters(array('title' => $title, 'enabled'=>true));
    }

    //liste des article rattachés au tag
    //@var $id : l'identifiant du tag
    //TODO : a implementer
    private function listArticleWithThisTag($id) {

    }

    //liste des diaporama rattachés au tag
    //@var $id : l'identifiant du tag
    //TODO : a implementer
    private function listDiaporamaWithThisTag($id) {

    }

}