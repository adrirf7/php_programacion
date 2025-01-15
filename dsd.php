public function agregarProducto($nombre, $precio, $cantidad)
{
array_push($this->productos, $nombre, $precio, $cantidad);
}
public function quitarProdcutos($nombre)
{
if (isset($this->productos)) {
unset($this->productos);
}
}