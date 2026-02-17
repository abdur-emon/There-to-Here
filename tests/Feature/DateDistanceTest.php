<?php

namespace Tests\Feature;

use App\Services\DateDistanceService;
use Tests\TestCase;

class DateDistanceTest extends TestCase
{
    private DateDistanceService $service;
    
    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new DateDistanceService();
    }
    
    public function test_calculates_future_date_correctly(): void
    {
        $result = $this->service->calculate('2030-01-01', '2025-01-01');
        
        $this->assertEquals(5, $result['years']);
        $this->assertEquals(0, $result['months']);
        $this->assertEquals(0, $result['days']);
        $this->assertEquals('future', $result['direction']);
    }
    
    public function test_calculates_past_date_correctly(): void
    {
        $result = $this->service->calculate('2020-01-01', '2025-01-01');
        
        $this->assertEquals(5, $result['years']);
        $this->assertEquals(0, $result['months']);
        $this->assertEquals(0, $result['days']);
        $this->assertEquals('past', $result['direction']);
    }
    
    public function test_calculates_same_date(): void
    {
        $result = $this->service->calculate('2025-01-01', '2025-01-01');
        
        $this->assertEquals(0, $result['totalDays']);
        $this->assertEquals('same', $result['direction']);
        $this->assertEquals('Today', $result['humanReadable']);
    }
    
    public function test_calculates_totals_correctly(): void
    {
        $result = $this->service->calculate('2026-01-01', '2025-01-01');
        
        $this->assertEquals(365, $result['totalDays']);
        $this->assertEquals(52.14, $result['totalWeeks']);
        $this->assertEquals(8760, $result['totalHours']);
    }
    
    public function test_validates_dates(): void
    {
        $this->assertTrue($this->service->isValidDate('2025-01-01'));
        $this->assertTrue($this->service->isValidDate('2025-12-31'));
        $this->assertFalse($this->service->isValidDate('invalid-date'));
        $this->assertFalse($this->service->isValidDate('2025-13-01')); // Invalid month
    }
    
    public function test_handles_leap_year(): void
    {
        // 2024 is a leap year
        $result = $this->service->calculate('2025-02-28', '2024-02-28');
        
        $this->assertEquals(1, $result['years']);
        $this->assertEquals(366, $result['totalDays']); // Leap year has 366 days
    }
    
    public function test_home_page_loads(): void
    {
        $response = $this->get('/');
        
        $response->assertStatus(200);
        $response->assertSee('How Long?');
    }
    
    public function test_home_page_with_query_params(): void
    {
        $response = $this->get('/?date=2030-01-01&from=2025-01-01');
        
        $response->assertStatus(200);
        $response->assertSee('5 years from now');
    }
}

