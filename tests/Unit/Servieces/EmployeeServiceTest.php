<?php
namespace Tests\Unit\Services;
use Tests\TestCase;
use App\Services\EmployeeService;
use App\Repositories\EmployeeRepository;
use App\Models\Employee;


class EmployeeServiceTest extends TestCase {
    protected $employeeService;
    protected function setUp():void{
        parent::setUp();

        $employeeRepository = $this->createMock(EmployeeRepository::class);
        $this->employeeService = new EmployeeService($employeeRepository);
    }
    public function testGetEmployeeById()
    {
        $employeeId = 1;
        $employee = factory(Employee::class)->make([
            'id' => $employeeId,
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
        ]);

        $this->employeeService->getRepository()
            ->method('getById')
            ->with($employeeId)
            ->willReturn($employee);

        $result = $this->employeeService->getById($employeeId);

        $this->assertEquals($employeeId, $result->id);
        $this->assertEquals('John Doe', $result->name);
        $this->assertEquals('johndoe@example.com', $result->email);
    }
}
 ?>
