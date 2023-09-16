<?php

namespace App\Models;

use Illuminate\Support\Collection;

class UserRole
{
    public const SUPER_ADMIN = 'Super Admin';
    public const SCHOOL_ADMINISTRATOR = 'Admin Sekolah';
    public const COUNSELOR_TEACHER = 'Guru BK';
    public const RELIGION_TEACHER = 'Guru Agama';
}
