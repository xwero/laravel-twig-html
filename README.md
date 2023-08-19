# laravel-twig-html

This is a html builder twig extension for people who use [Twig](https://twig.symfony.com/) in [Laravel](https://laravel.com/).

The [Laravel twig integration package](https://github.com/rcrowe/TwigBridge) comes with a formbuilder extension that uses [LaravelCollective/html](https://github.com/LaravelCollective/html).
This package is abandoned, with the suggestion to use [spatie/html](https://spatie.be/docs/laravel-html/).

My package uses the suggested library, maybe in a quirky way. But I saw the fluent API of the library, and I wanted the same in twig.

The out of the box twig integration code: `{{ form_open({"route":"home"}) }}`

Laravel twig html code: `{{ h()|e_form|form_route("home")|em_open }}`

As you can see this package involves more typing. I will add some shortcuts for frequently used combinations.

## Usage

The function `html()` can not be rendered on its own. It is the start value to create the tags. The short version is `h()`.

The element filters are prefixed with `e_`. And the element method filters are prefixed with `em_`.
The difference between the two is that the element filters are standalone, while the element method filters need an element for the filter to work.

When you add a string as an argument it will be used as the first argument of the underlying method. 
You can add the arguments as a [list](https://www.php.net/manual/en/function.array-is-list.php), but then the amount of items has to be the same as arguments of the underlying method.
To substitute the default arguments you can use named keys that match the default argument keys.

The defaults are pragmatic but when a combination of arguments can't result in usable html tag, the previous value will be returned.
For the element filters this means an error object can be returned. For the element method filters there will be no changes.

## Developing

You can run tests with `./vendor/bin/pest`. 

Unfortunately the form_route filter uses the route method without a slash so it looks for it in the Form class. Just add the slash, and all tests will run.

Other Laravel behaviours, like form_token, can not be tested without adding it to a Laravel project.





