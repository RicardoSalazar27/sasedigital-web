<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ContactoEmail {
    public static ?string $ultimoError = null;

    public static function enviar(array $datos): bool {
        self::$ultimoError = null;
        $mail = new PHPMailer(true);

        try {
            // ---------- DEBUG (solo dev) ----------
            $debugActivo = (string)($_ENV['MAIL_DEBUG'] ?? '0') === '1';
            if ($debugActivo) {
                $mail->SMTPDebug   = 2;               // 2-4 = más verboso
                $mail->Debugoutput = 'error_log';     // a error_log (se ve en tu consola php -S)
            }

            // ---------- SMTP ----------
            $mail->isSMTP();
            $mail->Host       = $_ENV['EMAIL_HOST'];          // smtp.ionos.mx
            $mail->SMTPAuth   = true;
            $mail->Hostname = 'sasedigital.com';
            $mail->Username   = $_ENV['EMAIL_USER'];          // contacto@sasedigital.com
            $mail->Password   = $_ENV['EMAIL_PASS'];

            // Seguridad y puerto
            $seguro = strtolower((string)($_ENV['EMAIL_SECURE'] ?? 'tls'));
            if ($seguro === 'ssl') {
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;   // SSL
                $mail->Port       = (int)($_ENV['EMAIL_PORT'] ?? 465);
            } else {
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // TLS
                $mail->Port       = (int)($_ENV['EMAIL_PORT'] ?? 587);
            }
            $mail->SMTPAutoTLS   = true;
            $mail->AuthType      = 'LOGIN';     // IONOS feliz con LOGIN
            $mail->Timeout       = 20;          // seg
            $mail->SMTPKeepAlive = false;

            // Si en dev tienes lío con certificados (no usar en prod)
            if ($debugActivo) {
                $mail->SMTPOptions = [
                    'ssl' => [
                        'verify_peer'       => false,
                        'verify_peer_name'  => false,
                        'allow_self_signed' => true,
                    ],
                ];
            }

            // ---------- Formato ----------
            $mail->CharSet = 'UTF-8';
            $mail->isHTML(true);

            // ---------- Remitente ----------
            $from     = $_ENV['EMAIL_FROM']      ?? $_ENV['EMAIL_USER'];
            $fromName = $_ENV['EMAIL_FROM_NAME'] ?? 'SASE Digital';
            $mail->setFrom($from, $fromName);

            // ---------- Destinatarios ----------
            $destinoPrincipal = $_ENV['EMAIL_TO_PRIMARY'] ?? 'contacto@sasedigital.com';
            $mail->addAddress($destinoPrincipal, 'SASE Digital');

            $copia = $_ENV['EMAIL_TO_COPY'] ?? 'edgar_ss2012@hotmail.com';
            if (!empty($copia)) {
                $mail->addCC($copia); // usa addBCC si quieres ocultarlo
            }

            // Responder al cliente
            if (!empty($datos['email'])) {
                $mail->addReplyTo($datos['email'], $datos['name'] ?? 'Contacto');
            }

            // ---------- Asunto ----------
            $asunto = 'Nuevo contacto: ' . ($datos['service_text'] ?? 'Consulta') . ' — ' . ($datos['name'] ?? '');
            $mail->Subject = trim($asunto);

            // ---------- Cuerpo ----------
            $h = static fn($v) => htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');

            $filas = [
                'Nombre'           => $datos['name']         ?? '',
                'Correo'           => $datos['email']        ?? '',
                'Teléfono'         => $datos['phone']        ?? '',
                'Empresa'          => $datos['company']      ?? '',
                // 'Interés (id)'     => $datos['service_id']   ?? ($datos['service'] ?? ''),
                'Interés (texto)'  => $datos['service_text'] ?? '',
                'Mensaje'          => $datos['message']      ?? '',
                'Consentimiento'   => !empty($datos['consent']) ? 'Sí' : 'No',
                // 'Origen'           => $datos['referrer']     ?? ($_ENV['HOST'] ?? ''),
                // 'IP'               => $_SERVER['REMOTE_ADDR']     ?? '',
                // 'Agente'           => $_SERVER['HTTP_USER_AGENT'] ?? '',
            ];

            $html  = '<h2 style="margin:0 0 10px">Nuevo contacto desde la web</h2>';
            $html .= '<table cellpadding="8" cellspacing="0" border="0" style="border-collapse:collapse;background:#f9fbff;border:1px solid #e5e9f2">';
            foreach ($filas as $k => $v) {
                $html .= '<tr><td style="font-weight:bold;border-bottom:1px solid #e5e9f2">'.$h($k).'</td><td style="border-bottom:1px solid #e5e9f2">'.$h($v).'</td></tr>';
            }
            $html .= '</table>';
            $mail->Body = $html;

            // Alternativo de texto plano
            $alt = "Nuevo contacto desde la web\n";
            foreach ($filas as $k => $v) {
                $alt .= $k . ': ' . preg_replace('/\s+/', ' ', (string)$v) . "\n";
            }
            $mail->AltBody = $alt;

            // ---------- Enviar ----------
            $ok = $mail->send();
            if (!$ok) self::$ultimoError = $mail->ErrorInfo ?: 'Error desconocido';
            return $ok;

        } catch (Exception $e) {
            self::$ultimoError = ($mail->ErrorInfo ?: 'Excepción') . ' | ' . $e->getMessage();
            error_log('Mailer error: ' . self::$ultimoError);
            return false;
        }
    }
}
