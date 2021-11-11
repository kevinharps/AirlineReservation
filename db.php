<?php  //db.php

function updateCapacityByFltId($id, $remainCap) {
  runSafeQuery(
    "UPDATE flights SET remaining_seats = ?
      WHERE id = ?",
    ["ii",
      $remainCap,
      $id
    ]
  );
}

function deleteConfirmation($confirmation) {
  runSafeQuery(
      "DELETE FROM codesforflights WHERE conf_code = ?",
      ["s", $confirmation]
  );
}

function joinFlightsConfirm($conf) {
  $rawFlight = runSafeQuery(
    "SELECT * FROM codesforflights
    JOIN flights ON codesforflights.flight_number = flights.flight_number
    JOIN airplanes ON flights.airplane_id = airplanes.id
    WHERE codesforflights.conf_code = ?",
    ['s', $conf]
  );
  $result = getAllResults($rawFlight);

  $flight = reset($result);

  return $flight;
}

function storeConfInfo($conf, $fltNum, $secCode, $pass) {
  runSafeQuery(
    "INSERT INTO codesforflights (conf_code, flight_number, security_code, passengers) VALUES (?, ?, ?, ?)",
    ["ssii", $conf, $fltNum, $secCode, $pass]
  );
}

function showFlightsUserSearch($post) {
  $flight = runSafeQuery(
    " SELECT * FROM flights
      WHERE month = ?
      AND day_of_month = ?
      AND depart_airport_id = ?
      AND arrival_airport_id = ?",
      ["iiss",
      $post['monthy'],
      $post['days'],
      $post['depart'],
      $post['arrive']]
  );
  $result = getAllResults($flight);

  return $result;
}

function checkUserLogin($username, $password) {
  $hashedPassword = md5($password);
  $rawResult = runSafeQuery(
    "SELECT * FROM admin WHERE username = ?",
    ["s", $username]
  );
  $result = getAllResults($rawResult);
  $user = reset($result);

  if (!$user) {
    die('User could not be found!');
  } else if ($user['password'] != $hashedPassword) {
    die('Passwords do not match');
  } else {
    return $user;
  }
}

function saveUser($username, $password, $first, $last) {
  $hashedPassword = md5($password);
  runSafeQuery(
    "INSERT INTO admin (username, password, first_name, last_name) VALUES (?, ?, ?, ?)",
    ["ssss", $username, $hashedPassword, $first, $last]
  );
}

function getUserById($id) {
  $rawResult = runSafeQuery(
    "SELECT * FROM admin WHERE id = ?",
    ['i', $id]
  );

  $result = getAllResults($rawResult);

  $user = reset($result);

  return $user;
}

function joinFlightById($id) {
  $rawResult = runSafeQuery(
    "SELECT * FROM flights
    JOIN airplanes ON flights.airplane_id = airplanes.id
    WHERE flights.id = ?",
    ['i', $id]
  );
  $results = getAllResults($rawResult);

  return reset($results);
}

function getFlightByid($id) {
  $rawResult = runSafeQuery(
    "SELECT * FROM flights WHERE id = ?",
    ["i", $id]
  );
  $results = getAllResults($rawResult);

  // Reset pulls out the first item
  return reset($results);
}

function getPlaneByid($id) {
  $rawResult = runSafeQuery(
    "SELECT * FROM airplanes WHERE id = ?",
    ["i", $id]
  );
  $results = getAllResults($rawResult);

  // Reset pulls out the first item
  return reset($results);
}

function deleteFlightById($flightId) {
  runSafeQuery(
      "DELETE FROM flights WHERE id = ?",
      ["i", $flightId]
  );
}

function updatePlaneById($planeId, $modelNumber, $engineType, $horsepower, $firstClassCap, $mainCap) {
  runSafeQuery(
    "UPDATE airplanes
      SET
        model_number = ?,
        engine_type = ?,
        horsepower = ?,
        first_class_seat_capacity = ?,
        main_cabin_capacity = ?
      WHERE id = ?",
    ["ssiiii",
      $modelNumber,
      $engineType,
      $horsepower,
      $firstClassCap,
      $mainCap,
      $planeId]
  );
}

function updateFlightById($flightId, $flightNumber, $month, $dayMonth, $dayWeek, $departureTime, $arrivalTime, $airplaneId, $flightTime, $gateNumber, $departAirportId, $arriveAirportId, $cost) {
  runSafeQuery(
    "UPDATE flights
      SET
        flight_number = ?,
        departure_time = ?,
        arrival_time = ?,
        month = ?,
        day_of_month = ?,
        day_of_week = ?,
        airplane_id =?,
        flight_time = ?,
        gate_number = ?,
        depart_airport_id = ?,
        arrival_airport_id = ?,
        cost = ?
      WHERE id = ?",
    ["ssssisissssii",
      $flightNumber,
      $departureTime,
      $arrivalTime,
      $month,
      $dayMonth,
      $dayWeek,
      $airplaneId,
      $flightTime,
      $gateNumber,
      $departAirportId,
      $arriveAirportId,
      $cost,
      $flightId]
  );
}

function createPlaneFromPost($post) {
  runSafeQuery(
    "INSERT INTO airplanes (
      model_number,
      engine_type,
      horsepower,
      first_class_seat_capacity,
      main_cabin_capacity)
    VALUES (?, ?, ?, ?, ?)",
    ["ssiii",
      $post['model_number'],
      $post['engine_type'],
      $post['horsepower'],
      $post['first_class_seat_capacity'],
      $post['main_cabin_capacity']]
    );
}

function createFlightFromPost($post) {
  runSafeQuery(
    "INSERT INTO flights (
      flight_number,
      departure_time,
      month,
      day_of_month,
      day_of_week,
      arrival_time,
      airplane_id,
      flight_time,
      gate_number,
      depart_airport_id,
      arrival_airport_id,
      cost)
      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
    ["ssiississssi",
      $post['flight_number'],
      $post['departure_time'],
      $post['month'],
      $post['day_of_month'],
      $post['day_of_week'],
      $post['arrival_time'],
      $post['airplane_id'],
      $post['flight_time'],
      $post['gate_number'],
      $post['depart_airport_id'],
      $post['arrival_airport_id'],
      $post['cost']
    ]
  );
}

function getAllPlanesFromDB() {
  $allPlanes = [];
  // Fill the array from the DB
  // Make a connection
  $connection = getConnection();
  // Run a query
  $rawresult = $connection->query("SELECT * FROM airplanes");
  // Get the results
  $allPlanes = getAllResults($rawresult);
  // Close the connection
  $connection->close();
  // Return the results
  return $allPlanes;
}

function getAllFlightsFromDB() {

  $allFlights = [];
  // Fill the array from the DB
  // Make a connection
  $connection = getConnection();
  // Run a query
  $rawresult = $connection->query("SELECT * FROM flights");
  // Get the results
  $allFlights = getAllResults($rawresult);
  // Close the connection
  $connection->close();
  // Return the results
  return $allFlights;
}

function getConnection() {
  $connection = new mysqli(
    'localhost',
    'root',
    'root',
    'airlinereservation'
  );

  if($connection->connect_error) {
    die('Connection Error: ' . $connection->connect_error);
  }

  // No error? Return the conneciton
  return $connection;
}

function getAllResults($rawResult) {
  $rows = [];

  // The result->fetch_assoc() call, returns either a row associative array
  // or FALSE when there are no more rows to fetch
  while($row = $rawResult->fetch_assoc()) {
    $rows[] = $row;
  }
  return $rows;
}

function runSafeQuery($query, $params) {
  // Get Conneciton
  $connection = getConnection();

  // Prepare
  $statement = $connection->prepare($query);

  // Check if prepare failed
  if($statement == false) {
    die('Prepare failed: ' . $connection->error);
  }

  // BIND PARAMETERS

  // Example: SELECT * FROM dogs WHERE id = ? AND name = ?
  // $statement->bind_param('is', 1, 'spot');
  // s = String, i = Integer, b = Blob/Binary
  $statement->bind_param(...$params);

  if ($statement->error) {
    die('Bind failed: ' . $statement->error);
  }

  $success = $statement->execute();

  if ($success == false) {
    die('Execute failed: ' . $statement->error);
  }

  $result = $statement->get_result();
  $connection->close();
  return $result;
}
