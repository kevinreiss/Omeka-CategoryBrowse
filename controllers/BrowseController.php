<?php

/* 
 * CategoryBrowse_ElbrowseController.php
 * 
 * Enables browsing of element values by element name and element text
 */

class CategoryBrowse_BrowseController extends Omeka_Controller_Action
{
	public function browseAction()
    {
     	$elementTextTable = $this->getDb()->getTable('ElementText');
       	$itemTable = $this->getDb()->getTable('Item');
        $elementText = urldecode($this->_getParam('eltext'));
        $elementSetName = $this->_unslugify($this->_getParam('elset'));
        $elementName = $this->_unslugify($this->_getParam('elname'));
        $el = $this->getDb()->getTable('Element')->findByElementSetNameAndElementName($elementSetName, $elementName);
        $select = $elementTextTable->getSelect()->where('text = ? ', $elementText)->where('element_id = ?', $el->id);
          
        release_object($el);
        $elTexts = $elementTextTable->fetchObjects($select);

        $records = array();
        foreach($elTexts as $elText) {
       		$records[] = $itemTable->find($elText->record_id);
        }

        $this->view->assign(array('items'=>$records, 'eltext'=>$elementText));

    }

    public function listAction()
    {
         
    	 $elementSetName = $this->_getParam('elset');
         $elementName = $this->_getParam('elname');
         $curPage = $this->_getParam('page');
         $elementTextTable = $this->getDb()->getTable('ElementText');
         $el = $this->getDb()->getTable('Element')->findByElementSetNameAndElementName($this->_unslugify($elementSetName), $this->_unslugify($elementName));
         //$elTexts = $this->getDb()->getTable('ElementText')->findByElement($el->id);
         $select = $elementTextTable->getSelect()->where('element_id = ?', $el->id)->order('text')->group('text');
         
         $elTexts = $elementTextTable->fetchObjects($select);
         //$sortedTexts = $elTexts->getSelect()->findByElement($el->id)->order('text');
       	 $totalCategories = count($elTexts);
         release_object($el);
         
         // set-up pagination routine
         $paginationUrl = $this->getRequest()->getBaseUrl().'/categories/list/' . $elementSetName . '/' . $elementName . "/";
         /*
         $pageAdapter = new Zend_Paginator_Adapter_DbSelect($elementTextTable->getSelect()->where('element_id = ?', $el->id)->order('text')->group('text'));
         */
         $paginator = Zend_Paginator::factory($select);
         $paginator->setItemCountPerPage(20);
         //$totalCategories = count($paginator);
         $paginator->setCurrentPageNumber($curPage);
         $this->view->paginator = $paginator;
           //Serve up the pagination
         // add other pagination items
         $pagination = array(
                            'page'          => $curPage, 
                            'per_page'      => 20, 
                            'total_results' => $totalCategories, 
                            'link'          => $paginationUrl);
        
         
         Zend_Registry::set('pagination', $pagination);
         //$this->view->assign(array('texts'=>$elTexts, 'elset'=>$elementSetName, 'elname'=>$elementName, 'total_results'=>$totalCategories));
		$this->view->assign(array('elset'=>$elementSetName, 'elname'=>$elementName, 'total_results'=>$totalCategories));
     }

     private function _unslugify($param)
     {
         return ucwords(str_replace("-", " ", $param) );
     }
}

?>
