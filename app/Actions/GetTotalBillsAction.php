<?php

namespace App\Actions;

class GetTotalBillsAction
{
    public static function handle($bills)
    {
        $total = 0;
        foreach ($bills as $bill) {
            $total += $bill->tuition;
        }
        return $total;
    }
}
