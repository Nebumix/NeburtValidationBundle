Nebumix/NeburtValidationBundle
=========================

A real time backend validation for Symfony2

## Installation

### Add bundle to your composer.json file

``` js
// composer.json

{
    "require": {
        // ...
        "nebumix/rt-validation-bundle": "dev-master"
    }
}
```

### Add bundle to your application kernel

``` php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Nebumix\rtValidationBundle\NebumixrtValidationBundle(),
        // ...
    );
}
```

### Download the bundle using Composer

``` bash
$ php composer.phar update nebumix/rt-validation-bundle
```

### Register the routing definition in `app/config/routing.yml`:

``` yml
# app/config/routing.yml
fos_js_routing:
    resource: "@FOSJsRoutingBundle/Resources/config/routing/routing.xml"

Nebumix_rtV_routing:
    resource: "@NebumixrtValidationBundle/Resources/config/routing.yml"
```


### Install assets

Given your server's public directory is named "web", install the public vendor resources

``` bash
$ php app/console assets:install web
```

Optionally, use the --symlink attribute to create links rather than copies of the resources 

``` bash
$ php app/console assets:install --symlink web
```

### Create new file `app/config/securityRT.yml`:

``` yml
# app/config/securityRT.yml
parameters:
    nebumix_rtvalidation.check.class: Nebumix\rtValidationBundle\Controller\CheckController
```

### Import the new file in `app/config/config.yml`:

``` yml
# app/config/config.yml
imports:
    // ...
    - { resource: securityRT.yml }
```



#### Installing NeburtValidation, you installed automatically also [`bmatzner/jquery-bundle`](https://github.com/bmatzner/BmatznerJQueryUIBundle) and [`friendsofsymfony/jsrouting-bundle`](https://github.com/FriendsOfSymfony/FOSJsRoutingBundle)

##### We need to configure friendsofsymfony/jsrouting-bundle, you can look the official documentation in the official page.

I suggest to add these lines in `app/config/config.yml`:

``` yml
# app/config/config.yml
fos_js_routing:
    routes_to_expose: [ nebumixrt_validation_check ]
```
The route name you need is `nebumixrt_validation_check`

Usage
-----

#### Add jQuery
Add this line in your layout:

```
<script type="text/javascript" src="{{ asset('bundles/bmatznerjquery/js/jquery.min.js') }}"></script>
```

#### Add FOSJsRoutingBundle
Add these two lines in your layout:

```
<script src="{{ asset('bundles/fosjsrouting/js/router.js') }}"></script>
<script src="{{ path('fos_js_routing_js', {"callback": "fos.Router.setData"}) }}"></script>
```

#### Add rtValidation
Add this line in your layout:

```
<script type="text/javascript" src="{{ asset('bundles/nebumixrtvalidation/js/nebumix_r_t_validation.js') }}"></script>
```

#### Write javascript functions
To validate in real time a form field, you need to call a function to check your field.
I use the .focusout function.

To validate a text field you need to add in your layout:

``` js
$(function() {  
	$('#form_namefield').focusout(function() {
		check_field('nameForm', 'namefield');
	});
	$('#form_namefield1').focusout(function() {
		check_field('nameForm', 'namefield1');
	});
	
	//...
	
	$('#form_namefieldN').focusout(function() {
		check_field('nameForm', 'namefieldN');
	});
});  
```

You need to replace `namefield` with the field name you want to validate, and `nameForm` with a name, it must to be different for each form.
Is not necessary `nameForm` is the real form name, it needs just to distinguish the form fields in the validation file.

#### Write validation rules in `securityRT.yml`:

``` yml
parameters:
    nebumix_rtvalidation.check.class: Nebumix\rtValidationBundle\Controller\CheckController
    nameForm:
        nameField:
            NotBlank:
                message: Field is required.
            Regex: 
                pattern: "/^\d+$/"
                message: insert an integer
        nameField1:
            NotBlank:
            Length:
                min: 3
```

You have to use the name you used as `nameForm` in the javascript function followed by the name used as `nameField` and by the validation rules, as you can see in the example.


### Print errors

To print errors you can add in your layout:

``` html
<div id="nameField_error"></div>
```

The div id must to have the `nameField` followed by `_error`. You have to write one for each field.


### Send the form

Now you can validate your form in real time, but if you like stopping the form if the validation returns errors, add the javascript function in your layout:

``` js
$( document ).ready(function() {
	$( "#sendForm" ).click(function() {

		//list functions, each per field
		var c_nameField = check_field('nameForm', 'nameField');
		var c_nameField1 = check_field('nameForm', 'nameField1');
		//..
		var c_nameFieldN = check_field('nameForm', 'nameFieldN');



		if( c_nameField == 1 && c_nameField1 == 1 )
		{
			var form_data = $('#myForm').serialize();

		      $.ajax({  
        		url: Routing.generate('_your_route_to_save_form'),  
		        type: "POST",  
		        data:  form_data,
		        dataType: "html",
		        async : false,
		        success: function(msg) { 
				//if the function have no error return 1
		                if(msg == 1){
					alert('Saved');
		                }else{
					check_field('nameForm', 'nameField');
					check_field('nameForm', 'nameField1');
					//...
					check_field('nameForm', 'nameFieldN');
				}
		        },
		        error: function(){
		          alert("ERROR!");
		        } 
		    }); 

		}
	});
});
```

This is just an example, you can write your own function.

### Supported Constraints:
[`NotBlank`](http://symfony.com/doc/current/reference/constraints/NotBlank.html) [`Blank`](http://symfony.com/doc/current/reference/constraints/Blank.html)  [`NotNull`](http://symfony.com/doc/current/reference/constraints/NotNull.html)  [`Null`](http://symfony.com/doc/current/reference/constraints/Null.html)  [`Type`](http://symfony.com/doc/current/reference/constraints/Type.html) 
[`Email`](http://symfony.com/doc/current/reference/constraints/Email.html) 
[`Length`](http://symfony.com/doc/current/reference/constraints/Length.html) 
[`Url`](http://symfony.com/doc/current/reference/constraints/Url.html) 
[`Regex`](http://symfony.com/doc/current/reference/constraints/Regex.html) 
[`Ip`](http://symfony.com/doc/current/reference/constraints/Ip.html) 
[`Uuid`](http://symfony.com/doc/current/reference/constraints/Uuid.html) 

### Example
...
