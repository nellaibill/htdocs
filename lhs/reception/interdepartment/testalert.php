
<head>
	<title>Test Alert</title>
	<link rel="stylesheet" href="../css/alertify.core.css" />
	<link rel="stylesheet" href="../css/alertify.default.css" id="toggleCSS" />
</head>
<body>
	<a href="#" id="notification">Standard Log</a><br>
	<a href="#" id="success">Success Log</a><br>
	<a href="#" id="error">Error Log</a><br>
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="../js/alertify.min.js"></script>
	<script>
		function reset () {
			$("#toggleCSS").attr("href", "../css/alertify.default.css");
			alertify.set({
				labels : {
					ok     : "OK",
					cancel : "Cancel"
				},
				delay : 5000,
				buttonReverse : false,
				buttonFocus   : "ok"
			});
		}

		// ==============================
		// Standard Dialogs
		$("#notification").on( 'click', function () {
			reset();
			alertify.log("Standard log message");
			return false;
		});

		$("#success").on( 'click', function () {
			reset();
			alertify.success("Success log message");
			return false;
		});

		$("#error").on( 'click', function () {
			reset();
			alertify.error("Error log message");
			return false;
		});

		
	</script>

</body>
</html>