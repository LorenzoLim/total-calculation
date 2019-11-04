<?php

namespace App\Helpers;

class CalculationMethod
{
  public static function calculateTotal($PurchaseOrderProduct)
  {
    // This function takes the full $PurchaseOrderProduct so that complex calculations can be made in this class with any of it's attributes
    if ($PurchaseOrderProduct->product_type_id == 1 || $PurchaseOrderProduct->product_type_id == 3) {
      // product_type_id 1 and 3 both use weight for the calculation method so they share this calculation
      return $PurchaseOrderProduct->unit_quantity_initial * $PurchaseOrderProduct->Product->weight;
    } else if ($PurchaseOrderProduct->product_type_id == 2) {
      // product_type_id 2 use volume for the calculation method
      return $PurchaseOrderProduct->unit_quantity_initial * $PurchaseOrderProduct->Product->volume;
    }
    return;
  }
}
