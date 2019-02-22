<?php

    class Cesta{

        private $articulos;
        private $codArticulo;

        function __construct() {
            $this->articulos = array();
            $this->codArticulo = 1;
        }

        function getListaArticulos(){
            return $this->articulos;
        }

        function annadirArticulo($articulo){
            $this->articulos[$this->codArticulo] = $articulo;
            $this->codArticulo++;
        }

        function eliminarArticulo($cod){
            unset($this->articulos[$cod]);
        }

        function precioTotal() {
            $precioTotal = 0;
            $listaArticulos = $this->getListaArticulos();

            foreach($listaArticulos as $fila) {
                $precioTotal += $fila['Precio_Producto'];
            }
            return precioTotal;
        }
    }

?>