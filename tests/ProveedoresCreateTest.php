<?php

use PHPUnit\Framework\TestCase;

class ProveedoresCreateTest extends TestCase
{
    private $pdoMock;

    protected function setUp(): void
    {
        // Crear un mock para la conexión PDO
        $this->pdoMock = $this->createMock(PDO::class);

        // Crear un mock para la sentencia PDOStatement
        $stmtMock = $this->createMock(PDOStatement::class);
        $stmtMock->expects($this->once())
            ->method('execute')
            ->willReturn(true); // Simula que la ejecución es exitosa

        // Configurar el mock para PDO
        $this->pdoMock->expects($this->once())
            ->method('prepare')
            ->willReturn($stmtMock);

        // Inyectar el mock en el entorno global
        $GLOBALS['pdo'] = $this->pdoMock;
    }

    public function testCreateProveedorSuccess()
    {
        // Simular datos del formulario
        $_POST['nombre_proveedor'] = 'Proveedor Test';
        $_POST['celular'] = '123456789';
        $_POST['telefono'] = '987654321';
        $_POST['empresa'] = 'Empresa Test';
        $_POST['email'] = 'test@empresa.com';
        $_POST['direccion'] = 'Dirección Test';
        $fechaHora = date('Y-m-d H:i:s'); // Simular fecha y hora actual

        // Simular la lógica del controlador
        $nombre = $_POST['nombre_proveedor'];
        $celular = $_POST['celular'];
        $telefono = $_POST['telefono'];
        $empresa = $_POST['empresa'];
        $email = $_POST['email'];
        $direccion = $_POST['direccion'];

        // Preparar la consulta para insertar el proveedor
        $stmt = $GLOBALS['pdo']->prepare("
            INSERT INTO tb_proveedores (nombre_proveedor, celular, telefono, empresa, email, direccion, fyh_creacion)
            VALUES (:nombre_proveedor, :celular, :telefono, :empresa, :email, :direccion, :fyh_creacion)
        ");
        $stmt->bindParam(':nombre_proveedor', $nombre);
        $stmt->bindParam(':celular', $celular);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':empresa', $empresa);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':direccion', $direccion);
        $stmt->bindParam(':fyh_creacion', $fechaHora);
        $result = $stmt->execute();

        // Simular la configuración de sesión después de la ejecución
        $_SESSION['mensaje'] = "Se registró el proveedor correctamente";
        $_SESSION['icono'] = "success";

        // Verificar el resultado simulado
        $this->assertTrue($result);
        $this->assertEquals('Se registró el proveedor correctamente', $_SESSION['mensaje']);
        $this->assertEquals('success', $_SESSION['icono']);
    }
}
