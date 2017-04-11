<?php

namespace AppBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'usuario' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.src.AppBundle.Model.map
 */
class UsuarioTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.AppBundle.Model.map.UsuarioTableMap';

    /**
     * Initialize the table attributes, columns and validators
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('usuario');
        $this->setPhpName('Usuario');
        $this->setClassname('AppBundle\\Model\\Usuario');
        $this->setPackage('src.AppBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('usu_id', 'UsuId', 'INTEGER', true, null, null);
        $this->addForeignKey('res_id', 'ResId', 'INTEGER', 'resturant', 'res_id', false, null, null);
        $this->addColumn('usu_nombre', 'UsuNombre', 'VARCHAR', false, 100, null);
        $this->addColumn('usu_apellido', 'UsuApellido', 'VARCHAR', false, 100, null);
        $this->addColumn('usu_clave', 'UsuClave', 'VARCHAR', false, 500, null);
        $this->addColumn('usu_telefono', 'UsuTelefono', 'VARCHAR', false, 20, null);
        $this->addColumn('usu_email', 'UsuEmail', 'VARCHAR', false, 50, null);
        $this->addColumn('usu_estado', 'UsuEstado', 'SMALLINT', false, null, null);
        $this->addColumn('usu_eliminado', 'UsuEliminado', 'BOOLEAN', false, 1, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Resturant', 'AppBundle\\Model\\Resturant', RelationMap::MANY_TO_ONE, array('res_id' => 'res_id', ), null, null);
        $this->addRelation('Pedido', 'AppBundle\\Model\\Pedido', RelationMap::ONE_TO_MANY, array('usu_id' => 'usu_id', ), null, null, 'Pedidos');
        $this->addRelation('Recurso', 'AppBundle\\Model\\Recurso', RelationMap::ONE_TO_MANY, array('usu_id' => 'usu_id', ), null, null, 'Recursos');
        $this->addRelation('TipoUsuario', 'AppBundle\\Model\\TipoUsuario', RelationMap::ONE_TO_MANY, array('usu_id' => 'usu_id', ), null, null, 'TipoUsuarios');
    } // buildRelations()

    /**
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array Associative array (name => parameters) of behaviors
     */
    public function getBehaviors()
    {
        return array(
            'timestampable' =>  array (
  'create_column' => 'created_at',
  'update_column' => 'updated_at',
  'disable_updated_at' => 'false',
),
        );
    } // getBehaviors()

} // UsuarioTableMap
