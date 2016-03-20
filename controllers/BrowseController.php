<?php
/**
 * Enables browsing of element values by element name and element text
 *
 * @package CategoryBrowse
 */
class CategoryBrowse_BrowseController extends Omeka_Controller_AbstractActionController
{
    protected $_autoCsrfProtection = true;

    protected $_browseRecordsPerPage = 100;

    public function init()
    {
        $this->_helper->db->setDefaultModelName('ElementText');
    }

	public function browseAction()
    {
        $db = $this->_helper->db;
        $itemTable = $db->getTable('Item');
        $elementTextTable = $db->getTable('ElementText');
        $elementTable = $db->getTable('Element');

        $elementSetName = $this->_unslugify($this->_getParam('elset'));
        $elementName = $this->_unslugify($this->_getParam('elname'));
        $el = $elementTable->findByElementSetNameAndElementName($elementSetName, $elementName);

        $elementText = urldecode($this->_getParam('eltext'));
        $select = $elementTextTable->getSelect()
            ->where('text = ? ', $elementText)
            ->where('element_id = ?', $el->id);
        $elTexts = $elementTextTable->fetchObjects($select);

        $records = array();
        foreach($elTexts as $elText) {
       		$records[] = $itemTable->find($elText->record_id);
        }

        $this->view->assign(array(
            'items' => $records,
            'eltext' => $elementText,
            'element' => $el,
        ));
    }

    public function listAction()
    {
        $db = $this->_helper->db;
        $elementTextTable = $db->getTable('ElementText');
        $elementTable = $db->getTable('Element');

        $elementSetName = $this->_unslugify($this->_getParam('elset'));
        $elementName = $this->_unslugify($this->_getParam('elname'));
        $el = $elementTable->findByElementSetNameAndElementName($elementSetName, $elementName);

        // Get the records filtered to Omeka_Db_Table::applySearchFilters().
        $params = array(
            'element_id' => $el->id,
            'sort_field' => 'text',
            'sort_dir' => 'a',
        );
        $recordsPerPage = $this->_getBrowseRecordsPerPage();
        $currentPage = $this->getParam('page', 1);

        $select = $db->getSelectForFindBy($params);
        $select->group('text');
        $totalRecords = get_db()->query($select)->rowCount();
        if ($currentPage) {
            $select->limitPage($currentPage, $recordsPerPage);
        } else {
            $select->limit($recordsPerPage);
        }
        $elTexts = $elementTextTable->fetchObjects($select);

        //$sortedTexts = $elTexts->getSelect()->findByElement($el->id)->order('text');
        release_object($el);

        // Add pagination data to the registry. Used by pagination_links().
        if ($recordsPerPage) {
            Zend_Registry::set('pagination', array(
                'page' => $currentPage,
                'per_page' => $recordsPerPage,
                'total_results' => $totalRecords,
            ));
        }

        $this->view->assign(array(
            'elTexts' => $elTexts,
            'elset' => $elementSetName,
            'elname' => $elementName,
            'total_results' => $totalRecords,
        ));
     }

    protected function _getBrowseDefaultSort()
    {
        return array('added', 'd');
    }

     private function _unslugify($param)
     {
         return ucwords(str_replace('-', ' ', $param));
     }
}
