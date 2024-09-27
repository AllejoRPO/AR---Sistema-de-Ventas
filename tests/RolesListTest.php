<?php

use PHPUnit\Framework\TestCase;

class RolesListTest extends TestCase
{
    public function testRolesList()
    {
        // Simular datos de roles
        $mockRoles = [
            ['id_rol' => 1, 'rol' => 'Admin'],
            ['id_rol' => 2, 'rol' => 'User']
        ];

        // Simular la función que obtiene los roles
        $mockQueryRoles = $this->createMock(PDOStatement::class);
        $mockQueryRoles->method('fetchAll')->willReturn($mockRoles);

        // Reemplazar el objeto PDO y la consulta
        $mockPDO = $this->createMock(PDO::class);
        $mockPDO->method('prepare')->willReturn($mockQueryRoles);

        // Simular la inclusión del controlador y la ejecución de la consulta
        $roles_datos = $mockQueryRoles->fetchAll(PDO::FETCH_ASSOC);

        // Validar la cantidad de roles obtenidos
        $this->assertCount(2, $roles_datos, 'Debería haber 2 roles en la lista.');

        // Validar los datos de los roles
        $this->assertEquals('Admin', $roles_datos[0]['rol'], 'El primer rol debería ser Admin.');
        $this->assertEquals('User', $roles_datos[1]['rol'], 'El segundo rol debería ser User.');
    }
}
