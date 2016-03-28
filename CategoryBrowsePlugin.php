<?php
/**
 * Category Browse
 *
 * Enables browsing of Omeka Content by element set, element name, and element
 * text value.
 *
 * @copyright Kevin Reiss, 2010
 * @copyright Daniel Berthereau, 2016
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @package CategoryBrowse
 */

/**
 * CategoryBrowsePlugin.php
 *
 * Test Class to Slugify Omeka Element Values
 * Kevin Reiss
 *
 * As suggested by Patrick Murray-John on Omeka-dev
 * see http://groups.google.com/group/omeka-dev/browse_thread/thread/80149f3e98c61861
 *
 * To Do:
 * 1. Incorporate Selected Browsing Element in "Browse" Results display contextual
 * 2. Add pagination to results
 * 3. Add order by alpah to results
 * 4. Improve slug creation routine to handle library punctuation
 * 5. Think about how to automatically build this into the theme using plugin hook
 * 6. Where does the user selection option need to live?
 */

/**
 * The Category Browse plugin.
 * @package Omeka\Plugins\CategoryBrowse
 */
class CategoryBrowsePlugin extends Omeka_Plugin_AbstractPlugin
{
    /**
     * @var array Hooks for the plugin.
     */
    protected $_hooks = array(
        'define_routes',
    );

    /**
     * Defines public routes
     *
     * @return void
     */
    public function hookDefineRoutes($args)
    {
        $router = $args['router'];
        $router->addRoute(
             'category_browse_elbrowse_browse',
             new Zend_Controller_Router_Route(
                 'categories/browse/:elset/:elname/:eltext',
                 array(
                     'module' => 'category-browse',
                     'controller' => 'browse',
                     'action' => 'browse',
                 )
             )
         );

         $router->addRoute(
             'category_browse_elbrowse_list',
             new Zend_Controller_Router_Route(
                 'categories/list/:elset/:elname',
                 array(
                     'module' => 'category-browse',
                     'controller' => 'browse',
                     'action' => 'list',
                 )
             )
         );
    }
}
