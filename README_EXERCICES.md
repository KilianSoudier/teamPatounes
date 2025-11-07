# Team Patounes — Parcours d’exercices Symfony (Twig + Back)

> Objectif : découvrir Symfony côté back (Doctrine, Security, Forms, Twig) en construisant un site d’adoption d’animaux.  
> Règle : **pas d’indices** ici. Je t’en donne uniquement si tu me le demandes.

## Sommaire

-   [Niveau 1 — Fondations](#niveau-1--fondations)
-   [Niveau 2 — Animaux & Médical](#niveau-2--animaux--médical)
-   [Niveau 3 — Comptes & Sécurité](#niveau-3--comptes--sécurité)
-   [Niveau 4 — Candidatures d’adoption](#niveau-4--candidatures-dadoption)
-   [Niveau 5 — Qualité, listes & UX Twig](#niveau-5--qualité-listes--ux-twig)
-   [Niveau 6 — Services, événements, emails](#niveau-6--services-événements-emails)
-   [Niveau 7 — Admin & observabilité](#niveau-7--admin--observabilité)
-   [Niveau 8 — API & tests](#niveau-8--api--tests)
-   [Bonus — Pour aller plus loin](#bonus--pour-aller-plus-loin)
-   [Modèle de données (référence)](#modèle-de-données-référence)

---

## Niveau 1 — Fondations

### Ex.1 — Bootstrap projet

-   Objectif : Initialiser Symfony avec Doctrine, Migrations, Twig, Security.
-   Acceptation : L’app démarre, page d’accueil “OK”.

### Ex.2 — Migrations & Entités de base

-   Objectif : Créer User, Shelter, Species, Breed + relations + migrations.
-   Acceptation : Schéma conforme au modèle ; migrations up/down OK.

### Ex.3 — Gestion des slugs

-   Objectif : Slugs uniques pour Shelter, Species, Breed.
-   Acceptation : 3 enregistrements créés avec slugs distincts.

### Ex.4 — CRUD Shelter (back-office)

-   Objectif : Liste, création, édition, suppression (Twig).

-   Acceptation : Écrans complets + validations basiques.

### Ex.5 — Fixtures minimales

-   Objectif : Jeux de données réalistes pour User, Shelter, Species, Breed.
-   Acceptation : >3 shelters, >3 species, >5 breeds.

## Niveau 2 — Animaux & Médical

### Ex.6 — Entités Animal, AnimalPhoto, MedicalRecord

-   Objectif : Implémenter entités + relations + migrations.
-   Acceptation : Intégrité référentielle OK.

### Ex.7 — CRUD Animal (multi-shelter)

-   Objectif : CRUD côté back pour Animal lié à un Shelter.
-   Acceptation : Liste paginée, création/édition species/breed, suppression.

### Ex.8 — Upload photo

-   Objectif : Ajouter photos d’animaux, définir une couverture.

-   Acceptation : ≥2 photos/animal, 1 couverture, affichage Twig.

### Ex.9 — Fiche animal publique

-   Objectif : Page /animaux/{slug} avec infos, photos, dossier médical.

-   Acceptation : Contenu complet rendu.

### Ex.10 — Tags & filtres

-   Objectif : Tags ManyToMany + catalogue filtrable (espèce, taille, statut, tags, refuge).

-   Acceptation : Filtres combinables + pagination.

## Niveau 3 — Comptes & Sécurité

### Ex.11 — Auth & rôles

-   Objectif : Inscription, login, logout. Rôles ROLE_USER, ROLE_SHELTER_ADMIN, ROLE_ADMIN.

-   Acceptation : Accès back Shelter limité à l’admin du refuge ; admin total pour ROLE_ADMIN.

### Ex.12 — Policies/Voters

-   Objectif : Restreindre édition/suppression Animal/Shelter via Voter.

-   Acceptation : Un admin refuge ne modifie que ses ressources.

### Ex.13 — Profils utilisateurs

-   Objectif : Page “Mon compte” (fullname, phone) + changement de mot de passe.

-   Acceptation : Modifs persistées + validation.

## Niveau 4 — Candidatures d’adoption

### Ex.14 — Soumettre candidature

-   Objectif : Formulaire public AdoptionApplication par animal.

-   Acceptation : Création en statut SUBMITTED, liens User/Animal corrects.

### Ex.15 — Workflow de candidature

-   Objectif : Back-office pour lister/filtrer + changer statut (REVIEWING/APPROVED/REJECTED/CANCELLED).

-   Acceptation : Transitions cohérentes, processedAt horodaté.

### Ex.16 — Unicité candidature

-   Objectif : Empêcher plusieurs candidatures actives du même user pour le même animal.

-   Acceptation : Tentative de doublon refusée (validation).

### Ex.17 — Verrou d’adoption

-   Objectif : Lors de APPROVED, mettre Animal.status à RESERVED ou ADOPTED.

-   Acceptation : L’animal n’est plus listé “AVAILABLE”.

## Niveau 5 — Qualité, listes & UX Twig

### Ex.18 — Favoris

-   Objectif : Ajouter/retirer un animal des favoris.

-   Acceptation : Bouton toggle, page “Mes favoris”, unicité respectée.

### Ex.19 — Recherche plein texte

-   Objectif : Recherche simple sur catalogue (nom, description, refuge).

-   Acceptation : Résultats pertinents paginés.

### Ex.20 — Tri & pagination

-   Objectif : Tri par date, nom, âge ; pagination stable.

-   Acceptation : Combinaisons tri+filtres reflétées dans l’URL.

### Ex.21 — Validation avancée

Objectif : Contraintes fortes (email, phone, enums), messages localisés.

-   Acceptation : Soumissions invalides bloquées avec messages lisibles.

### Ex.22 — Flash messages & layouts

-   Objectif : Layout de base, blocs Twig, flash messages cohérents.

-   Acceptation : Retours visuels après actions CRUD.

## Niveau 6 — Services, événements, emails

### Ex.23 — Service de slug & horodatage

-   Objectif : Externaliser génération slug + MAJ timestamps.

-   Acceptation : Service testé ; appliqué aux entités concernées.

### Ex.24 — Domain events / Doctrine listeners

-   Objectif : Listener sur changement de statut d’une candidature.

-   Acceptation : Action associée exécutée (ex : marquer animal réservé).

### Ex.25 — Notifications email

-   Objectif : Email au demandeur sur changements clés (SUBMITTED→REVIEWING, →APPROVED/REJECTED).

Acceptation : Email rendu Twig, expédié.

## Niveau 7 — Admin & observabilité

### Ex.26 — Tableau de bord refuge

-   Objectif : KPIs (animaux par statut, candidatures par statut, délais moyens) + liste “dernières candidatures”.

-   Acceptation : Cartes KPI + liste fonctionnelle en Twig.

### Ex.27 — Audit log minimal

-   Objectif : Tracer qui modifie quoi (Animal, AdoptionApplication).

-   Acceptation : Page consultable par admin avec événements récents.

### Ex.28 — Export CSV

-   Objectif : Exporter la liste des animaux d’un refuge (avec filtres).

-   Acceptation : Fichier CSV téléchargé, en-têtes corrects.

## Niveau 8 — API & tests

### Ex.29 — API publique read-only

-   Objectif : /api/animals (liste + détail JSON) + filtre espèce/tag.

-   Acceptation : Pagination, CORS, schéma JSON validé.

### Ex.30 — Tests

-   Objectif : Unit tests (services), fonctionnels (routes), sécurité (voters).

-   Acceptation : Suite verte en local.

## Bonus — Pour aller plus loin

### Ex.31 — Upload direct & thumbnails

-   Objectif : Miniatures et ratio cover.

-   Acceptation : Miniatures servies au catalogue.

### Ex.32 — Nettoyage fichiers orphelins

-   Objectif : Tâche qui supprime les fichiers non référencés (+ dry-run).

-   Acceptation : Commande CLI opérationnelle.

### Ex.33 — Accessibilité & i18n

-   Objectif : FR/EN, labels accessibles, switch langue.

-   Acceptation : Traductions et validations localisées.

## Modèle de données (référence)

-   User: id, email (unique), password (hash), roles[], fullname, phone?, createdAt.
-   Shelter: id, name (unique), slug (unique), description, email, phone?, addressLine1/2?, postalCode, city, country(ISO2), createdAt, manager→User.
-   Species: id, name (unique), slug (unique).
-   Breed: id, name, slug, species→Species, UNIQUE(name, species).
-   Animal: id, shelter→Shelter, species→Species, breed?→Breed, name, slug (unique), sex(enum), birthDate?, size(enum)?, color?, description, status(enum), createdAt, updatedAt.
-   AnimalPhoto: id, animal→Animal, path, isCover(bool).
-   Tag: id, name (unique), slug (unique).
-   AnimalTag: animal→Animal, tag→Tag, UNIQUE(animal, tag).
-   MedicalRecord: id, animal→Animal(OneToOne), vaccinated(bool), chipped(bool), sterilized(bool), lastVetVisitAt?, notes?.
-   AdoptionApplication: id, applicant→User, animal→Animal, message, status(enum), createdAt, processedAt?.
-   Favorite: user→User, animal→Animal, createdAt, UNIQUE(user, animal).

**Contraintes clés :**

-   Emails & slugs uniques (où indiqué).
-   Transition de `Animal.status` contrôlée via workflow logique.
-   Unicité d’une candidature active `(applicant, animal)` (pas de doublon tant que non REJECTED/CANCELLED).
