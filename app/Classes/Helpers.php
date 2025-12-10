<?php

use App\Moderator;

function getFacilitators($facilitatorsIds) {
    $facilitators = [];
    foreach ($facilitatorsIds as $id) {
        $facilitator = Moderator::find($id);
        if ($facilitator) {
            $facilitators[] = $facilitator;
        }
    }
    return $facilitators;
}
