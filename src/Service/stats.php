<?php

namespace App\Service;

use App\Repository\UtilisateurRepository;

class StatistiqueService
{
    private UtilisateurRepository $utilisateurRepository;

    public function __construct(UtilisateurRepository $utilisateurRepository)
    {
        $this->utilisateurRepository = $utilisateurRepository;
    }

    public function calculerPourcentageParRole(): array
    {
        $totalUtilisateurs = $this->utilisateurRepository->count([]);
        $utilisateursParRole = $this->utilisateurRepository->countByRole();

        $pourcentages = [];
        foreach ($utilisateursParRole as $role => $nombre) {
            $pourcentage = ($nombre / $totalUtilisateurs) * 100;
            $pourcentages[$role] = round($pourcentage, 2); // Arrondi à 2 décimales
        }

        return $pourcentages;
    }
}
