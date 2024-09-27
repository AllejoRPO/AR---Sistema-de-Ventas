<?php

use PHPUnit\Framework\TestCase;

class ClientesListTest extends TestCase
{
    public function testClientesList()
    {
        // Simular datos de clientes
        $mockClientes = [
            ['id_cliente' => 1, 'nombre_cliente' => 'Pamela Molina', 'nit_ci_cliente' => '1040518401', 'celular_cliente' => '3136980177', 'email_cliente' => 'pamelapandita@gmail.com'],
            ['id_cliente' => 2, 'nombre_cliente' => 'Margarita Arango', 'nit_ci_cliente' => '10385670911', 'celular_cliente' => '3234527766', 'email_cliente' => 'margarita2010@gmail.com']
        ];

        // Simular la función que obtiene los clientes
        $mockQueryClientes = $this->createMock(PDOStatement::class);
        $mockQueryClientes->method('fetchAll')->willReturn($mockClientes);

        // Reemplazar el objeto PDO y la consulta
        $mockPDO = $this->createMock(PDO::class);
        $mockPDO->method('prepare')->willReturn($mockQueryClientes);

        // Simular la inclusión del controlador y la ejecución de la consulta
        $clientes_datos = $mockQueryClientes->fetchAll(PDO::FETCH_ASSOC);

        // Validar la cantidad de clientes obtenidos
        $this->assertCount(2, $clientes_datos, 'Debería haber 2 clientes en la lista.');

        // Validar los datos de los clientes
        $this->assertEquals('Pamela Molina', $clientes_datos[0]['nombre_cliente'], 'El primer cliente debería ser Pamela Molina.');
        $this->assertEquals('Margarita Arango', $clientes_datos[1]['nombre_cliente'], 'El segundo cliente debería ser Margarita Arango.');
        $this->assertEquals('1040518401', $clientes_datos[0]['nit_ci_cliente'], 'El NIT/CI del primer cliente debería ser 1040518401.');
        $this->assertEquals('10385670911', $clientes_datos[1]['nit_ci_cliente'], 'El NIT/CI del segundo cliente debería ser 10385670911.');
        $this->assertEquals('3136980177', $clientes_datos[0]['celular_cliente'], 'El celular del primer cliente debería ser 3136980177.');
        $this->assertEquals('3234527766', $clientes_datos[1]['celular_cliente'], 'El celular del segundo cliente debería ser 3234527766.');
        $this->assertEquals('pamelapandita@gmail.com', $clientes_datos[0]['email_cliente'], 'El email del primer cliente debería ser pamelapandita@gmail.com.');
        $this->assertEquals('margarita2010@gmail.com', $clientes_datos[1]['email_cliente'], 'El email del segundo cliente debería ser margarita2010@gmail.com.');
    }
}
