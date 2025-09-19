<?php
use PHPUnit\Framework\TestCase;

// Utiliser l’autoloader de Composer
require_once __DIR__ . '/../vendor/autoload.php';



class Tp1Test extends TestCase
{
    private $recette;
    private $ingredient;
    private $utilisateur;
    private $ctrlAdminRecettes;
    private $ctrlAdminIngredients;

    protected function setUp(): void
    {
        $this->recette = new Recette();
        $this->ingredient = new Ingredient();
        $this->utilisateur = new Utilisateur();
        $this->ctrlAdminRecettes = new ControleurAdminRecettes();
        $this->ctrlAdminIngredients = new ControleurAdminIngredients();

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // ----------- TESTS MODELES -----------
    public function testUtilisateurAuthentificationValide()
    {
        $result = $this->utilisateur->connecter("admin", "12345");
        $this->assertTrue($result, "Connexion admin avec bons identifiants devrait réussir.");
    }

    public function testUtilisateurAuthentificationInvalide()
    {
        $result = $this->utilisateur->connecter("admin", "faux");
        $this->assertFalse($result, "Connexion doit échouer avec mauvais mot de passe.");
    }

    public function testRecetteContientTitre()
    {
        $recettes = $this->recette->getRecettes();
        $this->assertNotEmpty($recettes, "La base de données doit contenir au moins une recette.");
        $this->assertArrayHasKey('titre', $recettes[0], "Une recette doit contenir un champ titre.");
    }

    // ----------- TESTS CONTROLEURS ADMIN -----------
    public function testAdminRecetteAjout()
    {
        $_SESSION['user'] = ['id' => 1, 'nom' => 'Admin'];

        $result = $this->ctrlAdminRecettes->ajouter([
            'titre' => 'Test Recette',
            'description' => 'Ceci est une recette de test',
            'idUtilisateur' => 1,
            'idType' => 1
        ]);

        $this->assertTrue($result, "Un admin connecté doit pouvoir ajouter une recette.");
    }

    public function testAdminIngredientAjout()
    {
        $_SESSION['user'] = ['id' => 1, 'nom' => 'Admin'];

        $result = $this->ctrlAdminIngredients->ajouter([
            'nom' => 'Sel',
            'quantite' => '1 pincée',
            'idRecette' => 1
        ]);

        $this->assertTrue($result, "Un admin connecté doit pouvoir ajouter un ingrédient.");
    }

    public function testSuppressionEtRetablissementRecette()
    {
        $_SESSION['user'] = ['id' => 1, 'nom' => 'Admin'];

        $resultSupp = $this->ctrlAdminRecettes->effacer(1);
        $this->assertTrue($resultSupp, "Suppression d'une recette par son auteur doit fonctionner.");

        $resultRetab = $this->ctrlAdminRecettes->retablir(1);
        $this->assertTrue($resultRetab, "Rétablissement d'une recette par son auteur doit fonctionner.");
    }

    // ----------- TESTS VUES -----------
    public function testVueAccueilAfficheRecettes()
    {
        ob_start();
        include __DIR__ . '/../Vue/vueAccueil.php';
        $output = ob_get_clean();

        $this->assertStringContainsString("Recette", $output, "La vue accueil doit afficher au moins une recette.");
    }

    public function testGabaritAfficheConnexion()
    {
        unset($_SESSION['user']);
        ob_start();
        include __DIR__ . '/../Vue/gabarit.php';
        $output = ob_get_clean();

        $this->assertStringContainsString("Se connecter", $output, "Le gabarit doit afficher 'Se connecter' si personne n'est en session.");
    }

    public function testGabaritAfficheDeconnexion()
    {
        $_SESSION['user'] = ['id' => 1, 'nom' => 'Admin'];
        ob_start();
        include __DIR__ . '/../Vue/gabarit.php';
        $output = ob_get_clean();

        $this->assertStringContainsString("Se déconnecter", $output, "Le gabarit doit afficher 'Se déconnecter' si un utilisateur est en session.");
    }
}
