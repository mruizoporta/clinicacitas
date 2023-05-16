<?php namespace App\Interfaces;

use Carbon\Carbon;

interface HorarioServicesInterface{
    public function getAvailableIntervals($date, $doctorId);
    public function isAvailableInterval($date, $doctorId, Carbon $start);
    
}