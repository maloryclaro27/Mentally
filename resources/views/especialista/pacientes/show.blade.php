@extends('layouts.app')
@section('title', 'Expediente — {{ $paciente->name }} | Mentally')

@push('styles')
<style>
:root {
    --primary:#4db8a8; --primary-dark:#2c5f5d; --primary-light:#5bc4b3;
    --secondary:#5a7c7a; --background:linear-gradient(135deg,#f4fbfc 0%,#eef8f9 100%);
    --card-bg:rgba(255,255,255,0.85); --shadow:0 8px 30px rgba(44,95,93,0.08);
    --shadow-hover:0 15px 35px rgba(44,95,93,0.14);
}
body { background:var(--background); font-family:'Poppins',sans-serif; }
@keyframes slideInUp { from{opacity:0;transform:translateY(30px)} to{opacity:1;transform:translateY(0)} }

/* wrapper */
.hub { max-width:1400px; margin:100px auto 4rem; padding:0 2rem; display:flex; flex-direction:column; gap:2.5rem; }

/* header */
.hub-header {
    background:var(--card-bg); backdrop-filter:blur(10px); border-radius:20px;
    padding:2.5rem; box-shadow:var(--shadow); border:1px solid rgba(255,255,255,0.4);
    display:flex; align-items:center; gap:2rem; flex-wrap:wrap;
    animation:slideInUp .6s ease both; margin-top:4rem;
}
.hub-avatar {
    width:72px; height:72px; border-radius:20px;
    background:linear-gradient(135deg,var(--primary),var(--primary-light));
    color:#fff; display:flex; align-items:center; justify-content:center;
    font-weight:700; font-size:1.8rem; box-shadow:0 6px 18px rgba(77,184,168,.3); flex-shrink:0;
}
.hub-name  { font-family:'Quicksand',sans-serif; font-size:1.9rem; font-weight:700; color:var(--primary-dark); }
.hub-email { color:var(--secondary); margin-top:.2rem; }
.back-link { margin-left:auto; display:inline-flex; align-items:center; gap:.5rem;
    color:var(--primary); font-weight:600; text-decoration:none; font-size:.95rem; }
.back-link:hover { color:var(--primary-dark); }

/* tabs */
.tabs { display:flex; gap:.5rem; flex-wrap:wrap; animation:slideInUp .6s ease .1s both; }
.tab-btn {
    padding:.75rem 1.6rem; border-radius:30px; border:none; cursor:pointer;
    font-family:'Poppins',sans-serif; font-size:.9rem; font-weight:600; transition:all .25s;
    background:rgba(255,255,255,0.7); color:var(--secondary);
    box-shadow:0 2px 8px rgba(0,0,0,.04);
}
.tab-btn.active, .tab-btn:hover { background:var(--primary); color:#fff; }
.tab-content { display:none; animation:slideInUp .4s ease both; }
.tab-content.active { display:block; }

/* card */
.card {
    background:var(--card-bg); backdrop-filter:blur(10px); border-radius:20px;
    padding:2.5rem; box-shadow:var(--shadow); border:1px solid rgba(255,255,255,0.4);
}
.section-title {
    font-family:'Quicksand',sans-serif; font-size:1.3rem; font-weight:700;
    color:var(--primary-dark); display:flex; align-items:center; gap:.6rem; margin-bottom:1.8rem;
}

/* grid helpers */
.grid-2 { display:grid; grid-template-columns:1fr 1fr; gap:2rem; }
.grid-3 { display:grid; grid-template-columns:repeat(3,1fr); gap:1.5rem; margin-bottom:2rem; }
@media(max-width:900px){ .grid-2,.grid-3{grid-template-columns:1fr;} }

/* kpi */
.kpi { background:#fff; border-radius:16px; padding:1.5rem;
    box-shadow:0 4px 12px rgba(0,0,0,.04); border:1px solid rgba(77,184,168,.1); }
.kpi-val { font-size:2rem; font-weight:700; color:var(--primary-dark); }
.kpi-lbl { color:var(--secondary); font-size:.875rem; margin-top:.2rem; }

/* chart */
.chart-box { position:relative; height:280px; }

/* test list */
.test-row {
    display:flex; align-items:center; gap:1rem; padding:1rem 1.2rem;
    background:#fff; border-radius:14px; margin-bottom:.75rem;
    border:1px solid rgba(77,184,168,.1);
}
.test-type-tag { padding:.3rem .9rem; border-radius:20px; font-size:.8rem; font-weight:600; }
.tag-dep { background:rgba(77,184,168,.12); color:#2c5f5d; }
.tag-anx { background:rgba(255,152,0,.12); color:#e65100; }
.tag-wel { background:rgba(76,175,80,.12); color:#2e7d32; }
.test-score { font-size:1.5rem; font-weight:700; color:var(--primary-dark); margin-left:auto; }
.test-date  { font-size:.82rem; color:var(--secondary); }
.test-result { font-size:.82rem; padding:.25rem .7rem; border-radius:12px;
    background:rgba(77,184,168,.1); color:var(--primary-dark); }

/* medication rows */
.med-row {
    display:flex; align-items:center; gap:1.2rem; padding:1.2rem 1.4rem;
    background:#fff; border-radius:14px; margin-bottom:.8rem;
    border:1px solid rgba(77,184,168,.08); transition:transform .2s,box-shadow .2s;
}
.med-row:hover { transform:translateY(-2px); box-shadow:var(--shadow-hover); }
.med-icon { width:44px; height:44px; border-radius:12px;
    background:linear-gradient(135deg,rgba(77,184,168,.15),rgba(91,196,179,.25));
    color:var(--primary); display:flex; align-items:center; justify-content:center; font-size:1.2rem; flex-shrink:0; }
.med-name  { font-weight:600; color:var(--primary-dark); }
.med-dosis { font-size:.82rem; color:var(--secondary); }
.med-pct   { font-weight:700; font-size:1.1rem; margin-left:auto; }
.prog-track { height:6px; background:#eef8f9; border-radius:10px; overflow:hidden; margin-top:.4rem; min-width:100px; }
.prog-fill  { height:100%; border-radius:10px; }
.c-green { color:#4caf50; } .c-orange { color:#ff9800; } .c-red { color:#f44336; }
.f-green { background:#4caf50; } .f-orange { background:#ff9800; } .f-red { background:#f44336; }

/* risk badge */
.risk-badge {
    display:inline-flex; align-items:center; gap:.6rem;
    padding:.9rem 2rem; border-radius:40px; font-weight:700; font-size:1.1rem;
}
.risk-alto     { background:rgba(244,67,54,.1);  color:#c62828; border:2px solid rgba(244,67,54,.3); }
.risk-moderado { background:rgba(255,152,0,.1);  color:#e65100; border:2px solid rgba(255,152,0,.3); }
.risk-bajo     { background:rgba(76,175,80,.1);  color:#2e7d32; border:2px solid rgba(76,175,80,.3); }

/* tags cloud */
.tag-cloud { display:flex; flex-wrap:wrap; gap:.6rem; }
.tag-item { background:rgba(77,184,168,.1); color:var(--primary-dark);
    border:1px solid rgba(77,184,168,.2); padding:.35rem 1rem; border-radius:20px; font-size:.85rem; font-weight:500; }

/* crisis items */
.crisis-item { display:flex; gap:1rem; align-items:center; padding:.9rem 1.2rem;
    background:rgba(244,67,54,.06); border-left:4px solid #f44336; border-radius:10px; margin-bottom:.6rem; }
.crisis-date { font-size:.82rem; color:var(--secondary); }
</style>
@endpush

@section('content')
@include('partials.navbar-especialista')

<div class="hub">
    <!-- Header -->
    <div class="hub-header">
        <div class="hub-avatar">{{ strtoupper(substr($paciente->name,0,2)) }}</div>
        <div>
            <div class="hub-name">{{ $paciente->name }}</div>
            <div class="hub-email">{{ $paciente->email }}</div>
        </div>
        <a href="{{ route('especialista.pacientes.index') }}" class="back-link">
            <i class="fas fa-arrow-left"></i> Volver a mis pacientes
        </a>
    </div>

    <!-- Tabs -->
    <div class="tabs">
        <button class="tab-btn active" onclick="switchTab('chequeos',this)">
            <i class="fas fa-clipboard-check"></i> Chequeos
        </button>
        <button class="tab-btn" onclick="switchTab('adherencia',this)">
            <i class="fas fa-pills"></i> Adherencia
        </button>
        <button class="tab-btn" onclick="switchTab('diario',this)">
            <i class="fas fa-brain"></i> Diario Emocional
        </button>
        <button class="tab-btn" onclick="switchTab('chatbot',this)">
            <i class="fas fa-robot"></i> Chatbot
        </button>
    </div>

    <!-- ══════════ TAB: CHEQUEOS ══════════ -->
    <div id="tab-chequeos" class="tab-content active">
        @php
            $testTypes = ['depression'=>['label'=>'PHQ-9 — Depresión','cls'=>'tag-dep'],
                          'anxiety'=>['label'=>'GAD-7 — Ansiedad','cls'=>'tag-anx'],
                          'wellbeing'=>['label'=>'Bienestar','cls'=>'tag-wel']];
        @endphp
        @foreach ($testTypes as $type => $meta)
            @if ($chequeos[$type]->count())
            <div class="card" style="margin-bottom:2rem">
                <h3 class="section-title"><i class="fas fa-chart-line"></i> {{ $meta['label'] }}</h3>
                @foreach ($chequeos[$type]->take(8) as $t)
                    <div class="test-row">
                        <span class="test-type-tag {{ $meta['cls'] }}">{{ strtoupper($type) }}</span>
                        <div>
                            <div class="test-result">{{ $t->result ?? 'Sin clasificar' }}</div>
                            <div class="test-date">{{ \Carbon\Carbon::parse($t->taken_at)->format('d/m/Y — H:i') }}</div>
                        </div>
                        <span class="test-score">{{ $t->score }}</span>
                    </div>
                @endforeach
            </div>
            @endif
        @endforeach
        @if (!$chequeos['depression']->count() && !$chequeos['anxiety']->count() && !$chequeos['wellbeing']->count())
            <div class="card" style="text-align:center;padding:4rem;color:var(--secondary)">
                <i class="fas fa-clipboard" style="font-size:3rem;opacity:.3;display:block;margin-bottom:1rem"></i>
                <p>Este paciente aún no ha realizado ningún test clínico.</p>
            </div>
        @endif
    </div>

    <!-- ══════════ TAB: ADHERENCIA ══════════ -->
    <div id="tab-adherencia" class="tab-content">
        <div class="grid-3">
            @php
                $adh = $adherenciaGlobal;
                $adhClass = $adh>=85?'c-green':($adh>=60?'c-orange':'c-red');
            @endphp
            <div class="kpi">
                <div class="kpi-val {{ $adhClass }}">{{ $adherenciaGlobal }}%</div>
                <div class="kpi-lbl">Adherencia global (30 días)</div>
            </div>
            <div class="kpi">
                <div class="kpi-val">{{ $registeredTotal }}</div>
                <div class="kpi-lbl">Dosis registradas</div>
            </div>
            <div class="kpi">
                <div class="kpi-val">{{ $expectedTotal }}</div>
                <div class="kpi-lbl">Dosis esperadas</div>
            </div>
        </div>

        <div class="grid-2">
            <div class="card">
                <h3 class="section-title"><i class="fas fa-chart-line"></i> Tendencia 14 días</h3>
                <div class="chart-box"><canvas id="adhTrendChart"></canvas></div>
            </div>
            <div class="card">
                <h3 class="section-title"><i class="fas fa-chart-pie"></i> Balance de dosis</h3>
                <div class="chart-box"><canvas id="adhDonaChart"></canvas></div>
            </div>
        </div>

        <div class="card" style="margin-top:2rem">
            <h3 class="section-title"><i class="fas fa-pills"></i> Desglose por medicamento</h3>
            @forelse ($medicamentosAdherencia as $med)
                @php
                    $pc = $med->adherencia_pct;
                    $fc = $pc>=85?'f-green':($pc>=60?'f-orange':'f-red');
                    $cc = $pc>=85?'c-green':($pc>=60?'c-orange':'c-red');
                @endphp
                <div class="med-row">
                    <div class="med-icon"><i class="fas fa-capsules"></i></div>
                    <div style="flex:1">
                        <div class="med-name">{{ $med->nombre }} <span style="font-weight:400;font-size:.85rem;color:var(--secondary)">{{ $med->dosis }}</span></div>
                        <div class="med-dosis">{{ $med->dosis_registradas }} / {{ $med->dosis_esperadas }} dosis registradas</div>
                        <div class="prog-track"><div class="prog-fill {{ $fc }}" style="width:{{ $pc }}%"></div></div>
                    </div>
                    <span class="med-pct {{ $cc }}">{{ $pc }}%</span>
                </div>
            @empty
                <p style="color:var(--secondary);text-align:center;padding:2rem">Sin medicamentos prescritos activos.</p>
            @endforelse
        </div>
    </div>

    <!-- ══════════ TAB: DIARIO EMOCIONAL ══════════ -->
    <div id="tab-diario" class="tab-content">
        @php $d = $diario; @endphp

        <!-- KPIs -->
        <div class="grid-3">
            <div class="kpi">
                <div class="kpi-val">{{ $d['totalEntradas'] }}</div>
                <div class="kpi-lbl">Entradas analizadas (con opt-in)</div>
            </div>
            <div class="kpi">
                <div class="kpi-val">{{ $d['frecuenciaMedia'] }}/sem</div>
                <div class="kpi-lbl">Frecuencia de registro</div>
            </div>
            <div class="kpi">
                <div class="kpi-val {{ $d['crisisFlags']->count()>0 ? 'c-red' : 'c-green' }}">
                    {{ $d['crisisFlags']->count() }}
                </div>
                <div class="kpi-lbl">Crisis detectadas (recientes)</div>
            </div>
        </div>

        <!-- Nivel de riesgo -->
        <div class="card">
            <h3 class="section-title"><i class="fas fa-shield-alt"></i> Índice de Riesgo Psiquiátrico</h3>
            <div style="display:flex;align-items:center;gap:2rem;flex-wrap:wrap">
                <span class="risk-badge risk-{{ $d['nivelRiesgo'] }}">
                    @if($d['nivelRiesgo']==='alto') <i class="fas fa-exclamation-triangle"></i> Riesgo Alto — Atención Inmediata
                    @elseif($d['nivelRiesgo']==='moderado') <i class="fas fa-exclamation-circle"></i> Riesgo Moderado — Seguimiento Activo
                    @else <i class="fas fa-check-circle"></i> Riesgo Bajo — Estable
                    @endif
                </span>
                <p style="color:var(--secondary);font-size:.9rem;max-width:500px">
                    Score calculado en base a: presencia de flags de crisis, sentimientos negativos en los últimos 7 días y frecuencia de registros.
                    <strong>Score: {{ $d['scoreRiesgo'] }}/100</strong>
                </p>
            </div>
        </div>

        <div class="grid-2">
            <!-- Tendencia sentimental -->
            <div class="card">
                <h3 class="section-title"><i class="fas fa-chart-area"></i> Tendencia de Sentimiento (30 días)</h3>
                <div class="chart-box"><canvas id="diaryTrendChart"></canvas></div>
            </div>
            <!-- Distribución -->
            <div class="card">
                <h3 class="section-title"><i class="fas fa-chart-pie"></i> Distribución de Estados</h3>
                <div class="chart-box"><canvas id="diaryDistChart"></canvas></div>
            </div>
        </div>

        <!-- Temas Clave -->
        @if ($d['temasClave']->count())
        <div class="card">
            <h3 class="section-title"><i class="fas fa-tags"></i> Temas Recurrentes (IA)</h3>
            <div class="tag-cloud">
                @foreach ($d['temasClave'] as $tema => $count)
                    <span class="tag-item">{{ $tema }} <strong>({{ $count }})</strong></span>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Crisis recientes -->
        @if ($d['crisisFlags']->count())
        <div class="card">
            <h3 class="section-title" style="color:#c62828"><i class="fas fa-exclamation-triangle"></i> Eventos de Crisis Detectados</h3>
            @foreach ($d['crisisFlags'] as $crisis)
                <div class="crisis-item">
                    <i class="fas fa-flag" style="color:#f44336"></i>
                    <div>
                        <strong>Flag de crisis activa</strong>
                        <div class="crisis-date">{{ \Carbon\Carbon::parse($crisis->created_at)->format('d/m/Y — H:i') }}
                            @if($crisis->mood) — Estado de ánimo reportado: <em>{{ $crisis->mood }}</em> @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @endif
    </div>

    <!-- ══════════ TAB: CHATBOT ══════════ -->
    <div id="tab-chatbot" class="tab-content">
        @php $c = $chatbot; @endphp

        <div class="grid-3">
            <div class="kpi">
                <div class="kpi-val">{{ $c['mensajesTotales'] }}</div>
                <div class="kpi-lbl">Mensajes enviados al chatbot</div>
            </div>
            <div class="kpi">
                <div class="kpi-val {{ $c['pctNocturno']>=30?'c-red':($c['pctNocturno']>=15?'c-orange':'c-green') }}">
                    {{ $c['pctNocturno'] }}%
                </div>
                <div class="kpi-lbl">Uso en horario nocturno (21h–6h)</div>
            </div>
            <div class="kpi">
                <div class="kpi-val" style="font-size:1.1rem">{{ ucfirst($c['emocionPrincipal']) }}</div>
                <div class="kpi-lbl">Emoción predominante detectada</div>
            </div>
        </div>

        @if ($c['pctNocturno'] >= 30)
        <div class="card" style="border-left:4px solid #f44336">
            <h3 class="section-title" style="color:#c62828"><i class="fas fa-moon"></i> Alerta: Patrón de Uso Nocturno</h3>
            <p style="color:var(--secondary)">El <strong>{{ $c['pctNocturno'] }}%</strong> de las interacciones ocurren entre las 21:00 y las 06:00 h. Este patrón puede indicar insomnio, episodios de ansiedad nocturna o ideación negativa. Se recomienda abordar este punto en la próxima sesión clínica.</p>
        </div>
        @endif

        <div class="grid-2">
            <div class="card">
                <h3 class="section-title"><i class="fas fa-chart-bar"></i> Frecuencia Semanal de Uso</h3>
                <div class="chart-box"><canvas id="chatFreqChart"></canvas></div>
            </div>
            <div class="card">
                <h3 class="section-title"><i class="fas fa-heart"></i> Distribución de Emociones</h3>
                <div class="chart-box"><canvas id="chatEmoChart"></canvas></div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
function switchTab(name, btn) {
    document.querySelectorAll('.tab-content').forEach(t => t.classList.remove('active'));
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    document.getElementById('tab-'+name).classList.add('active');
    btn.classList.add('active');
}

const TOOLTIP_STYLE = {
    backgroundColor:'rgba(255,255,255,0.95)',
    titleColor:'#2c5f5d', bodyColor:'#5a7c7a',
    borderColor:'rgba(77,184,168,0.2)', borderWidth:1, padding:10, usePointStyle:true
};

document.addEventListener('DOMContentLoaded', function () {

    // ── Adherencia: Tendencia ──────────────────────────────────────────
    const adhCtx = document.getElementById('adhTrendChart').getContext('2d');
    const adhGrad = adhCtx.createLinearGradient(0,0,0,300);
    adhGrad.addColorStop(0,'rgba(77,184,168,0.4)');
    adhGrad.addColorStop(1,'rgba(77,184,168,0)');
    new Chart(adhCtx, {
        type:'line',
        data:{
            labels: {!! json_encode($trendLabels) !!},
            datasets:[{
                label:'Adherencia (%)',
                data: {!! json_encode($trendData) !!},
                borderColor:'#4db8a8', backgroundColor:adhGrad,
                borderWidth:3, fill:true, tension:0.4,
                pointBackgroundColor:'#4db8a8', pointBorderColor:'#fff',
                pointBorderWidth:2, pointRadius:5, pointHoverRadius:7, spanGaps:true
            }]
        },
        options:{responsive:true,maintainAspectRatio:false,
            scales:{y:{beginAtZero:true,max:100,ticks:{stepSize:25}}},
            plugins:{legend:{display:false},tooltip:TOOLTIP_STYLE}}
    });

    // ── Adherencia: Dona ──────────────────────────────────────────────
    new Chart(document.getElementById('adhDonaChart'), {
        type:'doughnut',
        data:{
            labels:['Dosis tomadas','Dosis perdidas'],
            datasets:[{
                data:[{{ $registeredTotal }}, {{ max(0,$expectedTotal-$registeredTotal) }}],
                backgroundColor:['#4caf50','#f44336'], borderWidth:0, hoverOffset:8
            }]
        },
        options:{responsive:true,maintainAspectRatio:false,cutout:'70%',
            plugins:{legend:{position:'bottom',labels:{padding:16,usePointStyle:true,font:{family:"'Poppins',sans-serif"}}},tooltip:TOOLTIP_STYLE}}
    });

    // ── Diario: Tendencia Sentimiento ─────────────────────────────────
    const diaryCtx = document.getElementById('diaryTrendChart').getContext('2d');
    const diaryGrad = diaryCtx.createLinearGradient(0,0,0,300);
    diaryGrad.addColorStop(0,'rgba(255,152,0,0.3)');
    diaryGrad.addColorStop(1,'rgba(255,152,0,0)');
    new Chart(diaryCtx, {
        type:'line',
        data:{
            labels: {!! json_encode($diario['diaryLabels']) !!},
            datasets:[{
                label:'Score Sentimiento',
                data: {!! json_encode($diario['diaryScores']) !!},
                borderColor:'#ff9800', backgroundColor:diaryGrad,
                borderWidth:3, fill:true, tension:0.4,
                pointBackgroundColor:'#ff9800', pointBorderColor:'#fff',
                pointBorderWidth:2, pointRadius:4, spanGaps:true
            }]
        },
        options:{responsive:true,maintainAspectRatio:false,
            scales:{y:{ticks:{callback:v=>v>0?'😊 '+v:v<0?'😞 '+v:v}}},
            plugins:{legend:{display:false},tooltip:{...TOOLTIP_STYLE,callbacks:{label:c=>' Score: '+c.parsed.y}}}}
    });

    // ── Diario: Distribución sentimientos ─────────────────────────────
    new Chart(document.getElementById('diaryDistChart'), {
        type:'doughnut',
        data:{
            labels: {!! json_encode($diario['sentimentDist']->keys()->values()) !!},
            datasets:[{
                data: {!! json_encode($diario['sentimentDist']->values()) !!},
                backgroundColor:['#4caf50','#ff9800','#f44336','#4db8a8','#9c27b0','#2196f3'],
                borderWidth:0, hoverOffset:8
            }]
        },
        options:{responsive:true,maintainAspectRatio:false,cutout:'65%',
            plugins:{legend:{position:'bottom',labels:{padding:14,usePointStyle:true}},tooltip:TOOLTIP_STYLE}}
    });

    // ── Chatbot: Frecuencia semanal ────────────────────────────────────
    new Chart(document.getElementById('chatFreqChart'), {
        type:'bar',
        data:{
            labels: {!! json_encode($chatbot['chatLabels']) !!},
            datasets:[{
                label:'Mensajes',
                data: {!! json_encode($chatbot['sesionesSemanales']) !!},
                backgroundColor:'rgba(77,184,168,0.7)',
                borderRadius:8, borderSkipped:false
            }]
        },
        options:{responsive:true,maintainAspectRatio:false,
            scales:{y:{beginAtZero:true,ticks:{stepSize:1}}},
            plugins:{legend:{display:false},tooltip:TOOLTIP_STYLE}}
    });

    // ── Chatbot: Emociones dona ────────────────────────────────────────
    new Chart(document.getElementById('chatEmoChart'), {
        type:'doughnut',
        data:{
            labels: {!! json_encode($chatbot['emocionDist']->keys()->values()) !!},
            datasets:[{
                data: {!! json_encode($chatbot['emocionDist']->values()) !!},
                backgroundColor:['#f44336','#ff9800','#2196f3','#9c27b0','#4caf50','#4db8a8'],
                borderWidth:0, hoverOffset:8
            }]
        },
        options:{responsive:true,maintainAspectRatio:false,cutout:'65%',
            plugins:{legend:{position:'bottom',labels:{padding:14,usePointStyle:true}},tooltip:TOOLTIP_STYLE}}
    });
});
</script>
@endpush
