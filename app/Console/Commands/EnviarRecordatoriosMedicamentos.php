<?php

namespace App\Console\Commands;

use App\Mail\RecordatorioMedicamento;
use App\Models\Medicamento;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class EnviarRecordatoriosMedicamentos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:enviar-recordatorios-medicamentos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envía recordatorios por correo de medicamentos programados para la hora actual';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $ahora = now();
        $hoy = $ahora->toDateString();
        $horaActual = $ahora->format('H:i');

        $this->info("Ahora: " . $ahora);
        $this->info("Hoy: " . $hoy);
        $this->info("Hora actual: " . $horaActual);

        $medicamentos = Medicamento::with('usuario')
            ->where('hora_toma', $horaActual)
            ->whereDate('fecha_inicio', '<=', $hoy)
            ->where(function ($query) use ($hoy) {
                $query->whereNull('fecha_fin')
                    ->orWhereDate('fecha_fin', '>=', $hoy);
            })
            ->get();

        $this->info("Medicamentos encontrados: " . $medicamentos->count());

        foreach ($medicamentos as $medicamento) {
            if (!$medicamento->usuario || !$medicamento->usuario->email) {
                continue;
            }

            $confirmUrl = URL::temporarySignedRoute(
                'medications.confirm-intake',
                now()->addMinutes(60),
                [
                    'schedule' => $medicamento->id,
                    'user' => $medicamento->user_id,
                ]
            );

            Mail::to($medicamento->usuario->email)->send(
                new RecordatorioMedicamento($medicamento, $confirmUrl)
            );

            $this->info("Recordatorio enviado a {$medicamento->usuario->email} para {$medicamento->nombre}");
        }

        return Command::SUCCESS;
    }
}
