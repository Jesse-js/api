<?php 

enum DocumentType: string
{
    case CPF = 'CPF';
    case CNPJ = 'CNPJ';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}