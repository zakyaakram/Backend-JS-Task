function checkEvenOrOdd(number) {
    // use modulus operator to get the remainder
    let remainder = number % 2;
  
    // if remainder is 0, the number is even
    if (remainder == 0) {
      return "even";
    }
    else {
      return "odd";
    }
  }