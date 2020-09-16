<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Carbon\Carbon;

class StatController extends Controller
{
    public function today()
    {
        $day = date("Y-m-d", time());
        return response($this->getSum($day));
    }

    public function yesterday()
    {
        $yesterday = strtotime('-1day', time());
        $day = date("Y-m-d", $yesterday);
        return response($this->getSum($day));
    }

    public function lastWeek()
    {
        $lastWeek = strtotime('-7day', time());
        $startOfDay = date("Y-m-d", $lastWeek);
        $endOfDay = date("Y-m-d", time());
        return response($this->getSum($startOfDay, $endOfDay));
    }

    public function thisYear()
    {
        $startOfYear = date("Y-01-01", time());
        $endOfYear = date("Y-12-31", time());
        return response($this->getSum($startOfYear, $endOfYear));
    }

    public function getSum($start, $end = null)
    {
        if ($end !== null) {
            $inc = Category::find('1')
                ->notes()
                ->where('date', '>=', $start)
                ->where('date', '<', $end)
                ->sum('amount');
            $exp = Category::find('2')
                ->notes()
                ->where('date', '>=', $start)
                ->where('date', '<', $end)
                ->sum('amount');
        } else {
            $inc = Category::find('1')
                ->notes()
                ->where('date', '=', $start)
                ->sum('amount');
            $exp = Category::find('2')
                ->notes()
                ->where('date', '=', $start)
                ->sum('amount');
        }


        return compact('inc', 'exp');
    }
}