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

        $routeLine = file_get_contents($stubFilePath);

        $directory = dirname($targetFilePath);


        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }


        if (!file_exists($targetFilePath)) {
            file_put_contents($targetFilePath, "<?php\n\n");
        }


        $targetContents = file_get_contents($targetFilePath);


        if (strpos($targetContents, $routeLine) === false) {

            file_put_contents($targetFilePath, PHP_EOL . $routeLine, FILE_APPEND);
            return true;
        }

        return false;
    }


    $stubFilePath = __DIR__.'/../stubs/api-routes.stub';
    $targetFilePath = base_path( 'routes/api.php');

    if (appendRouteIfNotExists($stubFilePath, $targetFilePath)) {
        echo "Route has been appended to the target file.";
    } else {
        echo "Route already exists in the target file.";
    }
}
}
