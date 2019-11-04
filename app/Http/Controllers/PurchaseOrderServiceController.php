<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\PurchaseOrderService;

class PurchaseOrderServiceController extends Controller
{
    public function calculateTotals(Request $request)
    {
        $bodyContent = $request->getContent();
        if ($bodyContent) {
            $obj = json_decode($bodyContent);
            $result = PurchaseOrderService::calculateTotals($obj->{"purchase_order_ids"});
            return "$result";
        }
    }
}
