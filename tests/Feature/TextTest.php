<?php

it('displays empty text input', function() {
    $template = $this->twig->load('textEmpty');

    expect($template->render())->toBe('<input type="text">');
})->group('text');

it('displays text with name test', function() {
    $template = $this->twig->load('textWithName');

    expect($template->render())->toBe('<input type="text" name="test" id="test" value>');
})->group('text');

it('displays text with name and value test', function() {
    $template = $this->twig->load('textWithNameAndValue');

    expect($template->render())->toBe('<input type="text" name="test" id="test" value="test">');
})->group('text');

it('displays text with attribute name test', function() {
    $template = $this->twig->load('textWithCustomAttribute');

    expect($template->render())->toBe('<input type="text" name="test">');
})->group('text');

it('displays text with data attribute name test', function() {
    $template = $this->twig->load('textWithDataAttribute');

    expect($template->render())->toBe('<input type="text" data-name="test">');
})->group('text');