// Version: 1.1 - CEACIÓN DE LOS GRÁFICOS
// Agrupacion de los grafico 

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

                // Crear el gráfico de barras horizontal para promedio de DetalleGrafismo en porcentaje
                const ctxDetalleGrafismo = document.getElementById('myChartDetalleGrafismo').getContext('2d');
                const myChartDetalleGrafismo = new Chart(ctxDetalleGrafismo, {
                    type: 'bar',
                    data: {
                        labels: grados,
                        datasets: [{
                            label: 'Tipografia (%)',
                            data: promedioTipografiaPorcentaje,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)', // Verde
                            borderColor: 'rgba(75, 192, 192, 1)', // Verde
                            borderWidth: 1,
                        },
                        {
                            label: 'Claridad (%)',
                            data: promedioClaridadPorcentaje,
                            backgroundColor: 'rgba(255, 206, 86, 0.2)', // Amarillo
                            borderColor: 'rgba(255, 206, 86, 1)', // Amarillo
                            borderWidth: 1,
                        },
                        {
                            label: 'Tamaño (%)',
                            data: promedioTamanoPorcentaje,
                            backgroundColor: 'rgba(153, 102, 255, 0.2)', // Morado
                            borderColor: 'rgba(75, 192, 192, 1)', // Morado
                            borderWidth: 1,
                        },
                        {
                            label: 'Claridad (%)',
                            data: promedioPresionPorcentaje,
                            backgroundColor: 'rgba(255, 99, 132, 0.2)', // Rojo
                            borderColor: 'rgba(255, 99, 132, 1)', // Rojo
                            borderWidth: 1,
                        },
                        {
                            label: 'Emplazamiento en el Renglón (%)',
                            data: promedioEmplazamientoRenglonPorcentaje,
                            backgroundColor: 'rgba(255, 159, 64, 0.2)', // Naranja
                            borderColor: 'rgba(255, 159, 64, 1)', // Naranja
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
                // const ctxTipografia = document.getElementById('myChartTipografia').getContext('2d');
                // const myChartTipografia = new Chart(ctxTipografia, {
                //     type: 'bar',
                //     data: {
                //        labels: grados,
                //        datasets: [{
                //            label: 'Tipografia (%)',
                //            data: promedioTipografiaPorcentaje,
                //            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                //            borderColor: 'rgba(75, 192, 192, 1)',
                //            borderWidth: 1,
                //        }]
                //    },
                //    options: {
                //        indexAxis: 'y',
                //        // maintainAspectRatio: false, // No mantener la relación de aspecto
                //        scales: {
                //            x: {
                //                beginAtZero: true,
                //                max: 100 // El máximo en el eje x es 100%
                //            }
                //        }
                //    }
                // });

                // Crear el gráfico de barras horizontal para promedio de claridad en porcentaje
                // const ctxClaridad = document.getElementById('myChartClaridad').getContext('2d');
                // const myChartClaridad = new Chart(ctxClaridad, {
                //     type: 'bar',
                //     data: {
                //         labels: grados,
                //         datasets: [{
                //             label: 'Claridad (%)',
                //             data: promedioClaridadPorcentaje,
                //             backgroundColor: 'rgba(75, 192, 192, 0.2)',
                //             borderColor: 'rgba(75, 192, 192, 1)',
                //             borderWidth: 1,
                //         }]
                //     },
                //     options: {
                //         indexAxis: 'y',
                //         // maintainAspectRatio: false, // No mantener la relación de aspecto
                //         scales: {
                //             x: {
                //                 beginAtZero: true,
                //                 max: 100 // El máximo en el eje x es 100%
                //             }
                //         }
                //     }
                // });

                // Crear el gráfico de barras horizontal para promedio de tamaño en porcentaje
                // const ctxTamano = document.getElementById('myChartTamano').getContext('2d');
                // const myChartTamano = new Chart(ctxTamano, {
                //     type: 'bar',
                //     data: {
                //         labels: grados,
                //         datasets: [{
                //             label: 'Tamaño (%)',
                //             data: promedioTamanoPorcentaje,
                //             backgroundColor: 'rgba(75, 192, 192, 0.2)',
                //             borderColor: 'rgba(75, 192, 192, 1)',
                //             borderWidth: 1,
                //         }]
                //     },
                //     options: {
                //         indexAxis: 'y',
                //         // maintainAspectRatio: false, // No mantener la relación de aspecto
                //         scales: {
                //             x: {
                //                 beginAtZero: true,
                //                 max: 100 // El máximo en el eje x es 100%
                //             }
                //         }
                //     }
                // });

                // Crear el gráfico de barras horizontal para promedio de presion en porcentaje
                // const ctxPresion = document.getElementById('myChartPresion').getContext('2d');
                // const myChartPresion = new Chart(ctxPresion, {
                //     type: 'bar',
                //     data: {
                //         labels: grados,
                //         datasets: [{
                //             label: 'Claridad (%)',
                //             data: promedioPresionPorcentaje,
                //             backgroundColor: 'rgba(75, 192, 192, 0.2)',
                //             borderColor: 'rgba(75, 192, 192, 1)',
                //             borderWidth: 1,
                //         }]
                //     },
                //     options: {
                //         indexAxis: 'y',
                //         // maintainAspectRatio: false, // No mantener la relación de aspecto
                //         scales: {
                //             x: {
                //                 beginAtZero: true,
                //                 max: 100 // El máximo en el eje x es 100%
                //             }
                //         }
                //     }
                // });

                // Crear el gráfico de barras horizontal para promedio de Emplazamiento en el Renglon en porcentaje
                // const ctxEmplazamientoRenglon = document.getElementById('myChartEmplazamientoRenglon').getContext('2d');
                // const myChartEmplazamientoRenglon = new Chart(ctxEmplazamientoRenglon, {
                //     type: 'bar',
                //     data: {
                //         labels: grados,
                //         datasets: [{
                //             label: 'Emplazamiento en el Renglón (%)',
                //             data: promedioEmplazamientoRenglonPorcentaje,
                //             backgroundColor: 'rgba(75, 192, 192, 0.2)',
                //             borderColor: 'rgba(75, 192, 192, 1)',
                //             borderWidth: 1,
                //         }]
                //     },
                //     options: {
                //         indexAxis: 'y',
                //         // maintainAspectRatio: false, // No mantener la relación de aspecto
                //         scales: {
                //             x: {
                //                 beginAtZero: true,
                //                 max: 100 // El máximo en el eje x es 100%
                //             }
                //         }
                //     }
                // });
    
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

                // Crear el gráfico de barras horizontal para promedio de ComposicionEscrita en porcentaje
                const ctxComposicionEscrita = document.getElementById('myChartComposicionEscrita').getContext('2d');
                const myChartComposicionEscrita = new Chart(ctxComposicionEscrita, {
                    type: 'bar',
                    data: {
                        labels: grados,
                        datasets: [{
                            label: 'Repeticiones (%)',
                            data: promedioRepeticionesPorcentaje,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1,
                        },
                        {
                            label: 'Vocabulario (%)',
                            data: promedioVocabularioPorcentaje,
                            backgroundColor: 'rgba(255, 206, 86, 0.2)', // Amarillo
                            borderColor: 'rgba(255, 206, 86, 1)', // Amarillo
                            borderWidth: 1,
                        },
                        {
                            label: 'Conectores (%)',
                            data: promedioConectoresPorcentaje,
                            backgroundColor: 'rgba(153, 102, 255, 0.2)', // Morado
                            borderColor: 'rgba(153, 102, 255, 1)', // Morado
                            borderWidth: 1,
                        },
                        {
                            label: 'Longitud (%)',
                            data: promedioLongitudPorcentaje,
                            backgroundColor: 'rgba(255, 99, 132, 0.2)', // Rojo
                            borderColor: 'rgba(255, 99, 132, 1)', // Rojo
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
                // const ctxRepeticiones = document.getElementById('myChartRepeticiones').getContext('2d');
                // const myChartRepeticiones = new Chart(ctxRepeticiones, {
                //     type: 'bar',
                //     data: {
                //         labels: grados,
                //         datasets: [{
                //             label: 'Repeticiones (%)',
                //             data: promedioRepeticionesPorcentaje,
                //             backgroundColor: 'rgba(75, 192, 192, 0.2)',
                //             borderColor: 'rgba(75, 192, 192, 1)',
                //             borderWidth: 1,
                //         }]
                //     },
                //     options: {
                //         indexAxis: 'y',
                //         // maintainAspectRatio: false, // No mantener la relación de aspecto
                //         scales: {
                //             x: {
                //                 beginAtZero: true,
                //                 max: 100 // El máximo en el eje x es 100%
                //             }
                //         }
                //     }
                // });

                // Crear el gráfico de barras horizontal para promedio de vocabulario en porcentaje
                // const ctxVocabulario = document.getElementById('myChartVocabulario').getContext('2d');
                // const myChartVocabulario = new Chart(ctxVocabulario, {
                //     type: 'bar',
                //     data: {
                //         labels: grados,
                //         datasets: [{
                //             label: 'Vocabulario (%)',
                //             data: promedioVocabularioPorcentaje,
                //             backgroundColor: 'rgba(75, 192, 192, 0.2)',
                //             borderColor: 'rgba(75, 192, 192, 1)',
                //             borderWidth: 1,
                //         }]
                //     },
                //     options: {
                //         indexAxis: 'y',
                //         // maintainAspectRatio: false, // No mantener la relación de aspecto
                //         scales: {
                //             x: {
                //                 beginAtZero: true,
                //                 max: 100 // El máximo en el eje x es 100%
                //             }
                //         }
                //     }
                // });

                // Crear el gráfico de barras horizontal para promedio de conectores en porcentaje
                // const ctxConectores = document.getElementById('myChartConectores').getContext('2d');
                // const myChartConectores = new Chart(ctxConectores, {
                //     type: 'bar',
                //     data: {
                //         labels: grados,
                //         datasets: [{
                //             label: 'Conectores (%)',
                //             data: promedioConectoresPorcentaje,
                //             backgroundColor: 'rgba(75, 192, 192, 0.2)',
                //             borderColor: 'rgba(75, 192, 192, 1)',
                //             borderWidth: 1,
                //         }]
                //     },
                //    options: {
                //         indexAxis: 'y',
                //         // maintainAspectRatio: false, // No mantener la relación de aspecto
                //         scales: {
                //             x: {
                //                 beginAtZero: true,
                //                 max: 100 // El máximo en el eje x es 100%
                //             }
                //         }
                //     }
                // });

                // Crear el gráfico de barras horizontal para promedio de longitud en porcentaje
                // const ctxLongitud = document.getElementById('myChartLongitud').getContext('2d');
                // const myChartLongitud = new Chart(ctxLongitud, {
                //     type: 'bar',
                //     data: {
                //         labels: grados,
                //         datasets: [{
                //             label: 'Longitud (%)',
                //             data: promedioLongitudPorcentaje,
                //             backgroundColor: 'rgba(75, 192, 192, 0.2)',
                //             borderColor: 'rgba(75, 192, 192, 1)',
                //             borderWidth: 1,
                //         }]
                //     },
                //     options: {
                //         indexAxis: 'y',
                //         // maintainAspectRatio: false, // No mantener la relación de aspecto
                //         scales: {
                //             x: {
                //                 beginAtZero: true,
                //                 max: 100 // El máximo en el eje x es 100%
                //             }
                //         }
                //     }
                // });