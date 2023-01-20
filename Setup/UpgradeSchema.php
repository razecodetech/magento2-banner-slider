<?php

namespace Razecode\Banner\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{

    /**
    * {@inheritdoc}
    */
    public function upgrade(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $installer = $setup;

        $installer->startSetup();

        if (version_compare($context->getVersion(), '1.0.1', '<')) {
            $installer->getConnection()->addColumn(
                $installer->getTable('razecode_banner'),
                'sort_order',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    'length' => 10,
                    'nullable' => true,
                    'comment' => 'Sort Order'
                ]
            );

            $installer->getConnection()->addColumn(
                $installer->getTable('razecode_banner'),
                'link',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => 255,
                    'nullable' => true,
                    'comment' => 'Link'
                ]
            );
        }

        if (version_compare($context->getVersion(), '1.0.3', '<')) {

            if (!$installer->tableExists('razecode_banner_store')) {

                $table = $installer->getConnection()->newTable(
                    $installer->getTable('razecode_banner_store')
                )->addColumn(
                    'slide_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                    null,
                    ['nullable' => false, 'primary' => true],
                    'Slide ID'
                )->addColumn(
                    'store_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                    null,
                    ['unsigned' => true, 'nullable' => false, 'primary' => true],
                    'Store ID'
                )->addIndex(
                    $installer->getIdxName('razecode_banner_store', ['store_id']),
                    ['store_id']
                );
                
                $installer->getConnection()->createTable($table);

            
            }
        }

        if (version_compare($context->getVersion(), '1.0.4', '<')) {
            
            $installer->getConnection()->addColumn(
                $installer->getTable('razecode_banner'),
                'content',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => 255,
                    'nullable' => true,
                    'comment' => 'Content'
                ]
            );
        }

        $installer->endSetup();
    }
}