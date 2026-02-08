<div class="min-h-screen bg-white dark:bg-[#1D293D]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16 lg:py-20">

        <div class="text-center mb-16">
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-slate-900 dark:text-white mb-4">
                ¿Cómo Funciona?
            </h1>
            <div class="w-24 h-1 bg-blue-600 mx-auto mb-6"></div>
            <p class="text-xl text-slate-600 dark:text-slate-300 max-w-3xl mx-auto">
                Participa en las encuestas electorales de manera simple, segura y transparente
            </p>
        </div>

        <div class="grid lg:grid-cols-2 gap-8 mb-20">
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-xl p-8 border-t-4 border-green-600 transform hover:-translate-y-2 transition-all duration-300">
                <div class="w-16 h-16 bg-green-100 dark:bg-green-900/50 rounded-full flex items-center justify-center mb-6 mx-auto">
                    <span class="text-3xl font-bold text-green-600 dark:text-green-400">1</span>
                </div>
                <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-4 text-center">Explora</h3>
                <p class="text-slate-600 dark:text-slate-300 text-center leading-relaxed">
                    Navega por las categorías disponibles, revisa las encuestas activas y conoce a los candidatos y sus propuestas.
                </p>
            </div>

            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-xl p-8 border-t-4 border-purple-600 transform hover:-translate-y-2 transition-all duration-300">
                <div class="w-16 h-16 bg-purple-100 dark:bg-purple-900/50 rounded-full flex items-center justify-center mb-6 mx-auto">
                    <span class="text-3xl font-bold text-purple-600 dark:text-purple-400">2</span>
                </div>
                <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-4 text-center">Vota</h3>
                <p class="text-slate-600 dark:text-slate-300 text-center leading-relaxed">
                    Emite tu voto de manera segura. Podrás ver los resultados en tiempo real una vez que hayas participado.
                </p>
            </div>
        </div>

        <div class="mb-20" x-data="{ activeTab: 'categorias' }">
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-xl overflow-hidden">
                <div class="border-b border-slate-200 dark:border-slate-700">
                    <nav class="flex flex-wrap -mb-px">
                        <button @click="activeTab = 'categorias'" :class="activeTab === 'categorias' ? 'border-blue-600 text-blue-600 dark:text-blue-400' : 'border-transparent text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-300 hover:border-slate-300 dark:hover:border-slate-600'" class="w-full sm:w-auto flex-1 sm:flex-none py-4 px-6 text-center border-b-2 font-medium text-sm transition-colors">
                            Categorías
                        </button>
                        <button @click="activeTab = 'encuestas'" :class="activeTab === 'encuestas' ? 'border-blue-600 text-blue-600 dark:text-blue-400' : 'border-transparent text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-300 hover:border-slate-300 dark:hover:border-slate-600'" class="w-full sm:w-auto flex-1 sm:flex-none py-4 px-6 text-center border-b-2 font-medium text-sm transition-colors">
                            Encuestas
                        </button>
                        <button @click="activeTab = 'votacion'" :class="activeTab === 'votacion' ? 'border-blue-600 text-blue-600 dark:text-blue-400' : 'border-transparent text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-300 hover:border-slate-300 dark:hover:border-slate-600'" class="w-full sm:w-auto flex-1 sm:flex-none py-4 px-6 text-center border-b-2 font-medium text-sm transition-colors">
                            Proceso de Votación
                        </button>
                    </nav>
                </div>

                <div class="p-8 sm:p-12">
                    <div x-show="activeTab === 'categorias'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0" style="display: none;">
                        <h2 class="text-3xl font-bold text-slate-900 dark:text-white mb-6">Categorías de Encuestas</h2>

                        <p class="text-slate-600 dark:text-slate-300 mb-8">
                            Las encuestas están organizadas por niveles de gobierno para facilitar tu participación según tus intereses:
                        </p>

                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/30 dark:to-blue-800/30 rounded-xl p-6 border border-blue-200 dark:border-blue-700">
                                <div class="flex items-center mb-4">
                                    <div class="w-10 h-10 bg-blue-600 dark:bg-blue-500 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-bold text-slate-900 dark:text-white">Nacional</h3>
                                </div>
                                <p class="text-slate-700 dark:text-slate-300">Encuestas para cargos de alcance nacional como Presidente de la República y Vicepresidentes.</p>
                            </div>

                            <div class="bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900/30 dark:to-green-800/30 rounded-xl p-6 border border-green-200 dark:border-green-700">
                                <div class="flex items-center mb-4">
                                    <div class="w-10 h-10 bg-green-600 dark:bg-green-500 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-bold text-slate-900 dark:text-white">Congresistas</h3>
                                </div>
                                <p class="text-slate-700 dark:text-slate-300">Preferencias para candidatos al Congreso de la República, tanto por circunscripción como nacional.</p>
                            </div>

                            <div class="bg-gradient-to-br from-purple-50 to-purple-100 dark:from-purple-900/30 dark:to-purple-800/30 rounded-xl p-6 border border-purple-200 dark:border-purple-700">
                                <div class="flex items-center mb-4">
                                    <div class="w-10 h-10 bg-purple-600 dark:bg-purple-500 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-bold text-slate-900 dark:text-white">Regional</h3>
                                </div>
                                <p class="text-slate-700 dark:text-slate-300">Candidatos a Gobernadores Regionales y Consejeros Regionales de tu región.</p>
                            </div>

                            <div class="bg-gradient-to-br from-orange-50 to-orange-100 dark:from-orange-900/30 dark:to-orange-800/30 rounded-xl p-6 border border-orange-200 dark:border-orange-700">
                                <div class="flex items-center mb-4">
                                    <div class="w-10 h-10 bg-orange-600 dark:bg-orange-500 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-bold text-slate-900 dark:text-white">Municipal</h3>
                                </div>
                                <p class="text-slate-700 dark:text-slate-300">Preferencias para Alcaldes y Regidores de tu provincia y distrito.</p>
                            </div>
                        </div>

                        <div class="mt-8 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-6">
                            <h4 class="font-semibold text-blue-900 dark:text-blue-300 mb-2 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                </svg>
                                Navegación por Categorías
                            </h4>
                            <p class="text-blue-800 dark:text-blue-300 text-sm">
                                Cada categoría incluye una descripción detallada del cargo, las responsabilidades, y el ámbito de acción de los candidatos. Esto te ayudará a tomar decisiones más informadas.
                            </p>
                        </div>
                    </div>

                    <div x-show="activeTab === 'encuestas'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0" style="display: none;">
                        <h2 class="text-3xl font-bold text-slate-900 dark:text-white mb-6">Exploración de Encuestas</h2>

                        <div class="space-y-6">
                            <div>
                                <h3 class="text-xl font-semibold text-slate-900 dark:text-white mb-4">Información de cada Encuesta</h3>
                                <p class="text-slate-600 dark:text-slate-300 mb-4">
                                    En el listado de encuestas encontrarás toda la información relevante para tu participación:
                                </p>

                                <div class="bg-white dark:bg-slate-700 border border-slate-200 dark:border-slate-600 rounded-lg p-6 space-y-4">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 w-8 h-8 bg-blue-100 dark:bg-blue-900/50 rounded-full flex items-center justify-center mr-3">
                                            <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-medium text-slate-900 dark:text-white">Título de la Encuesta</p>
                                            <p class="text-sm text-slate-600 dark:text-slate-400">Ejemplo: "Elecciones Presidenciales 2026 - Primera Vuelta"</p>
                                        </div>
                                    </div>

                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 w-8 h-8 bg-green-100 dark:bg-green-900/50 rounded-full flex items-center justify-center mr-3">
                                            <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-medium text-slate-900 dark:text-white">Fechas de Vigencia</p>
                                            <p class="text-sm text-slate-600 dark:text-slate-400">Fecha de inicio y finalización de la encuesta</p>
                                        </div>
                                    </div>

                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 w-8 h-8 bg-purple-100 dark:bg-purple-900/50 rounded-full flex items-center justify-center mr-3">
                                            <svg class="w-4 h-4 text-purple-600 dark:text-purple-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-medium text-slate-900 dark:text-white">Total de Votos</p>
                                            <p class="text-sm text-slate-600 dark:text-slate-400">Cantidad de personas que han participado</p>
                                        </div>
                                    </div>

                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 w-8 h-8 bg-orange-100 dark:bg-orange-900/50 rounded-full flex items-center justify-center mr-3">
                                            <svg class="w-4 h-4 text-orange-600 dark:text-orange-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-medium text-slate-900 dark:text-white">Número de Postulantes</p>
                                            <p class="text-sm text-slate-600 dark:text-slate-400">Cantidad de candidatos participando en la encuesta</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h3 class="text-xl font-semibold text-slate-900 dark:text-white mb-4">Estados de Encuestas</h3>
                                <div class="grid md:grid-cols-2 gap-4">
                                    <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4">
                                        <div class="flex items-center mb-2">
                                            <span class="w-3 h-3 bg-green-500 dark:bg-green-400 rounded-full mr-2"></span>
                                            <span class="font-semibold text-green-900 dark:text-green-300">Encuestas Activas</span>
                                        </div>
                                        <p class="text-sm text-green-800 dark:text-green-400">Puedes participar votando por tu candidato preferido</p>
                                    </div>

                                    <div class="bg-slate-50 dark:bg-slate-700 border border-slate-200 dark:border-slate-600 rounded-lg p-4">
                                        <div class="flex items-center mb-2">
                                            <span class="w-3 h-3 bg-slate-500 dark:bg-slate-400 rounded-full mr-2"></span>
                                            <span class="font-semibold text-slate-900 dark:text-slate-300">Encuestas Finalizadas</span>
                                        </div>
                                        <p class="text-sm text-slate-700 dark:text-slate-400">Puedes ver los resultados finales pero no votar</p>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h3 class="text-xl font-semibold text-slate-900 dark:text-white mb-4">Partidos Políticos</h3>
                                <p class="text-slate-600 dark:text-slate-300 mb-4">
                                    En la sección de partidos políticos encontrarás:
                                </p>
                                <ul class="space-y-2">
                                    <li class="flex items-start">
                                        <svg class="w-5 h-5 text-blue-500 dark:text-blue-400 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                        <span class="text-slate-700 dark:text-slate-300">Información completa de cada partido político</span>
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="w-5 h-5 text-blue-500 dark:text-blue-400 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                        <span class="text-slate-700 dark:text-slate-300">Descripción de sus propuestas e ideología</span>
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="w-5 h-5 text-blue-500 dark:text-blue-400 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                        <span class="text-slate-700 dark:text-slate-300">Información de contacto oficial</span>
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="w-5 h-5 text-blue-500 dark:text-blue-400 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                        <span class="text-slate-700 dark:text-slate-300">Listado de candidatos por partido</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div x-show="activeTab === 'votacion'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0" style="display: none;">
                        <h2 class="text-3xl font-bold text-slate-900 dark:text-white mb-6">Proceso de Votación</h2>

                        <div class="space-y-8">
                            <div>
                                <h3 class="text-xl font-semibold text-slate-900 dark:text-white mb-4">Pasos para Votar</h3>

                                <div class="space-y-4">
                                    <div class="flex">
                                        <div class="flex-shrink-0 w-10 h-10 bg-blue-600 dark:bg-blue-500 text-white rounded-full flex items-center justify-center font-bold mr-4">1</div>
                                        <div class="flex-1 pt-1">
                                            <h4 class="font-semibold text-slate-900 dark:text-white mb-1">Selecciona una Encuesta</h4>
                                            <p class="text-slate-600 dark:text-slate-300">Navega por las encuestas activas y haz clic en la que deseas participar.</p>
                                        </div>
                                    </div>

                                    <div class="flex">
                                        <div class="flex-shrink-0 w-10 h-10 bg-blue-600 dark:bg-blue-500 text-white rounded-full flex items-center justify-center font-bold mr-4">2</div>
                                        <div class="flex-1 pt-1">
                                            <h4 class="font-semibold text-slate-900 dark:text-white mb-1">Revisa los Detalles</h4>
                                            <p class="text-slate-600 dark:text-slate-300">Lee la descripción de la encuesta, las fechas y los candidatos participantes.</p>
                                        </div>
                                    </div>

                                    <div class="flex">
                                        <div class="flex-shrink-0 w-10 h-10 bg-blue-600 dark:bg-blue-500 text-white rounded-full flex items-center justify-center font-bold mr-4">3</div>
                                        <div class="flex-1 pt-1">
                                            <h4 class="font-semibold text-slate-900 dark:text-white mb-1">Explora la Tabla de Candidatos</h4>
                                            <p class="text-slate-600 dark:text-slate-300 mb-2">La tabla muestra información de cada candidato:</p>
                                            <ul class="text-sm text-slate-600 dark:text-slate-400 space-y-1 ml-4">
                                                <li>• Nombre del candidato</li>
                                                <li>• Partido político</li>
                                                <li>• Porcentaje de votos actual</li>
                                                <li>• Número total de votos recibidos</li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="flex">
                                        <div class="flex-shrink-0 w-10 h-10 bg-blue-600 dark:bg-blue-500 text-white rounded-full flex items-center justify-center font-bold mr-4">4</div>
                                        <div class="flex-1 pt-1">
                                            <h4 class="font-semibold text-slate-900 dark:text-white mb-1">Elige tu Opción de Voto</h4>
                                            <p class="text-slate-600 dark:text-slate-300 mb-2">Tienes varias opciones disponibles:</p>
                                            <div class="grid sm:grid-cols-3 gap-3 mt-3">
                                                <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-3 text-center">
                                                    <div class="font-semibold text-green-900 dark:text-green-300 text-sm">Candidato</div>
                                                    <p class="text-xs text-green-700 dark:text-green-400 mt-1">Vota por un candidato específico</p>
                                                </div>
                                                <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-3 text-center">
                                                    <div class="font-semibold text-yellow-900 dark:text-yellow-300 text-sm">No sabe / No opina</div>
                                                    <p class="text-xs text-yellow-700 dark:text-yellow-400 mt-1">No tengo una opinión clara o no tengo preferencia</p>
                                                </div>
                                                <div class="bg-slate-50 dark:bg-slate-700 border border-slate-200 dark:border-slate-600 rounded-lg p-3 text-center">
                                                    <div class="font-semibold text-slate-900 dark:text-slate-300 text-sm">Ninguno de los anteriores</div>
                                                    <p class="text-xs text-slate-700 dark:text-slate-400 mt-1">Ninguno de las opciones me representa o que no votaría</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex">
                                        <div class="flex-shrink-0 w-10 h-10 bg-blue-600 dark:bg-blue-500 text-white rounded-full flex items-center justify-center font-bold mr-4">5</div>
                                        <div class="flex-1 pt-1">
                                            <h4 class="font-semibold text-slate-900 dark:text-white mb-1">Confirma tu Voto</h4>
                                            <p class="text-slate-600 dark:text-slate-300">Haz clic en el botón "Marcar" de tu opción elegida. Se te pedirá confirmar tu decisión.</p>
                                        </div>
                                    </div>

                                    <div class="flex">
                                        <div class="flex-shrink-0 w-10 h-10 bg-green-600 dark:bg-green-500 text-white rounded-full flex items-center justify-center font-bold mr-4">✓</div>
                                        <div class="flex-1 pt-1">
                                            <h4 class="font-semibold text-slate-900 dark:text-white mb-1">Voto Registrado</h4>
                                            <p class="text-slate-600 dark:text-slate-300">Recibirás un mensaje de confirmación y podrás ver los resultados actualizados inmediatamente.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h3 class="text-xl font-semibold text-slate-900 dark:text-white mb-4">Resultados de la Encuesta</h3>
                                <p class="text-slate-600 dark:text-slate-300 mb-4">
                                    Después de votar, verás el resumen completo de la encuesta:
                                </p>
                                <div class="bg-slate-50 dark:bg-slate-700 border border-slate-200 dark:border-slate-600 rounded-lg p-6">
                                    <div class="grid md:grid-cols-3 gap-4 text-center">
                                        <div>
                                            <div class="text-3xl font-bold text-blue-600 dark:text-blue-400 mb-1">📊</div>
                                            <div class="text-sm font-semibold text-slate-900 dark:text-white">Total de Votos</div>
                                            <div class="text-xs text-slate-600 dark:text-slate-400 mt-1">Participación general</div>
                                        </div>
                                        <div>
                                            <div class="text-3xl font-bold text-yellow-600 dark:text-yellow-400 mb-1">❓</div>
                                            <div class="text-sm font-semibold text-slate-900 dark:text-white">Votos No Sabe / No Opina</div>
                                            <div class="text-xs text-slate-600 dark:text-slate-400 mt-1">No tengo una opinión clara o no tengo preferencia</div>
                                        </div>
                                        <div>
                                            <div class="text-3xl font-bold text-slate-600 dark:text-slate-400 mb-1">⬜</div>
                                            <div class="text-sm font-semibold text-slate-900 dark:text-white">Ninguno de los anteriores</div>
                                            <div class="text-xs text-slate-600 dark:text-slate-400 mt-1">Ninguno de las opciones me representa o que no votaría</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-6">
                                <h3 class="text-lg font-bold text-red-900 dark:text-red-300 mb-3 flex items-center">
                                    <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    Reglas Importantes
                                </h3>
                                <ul class="space-y-2 text-red-800 dark:text-red-300 text-sm">
                                    <li class="flex items-start">
                                        <svg class="w-5 h-5 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                        </svg>
                                        Solo puedes votar UNA VEZ por encuesta
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="w-5 h-5 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                        </svg>
                                        No podrás cambiar tu voto una vez confirmado
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="w-5 h-5 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                        </svg>
                                        Tu voto es anónimo - no se asocia públicamente con tu identidad
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
