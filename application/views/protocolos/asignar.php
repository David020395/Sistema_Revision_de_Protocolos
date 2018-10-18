<?php echo validation_errors(); ?>

<?php echo form_open_multipart('protocolos/assign'); ?>
  <input type="hidden" name="proc_ID" value="<?php echo $proc['proc_ID'] ?>">
  <input type="hidden" id="proc_c" name="proc_c" value="" required>
  <input type="hidden" id="proc_r1" name="proc_r1" value="" required>
  <input type="hidden" id="proc_r2" name="proc_r2" value="">
  <input type="hidden" id="proc_r3" name="proc_r3" value="">
  <input type="hidden" id="proc_r4" name="proc_r4" value="">
  <input type="hidden" id="proc_r5" name="proc_r5" value="">
  <input type="hidden" id="proc_numR" name="proc_numR" value="0">
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <h2 class="text-center"><?= $title; ?></h2>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4 col-md-offset-1">
      <h4 class="text-center">Disponibles</h4> <!-- ////////////////// DISPONIBLES ////////////////// -->
      <div class="row">
        <h4 class="text-center">Coordinadores de revisores</h4>
        <table class="table table-hover table-stripped table-responsive">
          <thead>
            <tr>
              <th scope="col">Nombre</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php  foreach($coordinadores as $cord) : ?>
              <tr>
                <td><?php echo $cord['pro_nombre'] ?></td>
                <td>
                  <?php $char = "'" ?>
                  <button type="button" onclick="assignC(<?php echo $cord['pro_ID'] ?>,<?php echo $char.$cord['pro_nombre'].$char ?>)" class="btn btn-sm">
                    <span class="glyphicon glyphicon-plus"></span> Asignar
                  </button>
                </td>
              </tr>
            <?php  endforeach; ?>
          </tbody>
        </table>
      </div>
      <div class="row">
        <h4 class="text-center">Revisores</h4>
        <table class="table table-hover table-stripped table-responsive">
          <thead>
            <tr>
              <th scope="col">Nombre</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php  foreach($profesores as $prof) : ?>
              <tr>
                <td><?php echo $prof['pro_nombre'] ?></td>
                <td>
                  <?php $char = "'" ?>
                  <button type="button" onclick="assignR(<?php echo $prof['pro_ID'] ?>,<?php echo $char.$prof['pro_nombre'].$char ?>)" class="btn btn-sm">
                    <span class="glyphicon glyphicon-plus"></span> Asignar
                  </button>
                </td>
              </tr>
            <?php  endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="col-md-4 col-md-offset-2">
      <h4 class="text-center">Asignados</h4><!-- ////////////////// ASIGNADOS ////////////////// -->
      <div class="row">
        <h4 class="text-center">Coordinadores de revisores</h4>
        <table class="table table-hover table-stripped table-responsive">
          <thead>
            <tr>
              <th scope="col">Nombre</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td id="txt_pro_c"></td>
              <td>
                <button style="display:none" id="btn_pro_c" type="button" onclick="quitC()" class="btn btn-sm">
                  <span class="glyphicon glyphicon-minus"></span> Retirar
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="row">
        <h4 class="text-center">Revisores</h4>
        <table class="table table-hover table-stripped table-responsive">
          <thead>
            <tr>
              <th scope="col">Nombre</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td id="txt_pro_r1"></td>
              <td>
                <button style="display:none" id="btn_pro_r1" type="button" onclick="quitR(1)" class="btn btn-sm">
                  <span class="glyphicon glyphicon-minus"></span> Retirar
                </button>
              </td>
            </tr>
            <tr>
              <td id="txt_pro_r2"></td>
              <td>
                <button style="display:none" id="btn_pro_r2" type="button" onclick="quitR(2)" class="btn btn-sm">
                  <span class="glyphicon glyphicon-minus"></span> Retirar
                </button>
              </td>
            </tr>
            <tr>
              <td id="txt_pro_r3"></td>
              <td>
                <button style="display:none" id="btn_pro_r3" type="button" onclick="quitR(3)" class="btn btn-sm">
                  <span class="glyphicon glyphicon-minus"></span> Retirar
                </button>
              </td>
            </tr>
            <tr>
              <td id="txt_pro_r4"></td>
              <td>
                <button style="display:none" id="btn_pro_r4" type="button" onclick="quitR(4)" class="btn btn-sm">
                  <span class="glyphicon glyphicon-minus"></span> Retirar
                </button>
              </td>
            </tr>
            <tr>
              <td id="txt_pro_r5"></td>
              <td>
                <button style="display:none" id="btn_pro_r5" type="button" onclick="quitR(5)" class="btn btn-sm">
                  <span class="glyphicon glyphicon-minus"></span> Retirar
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-3 col-md-offset-8">
      <button type="submit" class="btn btn-default">
        <span class="glyphicon glyphicon-ok"></span> Confirmar
      </button>
    </div>
  </div>
</form>

<script>
  function quitR(num){
    if (window.XMLHttpRequest) {
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
    } else { // code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function() {
      if (this.readyState==4 && this.status==200) {
        document.getElementById("proc_numR").value=(document.getElementById("proc_numR").value-1);
        if(num == 1){
          document.getElementById("proc_r1").value="";
          document.getElementById("txt_pro_r1").innerHTML="";
          document.getElementById("btn_pro_r1").style.display = "none";
        }else if(num == 2){
          document.getElementById("proc_r2").value="";
          document.getElementById("txt_pro_r2").innerHTML="";
          document.getElementById("btn_pro_r2").style.display = "none";
        }else if(num == 3){
          document.getElementById("proc_r3").value="";
          document.getElementById("txt_pro_r3").innerHTML="";
          document.getElementById("btn_pro_r3").style.display = "none";
        }else if(num == 4){
          document.getElementById("proc_r4").value="";
          document.getElementById("txt_pro_r4").innerHTML="";
          document.getElementById("btn_pro_r4").style.display = "none";
        }else if(num == 5){
          document.getElementById("proc_r5").value="";
          document.getElementById("txt_pro_r5").innerHTML="";
          document.getElementById("btn_pro_r5").style.display = "none";
        } 
      }
    }
    xmlhttp.open("GET","asinc",true);
    xmlhttp.send();
  }
  function assignR(id,nombre) {
    if (window.XMLHttpRequest) {
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
    } else { // code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function() {
      if (this.readyState==4 && this.status==200) {
        document.getElementById("proc_numR").value=(document.getElementById("proc_numR").value+1);
        if(document.getElementById("proc_r1").value==""){
          document.getElementById("proc_r1").value=id;
          document.getElementById("txt_pro_r1").innerHTML=nombre;
          document.getElementById("btn_pro_r1").style.display = "inline";
        }else if(document.getElementById("proc_r2").value==""){
          document.getElementById("proc_r2").value=id;
          document.getElementById("txt_pro_r2").innerHTML=nombre;
          document.getElementById("btn_pro_r2").style.display = "inline";
        }else if(document.getElementById("proc_r3").value==""){
          document.getElementById("proc_r3").value=id;
          document.getElementById("txt_pro_r3").innerHTML=nombre;
          document.getElementById("btn_pro_r3").style.display = "inline";
        }else if(document.getElementById("proc_r4").value==""){
          document.getElementById("proc_r4").value=id;
          document.getElementById("txt_pro_r4").innerHTML=nombre;
          document.getElementById("btn_pro_r4").style.display = "inline";
        }else if(document.getElementById("proc_r5").value==""){
          document.getElementById("proc_r5").value=id;
          document.getElementById("txt_pro_r5").innerHTML=nombre;
          document.getElementById("btn_pro_r6").style.display = "inline";
        }else{
          alert("Se ha asignado el numero maximo de revisores, puede retirar alguno si requiere de este revisor");
        }
      }
    }
    xmlhttp.open("GET","asinc",true);
    xmlhttp.send();
  }

  function quitC(){
    if (window.XMLHttpRequest) {
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
    } else { // code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function() {
      if (this.readyState==4 && this.status==200) {
        document.getElementById("proc_c").value="";
        document.getElementById("txt_pro_c").innerHTML="";
        document.getElementById("btn_pro_c").style.display = "none";
      }
    }
    xmlhttp.open("GET","asinc",true);
    xmlhttp.send();
  }
  function assignC(id,nombre) {
    if (window.XMLHttpRequest) {
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
    } else { // code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function() {
      if (this.readyState==4 && this.status==200) {
        if(document.getElementById("proc_c").value==""){
          document.getElementById("proc_c").value=id;
          document.getElementById("txt_pro_c").innerHTML=nombre;
          document.getElementById("btn_pro_c").style.display = "inline";
        }else{
          alert("Se ha asignado un coordinador de revisores, puede retirarlo si requiere de este coordinador");
        }
      }
    }
    xmlhttp.open("GET","asinc",true);
    xmlhttp.send();
  }
</script>