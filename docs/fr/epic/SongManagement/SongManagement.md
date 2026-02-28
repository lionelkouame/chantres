# 🎼 Epic : Core Song Inventory & Domain Logic

**Bounded Context :** `SongManagement`  
**Architecture :** Hexagonale (Ports & Adaptateurs)  
**Langage :** PHP 8.2+  
**Couche :** Domain (Domaine)

---

## 1. Description
Définition des règles métier, des agrégats et des interfaces (ports) pour la gestion du répertoire de la chorale.
Cette couche est **strictement isolée** : elle ne dépend ni de Doctrine, ni de Symfony, ni d'aucune bibliothèque d'infrastructure. Elle représente la "Logique Métier Pure".

---

## 2. Modèle de Domaine (Aggregates & Value Objects)

### **Aggregate Root : `Song`**
* **Responsabilité :** Garantir l'intégrité globale d'une œuvre musicale.
* **Identité :** `SongId` (Value Object encapsulant un UUID).
* **Attributs :** `Title`, `Language`, `Theme`.
* **Relations :** * Possède une collection d'entités `Arrangement`.
    * Référence des `ContributorId` pour les rôles de **Composer** et **Lyricist** (Association par identité).

### **Aggregate Root : `Contributor`**
* **Responsabilité :** Gérer l'identité et les métadonnées des auteurs.
* **Identité :** `ContributorId` (Value Object encapsulant un UUID).
* **Attributs :** `FullName` (VO), `Biography` (Optionnel).

### **Entity : `Arrangement`**
* **Responsabilité :** Gérer une version spécifique d'un chant (ex: SATB, 3 voix égales).
* **Attributs :** `MusicalKey`, `Difficulty` (Enum).
* **Composition :** Liste des pupitres requis (`Voice` / Enum).

### **Value Objects (Immuables) :**
* `SongId` / `ContributorId` : Identifiants uniques typés.
* `FullName` : Prénom/Nom validés (non vides).
* `Voice` : Enum (Soprano, Alto, Tenor, Bass, Baritone).
* `Difficulty` : Enum (Very Easy to Very Difficult).
* `MusicalKey` : Représentation d'une tonalité musicale (ex: "C Major").

---

## 3. Ports du Domaine (Interfaces)

### **Driven Ports (Sortie / Output)**
* `SongRepositoryInterface` : Interface pour persister ou récupérer un `Song`.
* `ContributorRepositoryInterface` : Interface pour persister ou récupérer un `Contributor`.
* `FileStorageInterface` : Interface pour la gestion des partitions (PDF) et fichiers audio.

---

## 4. Règles Métier & Invariants (Domain Services)

* **Uniqueness Validation :** Un `Song` ne peut pas avoir deux `Arrangements` identiques pour la même formation vocale.
* **Structural Validation :** Un chant doit avoir un `Title` non vide.
* **Contributor Linking :** Un chant doit être associé à au moins un `ContributorId` (ou un ID spécifique pour "Anonymous").
* **Tessitura Constraint :** Validation des types de `Voice` autorisés par arrangement.

---

## 5. Événements de Domaine (Domain Events)

* `SongAddedToLibrary` : Émis à la création d'un chant.
* `ContributorRegistered` : Émis lors de la création d'un nouveau contributeur.
* `ArrangementAddedToSong` : Émis quand une nouvelle version est disponible.
* `SongArchived` : Émis lorsqu'un chant est retiré du répertoire actif.

---

## 6. Critères d'Acceptation (Definition of Done)

- [ ] **POPO ONLY** : Les agrégats sont des classes PHP pures sans annotations `#[ORM]` ou `#[Serializer]`.
- [ ] **Identity Association** : Les relations entre `Song` et `Contributor` utilisent `ContributorId` (pas de références d'objets directes).
- [ ] **Strict Typing** : Utilisation complète des fonctionnalités PHP 8.2+ (propriétés `readonly`, constructor promotion).
- [ ] **Testing** : Couverture de tests unitaires (PHPUnit) à 100% sur les règles de validation du domaine.
- [ ] **Isolation** : Zéro dépendance vers les dossiers `Infrastructure` ou `Vendor`.
- [ ] **Exceptions** : Utilisation exclusive de **Domain Exceptions** typées.
