<?php

namespace QuasarAdmin\View\Helper;

use Cake\View\Helper\FormHelper;
use App\View\AppView as View;
use Cake\Utility\Inflector;

class QuasarFormHelper extends FormHelper
{
    /**
     * Construct the widgets and binds the default context providers
     *
     * @param \Cake\View\View $View The View this helper is being attached to.
     * @param array $config Configuration settings for the helper.
     */
    public function __construct(View $view, array $config = [])
    {
        // $config['templates']
        parent::__construct($view, $config);

    }

    /**
     * Render a named widget.
     *
     * This is a lower level method. For built-in widgets, you should be using
     * methods like `text`, `hidden`, and `radio`. If you are using additional
     * widgets you should use this method render the widget without the label
     * or wrapping div.
     *
     * @param string $name The name of the widget. e.g. 'text'.
     * @param array $data The data to render.
     * @return string
     */
    public function widget($name, array $data = [])
    {
        $secure = null;
        if (isset($data['secure'])) {
            $secure = $data['secure'];
            unset($data['secure']);
        }

        $widget = $this->_locator->get($name);
        if ($name == 'text') {
            // print_r($widget);
        }

        $out = $widget->render($data, $this->context());
        if (isset($data['name']) && $secure !== null && $secure !== self::SECURE_SKIP) {
            foreach ($widget->secureFields($data) as $field) {
                $this->_secure($secure, $this->_secureFieldName($field));
            }
        }

        return $out;
    }

}


