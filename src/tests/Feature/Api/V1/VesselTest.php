<?php

namespace Tests\Feature\Api\V1;

use App\Models\User;
use App\Models\Vessel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VesselTest extends TestCase
{
    /**
     * Test API V1 get list vessels success
     *
     * @return void
     */
    public function test_get_list_vessels_success()
    {
        $user = User::factory()->create();
        $token = $user->createToken('authToken')->plainTextToken;

        $response = $this->withHeaders([
                'Authorization' => 'Bearer '.$token
        ])->get('/api/v1/vessels');

        $response->assertOk()
                ->assertSeeText('data');
    }

    /**
     * Test API V1 get list vessels failed
     *
     * @return void
     */
    public function test_get_list_vessels_failed()
    {
        $response = $this->get('/api/v1/vessels');

        $response->assertUnauthorized();
    }

    /**
     * Test API V1 get detail vessels success
     *
     * @return void
     */
    public function test_get_detail_vessels_success()
    {
        $user = User::factory()->create();
        $token = $user->createToken('authToken')->plainTextToken;

        $vessel = Vessel::factory()->create();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$token
        ])->get('/api/v1/vessels/'.$vessel->_id);

        $response->assertOk()
                 ->assertJson([
                    'status' => true
        ]);
    }

    /**
     * Test API V1 get list vessels failed
     *
     * @return void
     */
    public function test_get_detail_vessels_failed()
    {
        $user = User::factory()->create();
        $token = $user->createToken('authToken')->plainTextToken;

        $vessel = Vessel::factory()->create();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$token
        ])->get('/api/v1/vessels/xx'.$vessel->_id);

        $response->assertNotFound();
    }

    /**
     * Test API V1 get filtered vessels success
     *
     * @return void
     */
    public function test_get_filtered_mmsi_vessels_success()
    {
        $user = User::factory()->create();
        $token = $user->createToken('authToken')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$token
        ])->get('/api/v1/vessels?mmsi=247039300');

        $response->assertOk()
                 ->assertJson([
                    'status' => true
        ]);
    }
}
