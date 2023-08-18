<?php

namespace Xwero\LaravelTwigHtml\Extension;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class LaravelTwigExtension extends AbstractExtension
{
    public function __construct(
    ){}

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
            new TwigFunction('html', fn() => html(), ['is_safe' => ['html'],]),
        ];
    }


    public function getFilters()
    {
        return [
            new TwigFilter('form', function($html, array $options = []) {
                if(isset($options['method']) && isset($options['action'])) {
                    return $html->form($options['method'], $options['action']);
                }

                if(isset($options['method'])) {
                    return $html->form($options['method']);
                }
                if(isset($options['action'])) {
                    return $html->form(action: $options['action']);
                }

                return $html->form();
            }, ['is_safe' => ['html'],]),
            new TwigFilter('form_route', function($html, $route, array $options = []){
                return $html->route($route, $options);
            }, ['is_safe' => ['html'],]),
            new TwigFilter('form_novalidate', function($html){
                return $html->novalidate();
            }, ['is_safe' => ['html'],]),
            new TwigFilter('form_files', function($html){
                return $html->acceptsFiles();
            }, ['is_safe' => ['html'],]),
            new TwigFilter('data', function($html, array $options = []){
                if(isset($options['name']) && isset($options['value'])) {
                    return $html->data($options['name'], $options['value']);
                }

                if(isset($options['name'])) {
                    return $html->data($options['name'], '');
                }

                return $html->data();
            }, ['is_safe' => ['html'],]),
            new TwigFilter('attribute', function($html, array $options = []){
                if(isset($options['name']) && isset($options['value'])) {
                    return $html->attribute($options['name'], $options['value']);
                }

                if(isset($options['name'])) {
                    return $html->attribute($options['name']);
                }

                return $html->attribute();
            }, ['is_safe' => ['html'],]),
            new TwigFilter('open', function ($html){
                return $html->open();
            }, ['is_safe' => ['html'],]),
            new TwigFilter('close', function ($html){
                return $html->close();
            }, ['is_safe' => ['html'],]),
            new TwigFilter('label', function($html, array $options = []){
                if(isset($options['content']) && isset($options['for'])) {
                    return $html->label($options['content'], $options['for']);
                }

                if(isset($options['content'])) {
                    return $html->label($options['content']);
                }

                return $html->label();
            }, ['is_safe' => ['html'],]),
            new TwigFilter('email', function($html, array $options = []){
                if(isset($options['name']) && isset($options['value'])) {
                    return $html->email($options['name'], $options['value']);
                }

                if(isset($options['name'])) {
                    return $html->email($options['name'], '');
                }

                return $html->email();
            }, ['is_safe' => ['html'],]),
            new TwigFilter('text', function($html, array $options = []){
                if(isset($options['name']) && isset($options['value'])) {
                    return $html->text($options['name'], $options['value']);
                }

                if(isset($options['name'])) {
                    return $html->text($options['name'], '');
                }

                return $html->text();
            }, ['is_safe' => ['html'],]),
        ];
    }
}