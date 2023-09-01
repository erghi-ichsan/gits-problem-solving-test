<?php

function isBracketValid($openBrackets, $closeBrackets, $chars = [])
{
  $result = true;

  foreach ($chars as $char) {
    if (!in_array($char, $openBrackets) && !in_array($char, $closeBrackets)) {
      $result = false;
      break;
    }
  }

  return $result;
}

function balancedBracket($string = "")
{
  $tmp = [];
  $openBrackets = ['(', '[', '{'];
  $closeBrackets = [')', ']', '}'];
  // Remove all spaces from string
  $string = preg_replace('/\s+/', '', $string);

  // Split string to array
  $chars = str_split($string);

  if (count($chars) <= 0) {
    return "No bracket detected!";
  }

  $bracketValid = isBracketValid($openBrackets, $closeBrackets, $chars);

  if (!$bracketValid) {
    return "Brackets not allowed";
  }

  foreach ($chars as $char) {
    // If current char is open bracket, insert into tmp
    if (in_array($char, $openBrackets)) {
      array_push($tmp, $char);
    }
    // If current char is close bracket
    elseif (in_array($char, $closeBrackets)) {
      // Get last open bracket in tmp and remove it
      $currentBracket = array_pop($tmp);
      // Get index of close bracket
      $idxCloseBracket = array_search($char, $closeBrackets);
      // Get close bracket
      $openBracket = $openBrackets[$idxCloseBracket];

      // If open bracket not match with close bracket, return NO
      if ($currentBracket !== $openBracket) {
        return "NO";
      }
    }
  }

  // If has no tmp left, return YES
  // else return NO
  return (count($tmp) <= 0) ? "YES" : "NO";
}

$input1 = "{ [ ( ) ] }";
$input2 = "{ [ ( ] ) }";
$input3 = "{ ( ( [ ] ) [ ] ) [ ] }";

echo "
  Input 1: $input1 <br>
  Result: " . balancedBracket($input1) . "
  <br><br>
";
echo "
  Input 2: $input2 <br>
  Result: " . balancedBracket($input2) . "
  <br><br>
";
echo "
  Input 3: $input3 <br>
  Result: " . balancedBracket($input3) . "
  <br><br>
";
