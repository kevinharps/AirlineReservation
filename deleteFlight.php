<?php

require('db.php');

deleteFlightById($_GET['id']);

header('Location: flights.php');
