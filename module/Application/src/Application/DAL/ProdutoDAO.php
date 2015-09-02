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
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Description of ProdutoDAO
 *
 * @author Irving Fernando de Medeiros Oliveira
 */
class ProdutoDAO extends GenericDAO{
    public function __construct(ServiceManager $serviceManager) {
        parent::__construct($serviceManager);
    }
    //@OVERRIDE método com query para ordenar pela descrição do tipo de produto
    public function lerTodos() {
        $dql = 'SELECT o, oj FROM Application\Entity\\Produto AS o ';
        $dql.= 'INNER JOIN o.tipo oj ';
        $dql.= 'ORDER BY oj.descricao';
        $objectManager = $this->getObjectManager();
        $query = $objectManager->createQuery($dql);
        return $query;
    }
    //@OVERRIDE
    public function busca(ArrayCollection $parametros) {
        $dql = 'SELECT o FROM Application\Entity\\Produto AS o ';
        $dql.= "INNER JOIN o.tipo oj ";
        if($parametros->first() == NULL)
            $dql.= "WHERE o.descricao LIKE '%".$parametros->last()."%' ";
        else {    
            $dql.= "WHERE oj.descricao = '".$parametros->first()."' ";
            if($parametros->last() != NULL)
                $dql.= "AND o.descricao LIKE '%".$parametros->last()."%' ";
        }
        $dql.= "ORDER BY oj.descricao, o.descricao";
        $objectManager = $this->getObjectManager();
        $query = $objectManager->createQuery($dql);
        return $query;
    }
}