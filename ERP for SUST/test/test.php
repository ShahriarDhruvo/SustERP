<html>
	<head>
		<link rel="stylesheet" href="test.css" />
	</head>
	<body onload="startTime()">
		<div class="container">
			<div class="card">
				<div class="front">
					<div class="contentfront">
						<div class="month"></div>
						<div class="date">
							<div class="datecont">
								<div id="date"><?php echo date("d"); ?></div>
								<div id="day"><?php echo date("l"); ?></div>
								<div id="month"><?php echo date("M/Y"); ?></div>
								<i
									class="fa fa-pencil edit"
									aria-hidden="true"
								></i>
							</div>
						</div>
					</div>
				</div>
				<div class="back">
					<!---<div class="contentback">
                      <div class="backcontainer">
                        hhh
                      </div>
                    </div>--->
				</div>
			</div>
		</div>
		<script src="test.js"></script>
	</body>
</html>
