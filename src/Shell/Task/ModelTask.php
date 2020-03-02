<?php
/**
 * Quasar Admin Bake Theme
 */
namespace QuasarAdmin\Shell\Task;

use Bake\Shell\Task\ModelTask as BaseModelTask;
use Cake\Console\Shell;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\Utility\Inflector;

/**
 * Task class for generating model files.
 *
 * @property \Bake\Shell\Task\FixtureTask $Fixture
 * @property \Bake\Shell\Task\BakeTemplateTask $BakeTemplate
 * @property \Bake\Shell\Task\TestTask $Test
 */
class ModelTask extends BaseModelTask
{

    /**
     * Override to add in extension baking for models, controllers and views
     */
    public function bake($name)
    {
        $table = $this->getTable($name);
        $tableObject = $this->getTableObject($name, $table);
        $data = $this->getTableContext($tableObject, $table, $name);
        $this->bakeTable($tableObject, $data);
        $this->bakeEntity($tableObject, $data);
        $this->bakeFixture($tableObject->getAlias(), $tableObject->getTable());
        $this->bakeTest($tableObject->getAlias());
        $this->bakeTableExtension($tableObject, $data);
        $this->bakeTableMain($tableObject, $data);
    }

    /**
     * Override in order to:
     * 1. add in searchPluginLoaded and searchField values
     * 2. alter the write path for baked models
     */
    public function bakeTable($model, array $data = [])
    {
        if (!empty($this->params['no-table'])) {
            return null;
        }

        $namespace = Configure::read('App.namespace');
        $pluginPath = '';
        if ($this->plugin) {
            $namespace = $this->_pluginNamespace($this->plugin);
        }

        $name = $model->getAlias();
        $entity = $this->_entityName($model->getAlias());

        $schema = $model->getSchema();
        $searchField = null;
        if (in_array('name', $schema->columns())) {
            $searchField = 'name';
        }
        if (in_array('title', $schema->columns())) {
            $searchField = 'title';
        }
        $searchPluginLoaded = \Cake\Core\Plugin::isLoaded('Search');

        $data += [
            'plugin' => $this->plugin,
            'pluginPath' => $pluginPath,
            'namespace' => $namespace,
            'name' => $name,
            'entity' => $entity,
            'associations' => [],
            'primaryKey' => 'id',
            'displayField' => null,
            'table' => null,
            'validation' => [],
            'rulesChecker' => [],
            'behaviors' => [],
            'connection' => $this->connection,
            'searchPluginLoaded' => $searchPluginLoaded,
            'searchField' => $searchField,
        ];

        $this->BakeTemplate->set($data);
        $out = $this->BakeTemplate->generate('Model/table');

        $path = $this->getPath();
        $filename = $path . 'Table' . DS . 'Baked' . DS . $name . 'Table.php';
        $this->out("\n" . sprintf('Baking table class for %s...', $name), 1, Shell::QUIET);
        $this->createFile($filename, $out);

        // Work around composer caching that classes/files do not exist.
        // Check for the file as it might not exist in tests.
        if (file_exists($filename)) {
            require_once $filename;
        }
        TableRegistry::getTableLocator()->clear();

        $emptyFile = $path . 'Table' . DS . 'empty';
        $this->_deleteEmptyFile($emptyFile);

        # since the app requires the baked models to be extended, check if extension exists and create it if not

        return $out;
    }

    public function bakeTableMain($model, array $data = [])
    {
        if (!empty($this->params['no-table'])) {
            return null;
        }

        $namespace = Configure::read('App.namespace');
        $pluginPath = '';
        if ($this->plugin) {
            $namespace = $this->_pluginNamespace($this->plugin);
        }

        $name = $model->getAlias();
        $entity = $this->_entityName($model->getAlias());

        $schema = $model->getSchema();
        $searchField = null;
        if (in_array('name', $schema->columns())) {
            $searchField = 'name';
        }
        if (in_array('title', $schema->columns())) {
            $searchField = 'title';
        }
        $searchPluginLoaded = \Cake\Core\Plugin::isLoaded('Search');

        $data += [
            'plugin' => $this->plugin,
            'pluginPath' => $pluginPath,
            'namespace' => $namespace,
            'name' => $name,
            'entity' => $entity,
            'associations' => [],
            'primaryKey' => 'id',
            'displayField' => null,
            'table' => null,
            'validation' => [],
            'rulesChecker' => [],
            'behaviors' => [],
            'connection' => $this->connection,
            'searchPluginLoaded' => $searchPluginLoaded,
            'searchField' => $searchField,
        ];

        $this->BakeTemplate->set($data);
        $out = $this->BakeTemplate->generate('Model/main');

        $path = $this->getPath();
        $filename = $path . 'Table' . DS . $name . 'Table.php';

        $this->out("\n" . sprintf('Baking table class for %s...', $name), 1, Shell::QUIET);
        $this->createFile($filename, $out);

        // Work around composer caching that classes/files do not exist.
        // Check for the file as it might not exist in tests.
        if (file_exists($filename)) {
            require_once $filename;
        }
        TableRegistry::getTableLocator()->clear();

        $emptyFile = $path . 'Table' . DS . 'empty';
        $this->_deleteEmptyFile($emptyFile);

        # since the app requires the baked models to be extended, check if extension exists and create it if not

        return $out;
    }

    public function bakeTableExtension($model, array $data = [])
    {
        if (!empty($this->params['no-table'])) {
            return null;
        }

        $namespace = Configure::read('App.namespace');
        $pluginPath = '';
        if ($this->plugin) {
            $namespace = $this->_pluginNamespace($this->plugin);
        }

        $name = $model->getAlias();
        $entity = $this->_entityName($model->getAlias());

        $schema = $model->getSchema();
        $searchField = null;
        if (in_array('name', $schema->columns())) {
            $searchField = 'name';
        }
        if (in_array('title', $schema->columns())) {
            $searchField = 'title';
        }
        $searchPluginLoaded = \Cake\Core\Plugin::isLoaded('Search');

        $data += [
            'plugin' => $this->plugin,
            'pluginPath' => $pluginPath,
            'namespace' => $namespace,
            'name' => $name,
            'entity' => $entity,
            'associations' => [],
            'primaryKey' => 'id',
            'displayField' => null,
            'table' => null,
            'validation' => [],
            'rulesChecker' => [],
            'behaviors' => [],
            'connection' => $this->connection,
            'searchPluginLoaded' => $searchPluginLoaded,
            'searchField' => $searchField,
        ];

        $this->BakeTemplate->set($data);
        $out = $this->BakeTemplate->generate('Model/extension');

        $path = $this->getPath();
        $filename = $path . 'Table' . DS . 'Extension' . DS . $name . 'Table.php';

        # Check if file exists and return if so
        $exists = file_exists($filename);
        if ($exists) {
            return null;
        }

        $this->out("\n" . sprintf('Baking table class for %s...', $name), 1, Shell::QUIET);
        $this->createFile($filename, $out);

        // Work around composer caching that classes/files do not exist.
        // Check for the file as it might not exist in tests.
        if (file_exists($filename)) {
            require_once $filename;
        }
        TableRegistry::getTableLocator()->clear();

        $emptyFile = $path . 'Table' . DS . 'empty';
        $this->_deleteEmptyFile($emptyFile);

        # since the app requires the baked models to be extended, check if extension exists and create it if not

        return $out;
    }

    /**
     * Override to only add in the belongsTo association if it is found, preventing errors when it's not.
     */
    public function findBelongsTo($model, array $associations)
    {
        $schema = $model->getSchema();
        foreach ($schema->columns() as $fieldName) {
            if (!preg_match('/^.+_id$/', $fieldName) || ([$fieldName] === $schema->primaryKey())) {
                continue;
            }

            if ($fieldName === 'parent_id') {
                $className = ($this->plugin) ? $this->plugin . '.' . $model->getAlias() : $model->getAlias();
                $assoc = [
                    'alias' => 'Parent' . $model->getAlias(),
                    'className' => $className,
                    'foreignKey' => $fieldName,
                ];
                $found = true;

            } else {
                $tmpModelName = $this->_modelNameFromKey($fieldName);
                if (!in_array(Inflector::tableize($tmpModelName), $this->_tables)) {
                    $found = $this->findTableReferencedBy($schema, $fieldName);
                    if ($found) {
                        $tmpModelName = Inflector::camelize($found);
                    }
                } else {
                    $found = true;
                }

                $assoc = [
                    'alias' => $tmpModelName,
                    'foreignKey' => $fieldName,
                ];
                if ($schema->getColumn($fieldName)['null'] === false) {
                    $assoc['joinType'] = 'INNER';
                }
            }

            if ($this->plugin && empty($assoc['className'])) {
                $assoc['className'] = $this->plugin . '.' . $assoc['alias'];
            }

            # don't add associations for tables that don't exist
            if ($found) {
                $associations['belongsTo'][] = $assoc;
            }

        }

        return $associations;
    }

    /**
     * Override to detect self-referencing M2M
     */
    public function findBelongsToMany($model, array $associations)
    {
        $schema = $model->getSchema();
        $tableName = $schema->name();
        $foreignKey = $this->_modelKey($tableName);
        $tables = $this->listAll();

        foreach ($tables as $otherTableName) {
            $assocTable = null;
            $offset = strpos($otherTableName, $tableName . '_');
            $otherOffset = strpos($otherTableName, '_' . $tableName);

            if ($offset !== false) {
                $assocTable = substr($otherTableName, strlen($tableName . '_'));
            } elseif ($otherOffset !== false) {
                $assocTable = substr($otherTableName, 0, $otherOffset);
            }

            # detect self-referencing many-to-many
            if ($offset !== false && $otherOffset !== false) {
                $model = $this->getTableObject($this->_camelize($otherTableName), $otherTableName);
                $assocTable = false;
                $schema = $model->getSchema();

                foreach ($model->getSchema()->columns() as $key => $column) {
                    if ($assocTable) {
                        break;
                    }
                    if ($column !== 'id' && $column !== $tableName . '_id') {
                        $assocTable = Inflector::pluralize(substr($column, 0, strpos($column, '_')));
                        $habtmName = $this->_camelize($assocTable);
                        $assoc = [
                            'alias' => $habtmName,
                            'className' => $this->_camelize($tableName),
                            'foreignKey' => $foreignKey,
                            'targetForeignKey' => $this->_modelKey($habtmName),
                            'joinTable' => $otherTableName,
                        ];
                        if ($assoc && $this->plugin) {
                            $assoc['className'] = $this->plugin . '.' . $assoc['alias'];
                        }
                        $associations['belongsToMany'][] = $assoc;
                    }
                }
            }
            if ($assocTable && in_array($assocTable, $tables)) {
                $habtmName = $this->_camelize($assocTable);
                $assoc = [
                    'alias' => $habtmName,
                    'foreignKey' => $foreignKey,
                    'targetForeignKey' => $this->_modelKey($habtmName),
                    'joinTable' => $otherTableName,
                ];
                if ($assoc && $this->plugin) {
                    $assoc['className'] = $this->plugin . '.' . $assoc['alias'];
                }
                $associations['belongsToMany'][] = $assoc;
            }
        }
        return $associations;
    }

    /**
     * Override to add in Search plugin
     */
    public function getBehaviors($model)
    {
        $behaviors = [];
        $schema = $model->getSchema();
        $fields = $schema->columns();
        if (empty($fields)) {
            return [];
        }
        if (in_array('created', $fields) || in_array('modified', $fields)) {
            $behaviors['Timestamp'] = [];
        }

        if (in_array('lft', $fields) && $schema->getColumnType('lft') === 'integer' &&
            in_array('rght', $fields) && $schema->getColumnType('rght') === 'integer' &&
            in_array('parent_id', $fields)
        ) {
            $behaviors['Tree'] = [];
        }

        $counterCache = $this->getCounterCache($model);
        if (!empty($counterCache)) {
            $behaviors['CounterCache'] = $counterCache;
        }

        if (\Cake\Core\Plugin::isLoaded('Search')) {
            $behaviors['Search.Search'] = [];
        }

        return $behaviors;
    }
}
