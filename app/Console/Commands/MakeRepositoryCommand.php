<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeRepositoryCommand extends Command
{
    protected $signature = 'make:repository {name}';
    protected $description = 'Create a new repository class, interface, and service';

    public function handle(): void
    {
        $name = $this->argument('name');
        $filesystem = new Filesystem();

        // مسیرهای فایل‌ها
        $repositoryPath = app_path("Repositories/Contracts/{$name}Repository.php");
        $interfacePath = app_path("Repositories/Interfaces/{$name}RepositoryInterface.php");
        $servicePath = app_path("Services/{$name}Service.php");

        // ایجاد دایرکتوری‌های مورد نیاز
        if (!$filesystem->isDirectory(app_path('Repositories/Interfaces'))) {
            $filesystem->makeDirectory(app_path('Repositories/Interfaces'), 0755, true);
        }
        if (!$filesystem->isDirectory(app_path('Repositories/Contracts'))) {
            $filesystem->makeDirectory(app_path('Repositories/Contracts'), 0755, true);
        }
        if (!$filesystem->isDirectory(app_path('Services'))) {
            $filesystem->makeDirectory(app_path('Services'), 0755, true);
        }

        // بررسی عدم وجود ریپازیتوری
        if ($filesystem->exists($repositoryPath)) {
            $this->error("Repository {$name} already exists!");
            return;
        }

        // ایجاد اینترفیس ریپازیتوری
        $interfaceContent = "<?php

namespace App\Repositories\Interfaces;

use App\Repositories\BaseRepositoryInterface;

interface {$name}RepositoryInterface extends BaseRepositoryInterface
{
    //
}
";
        $filesystem->put($interfacePath, $interfaceContent);

        // ایجاد کلاس ریپازیتوری
        $repositoryContent = "<?php

namespace App\Repositories\Contracts;

use App\Repositories\Interfaces\\{$name}RepositoryInterface;
use App\Models\\{$name};
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class {$name}Repository extends BaseRepository implements {$name}RepositoryInterface
{
    //
}
";
        $filesystem->put($repositoryPath, $repositoryContent);

        // ایجاد کلاس سرویس
        $serviceContent = "<?php

namespace App\Services;

use App\Repositories\Interfaces\\{$name}RepositoryInterface;

class {$name}Service
{
    public function __construct(public {$name}RepositoryInterface \$repository)
    {
    }

    public function all(int \$id)
    {
        return \$this->repository->all(\$id);
    }

    public function store(mixed \$validated)
    {
        return \$this->repository->store(\$validated);
    }

    public function update(mixed \$validated, mixed \$id)
    {
        return \$this->repository->update(\$id, \$validated);
    }

    public function destroy(int \$id)
    {
        return \$this->repository->destroy(\$id);
    }

    public function findById(int \$id)
    {
        return \$this->repository->findById(\$id);
    }
}
";
        $filesystem->put($servicePath, $serviceContent);

        $this->info("Repository, Interface, and Service for {$name} created successfully!");
    }
}
