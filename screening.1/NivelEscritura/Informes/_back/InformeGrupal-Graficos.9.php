// Version: 1.0
    // CEACIÓN DE LOS GRÁFICOS
        // Crear el gráfico de barras horizontal para promedio de puntos en porcentaje
        const ctxPuntosTotales = document.getElementById('myChartPuntosTotales').getContext('2d');
        const myChartPuntosTotales = new Chart(ctxPuntosTotales, {
            type: 'bar',
            data: {
                labels: grados,
                datasets: [{
                    label: 'Puntos Totales por Grado (%)',
                    data: promedioPuntosPorcentaje,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                }]
            },
            options: {
                indexAxis: 'y',
                // maintainAspectRatio: false, // No mantener la relación de aspecto
                scales: {
                    x: {
                        beginAtZero: true,
                        max: 100 // El máximo en el eje x es 100%
                    }
                }
            }
        });

        // Crear el gráfico de barras horizontal para promedio de total_puntos_grafismo en porcentaje
        const ctxPuntosTotalesGrafismo = document.getElementById('myChartPuntosTotalesGrafismo').getContext('2d');
        const myChartPuntosTotalesGrafismo = new Chart(ctxPuntosTotalesGrafismo, {
            type: 'bar',
            data: {
                labels: grados,
                datasets: [{
                    label: 'Puntos Totales por Grado (%)',
                    data: promedioPuntosGrafismoPorcentaje,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                }]
            },
            options: {
                indexAxis: 'y',
                // maintainAspectRatio: false, // No mantener la relación de aspecto
                scales: {
                    x: {
                        beginAtZero: true,
                        max: 100 // El máximo en el eje x es 100%
                    }
                }
            }
        });

                // Crear el gráfico de barras horizontal para promedio de tipografia en porcentaje
                const ctxTipografia = document.getElementById('myChartTipografia').getContext('2d');
                const myChartTipografia = new Chart(ctxTipografia, {
                    type: 'bar',
                    data: {
                        labels: grados,
                        datasets: [{
                            label: 'Tipografia (%)',
                            data: promedioTipografiaPorcentaje,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1,
                        }]
                    },
                    options: {
                        indexAxis: 'y',
                        // maintainAspectRatio: false, // No mantener la relación de aspecto
                        scales: {
                            x: {
                                beginAtZero: true,
                                max: 100 // El máximo en el eje x es 100%
                            }
                        }
                    }
                });

                // Crear el gráfico de barras horizontal para promedio de claridad en porcentaje
                const ctxClaridad = document.getElementById('myChartClaridad').getContext('2d');
                const myChartClaridad = new Chart(ctxClaridad, {
                    type: 'bar',
                    data: {
                        labels: grados,
                        datasets: [{
                            label: 'Claridad (%)',
                            data: promedioClaridadPorcentaje,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1,
                        }]
                    },
                    options: {
                        indexAxis: 'y',
                        // maintainAspectRatio: false, // No mantener la relación de aspecto
                        scales: {
                            x: {
                                beginAtZero: true,
                                max: 100 // El máximo en el eje x es 100%
                            }
                        }
                    }
                });

                // Crear el gráfico de barras horizontal para promedio de tamaño en porcentaje
                const ctxTamano = document.getElementById('myChartTamano').getContext('2d');
                const myChartTamano = new Chart(ctxTamano, {
                    type: 'bar',
                    data: {
                        labels: grados,
                        datasets: [{
                            label: 'Tamaño (%)',
                            data: promedioTamanoPorcentaje,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1,
                        }]
                    },
                    options: {
                        indexAxis: 'y',
                        // maintainAspectRatio: false, // No mantener la relación de aspecto
                        scales: {
                            x: {
                                beginAtZero: true,
                                max: 100 // El máximo en el eje x es 100%
                            }
                        }
                    }
                });

                // Crear el gráfico de barras horizontal para promedio de presion en porcentaje
                const ctxPresion = document.getElementById('myChartPresion').getContext('2d');
                const myChartPresion = new Chart(ctxPresion, {
                    type: 'bar',
                    data: {
                        labels: grados,
                        datasets: [{
                            label: 'Claridad (%)',
                            data: promedioPresionPorcentaje,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1,
                        }]
                    },
                    options: {
                        indexAxis: 'y',
                        // maintainAspectRatio: false, // No mantener la relación de aspecto
                        scales: {
                            x: {
                                beginAtZero: true,
                                max: 100 // El máximo en el eje x es 100%
                            }
                        }
                    }
                });

                // Crear el gráfico de barras horizontal para promedio de Emplazamiento en el Renglon en porcentaje
                const ctxEmplazamientoRenglon = document.getElementById('myChartEmplazamientoRenglon').getContext('2d');
                const myChartEmplazamientoRenglon = new Chart(ctxEmplazamientoRenglon, {
                    type: 'bar',
                    data: {
                        labels: grados,
                        datasets: [{
                            label: 'Emplazamiento en el Renglón (%)',
                            data: promedioEmplazamientoRenglonPorcentaje,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1,
                        }]
                    },
                    options: {
                        indexAxis: 'y',
                        // maintainAspectRatio: false, // No mantener la relación de aspecto
                        scales: {
                            x: {
                                beginAtZero: true,
                                max: 100 // El máximo en el eje x es 100%
                            }
                        }
                    }
                });
    

        // Crear el gráfico de barras horizontal para promedio de total_puntos_grafismo en porcentaje
        const ctxPuntosTotalesComposicionEscrita = document.getElementById('myChartPuntosTotalesComposicionEscrita').getContext('2d');
        const myChartPuntosTotalesComposicionEscrita = new Chart(ctxPuntosTotalesComposicionEscrita, {
            type: 'bar',
            data: {
                labels: grados,
                datasets: [{
                    label: 'Puntos Totales por Grado (%)',
                    data: promedioPuntosComposicionEscritaPorcentaje,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                }]
            },
            options: {
                indexAxis: 'y',
                // maintainAspectRatio: false, // No mantener la relación de aspecto
                scales: {
                    x: {
                        beginAtZero: true,
                        max: 100 // El máximo en el eje x es 100%
                    }
                }
            }
        });

        // Crear el gráfico de barras horizontal para promedio de repeticiones en porcentaje
                const ctxRepeticiones = document.getElementById('myChartRepeticiones').getContext('2d');
                const myChartRepeticiones = new Chart(ctxRepeticiones, {
                    type: 'bar',
                    data: {
                        labels: grados,
                        datasets: [{
                            label: 'Repeticiones (%)',
                            data: promedioRepeticionesPorcentaje,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1,
                        }]
                    },
                    options: {
                        indexAxis: 'y',
                        // maintainAspectRatio: false, // No mantener la relación de aspecto
                        scales: {
                            x: {
                                beginAtZero: true,
                                max: 100 // El máximo en el eje x es 100%
                            }
                        }
                    }
                });