<?php

function weightedStrings($string = "", $queries = [])
{
  if ($string == "" || count($queries) == 0) {
    return [];
  }

  $string = strtolower($string);
  $weights = [];
  $charsWeight = [
    "a" => 1,
    "b" => 2,
    "c" => 3,
    "d" => 4,
    "e" => 5,
    "f" => 6,
    "g" => 7,
    "h" => 8,
    "i" => 9,
    "j" => 10,
    "k" => 11,
    "l" => 12,
    "m" => 13,
    "n" => 14,
    "o" => 15,
    "p" => 16,
    "q" => 17,
    "r" => 18,
    "s" => 19,
    "t" => 20,
    "u" => 21,
    "v" => 22,
    "w" => 23,
    "x" => 24,
    "y" => 25,
    "z" => 26
  ];
  $lastChar = [
    "char" => "",
    "length" => 1
  ];
  $results = [];

  for ($i = 0; $i < strlen($string); $i++) {
    $currentChar = $string[$i];
    $currentWeight = $charsWeight[$currentChar];

    // If current char equal to lastChar, count previouse weight with current weight then insert into weights
    if ($currentChar == $lastChar["char"]) {
      $weights[] = $currentWeight + ($lastChar["length"] * $currentWeight);
      $lastChar["length"]++;
    }
    // Else, weights with currentWeight and reset lastChar length with 1 
    else {
      $weights[] = $currentWeight;
      $lastChar["length"] = 1;
    }

    // Insert lastChar with current char
    $lastChar["char"] = $currentChar;
  }

  foreach ($queries as $query) {
    // IF current query available in the weights, insert results with YES
    if (in_array($query, $weights)) {
      $results[] = 'Yes';
    }
    // IF current query doesn't available in the weights, insert results with NO
    else {
      $results[] = 'No';
    }
  }

  return $results;
}

$input1 = [
  "string" => "abbcccd",
  "queries" => [1, 3, 9, 8]
];
$input2 = [
  "string" => "zzbbbcdd",
  "queries" => [1, 3, 9, 8]
];
$input3 = [
  "string" => "zyyxxxi",
  "queries" => [26, 25, 50, 9, 24]
];

echo "
  Input 1: <br>
  String = " . $input1['string'] . " <br>
  Queries = " . json_encode($input1['queries']) . " <br>
  Result: " . json_encode(weightedStrings($input1['string'], $input1['queries'])) . "
  <br><br>
";
echo "
  Input 2: <br>
  String = " . $input2['string'] . " <br>
  Queries = " . json_encode($input2['queries']) . " <br>
  Result: " . json_encode(weightedStrings($input2['string'], $input2['queries'])) . "
  <br><br>
";
echo "
  Input 3: <br>
  String = " . $input3['string'] . " <br>
  Queries = " . json_encode($input3['queries']) . " <br>
  Result: " . json_encode(weightedStrings($input3['string'], $input3['queries'])) . "
  <br><br>
";
