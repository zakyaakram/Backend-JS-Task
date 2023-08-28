function is_anagram($str1, $str2) {
  $str1 = strtolower(preg_replace("/[^a-z]/", "", $str1));
  $str2 = strtolower(preg_replace("/[^a-z]/", "", $str2));
  $str1 = str_split($str1);
  $str2 = str_split($str2);
  sort($str1);
  sort($str2);
  return ($str1 == $str2);
}


(abcd, dcba)  Anagram \: Not anagram\