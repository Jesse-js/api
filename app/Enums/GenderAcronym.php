<?php 

enum GenderAcronym: string
{
    case MALE = 'M';
    case FEMALE = 'F';
    case UNKNOWN = 'N';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}