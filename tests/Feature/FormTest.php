<?php

it('renders a form open tag with action from route', function() {
    expect($this->twig->load('formWithRoute')->render())
        ->toBe('<form method="GET" action="/">');
});

it('renders form open tag for file uploads', function() {
    expect($this->twig->load('formWithFiles')->render())
        ->toBe('<form method="GET" enctype="multipart/form-data">');
});