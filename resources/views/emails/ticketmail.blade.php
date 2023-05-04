<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>{{ 'Ticket ID - #'.$ticket->id.' '.$ticket->subject }}</title>
</head>
<body>
	<h2>{{ 'Ticket ID - #'.$ticket->id.' : '.$ticket->subject }}</h2>
	<p>{{ $ticket->description }}</p>
	<p>{{ __('Thank You') }}</p>
</body>
</html>