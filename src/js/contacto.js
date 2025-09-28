(function () {
  const formulario = document.getElementById('contact-form');
  if (!formulario) return;

  const notaDeEstado = document.getElementById('form-note');

  const campos = {
    nombre:   formulario.querySelector('#c-name'),
    correo:   formulario.querySelector('#c-email'),
    telefono: formulario.querySelector('#c-phone'),
    empresa:  formulario.querySelector('#c-company'),
    interes:  formulario.querySelector('#c-service'),
    mensaje:  formulario.querySelector('#c-message'),
    consentimiento: formulario.querySelector('.check__input'),
    trampa:   formulario.querySelector('input[name="_gotcha"]') // honeypot (bots)
  };

  const expresionCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/i;

  // ---------- Utilidades de error ----------
  function asegurarNodoDeError(elemento) {
    const grupo = elemento.closest('.form__group') || elemento.closest('.check');
    if (!grupo) return null;
    let error = grupo.querySelector('.form__error');
    if (!error) {
      error = document.createElement('small');
      error.className = 'form__error';
      error.hidden = true;
      grupo.appendChild(error);
    }
    return error;
  }

  function mostrarError(elemento, mensaje) {
    const grupo = elemento.closest('.form__group') || elemento.closest('.check');
    if (!grupo) return;
    grupo.classList.add('is-invalid');
    elemento.setAttribute('aria-invalid', 'true');
    const error = asegurarNodoDeError(elemento);
    if (error) { error.textContent = mensaje; error.hidden = false; }
  }

  function limpiarError(elemento) {
    const grupo = elemento.closest('.form__group') || elemento.closest('.check');
    if (!grupo) return;
    grupo.classList.remove('is-invalid');
    elemento.removeAttribute('aria-invalid');
    const error = grupo.querySelector('.form__error');
    if (error) error.hidden = true;
  }

  // ---------- Validación ----------
  function validarFormulario() {
    let correcto = true;

    // Nombre (mínimo 2 caracteres)
    const valorNombre = campos.nombre.value.trim();
    if (valorNombre.length >= 2) limpiarError(campos.nombre);
    else { correcto = false; mostrarError(campos.nombre, 'Escribe tu nombre (mínimo 2 caracteres).'); }

    // Correo (formato válido)
    const valorCorreo = campos.correo.value.trim();
    if (expresionCorreo.test(valorCorreo)) limpiarError(campos.correo);
    else { correcto = false; mostrarError(campos.correo, 'Ingresa un correo válido.'); }

    // Mensaje (mínimo 10 caracteres)
    const valorMensaje = campos.mensaje.value.trim();
    if (valorMensaje.length >= 10) limpiarError(campos.mensaje);
    else { correcto = false; mostrarError(campos.mensaje, 'Escribe un mensaje (mínimo 10 caracteres).'); }

    // Interés principal (no permitir la opción 0)
    if (campos.interes) {
      if (campos.interes.value !== '0') limpiarError(campos.interes);
      else { correcto = false; mostrarError(campos.interes, 'Selecciona una opción.'); }
    }

    // Consentimiento (obligatorio)
    if (campos.consentimiento && campos.consentimiento.checked) {
      limpiarError(campos.consentimiento);
    } else {
      correcto = false;
      mostrarError(campos.consentimiento, 'Debes aceptar el contacto.');
    }

    return correcto;
  }

  // Validación en tiempo real
  formulario.addEventListener('input', function (evento) {
    const elemento = evento.target;
    if (elemento === campos.nombre) {
      return (elemento.value.trim().length >= 2)
        ? limpiarError(elemento)
        : mostrarError(elemento, 'Escribe tu nombre (mínimo 2 caracteres).');
    }
    if (elemento === campos.correo) {
      return expresionCorreo.test(elemento.value.trim())
        ? limpiarError(elemento)
        : mostrarError(elemento, 'Correo inválido.');
    }
    if (elemento === campos.mensaje) {
      return (elemento.value.trim().length >= 10)
        ? limpiarError(elemento)
        : mostrarError(elemento, 'Mínimo 10 caracteres.');
    }
    if (elemento === campos.interes) {
      return (elemento.value !== '0')
        ? limpiarError(elemento)
        : mostrarError(elemento, 'Selecciona una opción.');
    }
  });

  formulario.addEventListener('change', function (evento) {
    if (evento.target === campos.consentimiento) {
      campos.consentimiento.checked
        ? limpiarError(campos.consentimiento)
        : mostrarError(campos.consentimiento, 'Debes aceptar el contacto.');
    }
  });

  // ---------- Envío ----------
  formulario.addEventListener('submit', async function (evento) {
    evento.preventDefault();

    // Honeypot: si trae algo, es bot — decimos "gracias" y vaciamos
    if (campos.trampa && campos.trampa.value) {
      formulario.reset();
      if (notaDeEstado) { notaDeEstado.hidden = false; notaDeEstado.textContent = 'Gracias.'; }
      return;
    }

    if (!validarFormulario()) {
      const primerInvalido = formulario.querySelector('.is-invalid input, .is-invalid select, .is-invalid textarea');
      if (primerInvalido) primerInvalido.focus();
      return;
    }

    // Construir datos para PHP (application/x-www-form-urlencoded → $_POST)
    const datosFormulario = new FormData(formulario);

    // Normalizar y agregar campos útiles
    datosFormulario.set('name', campos.nombre.value.trim());
    datosFormulario.set('email', campos.correo.value.trim());
    datosFormulario.set('message', campos.mensaje.value.trim());
    datosFormulario.set('phone', campos.telefono.value.trim());
    datosFormulario.set('company', campos.empresa.value.trim());

    if (campos.interes) {
      const opcionSeleccionada = campos.interes.options[campos.interes.selectedIndex];
      datosFormulario.set('service_id', campos.interes.value);
      datosFormulario.set('service_text', opcionSeleccionada ? opcionSeleccionada.text : '');
    }

    datosFormulario.set('consent', campos.consentimiento.checked ? '1' : '0');
    datosFormulario.set('referrer', window.location.href);

    // Pasar a URLSearchParams
    const parametros = new URLSearchParams();
    for (const [clave, valor] of datosFormulario.entries()) {
      parametros.append(clave, String(valor));
    }

    const botonEnviar = formulario.querySelector('button[type="submit"]');
    const htmlOriginalDelBoton = botonEnviar ? botonEnviar.innerHTML : '';

    if (botonEnviar) {
      botonEnviar.disabled = true;
      botonEnviar.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Enviando…';
    }

    try {
      const respuesta = await fetch('/api/contacto', {
        method: 'POST',
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
        },
        body: parametros.toString(),
        credentials: 'same-origin'
      });

      if (!respuesta.ok) throw new Error('Error HTTP ' + respuesta.status);

      let datos = null;
      try { datos = await respuesta.json(); } catch (_) {}

      formulario.reset();
      if (notaDeEstado) {
        notaDeEstado.hidden = false;
        notaDeEstado.textContent = (datos && datos.message) ? datos.message : 'Gracias, recibimos tu mensaje.';
      }
    } catch (error) {
      if (notaDeEstado) {
        notaDeEstado.hidden = false;
        notaDeEstado.textContent = 'No pudimos enviar tu mensaje. Inténtalo de nuevo en unos minutos.';
      }
    } finally {
      if (botonEnviar) {
        botonEnviar.disabled = false;
        botonEnviar.innerHTML = htmlOriginalDelBoton;
      }
    }
  });
})();
