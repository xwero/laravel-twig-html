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
        $templates = array_merge(
            $this->unitTemplates(),
            $this->textTemplates(),
            $this->formTemplates(),
        );

        $loader = new ArrayLoader($templates);
        $twig = new Environment($loader);
        $twig->addExtension(new LaravelTwigExtension());

        $this->twig = $twig;
    }

    private function unitTemplates() {
        return [
            'unitHtml' => '{{ html() }}',
            'unitH' => '{{ h() }}',
            'unitEmpty' => '{{ h()|e_i }}',
            'unitStringOption' => '{{ h()|e_i("test") }}',
            'unitListOption' => '{{ h()|e_i(["test"]) }}',
            'unitNamedKeyOption' => '{{ h()|e_i({"contents": "test"}) }}',
            'unitBadNamedKeyOption' => '{{ h()|e_i({"content": "test"}) }}',
            'unitSomeNamedKeyOptions' => '{{ h()|e_a({"contents": "test"}) }}',
            'unitTooShortListOption' => '{{ h()|e_i(["test"]) }}',
        ];
    }

    private function textTemplates() {
        return [
            'textEmpty' => '{{ h()|e_text }}',
            'textWithName' => '{{ h()|e_text({"name":"test"}) }}',
            'textWithNameAndValue' => '{{ h()|e_text({"name":"test", "value":"test"}) }}',
            'textWithCustomAttribute' => '{{ h()|e_text|em_attribute({"attribute":"name", "value":"test"}) }}',
            'textWithDataAttribute' => '{{ h()|e_text|em_data({"name":"name", "value":"test"}) }}',
        ];
    }

    private function formTemplates() {
        return [
          'formWithRoute' => '{{ html()|e_form({"method": "get"})|form_route("test")|em_open }}',
          'formWithFiles' => '{{ html()|e_form({"method": "get"})|form_files|em_open }}'
        ];
    }
}
