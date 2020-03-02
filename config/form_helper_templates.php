<?php

return [
            'number' => '<qfh-text type="{{type}}" name="{{name}}"{{attrs}}></qfh-text>',
            'text' => '<qfh-text type="{{type}}" name="{{name}}"{{attrs}}></qfh-text>',
            'email' => '<qfh-email type="{{type}}" name="{{name}}"{{attrs}}></qfh-email>',
            'password' => '<qfh-password type="{{type}}" name="{{name}}"{{attrs}}></qfh-password>',
            'tel' => '<qfh-tel type="{{type}}" name="{{name}}"{{attrs}}></qfh-tel>',
            'datetime' => '<qfh-datetime type="{{type}}" name="{{name}}"{{attrs}}></qfh-datetime>',
            // Used for button elements in button().
            'button' => '<qfh-button{{attrs}} label="{{text}}"></qfh-button>',
            // Used for checkboxes in checkbox() and multiCheckbox().
            'checkbox' => '<qfh-checkbox name="{{name}}" checked="{{val}}"{{attrs}}></qfh-checkbox>',
            // Input group wrapper for checkboxes created via control().
            'checkboxFormGroup' => '{{label}}',
            // Wrapper container for checkboxes.
            'checkboxWrapper' => '<div class="checkbox">{{label}}</div>',
            // Widget ordering for date/time/datetime pickers.
            'dateWidget' => '{{year}}{{month}}{{day}}{{hour}}{{minute}}{{second}}{{meridian}}',
            // Error message wrapper elements.
            'error' => '<div class="error-message">{{content}}</div>',
            // Container for error items.
            'errorList' => '<ul>{{content}}</ul>',
            // Error item wrapper.
            'errorItem' => '<li>{{text}}</li>',
            // File input used by file().
            'file' => '<input type="file" name="{{name}}"{{attrs}}>',
            // Fieldset element used by allControls().
            'fieldset' => '<fieldset{{attrs}}>{{content}}</fieldset>',
            // Open tag used by create().
            'formStart' => '<form{{attrs}}>',
            // Close tag used by end().
            'formEnd' => '</form>',
            // General grouping container for control(). Defines input/label ordering.
            'formGroup' => '{{label}}{{input}}',
            // Wrapper content used to hide other content.
            'hiddenBlock' => '<div style="display:none;">{{content}}</div>',
            // Generic input element.
            'input' => '<input type="{{type}}" name="{{name}}"{{attrs}}/>',
            // Submit input element.
            'inputSubmit' => '<input type="{{type}}"{{attrs}}/>',
            // Container element used by control().
            'inputContainer' => '<div class="input {{type}}{{required}}">{{content}}</div>',
            // Container element used by control() when a field has an error.
            'inputContainerError' => '<div class="input {{type}}{{required}} error">{{content}}{{error}}</div>',
            // Label element when inputs are not nested inside the label.
            'label' => '<label{{attrs}}>{{text}}</label>',
            // Label element used for radio and multi-checkbox inputs.
            'nestingLabel' => '{{hidden}}<label{{attrs}}>{{input}}{{text}}</label>',
            // Legends created by allControls()
            'legend' => '<legend>{{text}}</legend>',
            // Multi-Checkbox input set title element.
            'multicheckboxTitle' => '<legend>{{text}}</legend>',
            // Multi-Checkbox wrapping container.
            'multicheckboxWrapper' => '<fieldset{{attrs}}>{{content}}</fieldset>',
            // Option element used in select pickers.
            'option' => '{\'label\':\'{{text}}\', \'value\':\'{{value}}\'}',
            // Option group element used in select pickers.
            'optgroup' => '<optgroup label="{{label}}"{{attrs}}>{{content}}</optgroup>',
            // Select element,
            'select' => '<qfh-select name="{{name}}"{{attrs}} :options="{{options}}" value="{{value}}">{{content}}</qfh-select>',
            // Multi-select element,
            'selectMultiple' => '<qfh-multiselect name="{{name}}"{{attrs}} formelementname="{{formelementname}}" :options="{{options}}" value=\'{{value}}\'>{{content}}</qfh-multiselect>',
            // Radio input element,
            'radio' => '<input type="radio" name="{{name}}" value="{{value}}"{{attrs}}>',
            // Wrapping container for radio input/label,
            'radioWrapper' => '{{label}}',
            // Textarea input element,
            'textarea' => '<qfh-textarea type="{{type}}" name="{{name}}"{{attrs}} value="{{value}}"></qfh-textarea>',
            // Container for submit buttons.
            'submitContainer' => '<div class="submit">{{content}}</div>',
            //Confirm javascript template for postLink()
            'confirmJs' => '{{confirm}}',
        ];
