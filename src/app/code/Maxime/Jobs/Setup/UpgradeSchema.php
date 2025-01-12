<?php namespace Maxime\Jobs\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * Upgrades DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        // Action to do if module version is less than 1.0.0.0
        if (version_compare($context->getVersion(), '1.0.0.0') < 0) {

            /**
             * Create table 'maxime_jobs'
             */

            $tableName = $installer->getTable('maxime_job');
            $tableComment = 'Job management on Magento 2';
            $columns = array(
                'entity_id' => array(
                    'type' => Table::TYPE_INTEGER,
                    'size' => null,
                    'options' => array('identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true),
                    'comment' => 'Job Id',
                ),
                'title' => array(
                    'type' => Table::TYPE_TEXT,
                    'size' => 255,
                    'options' => array('nullable' => false, 'default' => ''),
                    'comment' => 'Job Title',
                ),
                'type' => array(
                    'type' => Table::TYPE_TEXT,
                    'size' => 255,
                    'options' => array('nullable' => false, 'default' => ''),
                    'comment' => 'Job Type (CDI, CDD...)',
                ),
                'location' => array(
                    'type' => Table::TYPE_TEXT,
                    'size' => 255,
                    'options' => array('nullable' => false, 'default' => ''),
                    'comment' => 'Job Location',
                ),
                'date' => array(
                    'type' => Table::TYPE_DATE,
                    'size' => null,
                    'options' => array('nullable' => false),
                    'comment' => 'Job date begin',
                ),
                'status' => array(
                    'type' => Table::TYPE_BOOLEAN,
                    'size' => null,
                    'options' => array('nullable' => false, 'default' => 0),
                    'comment' => 'Job status',
                ),
                'description' => array(
                    'type' => Table::TYPE_TEXT,
                    'size' => 2048,
                    'options' => array('nullable' => false, 'default' => ''),
                    'comment' => 'Job description',
                ),
                'department_id' => array(
                    'type' => Table::TYPE_INTEGER,
                    'size' => null,
                    'options' => array('unsigned' => true, 'nullable' => false),
                    'comment' => 'Department linked to the job',
                ),
            );

            $indexes =  array(
                'title',
            );

            $foreignKeys = array(
                'department_id' => array(
                    'ref_table' => 'maxime_department',
                    'ref_column' => 'entity_id',
                    'on_delete' => Table::ACTION_CASCADE,
                )
            );

            /**
             *  We can use the parameters above to create our table
             */

            // Table creation
            $table = $installer->getConnection()->newTable($tableName);

            // Columns creation
            foreach($columns AS $name => $values){
                $table->addColumn(
                    $name,
                    $values['type'],
                    $values['size'],
                    $values['options'],
                    $values['comment']
                );
            }

            // Indexes creation
            foreach($indexes AS $index){
                $table->addIndex(
                    $installer->getIdxName($tableName, array($index)),
                    array($index)
                );
            }

            // Foreign keys creation
            foreach($foreignKeys AS $column => $foreignKey){
                $table->addForeignKey(
                    $installer->getFkName($tableName, $column, $foreignKey['ref_table'], $foreignKey['ref_column']),
                    $column,
                    $foreignKey['ref_table'],
                    $foreignKey['ref_column'],
                    $foreignKey['on_delete']
                );
            }

            // Table comment
            $table->setComment($tableComment);

            // Execute SQL to create the table
            $installer->getConnection()->createTable($table);
        }



        if (version_compare($context->getVersion(), '1.0.0.2') < 0) {

            /**
             * Add full text index to our table department
             */

            $tableName = $installer->getTable('maxime_department');
            $fullTextIntex = array('name'); // Column with fulltext index, you can put multiple fields


            $setup->getConnection()->addIndex(
                $tableName,
                $installer->getIdxName($tableName, $fullTextIntex, \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT),
                $fullTextIntex,
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
            );

            /**
             * Add full text index to our table jobs
             */

            $tableName = $installer->getTable('maxime_job');
            $fullTextIntex = array('title', 'type', 'location', 'description'); // Column with fulltext index, you can put multiple fields


            $setup->getConnection()->addIndex(
                $tableName,
                $installer->getIdxName($tableName, $fullTextIntex, \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT),
                $fullTextIntex,
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
            );

        }


        if (version_compare($context->getVersion(), '1.0.0.4') < 0) {

                /**
                 * Create table 'maxime_news'
                 */
                $newsTableName = $installer->getTable('maxime_news');
                $newsTableComment = 'News Management Table';
                $newsColumns = [
                    'entity_id' => [
                        'type' => Table::TYPE_INTEGER,
                        'size' => null,
                        'options' => ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                        'comment' => 'News ID',
                    ],
                    'title' => [
                        'type' => Table::TYPE_TEXT,
                        'size' => 255,
                        'options' => ['nullable' => false, 'default' => ''],
                        'comment' => 'News Title',
                    ],
                    'content' => [
                        'type' => Table::TYPE_TEXT,
                        'size' => 2048,
                        'options' => ['nullable' => false, 'default' => ''],
                        'comment' => 'News Content',
                    ],
                    'status' => [
                        'type' => Table::TYPE_BOOLEAN,
                        'size' => null,
                        'options' => ['nullable' => false, 'default' => 1],
                        'comment' => 'News Status (Enabled/Disabled)',
                    ],

                ];

                $newsIndexes = ['title'];

                $newsTable = $installer->getConnection()->newTable($newsTableName);

                // Add columns to news table
                foreach ($newsColumns as $name => $values) {
                    $newsTable->addColumn(
                        $name,
                        $values['type'],
                        $values['size'],
                        $values['options'],
                        $values['comment']
                    );
                }

                // Add indexes to news table
                foreach ($newsIndexes as $index) {
                    $newsTable->addIndex(
                        $installer->getIdxName($newsTableName, [$index]),
                        [$index]
                    );
                }

                // Set table comment and create the table
                $newsTable->setComment($newsTableComment);
                $installer->getConnection()->createTable($newsTable);

                /**
                 * Create pivot table 'maxime_department_news'
                 */
                $pivotTableName = $installer->getTable('maxime_department_news');
                $pivotTableComment = 'Pivot Table between Departments and News';
                $pivotColumns = [
                    'department_id' => [
                        'type' => Table::TYPE_INTEGER,
                        'size' => null,
                        'options' => ['unsigned' => true, 'nullable' => false],
                        'comment' => 'Department ID',
                    ],
                    'news_id' => [
                        'type' => Table::TYPE_INTEGER,
                        'size' => null,
                        'options' => ['unsigned' => true, 'nullable' => false],
                        'comment' => 'News ID',
                    ],
                ];

                $pivotIndexes = [
                    ['fields' => ['department_id', 'news_id'], 'type' => 'unique'],
                ];

                $pivotForeignKeys = [
                    'department_id' => [
                        'ref_table' => 'maxime_department',
                        'ref_column' => 'entity_id',
                        'on_delete' => Table::ACTION_CASCADE,
                    ],
                    'news_id' => [
                        'ref_table' => 'maxime_news',
                        'ref_column' => 'entity_id',
                        'on_delete' => Table::ACTION_CASCADE,
                    ],
                ];

                $pivotTable = $installer->getConnection()->newTable($pivotTableName);

                // Add columns to pivot table
                foreach ($pivotColumns as $name => $values) {
                    $pivotTable->addColumn(
                        $name,
                        $values['type'],
                        $values['size'],
                        $values['options'],
                        $values['comment']
                    );
                }

                // Add indexes to pivot table
                foreach ($pivotIndexes as $index) {
                    $pivotTable->addIndex(
                        $installer->getIdxName($pivotTableName, $index['fields'], $index['type']),
                        $index['fields'],
                        ['type' => $index['type']]
                    );
                }

                // Add foreign keys to pivot table
                foreach ($pivotForeignKeys as $column => $foreignKey) {
                    $pivotTable->addForeignKey(
                        $installer->getFkName($pivotTableName, $column, $foreignKey['ref_table'], $foreignKey['ref_column']),
                        $column,
                        $installer->getTable($foreignKey['ref_table']),
                        $foreignKey['ref_column'],
                        $foreignKey['on_delete']
                    );
                }

                // Set table comment and create the table
                $pivotTable->setComment($pivotTableComment);
                $installer->getConnection()->createTable($pivotTable);
        }

        if (version_compare($context->getVersion(), '1.0.0.5') < 0) {

            /**
             * Add full text index to our table department
             */

            $tableName = $installer->getTable('maxime_news');
            $fullTextIntex = array('title', 'content'); // Column with fulltext index, you can put multiple fields


            $setup->getConnection()->addIndex(
                $tableName,
                $installer->getIdxName($tableName, $fullTextIntex, \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT),
                $fullTextIntex,
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
            );
        }

        if (version_compare($context->getVersion(), '1.0.0.7') < 0) {
            $connection = $setup->getConnection();
            $tableName = $setup->getTable('maxime_department');

            if (!$connection->tableColumnExists($tableName, 'parent_id')) {
                $connection->addColumn(
                    $tableName,
                    'parent_id',
                    [
                        'type' => Table::TYPE_INTEGER,
                        'nullable' => true,
                        'unsigned' => true,
                        'comment' => 'Parent Department ID',
                        'default' => null
                    ]
                );


                $connection->addForeignKey(
                    $setup->getFkName('maxime_department', 'parent_id', 'maxime_department', 'entity_id'),
                    $tableName,
                    'parent_id',
                    $tableName,
                    'entity_id',
                    Table::ACTION_SET_NULL
                );
            }
        }



        $installer->endSetup();
    }
}
