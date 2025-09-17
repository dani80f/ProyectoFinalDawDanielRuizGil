<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class ImportJugadores extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-jugadores';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importar jugadores de La Liga y guardarlos en la base de datos';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $apiKey = env('API_FOOTBALL_SPORTMONKS_KEY');
        $leagueId = 271; //ID de La Liga española
        $season = 20331;

        //Obtener equipos a traves del id de la liga y usando la api key
        $equiposResponse = Http::get("https://api.sportmonks.com/v3/football/teams", [
            'api_token' => $apiKey,
            'leagues' => $leagueId,
        ]);

        if (!$equiposResponse->successful()) {

            $this->error('Error al obtener equipos: ' . $equiposResponse->status());
            return;
        }

        $equipos = $equiposResponse->json('data');



        if (empty($equipos)) {
            $this->error('No se encontraron equipos.');
            return;
        }

        foreach ($equipos as $equipo) {
            $id_equipo = $equipo['id'];

            $pagina = 1;
            do {
                //Obtener jugadores por equipo mediante el paginado

                /*$jugadoresResponse = Http::get("https://api.sportmonks.com/v3/football/players/team/{$id_equipo}", [
                    'api_token' => $apiKey,
                    'page' => $pagina,
                    'include' => 'stats,team',
                ]);*/

                $jugadoresResponse = Http::get("https://api.sportmonks.com/v3/football/players", [
                    'api_token' => $apiKey,
                    'team_ids' => $id_equipo,
                    'page' => $pagina,
                    'include' => 'stats,team',
                ]);


                if (!$jugadoresResponse->successful()) {

                    $this->error("Error al obtener jugadores del equipo {$id_equipo}, página {$pagina}: " . $jugadoresResponse->status());
                    break;
                }

                $jugadoresData = $jugadoresResponse->json('data');

                if (empty($jugadoresData)) {

                    break;
                }

                foreach ($jugadoresData as $jugador) {


                    $id_jugador = $jugador['id'];
                    $nombre = $jugador['firstname'] ?? ($jugador['name'] ?? '');
                    $apellidos = $jugador['lastname'] ?? '';
                    $imagen = $jugador['image_path'] ?? null;

                    // Estadísticas - SportMonks las devuelve en "stats" incluido o puedes hacer request separado
                    $estadisticas = $jugador['stats'] ?? [];

                    // Media y precio (si existen, o 0 si no)
                    $media = isset($estadisticas['rating']) ? (float) $estadisticas['rating'] : 0;

                    $precio = $media*2;

                    // Insertar o actualizar con upsert para evitar duplicados
                    DB::table('jugador')->updateOrInsert(
                        ['id_jugador_api' => $id_jugador],//Comprueba de que haya un jugador con este id, si no, lo crea
                        [
                            'nombre' => $nombre,
                            'apellidos' => $apellidos,
                            'imagen' => $imagen,
                            'estadisticas' => json_encode($estadisticas),
                            'media' => $media,
                            'precio' => $precio,
                        ]
                    );
                }

                $pagina++;
            } while (true);
        }

        $this->info('Jugadores importados correctamente desde SportMonks.');
    }


}
