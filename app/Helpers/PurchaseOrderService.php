<?php

namespace App\Helpers;

use App\Helpers\CalculationMethod;

class PurchaseOrderService
{
    /**
     * @param array $ids
     */
    public static function calculateTotals(array $ids)
    {
        $response = new \stdClass();
        $response->result = [];
        foreach ($ids as $id) {
            $curl = curl_init();
            // The url will call the api for every id that is being passed to this function
            $url = "https://api.cartoncloud.com.au/CartonCloud_Demo/PurchaseOrders/$id?version=5&associated=true";
            $username = env('API_USERNAME_CARTON_CLOUD');
            $password = env('API_PASSWORD_CARTON_CLOUD');

            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($curl, CURLOPT_USERPWD, $username . ":" . $password);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($curl);
            // Result comes in as a string so it's being decoded to become an object
            $obj = json_decode($result);
            // The data returned is an array of objects that needs to be traversed
            $data = json_encode($obj->data->PurchaseOrderProduct);
            // The data needs to be decoded so that it is a valid argument for the foreach method
            $arr = json_decode($data);
            foreach ($arr as $PurchaseOrderProduct) {
                // Sets the product_type_id to a variable called id for readability
                $id = $PurchaseOrderProduct->product_type_id;
                // This is where it is being calculated based on the data
                $method = new CalculationMethod();
                $total = $method::calculateTotal($PurchaseOrderProduct);
                // current_result is what the current response body will look like which could be an empty array
                $current_result = $response->result;
                // Checks to see if the current_result array is empty and if so creates a new object
                if (count($current_result) < 1) {
                    $newObj = new \stdClass();
                    $newObj->product_type_id = $id;
                    $newObj->total = $total;
                    array_push($response->result, $newObj);
                } else {
                    // If the array is not empty, this for loop traverses the array looking for the matching product_type_id
                    for ($i = 0; $i < count($current_result); $i++) {
                        if ($current_result[$i]->product_type_id == $id) {
                            // If it finds the id it updates the total
                            $current_result[$i]->total = $total;
                            break;
                        } else if ($i == count($current_result) - 1) {
                            // If it traverses the entire array and doesn't find the id then it will create it and push a new obj in
                            $newObj = new \stdClass();
                            $newObj->product_type_id = $id;
                            $newObj->total = $total;
                            array_push($response->result, $newObj);
                            break;
                        }
                    }
                }
            }
            curl_close($curl);
        }
        return json_encode($response);
    }
}
