<?php

function isPalindrome($chars, $l = 0)
{
  $charsLength = count($chars);
  $r = $charsLength - $l - 1;
  $leftChar = $chars[$l];
  $rightChar = $chars[$r];
  $l++;

  // If left char doesn't same with right char, return false
  if ($leftChar !== $rightChar) {
    return false;
  }

  // If string length is odd and left char index same lower half charsLength
  if ($charsLength % 2 != 0 && $l == floor($charsLength / 2)) {
    return true;
  }

  // Repeat isPalindrome while i < half of charsLength
  if ($l < $charsLength / 2) {
    return isPalindrome($chars, $l);
  }

  return true;
}

function getPalindromes($k, $chars, $tmp = [])
{
  // If tmp does'n initialize, fill with chars
  if (count($tmp) == 0) {
    $tmp[0] = $chars;
    $tmp[1] = $chars;
  }

  $charsLength = count($chars);
  $p = floor($charsLength / 2);

  $l = $p - $k;
  $r = $p + $k - 1;

  // If string length is odd, get the next right char
  if ($charsLength % 2 != 0) {
    $r++;
  }

  // Get left char
  $leftChar = $chars[$l];
  // Get right char
  $rightChar = $chars[$r];

  // Change left char palindrom 1 with right char
  $tmp[0][$r] = $leftChar;
  // Change right char palindrom 2 with left char
  $tmp[1][$l] = $rightChar;

  $k--;

  // If replacement length still exist, repeat getPalindromes
  if ($k > 0) {
    return getPalindromes($k, $chars, $tmp);
  }

  return $tmp;
}

function highestPalindrome($string = "", $k = 0)
{
  // If string is not a string of number, return "-1"
  if ($string == "" || !is_numeric($string)) {
    return "-1";
  }

  // Split string to array
  $chars = str_split($string);
  // Get palindroms
  $tmp = getPalindromes($k, $chars);

  // If left Palindrome1 and Palindrome2 is not palindrome, return "-1"
  if (!isPalindrome($tmp[0]) && !isPalindrome($tmp[1])) {
    return "-1";
  }

  $palindrome1 = join("", $tmp[0]);
  $palindrome2 = join("", $tmp[1]);

  if ((int)$palindrome1 > (int)$palindrome2) {
    return $palindrome1;
  } else {
    return $palindrome2;
  }
}


$input1 = [
  "string" => "3943",
  "k" => 1
];
$input2 = [
  "string" => "517485",
  "k" => 2
];
$input3 = [
  "string" => "7194327",
  "k" => 1
];

echo "
  Input 1: <br>
  String = " . $input1['string'] . " <br>
  K = " . $input1['k'] . " <br>
  Result: " . highestPalindrome($input1['string'], $input1['k']) . "
  <br><br>
";
echo "
  Input 2: <br>
  String = " . $input2['string'] . " <br>
  K = " . $input2['k'] . " <br>
  Result: " . highestPalindrome($input2['string'], $input2['k']) . "
  <br><br>
";
echo "
  Input 3: <br>
  String = " . $input3['string'] . " <br>
  K = " . $input3['k'] . " <br>
  Result: " . highestPalindrome($input3['string'], $input3['k']) . "
  <br><br>
";
