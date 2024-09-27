<?php

use PHPUnit\Framework\TestCase;

class ComprasListTest extends TestCase
{
    private $pdoMock;

    protected function setUp(): void
    {
        // Crear un mock para la conexión PDO
        $this->pdoMock = $this->createMock(PDO::class);

        // Crear un mock para la sentencia PDOStatement
        $stmtMock = $this->createMock(PDOStatement::class);

        // Simular el comportamiento del método 'execute' para listar compras
        $stmtMock->expects($this->once())
            ->method('execute')
            ->willReturn(true);

        // Simular el método 'fetchAll' para devolver una lista de compras
        $stmtMock->method('fetchAll')
            ->willReturn([
                ['id' => 1, 'producto' => 'Producto A', 'cantidad' => 10, 'precio' => 100.00],
                ['id' => 2, 'producto' => 'Producto B', 'cantidad' => 5, 'precio' => 50.00],
            ]);

        // Configurar el mock para PDO
        $this->pdoMock->expects($this->once())
            ->method('prepare')
            ->willReturn($stmtMock);

        // Inyectar el mock en el entorno global
        $GLOBALS['pdo'] = $this->pdoMock;
    }

    public function testListarCompras()
    {
        // Simular la lógica del controlador
        $stmt = $GLOBALS['pdo']->prepare("SELECT * FROM tb_compras");
        $stmt->execute();
        $resultado = $stmt->fetchAll();

        // Verificar que el resultado no esté vacío y sea un arreglo
        $this->assertNotEmpty($resultado, "La lista de compras no debe estar vacía.");
        $this->assertIsArray($resultado, "El resultado debe ser un arreglo.");

        // Verificar que los datos sean correctos
        $this->assertCount(2, $resultado, "Se esperaban 2 compras.");
        $this->assertEquals('Producto A', $resultado[0]['producto'], "El producto A debería ser el primero en la lista.");
    }

    public function testAgregarCompra()
    {
        // Simular datos de la compra a agregar
        $_POST['producto'] = 'Producto Ejemplo';
        $_POST['cantidad'] = 10;
        $_POST['precio'] = 100.00;
        $fechaHora = date('Y-m-d H:i:s'); // Simular fecha y hora actual

        // Simular la lógica del controlador para agregar compra
        $producto = $_POST['producto'];
        $cantidad = $_POST['cantidad'];
        $precio = $_POST['precio'];

        // Preparar la sentencia para insertar la compra
        $stmt = $GLOBALS['pdo']->prepare("
            INSERT INTO tb_compras (producto, cantidad, precio, fyh_creacion)
            VALUES (:producto, :cantidad, :precio, :fyh_creacion)
        ");
        $stmt->bindParam(':producto', $producto);
        $stmt->bindParam(':cantidad', $cantidad);
        $stmt->bindParam(':precio', $precio);
        $stmt->bindParam(':fyh_creacion', $fechaHora);

        // Simular la ejecución de la sentencia
        $result = $stmt->execute();

        // Simular la configuración de sesión después de la ejecución
        $_SESSION['mensaje'] = "Se registró la compra correctamente";
        $_SESSION['icono'] = "success";

        // Verificar el resultado simulado
        $this->assertTrue($result);
        $this->assertEquals('Se registró la compra correctamente', $_SESSION['mensaje']);
        $this->assertEquals('success', $_SESSION['icono']);
    }
}
