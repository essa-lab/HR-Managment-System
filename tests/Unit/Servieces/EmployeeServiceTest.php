<?php
namespace Tests\Unit\Services;
use Tests\TestCase;
use App\Services\EmployeeService;
use App\Repositories\EmployeeRepository;
use App\Models\Employee;
use Mockery\MockInterface;


class EmployeeServiceTest extends TestCase {
   protected $repositoryMock;
   protected $service;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a mock instance of EmployeeRepository
        $this->repositoryMock = $this->mock(EmployeeRepository::class, function (MockInterface $mock) {
            // Define what the `getById()` method of the repository should return when called with argument 1
            $mock->shouldReceive('getById')->with(1)->andReturn(
                new Employee([
                    'id' => 1,
                    'first_name' => 'John',
                    'last_name' => 'Doe',
                    // Add more attributes here as needed
                ])
            );

            // Define what the `getById()` method of the repository should return when called with argument 2
            $mock->shouldReceive('getById')->with(2)->andReturn(null);

            // specify the expected method calls and return values
           $mock->shouldReceive('delete')
            ->with(1)
             ->andReturn(true);
        });
        $this->service = new EmployeeService($this->repositoryMock);
    }

    public function testGetByIdReturnsEmployeeWithValidId()
    {
        // Call the getById() method of the service with a valid id (1)
        $employee = $this->service->getById(1);

        // Assert that the method returned an instance of Employee with the expected id
        $this->assertInstanceOf(Employee::class, $employee);
        $this->assertEquals(1, $employee->id);
        $this->assertEquals('John', $employee->first_name);
        $this->assertEquals('Doe', $employee->last_name);
        // Add more assertions here as needed
    }

    public function testGetByIdReturnsNullWithInvalidId()
    {

        // Call the getById() method of the service with an invalid id (2)
        $employee = $this->service->getById(2);

        // Assert that the method returned null
        $this->assertNull($employee);
    }
    public function testDeleteEmployeeWithValidId(){
         $this->assertTrue($this->service->delete(1));
    }


}
 ?>
