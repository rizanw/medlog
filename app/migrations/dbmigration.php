<?php

use Phalcon\Db\Column as Column;
use Phalcon\Db\Index as Index;
use Phalcon\Db\Reference as Reference;
use Phalcon\Mvc\Model\Migration;

class dbmigration extends Migration
{
    public function up()
    {
        $this->morphTable(
            'tempatpraktik',
            [
                'columns' => [
                    new Column(
                        'idtempat',
                        [
                            'type'          => Column::TYPE_INTEGER,
                            'size'          => 10,
                            'unsigned'      => true,
                            'notNull'       => true,
                            'autoIncrement' => true,
                            'first'         => true,
                        ]
                    ),
                    new Column(
                        'nmtempat',
                        [
                            'type'     => Column::TYPE_VARCHAR,
                            'size'     => 100,
                            'unsigned' => true,
                            'notNull'  => true,
                            'after'    => 'id',
                        ]
                    ),
                    new Column(
                        'name',
                        [
                            'type'    => Column::TYPE_VARCHAR,
                            'size'    => 70,
                            'notNull' => true,
                            'after'   => 'product_types_id',
                        ]
                    ),
                    
                ],
                'indexes' => [
                    new Index(
                        'PRIMARY',
                        [
                            'idtempat',
                        ]
                    ),
                    
                ],
            ]
        );
    }
}