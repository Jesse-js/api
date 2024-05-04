<?php
require_once __DIR__ . '/../../Enums/GenderAcronym.php';
require_once __DIR__ . '/../../Enums/CustomerStatus.php';
require_once __DIR__ . '/../../Enums/DocumentType.php';
require_once __DIR__ . '/../../Enums/StateAcronym.php';

class CustomerRequest
{
    public static function validate(array $data): array
    {
        $isValid = true;
        $errors = [];

        if (empty($data['name']))
            $errors['name'] = 'Name is required';

        if (!in_array($data['gender'], GenderAcronym::values()))
            $errors['gender'] = 'Gender option is not valid';

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL))
            $errors['email'] =  'Email is not valid email address';

        if (!self::validateDate($data['date_of_birth']))
            $errors['date_of_birth'] = 'Date of birth is not valid, must be in the format dd/mm/yyyy';

        if (!in_array($data['state'], StateAcronym::values()))
            $errors['state'] = 'State option is not valid';

        if (empty($data['city']))
            $errors['city'] = 'City is required';

        if (empty($data['street']))
            $errors['street'] = 'Street is required';

        if (empty($data['number']))
            $errors['number'] = 'Number is required';

        if (empty($data['zip_code']))
            $errors['zip_code'] = 'Zip code is required';

        if (!self::validateTelephone($data['telephone']))
            $errors['telephone'] = 'Telephone must be in the format (00) 0000-0000 or (00) 0 0000-0000';

        if (empty($data['document_type']))
            $errors['document_type'] = 'Document type is required';

        if (!in_array(strtoupper($data['document_type']), DocumentType::values()))
            $errors['document_type'] = 'Document type is not valid';
        
        if ($data['document_type'] === 'cpf' && !self::validateCpf($data['document_number']))
            $errors['cpf'] = 'Cpf is not valid';

        if ($data['document_type'] === 'cnpj' && !self::validateCnpj($data['document_number']))
            $errors['cnpj'] = 'Cnpj is not valid';

        if (!in_array($data['status'], CustomerStatus::values()))
            $errors['status'] = 'Status is not valid';

        if (!self::validateUsername($data['username']))
            $errors['username'] = 'Username is not valid';

        if (self::validatePassword($data['password']))
            $errors['password'] = self::validatePassword($data['password']);

        if (!empty($errors))
            $isValid = false;

        return [
            'isValid' => $isValid,
            'errors' => $errors
        ];
    }

    public static function validateDate(string $date, string $format = 'd/m/Y'): bool
    {
        $d = DateTime::createFromFormat($format, $date);
        if ($d && $d->format($format) == $date) {
            return true;
        }
        return false;
    }

    public static function validateTelephone(string $telephone): bool
    {
        $firstStandard = "/^\(\d{2}\) \d{1,4}-\d{4}$/";
        $secondStandard = "/^\(\d{2}\) \d \d{4}-\d{4}$/";

        return preg_match($firstStandard, $telephone) ||
            preg_match($secondStandard, $telephone);
    }

    public static function validateCpf(string $cpf): bool
    {
        $cpf = preg_replace('/[^0-9]/is', '', $cpf);

        if (strlen($cpf) != 11)
            return false;

        if (preg_match('/(\d)\1{10}/', $cpf))
            return false;

        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;
    }

    public static function validateCnpj(string $cnpj): bool
    {
        if (empty($cnpj))
            return false;

        $cnpj = preg_replace('/[^0-9]/', '', $cnpj);

        if (strlen($cnpj) != 14)
            return false;

        if (preg_match('/(\d)\1{13}/', $cnpj))
            return false;

        $b = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];

        for ($i = 0, $n = 0; $i < 12; $n += $cnpj[$i] * $b[++$i]);

        if ($cnpj[12] != ((($n %= 11) < 2) ? 0 : 11 - $n))
            return false;


        for ($i = 0, $n = 0; $i <= 12; $n += $cnpj[$i] * $b[$i++]);

        if ($cnpj[13] != ((($n %= 11) < 2) ? 0 : 11 - $n))
            return false;

        return true;
    }

    public static function validateUsername(string $username): bool
    {
        return preg_match('/^[a-zA-Z0-9]{5,15}$/', $username);
    }

    public static function validatePassword(string $password): array
    {
        $errors = [];
        if (strlen($password) < 6 || strlen($password) > 20)
            $errors[] = 'Password must have between 6 and 20 characters';

        if (!preg_match('/[A-Z]/', $password))
            $errors[] = 'Password must have at least one uppercase letter';

        if (!preg_match('/[0-9]/', $password))
            $errors[] = 'Password must have at least one number';

        if (!preg_match('/[^a-zA-Z0-9]/', $password))
            $errors[] = 'Password must have at least one special character';

        return $errors;
    }
}
