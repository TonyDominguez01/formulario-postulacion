<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Postulación</title>
    <link rel="stylesheet" href="ajolote/a-styles.css">
    <link rel="stylesheet" href="css/estilos.css">
    <script src="ajolote/a-functions.js"></script>
    <script src="js/functions.js"></script>
</head>
<body>
    <nav></nav>
    <div class="contenedor">
        <div class="contenedor card form-cont">
            <div class="encabezado-form text-right">
                <h1>Postularme para la vacante</h1>
                <h2>Puesto como operador telefónico </h2>
            </div>
            <form class="padding-superior-2" action="verificarDatos.php" method="POST">
                
                <div class="grid col-10">
                    <label class="span-10" for="nombre">Nombre</label>
                    <input class="input span-10" id="nombre" name="nombre" type="text" maxlength="50" required />

                    <label class="span-4" for="calleNumero">Calle y número</label>
                    <label class="span-3" for="colonia">Colonia</label>
                    <label class="span-3" for="cp">Código postal</label>

                    <input id="calleNumero" name="calleNumero" class=" span-4 input" type="text" maxlength="25" />
                    <input id="colonia" name="colonia" class="span-3 input" type="text" maxlength="20" />
                    <input id="cp" name="cp" class="span-3 input" type="number" min="0" max="99999" />
                    
                    <label class="span-5" for="ciudad">Ciudad</label>
                    <label class="span-5" for="estado">Estado</label>

                    <input class="span-5 input" id="ciudad" name="ciudad" type="text" maxlength="15" />
                    <input class="span-5 input" id="estado" name="estado" type="text" maxlength="15" />
                </div>

                <div class="grid col-2">
                    <label for="telefono01">Teléfono 1</label>
                    <label for="telefono02">Teléfono 2</label>
                    <input class="input" id="telefono01" name="telefono01" type="number" min="1000000000" max="9999999999" required />
                    <input class="input" id="telefono02" name="telefono02" type="number" min="1000000000" max="9999999999" />

                    <label for="email01">E-mail 1</label>
                    <label for="email02">E-mail 2</label>
                    <input class="input" id="email01" name="email01" type="email" maxlength="30" required />
                    <input class="input" id="email02" name="email02" type="email" maxlength="30" />
                </div>

                <div class="grid col-10">
                    <label class="span-10" for="beneficiario">Beneficiario</label>
                    <input class="span-10 input" id="beneficiario" name="beneficiario" type="text" maxlength="50" />

                    <label class="span-5" for="curp">Curp</label>
                    <label class="span-5" for="rfc">RFC</label>
                    <input class="span-5 input" id="curp" name="curp" type="text" minlength="18" maxlength="18" required />
                    <input class="span-5 input" id="rfc" name="rfc" type="text" minlength="13" maxlength="13" />

                    <label class="span-5" for="nss">Número de seguridad social</label>
                    <label class="span-5" for="ine">INE</label>
                    <input class="span-5 input" id="nss" name="nss" type="text" minlength="11" maxlength="11" />
                    <input class="span-5 input" id="ine" name="ine" type="text" minlength="18" maxlength="18" required />

                    <label class="span-10" for="nivelEstudios">Nivel de estudios</label>
                    <input class="span-10 input" id="nivelEstudios" name="nivelEstudios" type="text" maxlength="20" />
            
                    <label class="span-4" for="fechaNac">Fecha de nacimiento</label>
                    <label class="span-6" for="estadoCivil">Estado Civil</label>
                    <input class="span-4 input" id="fechaNac" name="fechaNac" type="date" required />
                    <input class="span-6 input" id="estadoCivil" name="estadoCivil" type="text" maxlength="10" />

                    <label class="span-4" for="experiencia">Experiencia</label>
                    <label class="span-5" for="experienciaDonde">Donde</label>
                    <div class="span-4 grid col-3">
                        <div>
                            <label for="xpSi">Si</label>
                            <input type="radio" name="experiencia" id="xpSi" value="si">
                        </div>
                        <div>
                            <label for="xpNo">No</label>
                            <input type="radio" name="experiencia" id="xpNo" value="no" checked>
                        </div>
                    </div>
                    <input class="span-6 input" id="experienciaDonde" name="experienciaDonde" type="text" maxlength="16" />

                    <label class="span-10" for="turnoInteres">Turno de interés</label>
                    <select class="span-10 input" name="turnoInteres" id="turnoInteres">
                        <option value="Matutino">Matutino</option>
                        <option value="Vespertino">Vespertino</option>
                        <option value="Mixto">Mixto</option>
                    </select>
                </div>

                <div class="contenedor-ancho no-padding text-right">
                    <button class="btn margen-inferior-3" type="submit">postularse</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>