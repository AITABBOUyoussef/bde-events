<?php

namespace App;

class TicketNumberGenerator
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function ticket(){
        $nem_uniq = 'BDE'.'-'.'2026'.'-'.time();
        // dd($nem_uniq);
        return $nem_uniq;
    }


}
