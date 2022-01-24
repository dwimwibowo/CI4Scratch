<?php

namespace App\Validation;

class CustomRules {

  // Rule is to validate select option
  public function selectValidation(string $str): bool
  {
    return $str == '' ? false : true;
  }
}
?>