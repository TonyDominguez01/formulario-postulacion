<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Postulación</title>
    <link rel="stylesheet" href="./ajolote/a-styles.css">
    <link rel="stylesheet" href="./css/estilos.css">
    <script src="./ajolote/a-functions.js"></script>
    <script src="./js/functions.js"></script>
</head>
<body>
    <div class="contenedor">
        <div class="contenedor card form-cont mt-1 mb-2">
            <div class="encabezado-form text-right">
                <h1>Postularme para la vacante</h1>
                <h2>Puesto como ejecutivo telefónico </h2>
            </div>
            <form action="php/verificarDatos.php" method="POST" onsubmit="return validacion()">
                
                <div class="grid col-10">
                    <label class="span-10" for="nombre">Nombre</label>
                    <input class="input span-10" id="nombre" name="nombre" type="text" maxlength="50" required />

                    <div class="span-4 peq-span-10">
                        <label for="calleNumero">Calle y número</label>
                        <input id="calleNumero" name="calleNumero" class="input" type="text" maxlength="25" />
                    </div>
                    <div class="span-3 peq-span-10">
                        <label for="colonia">Colonia</label>
                        <input id="colonia" name="colonia" class="input" type="text" maxlength="20" />
                    </div>
                    <div class="span-3 peq-span-10">
                        <label for="cp">C.P.</label>
                        <input id="cp" name="cp" class="input" type="text" pattern="[0-9]{5}" />
                    </div>

                    <div class="span-5 peq-span-10">
                        <label for="ciudad">Ciudad</label>
                        <input class="input" id="ciudad" name="ciudad" type="text" maxlength="15" />
                    </div>
                    <div class="span-5 peq-span-10">
                        <label for="estado">Estado</label>
                        <input class="input" id="estado" name="estado" type="text" maxlength="15" />
                    </div>

                </div>

                <div class="grid col-2">
                    <div class="peq-span-2">
                        <label for="telefono01">Teléfono 1</label>
                        <input class="input" id="telefono01" name="telefono01" type="text" pattern="[0-9]{10}" required />
                    </div>
                    <div class="peq-span-2">
                        <label for="telefono02">Teléfono 2</label>
                        <input class="input" id="telefono02" name="telefono02" type="text" pattern="[0-9]{10}" />
                    </div>
                    <div class="peq-span-2">
                        <label for="email01">E-mail 1</label>
                        <input class="input" id="email01" name="email01" type="email" maxlength="30" required />
                    </div>
                    <div class="peq-span-2">
                        <label for="email02">E-mail 2</label>
                        <input class="input" id="email02" name="email02" type="email" maxlength="30" />
                    </div>
                </div>

                <div class="grid col-10">
                    <label class="span-10" for="beneficiario">Beneficiario</label>
                    <input class="span-10 input" id="beneficiario" name="beneficiario" type="text" maxlength="50" />
                    <div class="span-5 peq-span-10">
                        <label for="curp">Curp</label>
                        <input class="input" id="curp" name="curp" type="text" minlength="18" maxlength="18" pattern="[A-Za-z0-9]{18}" required />
                    </div>
                    <div class="span-5 peq-span-10">
                        <label for="rfc">RFC</label>
                        <input class="input" id="rfc" name="rfc" type="text" minlength="13" maxlength="13" pattern="[A-Za-z0-9]{13}" />
                    </div>
                    <div class="span-5 peq-span-10">
                        <label for="nss">No. de seguridad social</label>
                        <input class="input" id="nss" name="nss" type="text" minlength="11" maxlength="11" pattern="[0-9]{11}" />
                    </div>
                    <div class="span-5 peq-span-10">
                        <label for="ine">INE (Clave de elector)</label>
                        <input class="input" id="ine" name="ine" type="text" minlength="18" maxlength="18" pattern="[A-Za-z0-9]{18}" required />
                    </div>

                    <label class="span-10" for="nivelEstudios">Nivel de estudios</label>
                    <input class="span-10 input" id="nivelEstudios" name="nivelEstudios" type="text" maxlength="20" />
            
                    <div class="span-4 med-span-5 peq-span-10">
                        <label for="fechaNac">Fecha de nacimiento</label>
                        <input class="input" id="fechaNac" name="fechaNac" type="date" required />
                    </div>
                    <div class="span-6 med-span-5 peq-span-10">
                        <label for="estadoCivil">Estado Civil</label>
                        <input class="input" id="estadoCivil" name="estadoCivil" type="text" maxlength="10" />
                    </div>

                    <div class="span-4 peq-span-10">
                        <label for="experiencia">Experiencia en Call Center</label>
                        <div class="grid col-3 med-col-2">
                            <div>
                                <label for="xpSi">Si</label>
                                <input type="radio" name="experiencia" id="xpSi" value="si">
                            </div>
                            <div>
                                <label for="xpNo">No</label>
                                <input type="radio" name="experiencia" id="xpNo" value="no" checked>
                            </div>
                        </div>
                    </div>
                    <div class="span-6 peq-span-10">
                        <label for="experienciaDonde">Donde</label>
                        <input class="input" id="experienciaDonde" name="experienciaDonde" type="text" maxlength="16" />
                    </div>

                    <label class="span-10" for="turnoInteres">
                        Turno de interés
                        <span class="modal-reference">
                            <button id="btn-horario" class="btn-question" type="button" onclick=activarModal()>?</button>
                            <div id="btn-modal" class="modal-simple" onclick=activarModal()>
                                <h2 class="texto-2">Horarios disponibles</h2>
                                <div class="grid col-2">
                                    <div class="peq-span-2">
                                        Completo <br>
                                        Lunes a viernes - 8:55 a 18:30 <br><br>
                                        Matutino <br>
                                        Lunes a viernes - 8:55 a 16:00 <br>
                                        Sabado - 8:55 a 14:00 <br>
                                    </div>
                                    <div class="peq-span-2">
                                        Vespertino <br>
                                        Lunes a viernes - 16:00 a 20:00 <br>
                                        Sabado - 10:00 a 15:00 <br><br>
                                        Mixto <br>
                                        Lunes a viernes - 13:00 a 20:00 <br>
                                        Sabado - 10:00 a 15:00 <br>
                                    </div>
                                </div>
                            </div>
                        </span>
                    </label>
                    <select class="span-10 input" name="turnoInteres" id="turnoInteres">
                        <option value="Matutino">Matutino</option>
                        <option value="Vespertino">Vespertino</option>
                        <option value="Mixto">Mixto</option>
                    </select>
                    <div class="span-10 mv-2">
                        <input class="checkbox" type="checkbox" name="avisoPrivacidad" value="aceptado" id="avisoPrivacidad">
                        <label for="avisoPrivacidad">He leído y acepto el <a class="clr-main" href="./aviso-de-privacidad.html" target="_blank">aviso  de privacidad</a></label>
                    </div>
                </div>

                <div class="contenedor-ancho p-0 text-right">
                    <button class="btn mb-3" type="submit">POSTULARSE</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>