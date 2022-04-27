<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <title>Document</title>
</head>
<body>
<h1>Bienvenido <?php echo $this->username->getName();?></h1>
<a href="<?php echo URL?>main/logout">dasda</a>

<?php if($this->mensajeError != ""):?>
  <div class="alert alert-danger d-flex align-items-center" role="alert">
  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
  <div>
    <?php echo $this->mensajeError ?>
  </div>
</div>
<?php endif?>

  <!-- CARD DE BOOSTRAP -->
<?php for($i = 0; $i < sizeof($this->gastos); $i++):?>
  <div class="card">
    <h5 class="card-header"><?php echo $this->gastos[$i]["concepto"] ?></h5>
    <div class="card-body">
      <h5 class="card-title"><?php echo $this->gastos[$i]["monto"] ?>€</h5>
      <p class="card-text"><?php echo $this->gastos[$i]["fecha_gasto"]?></p>
      <a href="" class="btn btn-primary">Modificar gasto</a>
      <a href="<?php echo URL?>main/delete?id=<?php echo $this->gastos[$i]['id_gasto']?>" class="btn btn-danger">Eliminar gasto</a>
    </div>
  </div>
<?php endfor;  ?>
<!-- FIN DE CARD DE BOOSTRAP -->
<a href="<?php echo URL?>main/transaction">Ingresar Transaccion</a>
</body>
</html>
