<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

/**
 * Seeder pour le modèle User permettant d'ajouter les vraies données de l'application dans la base de données
 * @author Jonathan Carrière
 */
class UsersSeeder
{
    public function run(): void
    {
        DB::table("users")->insert([
            ["name" => "Jonathan Carrière", "email" => "jonathancarriere2002@github.com", "email_verified_at" => now(), "password" => bcrypt("!M=Q2+JiP+hJ"), "is_admin" => 1],
            ["name" => "Admin", "email" => "admin@laravel.com", "email_verified_at" => now(), "password" => bcrypt("Hpg%f+,yA8Cn"), "is_admin" => 1],
            ["name" => "User", "email" => "user@laravel.com", "email_verified_at" => now(), "password" => bcrypt("N4M1.xUh_Qis"), "is_admin" => 0],
            ["name" => "Cloud Strife", "email" => "cloud@laravel.com.com", "email_verified_at" => now(), "password" => bcrypt("1PWrf8TDf+bF"), "is_admin" => 0],
            ["name" => "Barret Wallace", "email" => "barret@laravel.com.com", "email_verified_at" => now(), "password" => bcrypt("+ygv4=RANotf"), "is_admin" => 0],
            ["name" => "Tifa Lockhart", "email" => "tifa@laravel.com.com", "email_verified_at" => now(), "password" => bcrypt("tC0o:8W?iPWB"), "is_admin" => 0],
            ["name" => "Aerith Gainsborough", "email" => "aerith@laravel.com.com", "email_verified_at" => now(), "password" => bcrypt("45Xh)>doknow"), "is_admin" => 0],
            ["name" => "Red XIII", "email" => "red@laravel.com.com", "email_verified_at" => now(), "password" => bcrypt("5,Gx=VKE.BK7"), "is_admin" => 0],
            ["name" => "Yuffie Kisaragi", "email" => "yuffie@laravel.com.com", "email_verified_at" => null, "password" => bcrypt(":ij1U*]*eas!"), "is_admin" => 0],
            ["name" => "Cait Sith", "email" => "cait@laravel.com.com", "email_verified_at" => now(), "password" => bcrypt("+-56f)K]YxF!"), "is_admin" => 0],
            ["name" => "Vincent Valentine", "email" => "vincent@laravel.com.com", "email_verified_at" => null, "password" => bcrypt("!uK!#9e*7#hk"), "is_admin" => 0],
            ["name" => "Cid Highwind", "email" => "cid@laravel.com.com", "email_verified_at" => now(), "password" => bcrypt("oQtR6L3%%Zw#"), "is_admin" => 0],
            ["name" => "Sephiroth", "email" => "sephiroth@laravel.com.com", "email_verified_at" => now(), "password" => bcrypt("4H20%8Ksww%3"), "is_admin" => 0],
        ]);
    }
}
