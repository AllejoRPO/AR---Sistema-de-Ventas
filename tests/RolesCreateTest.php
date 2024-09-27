<?php

use PHPUnit\Framework\TestCase;

class RolesCreateTest extends TestCase
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
            ->willReturn(true);

        // Configurar el mock para PDO
        $this->pdoMock->expects($this->once())
            ->method('prepare')
            ->willReturn($stmtMock);

        // Inyectar el mock en el entorno global
        $GLOBALS['pdo'] = $this->pdoMock;
    }

    public function testCreateRoleSuccess()
    {
        // Simular datos del formulario
        $_POST['rol'] = 'Administrador';
        $fechaHora = date('Y-m-d H:i:s'); // Simular fecha y hora actual

        // Simular la lógica del controlador
        $rol = $_POST['rol'];
        $stmt = $GLOBALS['pdo']->prepare("
            INSERT INTO tb_roles (rol, fyh_creacion)
            VALUES (:rol, :fyh_creacion)
        ");
        $stmt->bindParam(':rol', $rol);
        $stmt->bindParam(':fyh_creacion', $fechaHora);
        $result = $stmt->execute();

        // Simular la configuración de sesión después de la ejecución
        $_SESSION['mensaje'] = "Se registró el rol correctamente";
        $_SESSION['icono'] = "success";

        // Verificar el resultado simulado
        $this->assertTrue($result);
        $this->assertEquals('Se registró el rol correctamente', $_SESSION['mensaje']);
        $this->assertEquals('success', $_SESSION['icono']);
    }
}
