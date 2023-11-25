<?php

if (isset($_POST['btnEdit'])) {

    $queryAntrian = mysqli_query($koneksidb, "UPDATE company_profile SET isi='$_POST[isi]' WHERE id='1'");

    if ($queryAntrian) {
        header("Location:?page=profile");
        exit();
    }
}

$qryEdit = mysqli_query($koneksidb, "SELECT * FROM company_profile WHERE id='1' ORDER BY id DESC LIMIT 1");
$dataEdit = mysqli_fetch_array($qryEdit);
?>
<div class="card" style="background: transparent;">
  <h5 class="card-header">Profile</h5>
  <div class="card-body">
    <form method="POST" action="<?php $_SERVER['PHP_SELF'];?>">
        <div class="form-group row">
          <label for="inputPassword" class="col-sm-2 col-form-label">Isi</label>
          <div class="col-sm-12">
            <textarea type="text" class="form-control texteditor" name="isi" required><?php echo $dataEdit['isi']; ?></textarea>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword" class="col-sm-2 col-form-label"></label>
          <div class="col-sm-12">
          <input type="submit" name="btnEdit" class="btn btn-primary" value="Save">
          </div>
        </div>
        </form>
  </div>
  <div class="card-footer">

  </div>
</div>
<!-- panggil ckeditor.js -->
<script type="text/javascript" src="plugin/ckeditor/ckeditor.js"></script>
<!-- panggil adapter jquery ckeditor -->
<script type="text/javascript" src="plugin/ckeditor/adapters/jquery.js"></script>
<!-- setup selector -->
<script type="text/javascript">
    $('textarea.texteditor').ckeditor();
</script>
    </script>
