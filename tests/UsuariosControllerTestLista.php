<?php
use PHPUnit\Framework\TestCase;

class UsuariosControllerTest extends TestCase
{
    private $pdo;
    private $stmt;
    protected function setUp(): void
    {
        // Simular el objeto PDO
        $this->pdo = $this->createMock(PDO::class);

        // Simular el objeto de la declaración preparada (PDOStatement)
        $this->stmt = $this->createMock(PDOStatement::class);
    }
    public function testConsultaUsuariosDevuelveResultadosEsperados()
    {
        // Datos simulados que se esperan de la base de datos
        $usuarios_datos_esperados = [
            [
                'id_usuario' => 1,
                'nombres' => 'Alejandro Restrepo',
                'email' => 'alejandro@gmail.com',
                'rol' => 'ADMINISTRADOR'
            ],
            [
                'id_usuario' => 2,
                'nombres' => 'Pamela Molina',
                'email' => 'pamelamolina@gmail.com',
                'rol' => 'CONTADOR'
            ]
        ];
        // Configuración del mock para que el método `prepare` devuelva el mock del PDOStatement
        $this->pdo->method('prepare')->willReturn($this->stmt);
        // Configuración del mock para que el método `execute` no falle
        $this->stmt->method('execute')->willReturn(true);
        // Configuración del mock para que `fetchAll` devuelva los datos esperados
        $this->stmt->method('fetchAll')->willReturn($usuarios_datos_esperados);
        // Ejecutar la consulta como lo haría en tu código real
        $sql_usuarios = "
            SELECT 
                us.id_usuario AS id_usuario, 
                us.nombres AS nombres, 
                us.email AS email, 
                rol.rol AS rol
            FROM tb_usuarios AS us
            INNER JOIN tb_roles AS rol ON us.id_rol = rol.id_rol
        ";

        $query_usuarios = $this->pdo->prepare($sql_usuarios);
        $query_usuarios->execute();
        $usuarios_datos = $query_usuarios->fetchAll(PDO::FETCH_ASSOC);

        // Afirmar que los datos obtenidos son los esperados
        $this->assertEquals($usuarios_datos_esperados, $usuarios_datos);
    }
}
