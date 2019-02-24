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


        function sumarCantidad($articulo, $contador) {
            $articulo['cantidad'] = $articulo['cantidad'] + $contador;
        }

        function eliminarArticulo($cod){
            unset($this->articulos[$cod]);
        }

        function precioTotal() {
            $precioTotal = 0;
            $listaArticulos = $this->getListaArticulos();

            foreach($listaArticulos as $fila) {
                $precioTotal += $fila['precioProducto'];
            }
            return $precioTotal;
        }
    }

?>