🔒 Sistema de Seguridad Anti-Fraude Electoral
Capas de Protección Implementadas
1. Validación por Sesión (Session ID)

Qué detecta: Mismo navegador/pestaña
Cómo funciona: Laravel genera un ID único por sesión del navegador
Persiste: Mientras el navegador esté abierto (aunque cierres pestañas)

2. Validación por Dirección IP

Qué detecta: Misma conexión a internet/computadora
Cómo funciona: Captura la IP pública del votante
Bloquea: Múltiples votos desde la misma red WiFi/computadora

3. Validación por User Agent

Qué detecta: Tipo y versión del navegador
Cómo funciona: Identifica el navegador (Chrome 120, Firefox 115, etc.)
Complementa: La validación por IP

4. Validación por IP + User Agent combinados

Qué detecta: Mismo navegador en la misma red
Cómo funciona: Valida ambos datos juntos
Utilidad: Doble verificación de autenticidad

5. Browser Fingerprinting (Huella Digital)

Qué detecta: Características únicas del dispositivo/navegador
Incluye:

Canvas rendering (renderizado gráfico único)
WebGL (información de tarjeta gráfica)
Resolución de pantalla y profundidad de color
Zona horaria y idioma
Núcleos del CPU (hardwareConcurrency)
Memoria RAM (deviceMemory)
Plugins instalados
Capacidades táctiles (maxTouchPoints)


Hash generado: SHA-256 de 64 caracteres

6. Composite Hash (Hash Compuesto)

Qué es: Hash SHA-256 único que combina:

ID de la encuesta
Fingerprint del navegador
Dirección IP
User Agent


Garantiza: Unicidad absoluta del voto

7. Rate Limiting

Límite: 5 intentos por minuto (configurable)
Bloquea: Bots y scripts automatizados
