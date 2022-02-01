<?php

namespace App\Validation;

use App\Models\UserModel;
use Exception;

class CustomRules {

  // Rule is to validate select option
  public function selectValidation(string $str): bool
  {
    return $str == '' ? false : true;
  }

  public function validateUser(string $str, string $fields, array $data): bool
  {
    try
    {
      $model = new UserModel();
      $user = $model->findUserByEmailAddress($data['email']);
      
      return password_verify($data['password'], $user['password']);
    }
    catch (Exception $e)
    {
      return false;
    }
  }
}
?>