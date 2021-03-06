# cakephp-bake-quasar
A CakePHP plugin that integrates the Quasar UI framework (based on Vue.js) into the baked admin scaffolding for your application.


## Installation

You can install this plugin into your CakePHP application using [composer](https://getcomposer.org).

The recommended way to install composer packages is:

```
composer require arc2/QuasarAdmin
```

UPDATE: the above won't work because it's not on packagist yet.
To install manually:
1. Copy the QuasarAdmin folder into your CakePhp plugins folder
1. Load the plugin: `bin/cake plugin load QuasarAdmin`
1. Follow the `How to use it` instructions below
1. Update the composer.json autoload.psr-4 as per https://book.cakephp.org/3.0/en/plugins.html e.g.:

```
"autoload": {
    "psr-4": {
        "App\\": "src/",
        "QuasarAdmin\\": "./plugins/QuasarAdmin/src/"
    }
},
```
1. Run `composer install` and select "Y" to set folder permissions

## Overview
QuasarAdmin is an integration of the Quasar UI framework with CakePHP bake. Quasar UI framework is a cross-platform UI framework built on VueJS. Its purpose is to provide a widget library that provides an excellent and consistent experience on a variety of platforms and screen sizes. 

It relies on a particular custom folder structure for the bake build. It differs in philosophy from the standard cake php bake. The standard is that bake provides a starting point, which is customised for the application. Once the scaffolding is built, bake's job is done and that's the end of it's use. This plugin takes a different premise as its starting point. It assumes that during developing and prototyping one might wish to alter the schemas of the application. The approach to this is to bake to folders and classes that are then extended for customisation. This allows bake to be re-run, non-destructively.

## Why use this plugin?
Over the past few years the web dev paradigm has shifted from server-side dynamic HTML web-applications towards having a server-side REST API integrated with a completely independent, Javascript, Ajax app. The advantage of this is better UX. The disadvantage of this shift is slower prototyping. In the older paradigm, everything was server-side and data-driven, which allowed for scaffolding scripts to quickly build prototype applications which could provide an interactive framework just by looking at the database schema. Our view is that this is a sorely missing feature in the modern paradigm. So this plugin is based on the desire to facilitate rapid prototyping within in the modern paradigm. 

The goal is that the scaffolded prototype allows one to quickly experiment with data structures and UI elements without having to invest in a full front-end build. 

The way in which we've integrated Quasar into the CakePHP framework means that while it will use the Quasar/VueJS javascript framework on the front-end, it handles all forms via standard POST requests. You gain the ability to generate a UI that will look exactly the same as the final SPA front-end would, even if it operates on a different mechanism. This means you can move from one to the other or you can build different parts of the app in different ways (e.g. an admin app vs. customer app) whilst easily keeping the same look and feel.

The other way to look at this is that is enables you to build a traditional, old-school webapp, that looks and feels like a modern Javascript UI. Either way, it's a win-win situation!

## How we did it
Quasar UI implements itself in such a way that it assumes there will be an Ajax (or similar) transfer of data to the server. For this reason it abandons many of the HTML conventions around creating forms and form elements. As a result, the forms generated by Quasar will not work out the box with a standard HTML form element's transfer protocol. To fix this, what we've done is have bake create hidden fields and VueJS models for each element where necessary, to create a seamless link between the HTML form protocols and the Quasar UI widgets.

## How to use it
First install the QuasarAdmin plugin (see Installation above). Then there are a few minor adjustments that need to be made to your application in order to link the plugin in with your application. 

1. Copy the AppView.php view from the plugin into your application
1. Copy the admin-layout.ctp layout template from the plugin into your application
1. Generate your database (ideally via migrations)
1. Run `bin/cake bake all --everything --theme QuasarAdmin` from the shell in order to bake your QuasarAdmin UI.

Use these as your starting points for developing your applications.

## Extending
To understand how the form helper system works, look at `vendor/cakephp/src/View/Helper/FormHelper.php`. Note the `$_defaultConfig` property (array). The `typeMap` key of the array shows how database column types will map to FormHelper templates. The `templates` key shows the template definitions. 

There are 3 places you need to make changes in order to add any missing Quasar element integrations:
1. QuasarAdmin/config/form_helper_templates.php
1. QuasarAdmin/config/form_helper-widgets.php
1. Add the new element component file as QuasarAdmin/Template/Element/<element_name>.ctp
1. Register the element in `AppView`

### Helper templates
This overrides the `templates` array from the FormHelper config. So for example the default template for a checkbox is `<input type="checkbox" name="{{name}}" value="{{value}}"{{attrs}}>`. The curly brace placeholders are pulled in from the Widget, which functions as a controller for these templates. To know which widget is in use you can see the `$_defaultWidgets` property of the FormHelper. 

### Helper widgets
This overrides the `$_defaultWidgets` array from the FormHelper config. So you can assign custom widget definitions for preparing data necessary for the Quasar widget. So, if you edit this file and alter the `checkbox` value from `Checkbox` to `QuasarAdmin\View\Widget\QuasarCheckboxWidget` then instead of using the cakephp default CheckboxWidget it will look for a widget definition in the QuasarAdmin plugin. You can copy the cakephp default widget that was in use as a starting point.

One fundamental thing this file must do is `return $this->_templates->format('<template_name>', [<array of placeholder/val pairs to hyrdrate>])`. It will first look in the `QuasarAdmin/form_helper_template.php` template definitions and will fall back to the `templates` property of the cakephp FormHelper for the template name definition.

It may also call on `$this->_templates->formatAttributs` to create a string of attributes to hydrate, these will hydrate the `{{attr}}` placeholder.

### Element component
The element template file is where you create the Vue component and integrate it with the QuasarAdmin layout through the use of scriptBlocks. The component must match that used in the `form_helper_templates.php` file. 

### AppView
The Element component must be pulled into your `View/AppView.php` file as a cake Element. This is then initialises the Vue component, which renders the template to the DOM. The way it links up is that the form_helper template gets writeen out as HTML. The Vue component then parses the HTML looking tags that match it's own definition. When found, it replaces that tag with the component template, hydrating it from the `props`, which are passed in by the form_helper.