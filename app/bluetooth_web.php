<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Bootstrap 4 Example</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	</head>
	<body>
		
		<div class="container">
			<h1>My First Bootstrap Page</h1>
			<p>This is some text.</p>
		</div>
		
		<button id="conectar" class="container">
			Conectar 
		</button>
		
		
		<script>
			let button = document.getElementById("conectar");
			
			button.addEventListener('pointerup', function(event) {
				navigator.bluetooth.requestDevice(options).then(function(device) {
					console.log('Name: ' + device.name);
					// Do something with the device.
				})
				.catch(function(error) {
					console.log("Something went wrong. " + error);
				});
			});
		</script>
		
	</body>
</html>
