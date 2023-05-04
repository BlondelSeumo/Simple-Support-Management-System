<?php

use App\Enums\TicketStatus;

return [
    TicketStatus::PENDING => 'PENDING',
    TicketStatus::OPEN    => 'OPEN',
    TicketStatus::HOLD    => 'HOLD',
    TicketStatus::SOLVED  => 'SOLVED',
    TicketStatus::CLOSED  => 'CLOSED',
];
