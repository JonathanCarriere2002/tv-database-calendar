<?php

namespace Tests\Feature;

use App\Models\Anime;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;

/**
 * Tests unitaires pour le modèle Anime
 * @author Jonathan Carrière
 */
class AnimeTest extends TestCase
{
    use DatabaseTransactions;
    private UploadedFile $image;
    private Anime $anime_test;
    private User $user_test;
    private User $user_admin_test;

    /**
     * Configuration de l'environnement pour les tests unitaires du modèle Anime
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->image = UploadedFile::fake()->image("image_test.png")->size(100);
        $this->anime_test = Anime::factory(1)->createOne([
            'titre' => 'anime_test'
        ]);
        $this->user_test = User::factory()->createOne([
            'is_admin' => 0
        ]);

        $this->user_admin_test = User::factory()->createOne([
            'is_admin' => 1
        ]);

    }


    /**
     * ##########################################################
     * TESTS POUR LA VÉRIFICATION DE LA DISPONIBILITÉ D'UNE ROUTE
     * ##########################################################
     */

    /**
     * Test permettant de vérifier qu'une route est disponible (animes.index)
     * @author Jonathan Carrière
     * @return void
     */
    public function test_index_existe(): void
    {
        $response = $this->actingAs($this->user_test)->get(route('animes.index'));
        $response->assertStatus(200);
    }

    /**
     * Test permettant de vérifier qu'une route est disponible (animes.show)
     * @author Jonathan Carrière
     * @return void
     */
    public function test_show_existe(): void
    {
        $response = $this->actingAs($this->user_test)->get("/animes/{$this->anime_test->id}");
        $response->assertStatus(200);
    }


    /**
     * ###########################################
     * TEST POUR LA VÉRIFICATION DE LA REDIRECTION
     * ###########################################
     */

    /**
     * Test permettant de vérifier qu'un admin se fait rediriger vers l'index des animes après la création d'un anime
     * @author Jonathan Carrière
     * @return void
     */
    public function test_ajout_donnes_valides_redirection_animesIndex():void{
        $response = $this->actingAs($this->user_admin_test)->post(route("animes.store"), [
            'titre' => 'titre',
            'image' => $this->image,
            'genre' => 'Action',
            'description' => 'description',
            'studio' => 'studio',
            'saisons' => 3,
            'episodes' => 12,
            'date_debut' => '2023-05-04',
            'duree_episode' => 24
        ]);
        $response->assertRedirect(route("animes.index"));
    }


    /**
     * ##############################################################
     * TEST POUR VÉRIFIER SI UNE/DES PROPRIÉTÉS S'AFFICHE DANS LA VUE
     * ##############################################################
     */

    /**
     * Tester si la vue Animes.Show affiche les données souhaitées
     * @author Jonathan Carrière
     * @return void
     */
    public function test_show_affiche_nom(): void
    {
        $response = $this->actingAs($this->user_test)->get("/animes/{$this->anime_test->id}");
        $response->assertSee($this->anime_test->nom);
        $response->assertSee($this->anime_test->description);
        $response->assertSee($this->anime_test->doubleurs);
        $response->assertSee($this->anime_test->animes);
    }


    /**
     * ##############################################################
     * TEST POUR VÉRIFIER LA PRÉSENCE D'UN MESSAGE DANS LA SESSION
     * ##############################################################
     */

    /**
     * Test permettant de vérifier si un message de confirmation se retrouve dans la session
     * @author Jonathan Carrière
     * @return void
     */
    public function test_message_apres_modification():void{
        $response = $this->actingAs($this->user_admin_test)->put(route("animes.update", $this->anime_test->id), [
            'titre' => 'titre',
            'image' => $this->image,
            'genre' => 'Action',
            'description' => 'description',
            'studio' => 'studio',
            'saisons' => 3,
            'episodes' => 12,
            'date_debut' => '2023-05-04',
            'duree_episode' => 24
        ]);
        $response->assertSessionHas('message', "L'anime titre a été modifié avec succès!");
    }


    /**
     * #########################################################
     * TEST POUR LA CRÉATION DE MODÈLES AVEC DES DONNÉES VALIDES
     * #########################################################
     */

    /**
     * Test permettant de vérifier qu'un anime peut être inséré dans la BD avec des données valides
     * @author Jonathan Carrière
     * @return void
     */
    public function test_ajout_valide_bd():void
    {
        $this->actingAs($this->user_admin_test)->assertDatabaseMissing("animes",[
            'titre' => 'titre',
            'genre' => 'Action',
            'description' => 'description',
            'studio' => 'studio',
            'saisons' => 3,
            'episodes' => 12,
            'date_debut' => '2023-05-04',
            'duree_episode' => 24
        ]);
        $reponse = $this->actingAs($this->user_admin_test)->post(route("animes.store"),[
            'titre' => 'titre',
            'image' => $this->image,
            'genre' => 'Action',
            'description' => 'description',
            'studio' => 'studio',
            'saisons' => 3,
            'episodes' => 12,
            'date_debut' => '2023-05-04',
            'duree_episode' => 24
        ]);
        $this->assertDatabaseHas("animes",[
            'titre' => 'titre',
            'genre' => 'Action',
            'description' => 'description',
            'studio' => 'studio',
            'saisons' => 3,
            'episodes' => 12,
            'date_debut' => '2023-05-04',
            'duree_episode' => 24
        ]);
    }


    /**
     * ############################################################
     * TESTS POUR LA CRÉATION DE MODÈLES AVEC DES DONNÉES INVALIDES
     * ############################################################
     */

    /**
     * Test permettant de vérifier que le titre d'un anime doit contenir plus de deux caractères
     * @author Jonathan Carrière
     * @return void
     */
    public function test_ajout_titre_min_2_caracteres_invalide():void
    {
        $reponse = $this->actingAs($this->user_admin_test)->post(route("animes.store"),[
            'titre' => 't',
            'image' => $this->image,
            'genre' => 'Action',
            'description' => 'description',
            'studio' => 'studio',
            'saisons' => 3,
            'episodes' => 12,
            'date_debut' => '2023-05-04',
            'duree_episode' => 24
        ]);
        $reponse->assertInvalid(["titre"]);
        $reponse->assertValid("image");
        $reponse->assertValid("genre");
        $reponse->assertValid("description");
        $reponse->assertValid("studio");
        $reponse->assertValid("saisons");
        $reponse->assertValid("eepisodes");
        $reponse->assertValid("date_debut");
        $reponse->assertValid("duree_episode");
        $this->assertDatabaseMissing("animes",[
            "titre" => "t"
        ]);
    }

    /**
     * Test permettant de vérifier que le titre d'un anime ne contient pas plus de 50 caractères
     * @author Jonathan Carrière
     * @return void
     */
    public function test_ajout_nom_max_50_caracteres_invalide():void
    {
        $reponse = $this->actingAs($this->user_admin_test)->post(route("animes.store"),[
            'titre' => '0123456789012345678901234567890123456789012345678901',
            'image' => $this->image,
            'genre' => 'Action',
            'description' => 'description',
            'studio' => 'studio',
            'saisons' => 3,
            'episodes' => 12,
            'date_debut' => '2023-05-04',
            'duree_episode' => 24
        ]);
        $reponse->assertInvalid(["titre"]);
        $reponse->assertValid("image");
        $reponse->assertValid("genre");
        $reponse->assertValid("description");
        $reponse->assertValid("studio");
        $reponse->assertValid("saisons");
        $reponse->assertValid("eepisodes");
        $reponse->assertValid("date_debut");
        $reponse->assertValid("duree_episode");
        $this->assertDatabaseMissing("animes",[
            "titre" => "0123456789012345678901234567890123456789012345678901"
        ]);
    }

    /**
     * Test permettant de vérifier que l'image est requise lors de l'ajout d'un anime
     * @author Jonathan Carrière
     * @return void
     */
    public function test_ajout_image_requise_invalide():void
    {
        $reponse = $this->actingAs($this->user_admin_test)->post(route("animes.store"),[
            'titre' => 'titre',
            'image' => "",
            'genre' => 'Action',
            'description' => 'description',
            'studio' => 'studio',
            'saisons' => 3,
            'episodes' => 12,
            'date_debut' => '2023-05-04',
            'duree_episode' => 24
        ]);
        $reponse->assertValid(["titre"]);
        $reponse->assertInvalid("image");
        $reponse->assertValid("genre");
        $reponse->assertValid("description");
        $reponse->assertValid("studio");
        $reponse->assertValid("saisons");
        $reponse->assertValid("eepisodes");
        $reponse->assertValid("date_debut");
        $reponse->assertValid("duree_episode");
        $this->assertDatabaseMissing("animes",[
            "titre" => "titre"
        ]);
    }

    /**
     * Test permettant de valider que la description d'un anime est d'au moins dix caractères
     * @author Jonathan Carrière
     * @return void
     */
    public function test_ajout_description_min_10_caracteres_invalide():void
    {
        $reponse = $this->actingAs($this->user_admin_test)->post(route("animes.store"),[
            'titre' => 'titre',
            'image' => $this->image,
            'genre' => 'Action',
            'description' => 'desc',
            'studio' => 'studio',
            'saisons' => 3,
            'episodes' => 12,
            'date_debut' => '2023-05-04',
            'duree_episode' => 24
        ]);
        $reponse->assertValid(["titre"]);
        $reponse->assertValid("image");
        $reponse->assertValid("genre");
        $reponse->assertInvalid("description");
        $reponse->assertValid("studio");
        $reponse->assertValid("saisons");
        $reponse->assertValid("eepisodes");
        $reponse->assertValid("date_debut");
        $reponse->assertValid("duree_episode");
        $this->assertDatabaseMissing("animes",[
            "titre" => "titre"
        ]);
    }


    /**
     * #############################################################
     * TEST POUR LA MODIFICATION DE MODÈLES AVEC DES DONNÉES VALIDES
     * #############################################################
     */

    /**
     * Test permettant de vérifier qu'un anime avec des données valides peut être ajouté à la BD
     * @author Jonathan Carrière
     * @return void
     */
    public function test_modification_nom(): void
    {
        $anime = Anime::factory()->createOne();
        $this->assertNotEquals($anime->titre, "titreTest");
        $this->actingAs($this->user_admin_test)->put(route("animes.update", $anime->id), [
            'titre' => 'titreTest',
            'genre' => 'Action',
            'description' => 'descriptionTest',
            'studio' => 'studio',
            'saisons' => 3,
            'episodes' => 12,
            'date_debut' => '2023-05-04',
            'duree_episode' => 24
        ]);
        $anime->refresh();
        $this->assertEquals($anime->titre, "titreTest");
        $this->assertEquals($anime->description, "descriptionTest");
    }


    /**
     * ###############################################################
     * TEST POUR LA MODIFICATION DE MODÈLES AVEC DES DONNÉES INVALIDES
     * ###############################################################
     */

    /**
     * Test permettant de valider que modifier un anime avec des données invalides est impossible
     * @author Jonathan Carrière
     * @return void
     */
    public function test_modification_donees_invalide(): void
    {
        $reponse = $this->actingAs($this->user_admin_test)->put(route("animes.update", $this->anime_test->id), [
            'titre' => 't'
        ]);
        $reponse->assertInvalid("titre");
    }


    /**
     * ###################################
     * TEST POUR LA SUPPRESSION D'UN OBJET
     * ###################################
     */

    /**
     * Test permettant de vérifier qu'il est possible de supprimer un anime
     * @author Jonathan Carrière
     * @return void
     */
    public function test_suppression_anime_bd():void{
        $this->actingAs($this->user_admin_test)->assertDatabaseMissing("animes",[
            "id" => 100,
            'titre' => 'titre',
            'genre' => 'Action',
            'description' => 'description',
            'studio' => 'studio',
            'saisons' => 3,
            'episodes' => 12,
            'date_debut' => '2023-05-04',
            'duree_episode' => 24
        ]);
        $this->actingAs($this->user_admin_test)->post(route("animes.store"),[
            'id' => 100,
            'titre' => 'titre',
            'image' => $this->image,
            'genre' => 'Action',
            'description' => 'description',
            'studio' => 'studio',
            'saisons' => 3,
            'episodes' => 12,
            'date_debut' => '2023-05-04',
            'duree_episode' => 24
        ]);
        $this->actingAs($this->user_admin_test)->assertDatabaseHas("animes",[
            'titre' => 'titre',
            'genre' => 'Action',
            'description' => 'description',
            'studio' => 'studio',
            'saisons' => 3,
            'episodes' => 12,
            'date_debut' => '2023-05-04',
            'duree_episode' => 24
        ]);
        $this->delete(route("animes.destroy", 100));
        $this->assertDatabaseMissing("animes",[
            'id' => 100
        ]);
    }


    /**
     * ####################################################################################
     * TESTS PERMETTANT DE VÉRIFIER L'ACCESSIBILITÉ DES ROUTES SELON LE STATUT DE CONNEXION
     * ####################################################################################
     */

    /**
     * Test permettant de vérifier qu'un utilisateur non connecté ne peut pas accéder à l'horaire
     * @author Jonathan Carrière
     * @return void
     */
    public function test_affichage_horaire_non_connecte():void {
        $response = $this->get(route('horaires.index'));
        $response->assertRedirect("/login");
    }

    /**
     * Test permettant de vérifier qu'un utilisateur connecté peut accéder à l'horaire
     * @author Jonathan Carrière
     * @return void
     */
    public function test_affichage_horaire_connecte():void {
        $response = $this->actingAs($this->user_test)->get(route('horaires.index'));
        $response->assertStatus(200);
    }


    /**
     * ##########################################################################
     * TESTS PERMETTANT DE VÉRIFIER LES RÈGLES D'AUTORISATION QUI UTILISE UN RÔLE
     * ##########################################################################
     */

    /**
     * Test permettant de vérifier qu'il est impossible pour un utilisateur régulier d'ajouter un anime
     * @author Jonathan Carrière
     * @return void
     */
    public function test_ajout_refuse_non_admin():void{
        $response = $this->actingAs($this->user_test)->post(route("animes.store"), [
            'titre' => 'titre',
            'image' => $this->image,
            'genre' => 'Action',
            'description' => 'description',
            'studio' => 'studio',
            'saisons' => 3,
            'episodes' => 12,
            'date_debut' => '2023-05-04',
            'duree_episode' => 24
        ]);
        $response->assertForbidden();
    }

    /**
     * Test permettant de vérifier qu'un admin peut supprimer un modèle dans la base de données
     * @author Jonathan Carrière
     * @return void
     */
    public function test_suppression_anime_admin_bd():void{
        $this->actingAs($this->user_admin_test)->assertDatabaseMissing("animes",[
            "id" => 100,
            'image' => $this->image,
            'titre' => 'titre',
            'genre' => 'Action',
            'description' => 'description',
            'studio' => 'studio',
            'saisons' => 3,
            'episodes' => 12,
            'date_debut' => '2023-05-04',
            'duree_episode' => 24
        ]);
        $this->post(route("animes.store"),[
            "id" => 100,
            'image' => $this->image,
            'titre' => 'titre',
            'genre' => 'Action',
            'description' => 'description',
            'studio' => 'studio',
            'saisons' => 3,
            'episodes' => 12,
            'date_debut' => '2023-05-04',
            'duree_episode' => 24
        ]);
        $this->actingAs($this->user_admin_test)->delete(route("animes.destroy", 100));
        $this->assertDatabaseMissing("animes",[
            "id" => 100
        ]);
    }
}
