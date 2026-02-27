# Epic : Core Song Inventory & Domain Logic
**Bounded Context :** `SongManagement`  
**Architecture :** Hexagonale  
**Technologie :** PHP 8.2+ (Symfony)  
**Couche :** Domain

---

## 1. Description
Définition des règles métier, des agrégats et des interfaces (ports) pour la gestion du répertoire de la chorale. 
Cette couche est isolée : elle ne dépend ni de Doctrine, ni de Symfony, ni d'aucune bibliothèque d'infrastructure.

---

## 2. Modèle de Domaine (Aggregates & Value Objects)

### **Aggregate Root : `Song`**
* **Responsabilité :** Garantir lgit branch 'intégrité globale d'un chant.
* **Identité :** `SongId` (Value Object encapsulant un UUID).
* **Attributs :** Titre, Compositeur, Parolier, Langue, Thématique.
* **Relations :** Gère une collection d'entités `Arrangement`.

### **Entity : `Arrangement`**
* **Responsabilité :** Gérer une version spécifique d'un chant (ex: SATB, 3 voix égales).
* **Attributs :** Tonalité (`MusicalKey`), Niveau de difficulté (`Difficulty`).
* **Composition :** Liste des pupitres (`Voice`) requis.

### **Value Objects (Immuables) :**
* `SongId` : Identifiant unique typé.
* `Voice` : Enum (Soprano, Alto, Ténor, Basse, Baryton).
* `Difficulty` : Enum (Très facile à Très difficile).
* `MusicalKey` : Représentation d'une tonalité.

---

## 3. Ports du Domaine (Interfaces)

### **Driven Ports (Output)**
* `SongRepositoryInterface` : Interface pour persister ou récupérer un `Song`.
* `FileStorageInterface` : Interface pour la gestion des partitions (PDF) et fichiers audio.

---

## 4. Règles Métier & Logique (Domain Services)

* **Validation d'unicité :** Un `Song` ne peut pas avoir deux `Arrangements` identiques pour la même formation vocale.
* **Validation de structure :** Un chant doit avoir un titre non vide et un compositeur défini (ou "Anonyme").
* **Contrainte de tessiture :** Validation des types de voix autorisés par arrangement.

---

## 5. Événements de Domaine (Domain Events)

* `SongAddedToLibrary` : Émis à la création d'un chant.
* `ArrangementAddedToSong` : Émis quand une nouvelle version est disponible.
* `SongArchived` : Émis lorsqu'un chant est retiré du répertoire actif.

---

## 6. Critères d'Acceptation (Definition of Done)

* [ ] L'agrégat `Song` est une classe PHP pure sans aucune annotation `#[ORM]`.
* [ ] Le `SongId` valide le format UUID dès l'instanciation.
* [ ] Couverture de tests unitaires (PHPUnit) à 100% sur les règles de validation du domaine.
* [ ] Zéro dépendance vers le dossier `Infrastructure` ou `Vendor` (hors polyfills de types/UUID).
* [ ] Utilisation exclusive de **Domain Exceptions** typées.
