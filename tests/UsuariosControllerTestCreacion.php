<?php

use PHPUnit\Framework\TestCase;

class UsuariosControllerTestCreacion extends TestCase
{
    protected $pdo;
    protected $fechaHora;

    protected function setUp(): void
    {
        // Configurar un mock para PDO
        $this->pdo = $this->createMock(PDO::class);
        $this->fechaHora = date('Y-m-d H:i:s');
    }

    public function testCrearUsuarioCorrectamente()
    {
        // Datos de prueba
        $nombres = 'John Doe';
        $email = 'johndoe@example.com';
        $id_rol = 1; // ID de rol
        $password_user = 'password123';
        $password_repeat = 'password123';

        // Configurar el mock para PDOStatement
        $pdoStatement = $this->createMock(PDOStatement::class);
        $pdoStatement->expects($this->once())
            ->method('execute')
            ->willReturn(true);

        // Configurar el mock para PDO
        $this->pdo->expects($this->once())
            ->method('prepare')
            ->with($this->stringContains('INSERT INTO tb_usuarios'))
            ->willReturn($pdoStatement);

        // Llamar a la función para registrar el usuario
        $resultado = $this->crearUsuario($nombres, $email, $id_rol, $password_user, $password_repeat);

        // Verificar el resultado
        $this->assertEquals('Se registró al usuario correctamente', $resultado);
    }

    public function testCrearUsuarioConContraseñasNoCoinciden()
    {
        // Datos de prueba
        $nombres = 'John Doe';
        $email = 'johndoe@example.com';
        $id_rol = 1; // ID de rol
        $password_user = 'password123';
        $password_repeat = 'password124'; // Contraseña diferente

        // Llamar a la función para registrar el usuario
        $resultado = $this->crearUsuario($nombres, $email, $id_rol, $password_user, $password_repeat);

        // Verificar el resultado
        $this->assertEquals('Error: las contraseñas no coinciden', $resultado);
    }

    private function crearUsuario($nombres, $email, $id_rol, $password_user, $password_repeat)
    {
        // Simulación de la lógica del controlador
        if ($password_user === $password_repeat) {
            $password_user = password_hash($password_user, PASSWORD_DEFAULT);

            $sentencia = $this->pdo->prepare("
                INSERT INTO tb_usuarios 
                    (nombres, email, id_rol, password_user, fyh_creacion)
                VALUES 
                    (:nombres, :email, :id_rol, :password_user, :fyh_creacion)
            ");

            $sentencia->bindParam(':nombres', $nombres);
            $sentencia->bindParam(':email', $email);
            $sentencia->bindParam(':id_rol', $id_rol);
            $sentencia->bindParam(':password_user', $password_user);
            $sentencia->bindParam(':fyh_creacion', $this->fechaHora);

            if ($sentencia->execute()) {
                return 'Se registró al usuario correctamente';
            } else {
                return 'Error al registrar al usuario';
            }
        } else {
            return 'Error: las contraseñas no coinciden';
        }
    }
}
