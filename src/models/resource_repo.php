<?php
declare(strict_types=1);

class ResourceRepo {
    private $context;
    private const ENDPOINT = "https://api.github.com/repos/joanmat117/pruebas-de-ingreso-recursos/git/trees/main?recursive=1";

    public function __construct() {
        $options = [
            "http" => [
                "method" => "GET",
                "header" => [
                    "User-Agent: PHP-App",
                    "Accept: application/vnd.github.v3+json"
                ]
            ]
        ];
        $this->context = stream_context_create($options);
    }

    public function get_all_files(): array {
        $response = file_get_contents(self::ENDPOINT, false, $this->context); 
        
        if ($response === false) {
            // Si falla la conexión con la API, usar el archivo mock
            return $this->get_all_files_mock();
        }

        $data = json_decode($response, true);
        
        // Si la API devuelve una respuesta vacía o sin el campo 'tree',
        // también usar el archivo mock
        if (empty($data) || !isset($data['tree'])) {
            return $this->get_all_files_mock();
        }

        return $data['tree'];
    }

    public function get_all_files_mock(): array {
        $response = file_get_contents(ROOT . "/src/data/files_mock.json"); 
        
        if ($response === false) {
            return []; // Manejo básico de error
        }

        $data = json_decode($response, true);
        
        return $data['tree'] ?? [];
    }
}
