<?php

namespace Tests\Unit;

use Tests\TestCase;

class ReceivedExpectedValueTest extends TestCase
{
    /**
     * @test
     * @return void
     */
    public function received_expected_value()
    {
        $this->withoutMiddleware();

        $response = $this->json('POST', '/test', [
            'purchase_order_ids' => array(
                2344, 2345, 2346
            )
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'result' => array(
                    array('product_type_id' => "1", 'total' => "16"),
                    array('product_type_id' => "2", 'total' => "4.8"),
                    array('product_type_id' => "3", 'total' => "12.5")
                )
            ]);
    }
}
