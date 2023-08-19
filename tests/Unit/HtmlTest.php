<?php

it('tries to render html()', function() {
    expect(fn() => $this->twig->load('unitHtml')->render())
        ->toBeObject(Error::class);
});

it('tries to render h()', function() {
   expect(fn() => $this->twig->load('unitH')->render())
       ->toBeObject(Error::class);
});
