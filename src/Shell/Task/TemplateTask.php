<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.1.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace QuasarAdmin\Shell\Task;

use Bake\Shell\Task\TemplateTask as BaseTemplateTask;
use Bake\Utility\Model\AssociationFilter;
use Cake\Console\Shell;
use Cake\Core\App;
use Cake\Core\Configure;
use Cake\Datasource\EntityInterface;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Utility\Inflector;

/**
 * Task class for creating and updating view template files.
 *
 * @property \Bake\Shell\Task\ModelTask $Model
 * @property \Bake\Shell\Task\BakeTemplateTask $BakeTemplate
 */
class TemplateTask extends BaseTemplateTask
{
    /**
     * Tasks to be loaded by this Task
     *
     * @var array
     */
    public $tasks = [
        'QuasarAdmin.Model',
        'QuasarAdmin.BakeTemplate'
    ];

    public $pathFragment = 'Template/Baked/';
    /**
     * Override to set baked path
     */
    public function initialize()
    {
        $this->path = current(App::path('Template/Baked'));
    }

    /**
     * Override to also write to Extension path
     */
    public function bake($template, $content = '', $outputFile = null) {
        $content = parent::bake($template, $content, $outputFile);
        if ($outputFile === null) {
            $outputFile = $template;
        }
        $path = $this->getPath();
        $filename = str_replace('Baked', 'Extension', $path) . Inflector::underscore($outputFile) . '.ctp';
        if (!file_exists($filename)) {
            $extendedContent = <<<EOD
<?php
    include str_replace('Extension', 'Baked', __FILE__);
?>            
EOD;
            $this->createFile($filename, $extendedContent);
        }
        return $content;
    }
}
