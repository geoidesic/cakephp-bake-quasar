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

use Bake\Shell\Task\BakeTemplateTask as BaseBakeTemplateTask;
use Bake\View\BakeView;
use Cake\Console\Shell;
use Cake\Core\ConventionsTrait;
use Cake\Event\Event;
use Cake\Event\EventManager;
use Cake\Http\Response;
use Cake\Http\ServerRequest as Request;
use Cake\View\Exception\MissingTemplateException;
use Cake\View\ViewVarsTrait;

/**
 * Used by other tasks to generate templated output, Acts as an interface to BakeView
 */
class BakeTemplateTask extends BaseBakeTemplateTask
{
   
    /**
     * Override t use QuasarAdmin.Bake
     */
    public function getView()
    {
        if ($this->View) {
            return $this->View;
        }

        $theme = isset($this->params['theme']) ? $this->params['theme'] : '';

        $viewOptions = [
            'helpers' => [
                'QuasarAdmin.Bake',
                'Bake.DocBlock'
            ],
            'theme' => $theme
        ];

        $view = new BakeView(new Request(), new Response(), null, $viewOptions);
        $event = new Event('Bake.initialize', $view);
        EventManager::instance()->dispatch($event);
        /** @var \Bake\View\BakeView $view */
        $view = $event->getSubject();
        $this->View = $view;

        return $this->View;
    }
}
