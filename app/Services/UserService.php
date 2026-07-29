<?php

namespace App\Services;

use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
     public function getuser(array $events): Event
    {
 $events = DB::select('SELECT users.name , COUNT(reservations.user_id) FROM `users` JOIN reservations on reservations.user_id=users.id GROUP by users.name HAVING COUNT(reservations.user_id) > 2;');

 return (compact($events));
 }

}
