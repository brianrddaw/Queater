<?php

namespace App\Http\Controllers;

use App\Models\OrdersLine;
use Illuminate\Support\Facades\DB;

class GraphController extends Controller
{

    public function getTop5inWeek()
    {
        $top5 = OrdersLine::select('products.name', DB::raw('count(orders_lines.product_id) as total'))
            ->join('products', 'products.id', '=', 'orders_lines.product_id')
            ->groupBy('products.name')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();

        return $top5;
    }

    public function salesOfLast7Days()
    {
        $labels = [];
        $data = [];

        for ($i = 7; $i > 0; $i--) {
            $day = now()->addDay()->subDays($i)->format('d/m/Y');
            $sales = OrdersLine::join('products', 'orders_lines.product_id', '=', 'products.id')
                ->select(DB::raw("DATE_FORMAT(orders_lines.created_at, '%d') as day"), DB::raw('sum(orders_lines.quantity * products.price) as total'))
                ->whereDate('orders_lines.created_at', now()->addDay()->subDays($i))
                ->groupBy('day')
                ->first();

            $labels[] = $day;

            if ($sales) {
                $totalFormatted = number_format($sales->total, 2, '.', '');
                $data[] = $totalFormatted;
            } else {
                $data[] = 0;
            }
        }

        return [
            'labels' => $labels,
            'data' => $data
        ];
    }

}
