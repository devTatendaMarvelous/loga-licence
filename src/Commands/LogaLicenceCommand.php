<?php
namespace Marvelous\Licence\Commands;

use Illuminate\Console\Command;

class LogaLicenceCommand extends Command
{
protected $signature = 'loga-licence';
protected $description = 'Description of your command';

public function handle()
{
    function appendRouteIfNotExists($stubFilePath, $targetFilePath)
    {
        // Get the contents of the stub file
        $routeLine = file_get_contents($stubFilePath);

        // Get the directory path from the target file path
        $directory = dirname($targetFilePath);


        // Check if the directory exists, if not, create it
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true); // Create directory recursively
        }

        // Check if the target file exists
        if (!file_exists($targetFilePath)) {
            // Create the target file and initialize with PHP opening tag
            file_put_contents($targetFilePath, "<?php\n\n");
        }

        // Get the contents of the target file
        $targetContents = file_get_contents($targetFilePath);

        // Check if the route line exists in the target file
        if (strpos($targetContents, $routeLine) === false) {
            // Append the route line to the target file
            file_put_contents($targetFilePath, PHP_EOL . $routeLine, FILE_APPEND);
            return true; // Route line was appended
        }

        return false; // Route line already exists
    }

// Usage
    $stubFilePath = __DIR__.'/../stubs/api-routes.stub'; // Update with the actual path to the stub file
    $targetFilePath = base_path( 'routes/api.php'); // Update with the actual path to the target file

    if (appendRouteIfNotExists($stubFilePath, $targetFilePath)) {
        echo "Route has been appended to the target file.";
    } else {
        echo "Route already exists in the target file.";
    }
}
}
