<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrdersLine;
use Illuminate\Support\Facades\DB;


class GraphController extends Controller
{

    function getTop5inWeek(){
        //Recoge el top 5 de productos mas vendidos en las orders-lines en los ultimos 7 dias.
        $top5 = OrdersLine::select('product_id', DB::raw('count(product_id) as total'))
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('product_id')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();

        echo $top5;
    }


    function salesOfLast7Days(){
        // Initialize arrays for labels and data
        $labels = [];
        $data = [];

        // Get sales data for each of the last 7 days
        for ($i = 7; $i > 0; $i--) {
            $day = now()->subDays($i)->format('d'); // Format the date to include only the day
            $sales = OrdersLine::select(DB::raw("DATE_FORMAT(created_at, '%d') as day"), DB::raw('sum(quantity) as total'))
                ->whereDate('created_at', now()->subDays($i))
                ->groupBy('day')
                ->first();

            // Add the day to labels array
            $labels[] = $day;

            // If there are sales data for the day, add the total to the data array
            if ($sales) {
                $data[] = $sales->total;
            } else {
                // If there are no sales data for the day, add 0 to the data array
                $data[] = 0;
            }
        }

        // Return an array with labels and data
        return [
            'labels' => $labels,
            'data' => $data
        ];
    }

}
