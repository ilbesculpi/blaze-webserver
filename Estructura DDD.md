# Folder Structure

```
app/
├── Domains/
│   ├── Users/
│   │   ├── Entities/
│   │   │   └── User.php
│   │   ├── Repositories/
│   │   │   └── UserRepository.php
│   │   ├── Services/
│   │   │   └── UserService.php
│   │   ├── UseCases/
│   │   │   └── CreateUserUseCase.php
│   │   └── ValueObjects/
│   │       └── Email.php
│   ├── Condominios/
│       ├── Entities/
│       │   └── Condominio.php
│       ├── Repositories/
│       │   └── CondominioRepository.php
│       ├── Services/
│       │   └── CondominioService.php
│       ├── UseCases/
│       │   └── CreateCondominioUseCase.php
│       └── ValueObjects/
│           └── Money.php
├── Http/
│   ├── Controllers/
│   │   ├── UserController.php
│   │   └── CondominioController.php
│   └── Requests/
│       ├── CreateUserRequest.php
│       └── CreateCondominiRequest.php
├── Models/
│   ├── User.php
│   └── Condominio.php
```

## Code Examples

namespace App\Http\Controllers;

use App\Domains\Users\UseCases\CreateUserUseCase;
use Illuminate\Http\Request;

**UserController.php**
```php
class UserController extends Controller
{
    public function store(Request $request)
    {
        $createUserUseCase = new CreateUserUseCase();
        $createUserUseCase->execute($request->all());

        return redirect()->route('users.index');
    }
}
```


**CreateUserUseCase.php**
```php
namespace App\Http\Controllers;

use App\Domains\Users\UseCases\CreateUserUseCase;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $createUserUseCase = new CreateUserUseCase();
        $createUserUseCase->execute($request->all());

        return redirect()->route('users.index');
    }
}
```

**CreateUserUseCase.php**
```php
namespace App\Domains\Users\UseCases;

use App\Domains\Users\Repositories\UserRepository;

class CreateUserUseCase
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(array $userData)
    {
        $user = $this->userRepository->create($userData);
        // ... other logic, like sending a welcome email, etc.
    }
}
```

**UserRepository.php**
```php
namespace App\Domains\Users\Repositories;

use App\Models\User;

class UserRepository
{
    public function create(array $userData): User
    {
        return User::create($userData);
    }
}
```

## Tests

**CreateUserUseCaseTest.php**
```php
namespace Tests\Unit\Domains\Users\UseCases;

use App\Domains\Users\Repositories\UserRepository;
use App\Domains\Users\UseCases\CreateUserUseCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateUserUseCaseTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateUser()
    {
        $userRepository = $this->mock(UserRepository::class);
        $userRepository->shouldReceive('create')->once()->with(['name' => 'John Doe', 'email' => 'johndoe@example.com'])->andReturn(new \App\Models\User());

        $createUserUseCase = new CreateUserUseCase($userRepository);
        $createUserUseCase->execute(['name' => 'John Doe', 'email' => 'johndoe@example.com']);

        $userRepository->shouldHaveReceived('create');
    }
}
```

**UserRepositoryTest.php**
```php
namespace Tests\Unit\Domains\Users\Repositories;

use App\Domains\Users\Repositories\UserRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateUser()
    {
        $userData = ['name' => 'Jane Doe', 'email' => 'janedoe@example.com'];
        $user = (new UserRepository())->create($userData);

        $this->assertDatabaseHas('users', $userData);
        $this->assertInstanceOf(\App\Models\User::class, $user);
    }
}
```
