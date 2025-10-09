<?php

namespace Tests\Feature;

use App\Models\Personnage;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

/**
 * Tests unitaires pour le modèle Personnage
 * @author Jonathan Carrière
 */
class PersonnageTest extends TestCase
{
    use DatabaseTransactions;
    private UploadedFile $image;
    private Personnage $personnageTest;
    private User $userTest;
    private User $userAdminTest;

    /**
     * Configuration de l'environnement pour les tests unitaires du modèle Anime
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->image = UploadedFile::fake()->image("imageTest.png")->size(100);
        $this->personnageTest = Personnage::factory(1)->createOne([
            'nom' => 'PersonnageTest'
        ]);
        $this->userTest = User::factory()->createOne([
            'is_admin' => 0
        ]);

        $this->userAdminTest = User::factory()->createOne([
            'is_admin' => 1
        ]);

    }

    /** ################################
     *  ## TESTS D'AFFICHAGE DE PAGES ##
     *  ################################
     */

    /**
     * Test si la page Index du contrôleur PersonnageController existe
     * @author Jonathan Carrière
     */
    public function test_index_existe(): void
    {
        $response = $this->actingAs($this->userTest)->get(route('personnages.index'));
        $response->assertStatus(200);
    }

    /**
     * Tester si la page Show du contrôleur PersonnageController est valide
     * @author Jonathan Carrière
     */
    public function test_show_existe(): void
    {
        $response = $this->actingAs($this->userTest)->get("/personnages/{$this->personnageTest->id}");
        $response->assertStatus(200);
    }

    /**
     * Tester si la page Show du contrôleur PersonnageController affiche les données souhaitées
     * @author Jonathan Carrière
     */
    public function test_show_affiche_nom(): void
    {
        $response = $this->actingAs($this->userTest)->get("/personnages/{$this->personnageTest->id}");
        $response->assertSee($this->personnageTest->nom);
        $response->assertSee($this->personnageTest->description);
        $response->assertSee($this->personnageTest->doubleurs);
        $response->assertSee($this->personnageTest->animes);
    }

    /**
     * Test que l'admin est redirigé vers la liste des personnages après l'ajout d'un personnage
     * @author Jonathan Carrière
     * @return void
     */
    public function test_ajout_donnes_valides_redirection_personnagesIndex():void{
        $response = $this->actingAs($this->userAdminTest)->post(route("personnages.store"), [
            'nom' => 'nom',
            'image' => $this->image,
            'description' => 'description',
            'anime_id' => 1,
            'doubleurs_id' => 1
        ]);
        $response->assertRedirect(route("personnages.index"));
    }

    /**
     * Test la possibilité d'un utilisateur connecté à voir son horaire
     * @author Jonathan Carrière
     * @return void
     */
    public function test_affichage_horaire_connecte():void {
        $response = $this->actingAs($this->userTest)->get(route('horaires.index'));
        $response->assertStatus(200);
    }

    /**
     * Test l'impossibilité d'un utilisateur non connecté à voir son horaire
     * @author Jonathan Carrière
     * @return void
     */
    public function test_affichage_horaire_non_connecte():void {
        $response = $this->get(route('horaires.index'));
        $response->assertRedirect("/login");
    }


    /** ##############################
     *  ## TESTS D'AJOUT DANS LA BD ##
     *  ##############################
     */

    /**
     * Test que le nom d'un personnage doit contenir plus de 2 caractères à l'ajout
     * @author Jonathan Carrière
     */
    public function test_ajout_nom_min_2_caracteres_invalide():void
    {
        $reponse = $this->actingAs($this->userAdminTest)->post(route("personnages.store"),[
            'nom' => 'n',
            'image' => $this->image,
            'description' => 'desription',
            'anime_id' => 1,
            'doubleurs_id' => 1,
        ]);

        $reponse->assertInvalid(["nom"]);
        $reponse->assertValid("image");
        $reponse->assertValid("description");
        $reponse->assertValid("anime_id");
        $reponse->assertValid("doubleurs_id");

        $this->assertDatabaseMissing("personnages",[
            "nom" => "n"
        ]);
    }

    /**
     * Test que le nom d'un personnage doit contenir au maximum 50 caractères à l'ajout
     * @author Jonathan Carrière
     * @return void
     */
    public function test_ajout_nom_max_50_caracteres_invalide():void
    {
        $reponse = $this->actingAs($this->userAdminTest)->post(route("personnages.store"),[
            'nom' => '12345678901234567890123456789012345678901234567890123456',
            'image' => $this->image,
            'description' => 'desription',
            'anime_id' => 1,
            'doubleurs_id' => 1,
        ]);

        $reponse->assertInvalid(["nom"]);
        $reponse->assertValid("image");
        $reponse->assertValid("description");
        $reponse->assertValid("anime_id");
        $reponse->assertValid("doubleurs_id");

        $this->assertDatabaseMissing("personnages",[
            "nom" => "12345678901234567890123456789012345678901234567890123456"
        ]);
    }

    /**
     * Test que l'image d'un personnage est requise à l'ajout'
     * @author Jonathan Carrière
     */
    public function test_ajout_image_requise_invalide():void
    {
        $reponse = $this->actingAs($this->userAdminTest)->post(route("personnages.store"),[
            'nom' => 'nom',
            'image' => '',
            'description' => 'desription',
            'anime_id' => 1,
            'doubleurs_id' => 1,
        ]);

        $reponse->assertValid(["nom"]);
        $reponse->assertInvalid("image");
        $reponse->assertValid("description");
        $reponse->assertValid("anime_id");
        $reponse->assertValid("doubleurs_id");

        $this->assertDatabaseMissing("personnages",[
            "nom" => "nom"
        ]);
    }

    /**
     * Test que la description d'un personnage est d'au moins 10 caractères à l'ajout
     * @author Jonathan Carrière
     */
    public function test_ajout_description_min_10_caracteres_invalide():void
    {
        $reponse = $this->actingAs($this->userAdminTest)->post(route("personnages.store"),[
            'nom' => 'nom',
            'image' => $this->image,
            'description' => 'des',
            'anime_id' => 1,
            'doubleurs_id' => 1,
        ]);

        $reponse->assertValid(["nom"]);
        $reponse->assertValid("image");
        $reponse->assertInvalid("description");
        $reponse->assertValid("anime_id");
        $reponse->assertValid("doubleurs_id");

        $this->assertDatabaseMissing("personnages",[
            "nom" => "nom"
        ]);
    }

    /**
     * Test l'ajout de données valides pour tous les champs d'un personnage dans la bd
     * @author Jonathan Carrière
     */
    public function test_ajout_valide_bd():void
    {
        //!!! FONCTIONNE LORSQUE ROULÉ SEUL !!!
        $this->actingAs($this->userAdminTest)->assertDatabaseMissing("personnages",[
            'nom' => 'nom',
            'description' => 'description',
            'anime_id' => 1,
            'doubleurs_id' => 1
        ]);

        $reponse = $this->actingAs($this->userAdminTest)->post(route("personnages.store"),[
            'nom' => 'nom',
            'image' => $this->image,
            'description' => 'description',
            'anime_id' => 1,
            'doubleurs_id' => 1
        ]);

        $this->assertDatabaseHas("personnages",[
            'nom' => 'nom',
            'description' => 'description',
            'anime_id' => 1,
            'doubleurs_id' => 1
        ]);
    }

    /**
     * Test l'impossibilité d'ajouter un personnage par un non admin
     * @author Jonathan Carrière
     * @return void
     */
    public function test_ajout_refuse_non_admin():void{
        $response = $this->actingAs($this->userTest)->post(route("personnages.store"), [
            'nom' => 'nom',
            'image' => $this->image,
            'description' => 'description',
            'anime_id' => 1,
            'doubleurs_id' => 1,
        ]);
        $response->assertForbidden();
    }

    /**
     * Test l'ajout de message dans la session après la création d'un personnage
     * @author Jonathan Carrière
     * @return void
     */
    public function test_message_apres_modification():void{
        $response = $this->actingAs($this->userAdminTest)->put(route("personnages.update", $this->personnageTest->id), [
            "nom" => "truiteSaumon",
            'image' => $this->image,
            'description' => 'description',
            'anime_id' => 1,
            'doubleurs_id' => 1
        ]);
        $response->assertSessionHas('message', "Le personnage truiteSaumon a été modifié avec succès!");
    }


    /** #####################################
     *  ## TESTS DE SUPPRESSION DANS LA BD ##
     *  #####################################
     */

    /**
     * Test la suppression d'un personnage
     * @author Jonathan Carrière
     * @return void
     */
    public function test_suppression_personnage_bd():void{
        //Création d'un personnage par un admin
        $this->actingAs($this->userAdminTest)->assertDatabaseMissing("personnages",[
            "id" => 100,
            'nom' => 'nom',
            'description' => 'desription',
            'anime_id' => 1,
            'doubleurs_id' => 1,
        ]);

        //Le serveur ajoute le personnage dans la bd
        $this->actingAs($this->userAdminTest)->post(route("personnages.store"),[
            'id' => 100,
            'nom' => 'nom',
            'image' => $this->image,
            'description' => 'desription',
            'anime_id' => 1,
            'doubleurs_id' => 1,
        ]);

        //l'admin détruit le personnage
        $this->actingAs($this->userAdminTest)->assertDatabaseHas("personnages",[
            'nom' => 'nom',
            'description' => 'desription',
            'anime_id' => 1,
            'doubleurs_id' => 1,
        ]);

        //Le serveur détruit le personnage
        $this->delete(route("personnages.destroy", 100));

        //Vérification que le personnage est manquant
        $this->assertDatabaseMissing("personnages",[
            'id' => 100,
            'nom' => 'nom',
            'description' => 'desription',
            'anime_id' => 1,
            'doubleurs_id' => 1,
        ]);
    }

    /**
     * Test la suppression d'un personnage dans la bd par un admin
     * @author Jonathan Carrière
     * @return void
     */
    public function test_suppression_personnage_admin_bd():void{
        //Création d'un personnage par un admin
        $this->actingAs($this->userAdminTest)->assertDatabaseMissing("personnages",[
            "id" => 100,
            'nom' => 'nom',
            'image' => $this->image,
            'description' => 'desription',
            'anime_id' => 1,
            'doubleurs_id' => 1,
        ]);

        //Le serveur ajoute le personnage dans la bd
        $this->post(route("personnages.store"),[
            "id" => 100,
            'nom' => 'nom',
            'image' => $this->image,
            'description' => 'desription',
            'anime_id' => 1,
            'doubleurs_id' => 1,
        ]);

        //L'admin détruit le personnage
        $this->actingAs($this->userAdminTest)->delete(route("personnages.destroy", 100));

        //Vérification que le personnage est manquant
        $this->assertDatabaseMissing("personnages",[
            "id" => 100,
            'nom' => 'nom',
            'image' => $this->image,
            'description' => 'desription',
            'anime_id' => 1,
            'doubleurs_id' => 1,
        ]);
    }

    /**
     * Test l'impossibilité d'un utilisateur à supprimer un personnage dans la bd
     * @author Jonathan Carrière
     * @return void
     */
    public function test_suppression_personnage_user_bd():void{
        $reponse = $this->actingAs($this->userTest)->delete(route('animes.destroy', 1));

        $reponse->assertForbidden();
    }


    /** ######################################
     *  ## TESTS DE MODIFICATION DANS LA BD ##
     *  ######################################
     */

    /**
     * Test qu'un admin peut modifier le nom d'un personnage, sa description
     * et qu'une image est belle et bien optionnelle dans sa modification
     * @author Jonathan Carrière
     * @return void
     */
    public function test_modification_nom(): void
    {
        $personnage = Personnage::factory()->createOne();
        $this->assertNotEquals($personnage->nom, "jean-michel");
        $this->actingAs($this->userAdminTest)->put(route("personnages.update", $personnage->id), [
            'nom' => 'jean-michel',
            'description' => 'descriptionTest',
            'anime_id' => 1,
            'doubleurs_id' => 1,
        ]);
        $personnage->refresh();
        $this->assertEquals($personnage->nom, "jean-michel");
        $this->assertEquals($personnage->description, "descriptionTest");
    }

    /**
     * Test l'impossibilité pour un non-admin de modifier un personnage
     * @author Jonathan Carrière
     * @return void
     */
    public function test_modification_non_admin(): void
    {
        $personnage = Personnage::factory()->createOne();
        $reponse = $this->actingAs($this->userTest)->put(route("personnages.update", $personnage->id), [
            'nom' => 'jean-michel',
            'description' => 'descriptionTest',
            'anime_id' => 1,
            'doubleurs_id' => 1,
        ]);
        $reponse->assertForbidden();
    }

    /**
     * Test l'impossibilité de modifier un animé avec des données invalides
     * @author Jonathan Carrière
     * @return void
     */
    public function test_modification_donees_invalide(): void
    {
        $reponse = $this->actingAs($this->userAdminTest)->put(route("personnages.update", $this->personnageTest->id), [
            'nom' => 'j'
        ]);
        $reponse->assertInvalid("nom");
    }

    /**
     * Test la modification de relation du personnage
     * @author Jonathan Carrière
     * @return void
     */
    public function test_modification_personnage_anime_id(): void
    {
        $this->assertNotEquals($this->personnageTest->anime_id, 2);
        $this->actingAs($this->userAdminTest)->put(route("personnages.update", $this->personnageTest->id), [
            'nom' => 'jean-michel',
            'description' => 'descriptionTest',
            'anime_id' => 2,
            'doubleurs_id' => 1,
        ]);
        $this->personnageTest->refresh();
        $this->assertEquals($this->personnageTest->anime_id, 2);
    }


    /**
     * ############################################################
     * TEST POUR VÉRIFIER LA MODIFICATION DE LA RELATION D'UN OBJET
     * ############################################################
     */

    /**
     * Test permettant de vérifier la modification de la relation d'un personnage (modifier son doubleur)
     * @author Jonathan Carrière
     * @return void
     */
    public function test_modification_personnage_doubleurs_id(): void
    {
        $this->assertNotEquals($this->personnageTest->doubleurs_id, 2);
        $this->actingAs($this->userAdminTest)->put(route("personnages.update", $this->personnageTest->id), [
            'nom' => 'jean-michel',
            'description' => 'descriptionTest',
            'anime_id' => 1,
            'doubleurs_id' => 2,
        ]);
        $this->personnageTest->refresh();
        $this->assertEquals($this->personnageTest->doubleurs_id, 2);
    }
}
