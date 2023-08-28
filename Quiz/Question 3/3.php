function is_palindrome($str) {
  $str = strtolower(preg_replace("/[^a-z]/", "", $str));

  return ($str == strrev($str));
}


(eye)   // Palindrome
(madam)  // Palindrome