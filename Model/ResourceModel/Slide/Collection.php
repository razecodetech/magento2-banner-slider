<?php

namespace Razecode\Banner\Model\ResourceModel\Slide;

use Zend_Db_Expr;

class Collection extends \Magento\Cms\Model\ResourceModel\Page\Collection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'slide_id';
    /**
     * Define resource model.
     */

    /**
     * @var string
     */
    private $queryText;

    /**
     * @var string
     */
    private $storeId;
    
    protected function _construct()
    {
        $this->_init(
            'Razecode\Banner\Model\Slide',
            'Razecode\Banner\Model\ResourceModel\Slide'
        );
        $this->_map['fields']['slide_id'] = 'main_table.slide_id';
        $this->_map['fields']['store'] = 'store_table.store_id';
    }

    /**
     * Perform operations after collection load
     *
     * @return $this
     */
    protected function _afterLoad()
    {
        $result = parent::_afterLoad();
        $this->performAfterLoad('razecode_banner_store', $this->getIdFieldName());
        $this->_previewFlag = false;

        return $result;
    }

    /**
     * Perform operations before rendering filters
     *
     * @return void
     */
    protected function _renderFiltersBefore()
    {
        if ($this->queryText) {
            $allColumns = $this->getFulltextIndexColumns($this, $this->getMainTable());

            $where = 'where';
            foreach ($allColumns as $key => $indexColumns) {
                if ($key > 0) {
                    $where = 'orWhere';
                }
                $this->getSelect()
                    ->{$where}(
                        'MATCH(' . implode(',', $indexColumns) . ') AGAINST(?)',
                        $this->queryText
                    )->order(
                        new Zend_Db_Expr(
                            $this->getConnection()->quoteInto(
                                'MATCH(' . implode(',', $indexColumns) . ') AGAINST(?)',
                                $this->queryText
                            ) . ' desc'
                        )
                    );
            }
        }

        $this->joinStoreRelationTable('razecode_banner_store', $this->getIdFieldName());
    }

        /**
     * @param string $query
     * @return $this
     */
    public function addSearchFilter($query)
    {
        $this->queryText = trim($this->queryText . ' ' . $query);

        return $this;
    }

    /**
     * @return int
     */
    public function getStoreId()
    {
        if ($this->storeId === null) {
            $this->setStoreId($this->storeManager->getStore()->getId());
        }

        return $this->storeId;
    }

    /**
     * @param int $storeId
     * @return $this
     */
    public function setStoreId($storeId)
    {
        if ($storeId instanceof \Magento\Store\Model\Store) {
            $storeId = $storeId->getId();
        }
        $this->storeId = (int)$storeId;

        return $this;
    }

    /**
     * @param $collection
     * @param $indexTable
     * @return array
     */
    protected function getFulltextIndexColumns($collection, $indexTable)
    {
        $indexes = $collection->getConnection()->getIndexList($indexTable);
        $columns = array();
        foreach ($indexes as $index) {
            if (strtoupper($index['INDEX_TYPE']) == 'FULLTEXT') {
                $columns[] = $index['COLUMNS_LIST'];
            }
        }

        return $columns;
    }

}
