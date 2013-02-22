# Messages Package

Message is a lightweight package that helps you to handle with Alerts of your system. Our default views are using __Twitter Bootstrap__

## Default Types

* Success
* Info
* Warning
* Error

## Add Messages

	// Simply Add a New Message
	Message::success('First Success Message');
	Message::success('Second Success Message');

	Message::info('Second Info Message');
	Message::warning('Second Warning Message');
	Message::error('Second Error Message');

	// Clean all Messages and Add this Message
	Message::success('First Success Message Again.', true);

## Get Messages

	// Get All Messages
	Message::get();

	// Get Success Messages
	Message::get('success');

## License

This is released under the MIT License.

### More Docs comming soon
