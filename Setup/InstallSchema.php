<?php

namespace Razecode\Banner\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{

	public function install(
		\Magento\Framework\Setup\SchemaSetupInterface $setup, 
		\Magento\Framework\Setup\ModuleContextInterface $context
	){
		$installer = $setup;
		$installer->startSetup();
		if (!$installer->tableExists('razecode_banner')) {
			$table = $installer->getConnection()->newTable(
				$installer->getTable('razecode_banner')
			)
				->addColumn(
					'slide_id',
					\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
					null,
					[
						'identity' => true,
						'nullable' => false,
						'primary'  => true,
						'unsigned' => true,
					],
					'Slide ID'
				)
				->addColumn(
					'title',
					\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					255,
					['nullable => false'],
					'Slide Title'
				)
				->addColumn(
					'slide_image_desktop',
					\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					255,
					[],
					'Desktop Image'
				)
				->addColumn(
					'slide_image_tablet',
					\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					255,
					[],
					'Tablet Image'
				)
				->addColumn(
					'slide_image_mobile',
					\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					255,
					[],
					'Mobile Image'
				)
				->addColumn(
					'video',
					\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					255,
					[],
					'Video'
				)
				->addColumn(
					'is_active',
					\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
					1,
					[],
					'Slide Status'
				)
				->addColumn(
					'created_at',
					\Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
					null,
					['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
					'Created At'
				)->addColumn(
					'updated_at',
					\Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
					null,
					['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
					'Updated At')
				->setComment('Razecode Banner Table');
			$installer->getConnection()->createTable($table);

			$installer->getConnection()->addIndex(
				$installer->getTable('razecode_banner'),
				$setup->getIdxName(
					$installer->getTable('razecode_banner'),
					['title', 'slide_image_desktop', 'slide_image_tablet', 'slide_image_mobile', 'video'],
					\Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
				),
				['title', 'slide_image_desktop', 'slide_image_tablet', 'slide_image_mobile', 'video'],
				\Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
			);
		}
		$installer->endSetup();
	}
}