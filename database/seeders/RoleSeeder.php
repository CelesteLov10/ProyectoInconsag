<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Cliente']);
        
        // para asignar un permiso a varios roles 
        // Permission::create(['name' => 'Admin.puestoLaboral.index'])->syncRoles([$role1, $role2]);

        //asiganar un permiso solo a un role
        // Permission::create(['name' => 'Admin.puestoLaboral.index'])->assingRole($role1);
        Permission::create(['name' => 'Admin.puestoLaboral.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'Admin.puestoLaboral.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'Admin.puestoLaboral.edit'])->syncRoles([$role1]);
    
        Permission::create(['name' => 'Admin.empleado.indexEmp'])->syncRoles([$role1]);
        Permission::create(['name' => 'Admin.empleado.createEmp'])->syncRoles([$role1]);
        Permission::create(['name' => 'Admin.empleado.editEmp'])->syncRoles([$role1]);
        Permission::create(['name' => 'Admin.empleado.showEmp'])->syncRoles([$role1]);

        Permission::create(['name' => 'Admin.inventario.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'Admin.inventario.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'Admin.inventario.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'Admin.inventario.show'])->syncRoles([$role1]);

        Permission::create(['name' => 'Admin.oficina.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'Admin.oficina.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'Admin.oficina.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'Admin.oficina.show'])->syncRoles([$role1]);

        Permission::create(['name' => 'Admin.proveedor.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'Admin.proveedor.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'Admin.proveedor.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'Admin.proveedor.show'])->syncRoles([$role1]);

        Permission::create(['name' => 'Admin.maquinaria.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'Admin.maquinaria.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'Admin.maquinaria.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'Admin.maquinaria.show'])->syncRoles([$role1]);
        Permission::create(['name' => 'Admin.maquinaria.pdf'])->syncRoles([$role1]);

        Permission::create(['name' => 'Admin.bloque.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'Admin.bloque.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'Admin.bloque.show'])->syncRoles([$role1]);

        Permission::create(['name' => 'Admin.lote.create'])->syncRoles([$role1]);

        Permission::create(['name' => 'Admin.cliente.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'Admin.cliente.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'Admin.cliente.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'Admin.cliente.show'])->syncRoles([$role1]);

        Permission::create(['name' => 'Admin.beneficiario.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'Admin.beneficiario.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'Admin.beneficiario.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'Admin.beneficiario.show'])->syncRoles([$role1]);

        Permission::create(['name' => 'Admin.venta.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'Admin.venta.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'Admin.venta.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'Admin.venta.show'])->syncRoles([$role1]);

        Permission::create(['name' => 'Admin.pago.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'Admin.pago.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'Admin.pago.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'Admin.pago.show'])->syncRoles([$role1]);
        Permission::create(['name' => 'Admin.pago.pdf'])->syncRoles([$role1]);

        Permission::create(['name' => 'Admin.constructora.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'Admin.constructora.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'Admin.constructora.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'Admin.constructora.show'])->syncRoles([$role1]);

        Permission::create(['name' => 'Admin.casa.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'Admin.casa.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'Admin.casa.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'Admin.casa.show'])->syncRoles([$role1]);

        Permission::create(['name' => 'Admin.liberado.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'Admin.liberado.create'])->syncRoles([$role1]);

        Permission::create(['name' => 'Admin.gasto.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'Admin.gasto.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'Admin.gasto.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'Admin.gasto.show'])->syncRoles([$role1]);

        Permission::create(['name' => 'Admin.planilla.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'Admin.planilla.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'Admin.planilla.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'Admin.planilla.show'])->syncRoles([$role1]);

        Permission::create(['name' => 'Admin.user.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'Admin.user.edit'])->syncRoles([$role1]);

        //$role1->permissions()->attach(1,2,3 ...);

    }

}
