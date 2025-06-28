<?php
namespace App\Enum;

enum UserSex: string
{
    case MALE = 'male';
    case FEMALE = 'female';
    case OTHER = 'other';
}