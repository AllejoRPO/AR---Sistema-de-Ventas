<?php

use PHPUnit\Framework\TestCase;

class VentasFacturaTest extends TestCase
{
    protected $pdo;
    protected $fechaHora;

    protected function setUp(): void
    {
        // Configurar un mock para PDO
        $this->pdo = $this->createMock(PDO::class);
        $this->fechaHora = date('Y-m-d H:i:s');
    }

    public function testCrearFacturaCorrectamente()
    {
        // Datos de prueba
        $cliente_id = 1; // ID del cliente
        $total = 100.00; // Total de la factura

        // Configurar el mock para PDOStatement
        $pdoStatement = $this->createMock(PDOStatement::class);
        $pdoStatement->expects($this->once())
            ->method('execute')
            ->willReturn(true);

        // Configurar el mock para PDO
        $this->pdo->expects($this->once())
            ->method('prepare')
            ->with($this->stringContains('INSERT INTO ventas'))
            ->willReturn($pdoStatement);

        // Llamar a la función para registrar la factura
        $resultado = $this->crearFactura($cliente_id, $total);

        // Verificar el resultado
        $this->assertEquals('Se registró la factura correctamente', $resultado);
    }

    public function testCrearFacturaConDatosInvalidos()
    {
        // Datos de prueba
        $cliente_id = null; // ID del cliente inválido
        $total = 100.00; // Total de la factura

        // Llamar a la función para registrar la factura
        $resultado = $this->crearFactura($cliente_id, $total);

        // Verificar el resultado
        $this->assertEquals('Error: ID de cliente inválido', $resultado);
    }

    private function crearFactura($cliente_id, $total)
    {
        // Simulación de la lógica del controlador
        if ($cliente_id === null) {
            return 'Error: ID de cliente inválido';
        }

        $sentencia = $this->pdo->prepare("
            INSERT INTO ventas 
                (cliente_id, fecha, total) 
            VALUES 
                (:cliente_id, :fecha, :total)
        ");

        $sentencia->bindParam(':cliente_id', $cliente_id);
        $sentencia->bindParam(':fecha', $this->fechaHora);
        $sentencia->bindParam(':total', $total);

        if ($sentencia->execute()) {
            return 'Se registró la factura correctamente';
        } else {
            return 'Error al registrar la factura';
        }
    }
}
