<?php

namespace App\Filament\Widgets;

use App\Models\Candidate;
use App\Models\PoliticalParty;
use App\Models\Poll;
use App\Models\User;
use App\Models\Vote;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class ElectoralStatsOverview extends BaseWidget
{
    use HasWidgetShield;

    protected static bool $isLazy = true;

    protected ?string $heading = 'Estadísticas Electorales';

    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalPolls = Poll::count();
        $activePolls = Poll::where('status', 'activo')->count();
        $totalPoliticalParties = PoliticalParty::count();
        $totalCandidates = Candidate::count();
        $totalVotes = Vote::count();
        $todayVotes = Vote::whereDate('created_at', today())->count();

        return [
            Stat::make('Total de Encuestas', $totalPolls)
                ->description($activePolls . ' en curso')
                ->descriptionIcon('heroicon-m-clipboard-document-list')
                ->color('success'),

            Stat::make('Total de Partidos Políticos', number_format($totalPoliticalParties))
                ->description('Partidos políticos totales')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('danger'),

            Stat::make('Total de Candidatos', number_format($totalCandidates))
                ->description('Candidatos totales')
                ->descriptionIcon('heroicon-m-users')
                ->color('info'),

            Stat::make('Total de Votos', number_format($totalVotes))
                ->description($todayVotes . ' votos hoy')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('primary'),
        ];
    }
}
