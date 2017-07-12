<?php

if(!function_exists("readline")) {
    function readline($prompt = null){
        if($prompt){
            echo $prompt;
        }
        $fp = fopen("php://stdin","r");
        $line = rtrim(fgets($fp, 1024));
        return $line;
    }
}

class GitKeep
{
	private $path;
	private $ignored;

	public function __construct($path)
	{
		$path = realpath($path);

		if (!file_exists($path)) {
			throw new Exception("Le dossier n'existe pas", 1);
		}

		$this->ignored = [
			'.git'
		];

		$this->path = $path;
	}

	private function createGitkeep($path, &$command)
	{
		$files = array_diff(scandir($path), array('..', '.'));

		if (empty($files)) {
			$command .= 'touch "'.$path."/.gitkeep\"\n";
		} else {

			foreach ($files as $file) {

				if (in_array($file, $this->ignored)) {
					continue;
				}

				$pathOfFile = $path."/".$file;
				if (is_dir($pathOfFile)) {
					$this->createGitkeep($pathOfFile, $command);
				}
			}
		}
	}

	public function execute()
	{
		$command = "";
		$this->createGitkeep($this->path, $command);

		if ($command) {
			echo $command."\nconfirm (y/n) : ";
			$input = readline();

			if ($input == 'y') {
				echo `$command`;
				echo "fichier créer\n";
			} else {
				echo "opération annulé\n";
			}
		} else {
			echo "Toute l'architechture est gitkeep\n";
		}
	}
}