<?php
// controllers/ContactoController.php
namespace Controllers;

use Classes\ContactoEmail;
use Model\Contacto;
use Model\Prospecto;

class ContactoController
{
    public static function contacto()
    {
        header('Content-Type: application/json; charset=utf-8');

        // Solo POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['ok' => false, 'message' => 'Método no permitido']);
            return;
        }

        // Honeypot (bot)
        if (!empty($_POST['_gotcha'])) {
            echo json_encode(['ok' => true, 'message' => 'Gracias.']);
            return;
        }

        // Entradas
        $nombre          = trim((string)($_POST['name']    ?? ''));
        $correo          = trim((string)($_POST['email']   ?? ''));
        $telefono        = trim((string)($_POST['phone']   ?? ''));
        $empresa         = trim((string)($_POST['company'] ?? ''));
        $mensaje         = trim((string)($_POST['message'] ?? ''));
        $servicioId      = (string)($_POST['service_id'] ?? $_POST['service'] ?? '0');
        $consentimiento  = (($_POST['consent'] ?? '') === '1');
        $referer         = (string)($_POST['referrer'] ?? '');

        // Validación servidor
        $errores = [];
        if (mb_strlen($nombre) < 2)                       $errores['name']    = 'Nombre demasiado corto.';
        if (!filter_var($correo, FILTER_VALIDATE_EMAIL))  $errores['email']   = 'Correo inválido.';
        if (mb_strlen($mensaje) < 10)                     $errores['message'] = 'Mensaje demasiado corto.';
        if ($servicioId === '0')                          $errores['service'] = 'Selecciona un interés.';
        if (!$consentimiento)                             $errores['consent'] = 'Se requiere consentimiento.';

        // Mapa de servicios (no confiamos en el texto que viene del cliente)
        $servicios = [
            '1' => 'Sistema Gestor Hotelero',
            '2' => 'Software a medida',
            '3' => 'Servidores y redes',
            '4' => 'Videovigilancia y alarmas',
            '5' => 'Mantenimiento de equipos',
        ];
        $servicioTexto = $servicios[$servicioId] ?? ($_POST['service_text'] ?? 'No especificado');

        if ($errores) {
            http_response_code(422);
            echo json_encode(['ok' => false, 'message' => 'Revisa los campos.', 'errors' => $errores]);
            return;
        }

        // Límite por seguridad
        if (mb_strlen($mensaje) > 5000) {
            $mensaje = mb_substr($mensaje, 0, 5000) . '…';
        }

        // ===========================
        // 1) Buscar o crear CONTACTO
        // ===========================
        $contacto = Contacto::where('correo', $correo);
        if (!$contacto && $telefono !== '') {
            $contacto = Contacto::where('telefono', $telefono);
        }

        if (!$contacto) {
            // Crear
            $contacto = new Contacto([
                'nombre'   => $nombre,
                'correo'   => $correo,
                'telefono' => $telefono,
                'empresa'  => $empresa
            ]);

            $erroresContacto = $contacto->validar();
            if ($erroresContacto) {
                http_response_code(422);
                echo json_encode(['ok'=>false,'message'=>'Revisa los campos de contacto','errors'=>$erroresContacto]);
                return;
            }

            $resultadoC = $contacto->guardar();
            $contacto->id = $resultadoC['id'] ?? null;

            if (!$resultadoC['resultado'] || !$contacto->id) {
                http_response_code(500);
                echo json_encode(['ok'=>false,'message'=>'No se pudo guardar el contacto.']);
                return;
            }
        } else {
            // Actualizar suavemente si llegaron datos nuevos
            $actualizo = false;
            if ($nombre   && $nombre   !== $contacto->nombre)   { $contacto->nombre   = $nombre;   $actualizo = true; }
            if ($telefono && $telefono !== $contacto->telefono) { $contacto->telefono = $telefono; $actualizo = true; }
            if ($empresa  && $empresa  !== $contacto->empresa)  { $contacto->empresa  = $empresa;  $actualizo = true; }
            if ($actualizo) {
                $contacto->guardar(); // no pasa nada si falla; no es crítico
            }
        }

        // ===========================================
        // 2) Crear PROSPECTO (deduplicación por día)
        // ===========================================
        $mensajeNormalizado = preg_replace('/\s+/', ' ', $mensaje);
        $hash = sha1(mb_strtolower($correo) . '|' . $mensajeNormalizado . '|' . date('Y-m-d'));

        $prospectoExistente = Prospecto::where('hash_deduplicacion', $hash);
        if (!$prospectoExistente) {
            $prospecto = new Prospecto([
                'contacto_id'        => $contacto->id,
                'servicio_id'        => (int)$servicioId,
                'servicio_texto'     => $servicioTexto,
                'mensaje'            => $mensajeNormalizado,
                'referencia'         => $referer,
                'consentimiento'     => $consentimiento ? 1 : 0,
                'ip'                 => $_SERVER['REMOTE_ADDR']     ?? '',
                'agente_usuario'     => $_SERVER['HTTP_USER_AGENT'] ?? '',
                'estado'             => 'nuevo',
                'fuente'             => 'web',
                'hash_deduplicacion' => $hash,
                'creado_en'          => date('Y-m-d H:i:s')
            ]);

            $erroresPros = $prospecto->validar();
            if ($erroresPros) {
                http_response_code(422);
                echo json_encode(['ok'=>false,'message'=>'Revisa los campos del prospecto','errors'=>$erroresPros]);
                return;
            }

            $resultadoP = $prospecto->guardar();
            if (!$resultadoP['resultado']) {
                http_response_code(500);
                echo json_encode(['ok'=>false,'message'=>'No se pudo guardar el prospecto.']);
                return;
            }
        }
        // Si ya existía el hash del día, no insertamos duplicado y seguimos

        // ===========================
        // 3) Enviar correo
        // ===========================
        $datosCorreo = [
            'name'         => $nombre,
            'email'        => $correo,
            'phone'        => $telefono,
            'company'      => $empresa,
            // 'service_id'   => $servicioId,
            'service_text' => $servicioTexto,
            'message'      => $mensaje,
            'consent'      => $consentimiento ? '1' : '0',
            // 'referrer'     => $referer,
        ];

        $enviado = ContactoEmail::enviar($datosCorreo);

        if ($enviado) {
            echo json_encode(['ok' => true, 'message' => 'Gracias, recibimos tu mensaje. Te contactaremos pronto.']);
        } else {
            http_response_code(500);
            $respuesta = ['ok' => false, 'message' => 'No pudimos enviar tu mensaje. Intenta más tarde.'];
            if ((string)($_ENV['APP_DEBUG'] ?? '0') === '1') {
                $respuesta['debug'] = ContactoEmail::$ultimoError ?? 'sin detalle';
            }
            echo json_encode($respuesta);
        }
    }
}
