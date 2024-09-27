<?php

use PHPUnit\Framework\TestCase;

class CategoriasListTest extends TestCase
{
    private $pdo;
    private $stmt;

    protected function setUp(): void
    {
        // Crea un mock de la clase PDO
        $this->pdo = $this->createMock(PDO::class);

        // Crea un mock del statement que devolverá los datos simulados
        $this->stmt = $this->createMock(PDOStatement::class);

        // Simula el resultado del query de listado de categorías
        $fakeCategories = [
            ['id' => 1, 'nombre' => 'Carnes'],
            ['id' => 2, 'nombre' => 'Lácteos']
        ];

        // Configura el mock para devolver el resultado simulado cuando se llama a fetchAll
        $this->stmt->method('fetchAll')
            ->willReturn($fakeCategories);

        // Configura el mock de PDO para que devuelva el mock del statement cuando se llama a query
        $this->pdo->method('query')
            ->willReturn($this->stmt);
    }

    public function testListadoCategorias()
    {
        // Simula la ejecución del query y la obtención de los resultados
        $sql = "SELECT * FROM categorias";
        $stmt = $this->pdo->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Verifica que el resultado no esté vacío
        $this->assertNotEmpty($result, "El listado de categorías está vacío");

        // Verifica que el array de resultados contenga las categorías simuladas
        $this->assertCount(2, $result, "El número de categorías no es el esperado");
        $this->assertEquals('Carnes', $result[0]['nombre']);
        $this->assertEquals('Lácteos', $result[1]['nombre']);
    }
}



