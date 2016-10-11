<?php

/**
 * @author Matthew Cooper
 * @author Matthew Cooper <matthew.cooper@thedailyedited.com>
 */
namespace Tde\Press\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        /**
         * Prepare database before module installation
         */
        $setup->startSetup();

        /**
         * Create table 'tde_stock_notifications'
         */
        $table = $setup->getConnection()->newTable(
            $setup->getTable('tde_press')
        )->addColumn(
            'entity_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
            'Press Id'
        )->addColumn(
            'title',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            128,
            [],
            'Press article title'
        )->addColumn(
            'release_date',
            \Magento\Framework\DB\Ddl\Table::TYPE_DATE,
            null,
            ['nullable' => false],
            'The press article\'s release date'
        )->addColumn(
            'thumbnail',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            256,
            ['nullable' => false],
            'Thumbnail image path'
        )->addColumn(
            'images',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            '1M',
            ['nullable' => false],
            'Press content'
        )->addColumn(
            'description',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            '1M',
            ['nullable' => false],
            'Press release description'
        )->addColumn(
            'is_active',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            1,
            ['nullable' => false, 'default' => 0],
            'Is press release published'
        )->addColumn(
            'created_at',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
            'Created At'
        )->addColumn(
            'update_time',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
            'Press release modification time'
        )->addIndex(
            $setup->getIdxName('tde_press', ['is_active']),
            ['is_active']
        )->setComment(
            'Tde press release data'
        );
        $setup->getConnection()->createTable($table);
        $setup->endSetup();
    }
}
