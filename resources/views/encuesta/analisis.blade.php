<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Análisis de Carencia Médica</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }

        h1, h2 {
            text-align: center;
            color: #333;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            padding: 20px;
        }

        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 300px;
            padding: 20px;
            text-align: center;
        }

        .card canvas {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .card h3 {
            font-size: 18px;
            margin-top: 10px;
            color: #333;
        }

        .card p {
            font-size: 14px;
            color: #555;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .card-container {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body>
    <!-- Sección Carencia Médica -->
    <h1>Análisis de Carencia Médica</h1>
    <h2>Comparativa de Carencia Médica por Departamento</h2>

    <div class="card-container">
        <div class="card">
            <canvas id="carenciaChart" width="400" height="200"></canvas>
            <h3>Departamento: <span id="departamentoNombre"></span></h3>
            <p id="carenciaInfo"></p>
        </div>

        <!-- Sección Obesidad -->
        <div class="card">
            <canvas id="obesidadChart" width="400" height="200"></canvas>
            <h3>Departamento: <span id="obesidadDepartamentoNombre"></span></h3>
            <p id="obesidadInfoText"></p>
        </div>

        <!-- Sección Enfermedades Crónicas -->
        <div class="card">
            <canvas id="enfermedadesCronicasChart" width="400" height="200"></canvas>
            <h3>Departamento: <span id="enfermedadesCronicasDepartamentoNombre"></span></h3>
            <p id="enfermedadesCronicasInfoText"></p>
        </div>
    </div>

    <script>
        // Carencia Médica Chart
        const ctxCarencia = document.getElementById('carenciaChart').getContext('2d');
        const departamentosCarencia = @json($departamentos).map(d => d.nombre_departamento);
        const carencias = @json($carencias);

        const carenciaData = departamentosCarencia.map(d => carencias[d] || 0);

        const departamentoSeleccionadoCarencia = @json($departamentoSeleccionado);
        document.getElementById('departamentoNombre').textContent = departamentoSeleccionadoCarencia;
        document.getElementById('carenciaInfo').textContent = `El departamento de ${departamentoSeleccionadoCarencia} tiene un porcentaje de carencia médica de ${carencias[departamentoSeleccionadoCarencia]}%`;

        const dataCarencia = {
            labels: departamentosCarencia,
            datasets: [{
                label: 'Porcentaje de Carencia Médica',
                data: carenciaData,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        };

        new Chart(ctxCarencia, { type: 'bar', data: dataCarencia });

        // Obesidad Chart
        const ctxObesidad = document.getElementById('obesidadChart').getContext('2d');
        const departamentosObesidad = @json($departamentos).map(d => d.nombre_departamento);
        const obesidades = @json($obesidades);

        const obesidadData = departamentosObesidad.map(d => obesidades[d] || 0);

        const departamentoSeleccionadoObesidad = @json($departamentoSeleccionado);
        document.getElementById('obesidadDepartamentoNombre').textContent = departamentoSeleccionadoObesidad;
        document.getElementById('obesidadInfoText').textContent = `El departamento de ${departamentoSeleccionadoObesidad} tiene un porcentaje de obesidad de ${obesidades[departamentoSeleccionadoObesidad]}%`;

        const dataObesidad = {
            labels: departamentosObesidad,
            datasets: [{
                label: 'Porcentaje de Obesidad',
                data: obesidadData,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        };

        new Chart(ctxObesidad, { type: 'bar', data: dataObesidad });

        // Enfermedades Crónicas Chart
        const ctxEnfermedadesCronicas = document.getElementById('enfermedadesCronicasChart').getContext('2d');
        const departamentosEnfermedadesCronicas = @json($departamentos).map(d => d.nombre_departamento);
        const enfermedadesCronicas = @json($enfermedadesCronicas);

        const enfermedadesCronicasData = departamentosEnfermedadesCronicas.map(d => enfermedadesCronicas[d] || 0);

        const departamentoSeleccionadoEnfermedadesCronicas = @json($departamentoSeleccionado);
        document.getElementById('enfermedadesCronicasDepartamentoNombre').textContent = departamentoSeleccionadoEnfermedadesCronicas;
        document.getElementById('enfermedadesCronicasInfoText').textContent = `El departamento de ${departamentoSeleccionadoEnfermedadesCronicas} tiene un porcentaje de enfermedades crónicas de ${enfermedadesCronicas[departamentoSeleccionadoEnfermedadesCronicas]}%`;

        const dataEnfermedadesCronicas = {
            labels: departamentosEnfermedadesCronicas,
            datasets: [{
                label: 'Porcentaje de Enfermedades Crónicas',
                data: enfermedadesCronicasData,
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1
            }]
        };

        new Chart(ctxEnfermedadesCronicas, { type: 'bar', data: dataEnfermedadesCronicas });
    </script>
</body>
</html>
