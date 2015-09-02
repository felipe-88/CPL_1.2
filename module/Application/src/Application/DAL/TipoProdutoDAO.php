<?php

/*
 * Copyright (C) 2015 Irving Fernando de Medeiros Oliveira
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace Application\DAL;

use Zend\ServiceManager\ServiceManager;
/**
 * Description of TipoProdutoDAO
 *
 * @author Irving Fernando de Medeiros Oliveira
 */
class TipoProdutoDAO extends GenericDAO{
    public function __construct(ServiceManager $serviceManager) {
        parent::__construct($serviceManager);
    }
    
    //@OVERRIDE método com query para ordenar pela descrição
    public function lerTodos() {
        $dql = 'SELECT o, oj FROM Application\Entity\\TipoProduto AS o ';
        $dql.= 'LEFT JOIN o.tipoPai oj ';
        $dql.= 'ORDER BY o.descricao';
        $objectManager = $this->getObjectManager();
        $query = $objectManager->createQuery($dql);
        return $query;
    }
}
