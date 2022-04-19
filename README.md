# JSendResponse
JSendResponse Component for HttpFoundation based applications (Symfony, Silex, Laravel, Drupal etc.)

**Note**: This repository is a fork of [Junker/JSendResponse](https://github.com/Junker/JSendResponse). See the [changelog](#changelog) for modification history.


## Installation
The best way to install JSendResponse is to use a [Composer](https://getcomposer.org/download):

    composer require artyuum/symfony-jsend-response

## Examples

```php
use Junker\JSendResponse\JSendResponse;
use Junker\JSendResponse\JSendSuccessResponse;
use Junker\JSendResponse\JSendFailResponse;
use Junker\JSendResponse\JSendErrorResponse;


class AppController
{
	...

	$data = ['id' => 50, 'name' => 'Waldemar'];
	$message = 'Error, total error!';
	$code = 5;

	return new JsendResponse(JSendResponse::STATUS_SUCCESS, $data);
	#or
	return new JsendResponse(JSendResponse::STATUS_FAIL, $data);
	#or 
	return new JsendResponse(JSendResponse::STATUS_ERROR, NULL, $message);
	#or
	return new JsendResponse(JSendResponse::STATUS_ERROR, $data, $message, $code);
	#or
	return new JsendSuccessResponse($data);
	#or
	return new JsendFailResponse($data);
	#or
	return new JsendErrorResponse($message);
	#or
	return new JsendErrorResponse($message, $code, $data);

}

```

## Changelog
This library follows [semantic versioning](https://semver.org).

* **1.0.0** - (draft)
  * The default HTTP status code when using JSendFailResponse is now 400.
  * The default HTTP status code when using JSendErrorResponse is now 500.
  * Removed support for Symfony 2 & 3.
  * Replaced usage o ArrayObject by a traditional array.
  * Tests (WIP)

## Contributing
If you'd like to contribute, please fork the repository and make changes as you'd like. Be sure to follow the same coding style & naming used in this library to produce a consistent code.
