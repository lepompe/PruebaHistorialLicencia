<!DOCTYPE html>
<html lang="es">
<head>
    <!-- estilos -->
    <link href="css/pdf.css" rel="stylesheet">
    <!-- fuentes -->


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Historial de licencia</title>
</head>
<body>
    <header>
        <img src="img/qr.jpg" alt="" id="qr">
        <img src="img/ssp.jpg" alt="" id="ssp">
            <div class="container-top">
                <p class="depen negritas">Dependencia: </p>
                <p class="depen negritas linea">DIRECCION ESTATAL DE TRANSITO</p>
                <br>
                <p class="ref negritas">Ref.: </p>
                <p class="ref negritas linea">DEPARTAMENTO DE LICENCIAS DE CONDUCIR</p>
                <br>
                <p class="negritas">“2020, Año del 50 Aniversario de la Fundación de Cancún”</p>
                <br>
                <p id="fecha">Chetumal Q. Roo, a {{ date('d') }} de {{ $meses[date('n')-1] }} de {{ date('Y') }}</p>
                <br>
                <p class="negritas">Asunto: </p>
                <p>Historial de licencia de conducir</p>
            </div>
    </header>      
    <p class="negritas">A QUIEN CORRESPONDA </p>
    <div class="container">
        <p>EL QUE SUSCRIBE </p>
        <p class="negritas">CMDTE. JORGE CESAR SANTANA POOT,</p>
        <p>DIRECTOR DE TRANSITO DEL ESTADO.</p>
    </div>
        
    
    <div class="container-mid">
        <p id="2" class="negritas">HACE CONSTAR</p>
    </div>
    <p class="principal">QUE EN LOS ARCHIVOS GENERALES DE ESTA DIRECCION, SE ENCUENTRA EL EXPEDIENTE DE CONDUCIR DEL  C.{{$persona->Dat_Nombre}} {{$persona->Dat_Paterno}} {{$persona->Dat_Materno}} CON NÚMERO DE EXPEDIENTE {{$persona->Lic_Expediente}} DE LA SIGUIENTE MANERA.</p>

    <table class="table">
        <thead>
            <tr>
                <th>Tipo de Licencia</th>
                <th>Fecha de Expedición</th>
                <th>Fecha de Vencimiento</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($licencia as $lic)
                <tr>
                    
                    <td>{{$lic->TipLic_Descripcion}}</td>
                    <td>{{$lic->Lic_Expedicion}}</td>
                    <td>{{$lic->Lic_Vencimiento}}</td>    
                    
                </tr>
            @endforeach 
        </tbody>
    </table>

    <p class="principal">A PETICIÓN DE LA PARTE INTERESADA Y PARA LOS FINES LEGALES CORRESPONDIENTES A QUE HAYA LUGAR, SE
        EXTIENDE EL PRESENTE HISTORIAL DE LICENCIA, EN LA CIUDAD CHETUMAL CAPITAL DEL ESTADO DE QUINTANA
        ROO, A LOS {{ date('d') }} DIAS DEL MES DE {{ strtoupper($meses[date('n')-1]) }} DEL DOS MIL VEINTE.</p>

        <div class="container-mid">
            
            <div class="texto-mid">
                <p class="negritas">ATENTAMENTE</p>
                <p class="negritas">EL DIRECTOR DE TRANSITO DEL ESTADO</p>
                <br>
                <p class="negritas">CMDTE. JORGE CESAR SANTANA POOT</p>
            </div>
            <img src="img/firma.png" alt="" id="firma">
        </div>
       
<footer>
    <div class="container-bot">
        <div class="texto-footer">
            <h5>DIRECCION DE TRANSITO DEL ESTADO</h5>
            <p>Av. Insurgentes s/n esq. Belice Col. Caminera, C.P. 77000.</p>
            <p>(983) 83 29600 y 83 24141, Ext. 140</p>
            <p>Chetumal, Quintana Roo, México</p>
        </div>
        <img src="img/footer.png" alt="" id="footer">
    </div> 
</footer>
</body>
</html>