<?php
namespace Tests\Unit\Services;
use App\Models\Employee;
use ArrayObject;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use App\Services\SearchService;
use Tests\TestCase;

class SearchServiceTest extends TestCase {
    public function testSearch(){
    // Set search criteria
    $criteria = [

    'department_id' => 1,
    'position_id' => 2,
    ];

    // Mock the cache
    Cache::shouldReceive('remember')
     ->once()
     ->with('search_results_' . serialize($criteria), 60, \Closure::class)
     ->andReturn(collect([]));

    // Call the search function with the criteria
    $results = app(SearchService::class)->search(Employee::class, $criteria);

    // Assert that the expected results are returned
    $this->assertInstanceOf(ArrayObject::class, $results);
    }
}
 ?>
