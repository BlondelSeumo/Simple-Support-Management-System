<?php

namespace App\Enums;

interface TicketStatus
{

    const PENDING = 5;
    const OPEN    = 10;
    const HOLD    = 15;
    const SOLVED  = 20;
    const CLOSED  = 25;
}
