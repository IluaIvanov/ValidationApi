## ValidationAPI

The validator allows you to simplify the work and give the answer to the user in the desired format

## Includes several commands:

Includes several commands for data validation:

- required
- array
- integer
- string
- in_object
- key_array
- in_array
- exist
- bool
- email
- phone
- between
- json

## Output formats

- AJAX_ERROR
- LANGUAGE_ERROR_RU
- DEFAULT_FORMAT_ERROR
- WEB_FORMAT_ERROR

### Fast starting

```php

ValidationApi:validate($request, [
  'limit:required|array|in_array?print,less/small/test',
  'phone:custom?App\Kernel\Data\Users\Users,issetPhoneNumber,exist,+700000',
  'phone:unique?User,phone,+794585825252/+79999999999'
]);

ValidationApi::validate($request, [
	'password:required',
	'oldPassword:required'
], AJAX_ERROR|LANGUAGE_ERROR_RU, [
	'password' => ['atr' => ['ru' => 'новый пароль']],
	'oldPassword' => ['atr' => ['ru' => 'старый пароль']],
]);

$filterData = ValidationApi::validateParametrs($request, [], [
	'search:required',
	'limit:required|integer',
	'offset:required|integer'
]);

```