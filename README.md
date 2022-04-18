# JSendResponse
JSendResponse Component for HttpFoundation based frameworks (Symfony, Silex, Laravel etc.)

**Note**: This repository is a fork of [Junker/JSendResponse](https://github.com/Junker/JSendResponse). Here is a list of the changes I made but that were not accepted into the original repository:
- The default HTTP status code JSendFailResponse for is now 400.
- The default HTTP status code JSendErrorResponse for is now 500.
- Removed support for Symfony 2 & 3.

## Installation
The best way to install JSendResponse is to use a [Composer](https://getcomposer.org/download):

    composer require artyuum/symfony-jsend-response

## Examples

```php
use Junker\JsendResponse\JSendResponse;
use Junker\JsendResponse\JSendSuccessResponse;
use Junker\JsendResponse\JSendFailResponse;
use Junker\JsendResponse\JSendErrorResponse;


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

