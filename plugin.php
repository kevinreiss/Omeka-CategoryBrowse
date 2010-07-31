<?php

/*
 * CategoryBrowse.php
 * 
 * Test Class to Slugify Omeka Element Values
 * Kevin Reiss
 * 
 * As suggested by Patrick Murray-John on Omeka-dev
 * see http://groups.google.com/group/omeka-dev/browse_thread/thread/80149f3e98c61861
 * To Do:
 * 
 * 1. Incorporate Selected Browsing Element in "Browse" Results display contextual
 * 2. Add pagination to results
 * 3. Add order by alpah to results
 * 4. Improve slug creation routine to handle library punctuation
 * 5. Think about how to automatically build this into the theme using plugin hook
 * 6. Where does the user selection option need to live?
 * 
 */

add_plugin_hook('install', 'category_browse_install');
add_plugin_hook('uninstall', 'category_browse_uninstall');
add_plugin_hook('define_routes', 'category_browse_define_routes');

function category_browse_install() {
	
}

function category_browse_uninstall() {
	
}

function category_browse_define_routes($router)
{
     $router->addRoute(
         'category_browse_elbrowse_browse',
         new Zend_Controller_Router_Route(
             'categories/browse/:elset/:elname/:eltext',
             array(
                 'module'       => 'category-browse',
                 'controller'   => 'browse',
                 'action'       => 'browse'
             )
         )
     );

     $router->addRoute(
         'category_browse_elbrowse_list',
         new Zend_Controller_Router_Route(
             'categories/list/:elset/:elname/:page',
             array(
                 'module'       => 'category-browse',
                 'controller'   => 'browse',
                 'action'       => 'list',
                 'page'         => 1
             ),
             array('page' => '\d+')
         )
     );

}


?>
