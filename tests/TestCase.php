<?php

namespace Tests;

use PHPUnit\Framework\TestCase as BaseTestCase;
use Twig\Environment;
use Twig\Loader\ArrayLoader;
use Xwero\LaravelTwigHtml\Extension\LaravelTwigExtension;

class TestCase extends BaseTestCase
{
    protected $twig;
    protected function setUp(): void
    {
        $templates = [
            'textEmpty' => '{{ html()|text }}',
            'textWithName' => '{{ html()|text({"name":"test"}) }}',
            'textWithNameAndValue' => '{{ html()|text({"name":"test", "value":"test"}) }}',
            'textWithCustomAttribute' => '{{ html()|text|attribute({"name":"name", "value":"test"}) }}',
            'textWithDataAttribute' => '{{ html()|text|data({"name":"name", "value":"test"}) }}',
        ];

        $loader = new ArrayLoader($templates);
        $twig = new Environment($loader);
        $twig->addExtension(new LaravelTwigExtension());

        $this->twig = $twig;
    }
}
