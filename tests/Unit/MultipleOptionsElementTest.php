<?php

it('renders multiple option element with some defaults', function() {
    expect($this->twig->load('unitSomeNamedKeyOptions')->render())
        ->toBe('<a>test</a>');
});

it('tries to render element from list which is too short', function () {
   expect(fn() => $this->twig->load('unitTooShortListOption')->render())
       ->toBeObject(Error::class);
});