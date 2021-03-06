<?php
/**
 * This file is part of the <Template> project.
 *
 * @category   Template
 * @package    DependencyInjection
 * @subpackage Configuration
 * @author     Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @copyright  2015 PI-GROUPE
 * @license    http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version    2.3
 * @link       http://opensource.org/licenses/gpl-license.php
 * @since      2015-02-16
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Sfynx\TemplateBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 * 
 * @category   Template
 * @package    DependencyInjection
 * @subpackage Configuration
 * @author     Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @copyright  2015 PI-GROUPE
 * @license    http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version    2.3
 * @link       http://opensource.org/licenses/gpl-license.php
 * @since      2015-02-16
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('sfynx_template');
        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.
        $this->addFormConfig($rootNode);

        return $treeBuilder;
    }

    /**
     * Form config
     *
     * @param $rootNode \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition
     *
     * @return void
     * @access protected
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    protected function addFormConfig(ArrayNodeDefinition $rootNode)
    {
    	$rootNode
        ->children()
            ->arrayNode('form')
                ->addDefaultsIfNotSet()                    
                ->children()
                
                    ->booleanNode('show_legend')->defaultValue(true)->end()
                    ->booleanNode('show_child_legend')->defaultValue(false)->end()
                    ->scalarNode('error_type')->defaultValue('inline')->cannotBeEmpty()->end()
                    ->booleanNode('render_fieldset')->defaultValue(true)->end()     
                    ->booleanNode('render_required_asterisk')->defaultValue(false)->end()
                    ->booleanNode('render_optional_text')->defaultValue(true)->end()
                    ->booleanNode('errors_on_forms')->defaultValue(false)->end()
                    ->scalarNode('checkbox_label')->defaultValue('both')->end()
                    ->arrayNode('tooltip')
                        ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('icon')
                                ->defaultValue('icon-info-sign')
                            ->end()
                            ->scalarNode('placement')
                                ->defaultValue('top')
                            ->end()
                        ->end()
                    ->end()                
                
                ->end()
            ->end()
    	->end();
    } 

}