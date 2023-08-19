<?php

it('renders empty element', function () {
    expect($this->twig->load('unitEmpty')->render())
        ->toBe('<i></i>');
});

it('renders element with string option', function() {
    expect($this->twig->load('unitStringOption')->render())
        ->toBe('<i>test</i>');
});

it('renders element from list', function() {
    expect($this->twig->load('unitListOption')->render())
        ->toBe('<i>test</i>');
});

it('renders element with named option', function() {
    expect($this->twig->load('unitNamedKeyOption')->render())
        ->toBe('<i>test</i>');
});

it('renders element with wrongly named option', function() {
    expect($this->twig->load('unitBadNamedKeyOption')->render())
        ->toBe('<i></i>');
});