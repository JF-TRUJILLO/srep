<?php 
include("../../bd.php");



//INSTRUCCION DE BORRAR//

if(isset( $_GET['txtID'] )){

    //almacenar el id
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";


    //instruccion sql
    $sentencia=$conexion->prepare("DELETE FROM tbl_tituladas WHERE id=:id");
    //parametro para el borrado
    $sentencia->bindParam(":id",$txtID);
    //borrado
    $sentencia->execute();
    $mensaje="Usuario eliminado"


    //redireccion
    header("Location:index.php");
}





$sentencia=$conexion->prepare("SELECT * FROM `tbl_tituladas`");
$sentencia->execute();
$lista_tbl_tituladas=$sentencia->fetchALL(PDO::FETCH_ASSOC);



?>
<?php include("../../templates/header.php"); ?>

<?php  if(isset{$_GET['mensaje']}) { ?>
<script>
    Swal.fire({icon:"success", title:"<?php echo $_GET['mensaje']; ?>"});
</script>
<?php } ?>
<br/>

<div class="card">
    <div class="card-header">
    <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar Titulada</a>
    </div>
    <div class="card-body">
    <div class="table-responsive sm">
    <table class="table"  id="tabla_id">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Titulada</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>

        <?php foreach ($lista_tbl_tituladas as $registro) { ?>
            <tr class="">
                <td scope="row"><?php echo $registro['id'] ?></td>
                <td><?php echo $registro['nombretitulada'] ?></td>
                <td>

                    <a class="btn btn-success" href="editar.php?txtID=<?php echo $registro['id'] ?>" role="button">Editar</a>

                   
                    <a class="btn btn-danger" href="javascript:borrar(<?php echo $registro['id'] ?>);" role="button">Eliminar</a>

                



                </td>
            </tr>
        <?php } ?>
        
        

            
           
        </tbody>
    </table>
</div>

        
    </div>
   
</div>


<script>
function borrar(id){
   
   Swal.fire({
       title: 'Desea eliminar la titulada?  ',
  
          showCancelButton: true,
          confirmButtonText: 'Si'
}).then((result) => {

  if (result.isConfirmed) {
    window.location="index.php?txtID="+id;
   
  } 
})
 
}
</script>



<?php include("../../templates/footer.php"); ?>