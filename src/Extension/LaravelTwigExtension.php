<?php

namespace Xwero\LaravelTwigHtml\Extension;

use Spatie\Html\Elements\Form;
use Spatie\Html\Html;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class LaravelTwigExtension extends AbstractExtension
{
    public function __construct()
    {
    }

    public function getName()
    {
        return 'App_Extension_Laravel_Form';
    }

    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        return [
            new TwigFunction('html', fn() => html()),
            new TwigFunction('h', fn() => html()),
        ];
    }


    public function getFilters()
    {
        return [
            new TwigFilter('e_*', function($name, $html, array|string $options = null){
                $elements = $this->htmlElements();

                if(!key_exists($name, $elements)) {
                    return $html;
                }

                $defaults = $elements[$name];

                if(is_null($options)) {
                    return $html->{$name}();
                }

                if(is_null($defaults)) {
                    return $html->{$name}();
                }

                if(is_string($options) && count($defaults) > 0) {
                    return $html->{$name}($options);
                }

                $elementKeys = array_keys($defaults);

                if(array_is_list($options) && count($options) !== count($elementKeys)) {
                    return $html;
                }

                if(array_is_list($options) && count($options) === count($elementKeys)) {
                    return call_user_func_array([$html, $name], $options);
                }

                $optionKeys = array_keys($options);
                $unknownKeys = array_diff($optionKeys, $elementKeys);

                foreach ($unknownKeys as $unknownKey) {
                    unset($options[$unknownKey]);
                }

                foreach ($options as $key => $value) {
                    $defaults[$key] = $value;
                }

                return call_user_func_array([$html, $name], $defaults);
            }, [
                'is_safe' => ['html'],
            ]),
            new TwigFilter('em_*', function ($name, $html, array|string $options = []) {
                $elementMethods = $this->htmlElementMethods();

                if(!key_exists($name, $elementMethods)) {
                    return $html;
                }

                $defaults = $elementMethods[$name];

                if(is_null($defaults)) {
                    return $html->{$name}();
                }

                if(is_string($defaults) && !is_string($options)) {
                    return $html;
                }

                if(is_string($defaults) && is_string($options)) {
                    return $html->{$name}($options);
                }

                if(is_string($options) && is_array($defaults) && count($defaults) > 0) {
                    return $html->{$name}($options);
                }

                if(is_array($defaults) && empty($defaults) && !is_array($options)) {
                    return $html;
                }

                if(is_array($defaults) && empty($defaults) && is_array($options)) {
                    return $html->{$name}($options);
                }

                $elementMethodKeys = array_keys($defaults);

                if(array_is_list($options) && count($options) !== count($elementMethodKeys)) {
                    return $html;
                }

                if(array_is_list($options) && count($options) === count($elementMethodKeys)) {
                    return call_user_func_array([$html, $name], $options);
                }

                $optionKeys = array_keys($options);
                $unknownKeys = array_diff($optionKeys, $elementMethodKeys);

                foreach ($unknownKeys as $unknownKey) {
                    unset($options[$unknownKey]);
                }

                if(in_array($name, ['form', 'formModel']) && isset($options['method'])) {
                    $options['method'] = strtoupper($options['method']);
                }

                foreach ($options as $key => $value) {
                    $defaults[$key] = $value;
                }

                return call_user_func_array([$html, $name], $defaults);
            }, [
                'is_safe' => ['html'],
            ]),
            new TwigFilter('form_route', function($html, $route, array $options = []) {
               if(!$html instanceof Form) {
                   return $html;
               }

               return $html->route($route, $options);
            }, [
                'is_safe' => ['html'],
            ]),
            new TwigFilter('form_files', function($html) {
                if(!$html instanceof Form) {
                    return $html;
                }

                return $html->acceptsFiles();
            }, [
                'is_safe' => ['html'],
            ]),
        ];
    }

    private function htmlElements()
    {
        return [
            'a' => [
                'href' => null,
                'contents' => null
            ],
            'i' => [
                'contents' => null
            ],
            'p' => [
                'contents' => null
            ],
            'button' => [
                'contents' => null,
                'type' => null,
                'name' => null
            ],
            'checkbox' => [
                'name' => null,
                'checked' => null,
                'value' => '1'
            ],
            'div' => [
                'contents' => null
            ],
            'email' => [
                'name' => null,
                'value' => null
            ],
            'date' => [
                'name' => '',
                'value' => null,
                'format' => true
            ],
            'datetime' => [
                'name' => '',
                'value' => null,
                'format' => true
            ],
            'range' => [
                'name' => '',
                'value' => '',
                'min' => null,
                'max' => null,
                'step' => null
            ],
            'time' => [
                'name' => '',
                'value' => null,
                'format' => true
            ],
            'element' => [
                'tag' => 'p'
            ],
            'input' => [
                'type' => null,
                'name' => null,
                'value' => null
            ],
            'fieldset' => [
                'legend' => null
            ],
            'form' => [
                'method' => 'POST',
                'action' => null
            ],
            'hidden' => [
                'name' => null,
                'value' => null
            ],
            'img' => [
                'src' => null,
                'alt' => null
            ],
            'label' => [
                'contents' => null,
                'for' => null
            ],
            'legend' => [
                'contents' => null
            ],
            'mailto' => [
                'email' => 'dummy@test.com',
                'text' => null
            ],
            'multiselect' => [
                'name' => null,
                'options' => [],
                'value' => null
            ],
            'number' => [
                'name' => null,
                'value' => null,
                'min' => null,
                'max' => null,
                'step' => null
            ],
            'option' => [
                'text' => null,
                'value' => null,
                'selected' => false
            ],
            'password' => [
                'name' => null
            ],
            'radio' => [
                'name' => null,
                'checked' => null,
                'value' => null
            ],
            'select' => [
                'name' => null,
                'options' => [],
                'value' => null],
            'span' => [
                'contents' => null
            ],
            'submit' => [
                'text' => null
            ],
            'reset' => [
                'text' => null
            ],
            'tel' => [
                'number' => '1',
                'text' => null
            ],
            'text' => [
                'name' => null,
                'value' => null
            ],
            'file' => [
                'name' => null
            ],
            'textarea' => [
                'name' => null,
                'value' => null
            ],
            'token' => null,
            'modelForm' => [
                'model' => [],
                'method' => 'POST',
                'action' => null
            ],
            'closeModelForm' => null,
        ];
    }

    private function htmlElementMethods() {
        return [
            'attribute' => [
                'attribute' => 'title',
                'value' => null
            ],
            'attributes' => [],
            'class' => '',
            'id' => random_bytes(10),
            'style' => '',
            'data' => [
                'name' => 'dummy',
                'value' => null
            ],
            'child' => [
                'child' => null,
                'mapper' => null
            ],
            'text' => '',
            'html' => '',
            'open' => null,
            'close' => null,
        ];
    }
}