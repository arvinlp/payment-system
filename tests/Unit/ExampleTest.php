<?php

namespace Tests\Feature;

use App\Models\Currency;
use App\Models\Gateway;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class MainControllerTest extends TestCase
{
    use RefreshDatabase; // Use this trait to reset the database with each test

    protected function setUp(): void
    {
        parent::setUp();
        // Create necessary data for testing
        Currency::factory()->create(['status' => 2, 'name' => 'IRR']);
        Gateway::factory()->create(['status' => 1, 'id' => 1]);
    }

    public function testIndexReturnsViewWithCurrencyAndGateways()
    {
        $response = $this->get(route('home')); // Adjust the route name as needed
        
        $response->assertStatus(200);
        $response->assertViewHas('currency', 'IRR');
        $response->assertViewHas('gateways'); // Check if gateways are returned
    }

    public function testShowRedirectsOnInvalidInput()
    {
        $response = $this->get(route('show', ['amount' => null, 'gateway' => null]));
        
        $response->assertRedirect(route('home'));
    }

    public function testShowHandlesValidInputSuccessfully()
    {
        $mobile = '09123456789';
        User::create(['mobile' => $mobile, 'nickname' => 'Test User']);

        $response = $this->get(route('show', [
            'amount' => 2000,
            'gateway' => 1,
            'mobile' => $mobile,
            'name' => 'Test User'
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('pay');
        $response->assertViewHas('amount', 2000);
    }

    public function testSendRedirectsWithErrorOnInvalidMobile()
    {
        $response = $this->post(route('send'), [
            'amount' => 1500,
            'gateway' => 1,
            'mobile' => 'invalid-mobile'
        ]);

        $response->assertRedirect(route('home'));
        $response->assertSessionHas('error', 'شماره موبایل قابل قبول نمی‌باشد !');
    }

    public function testVerifyHandlesSuccessfulPayment()
    {
        // Create a mock payment record
        $payment = Payment::create(['transaction' => '123', 'amount' => 1500]);

        // Call the verify method with valid transaction details
        $response = $this->get(route('verify', ['sti' => $payment->transaction, 'price' => 1500, 'ipgw' => 1]));

        $response->assertStatus(200);
        // Ensure further assertions based on the view returned
    }

    // Add more tests as necessary...
}
<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_that_true_is_true(): void
    {
        $this->assertTrue(true);
    }
}
