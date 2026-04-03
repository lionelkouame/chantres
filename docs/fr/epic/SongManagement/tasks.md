# Tasks : Gestion des Chants & Catégories

**Bounded Context :** `SongManagement`
**Architecture :** Hexagonale (Ports & Adaptateurs) — DDD / CQRS

---

## Gestion des Chants

### Commandes (Write)

- [ ] `AddSongToLibrary` — ✅ Déjà implémenté
- [ ] `UpdateSongDetails` — Modifier titre, langue, thème
- [ ] `ArchiveSong` — Retirer du répertoire actif → event `SongArchived`
- [ ] `RestoreSong` — Réactiver un chant archivé
- [ ] `AssignCategoryToSong` — Lier une/des catégories à un chant
- [ ] `RemoveCategoryFromSong` — Dissocier une catégorie
- [ ] `AddArrangementToSong` — Ajouter une version vocale (SATB, 3 voix...)
- [ ] `RemoveArrangementFromSong` — Supprimer une version
- [ ] `AttachScoreFile` — Lier une partition PDF → `FileStorageInterface`
- [ ] `AttachAudioFile` — Lier un fichier audio

### Queries (Read)

- [ ] `GetSongById` — Récupérer un chant par ID
- [ ] `ListSongs` — Liste paginée de tous les chants
- [ ] `SearchSongs` — Recherche par titre, langue, thème, catégorie
- [ ] `ListSongsByCategory` — Filtrer par catégorie
- [ ] `ListArchivedSongs` — Chants archivés uniquement

---

## Gestion des Catégories

### Modèle de domaine

**Aggregate Root : `Category`**
- `CategoryId` — UUID
- `Name` — Value Object non vide
- `Description` — Optionnel
- `ParentCategoryId` — Optionnel (catégories hiérarchiques)

### Commandes (Write)

- [ ] `CreateCategory` — Créer une catégorie (ex: Liturgique, Avent, Noël...)
- [ ] `UpdateCategory` — Modifier nom / description
- [ ] `DeleteCategory` — Supprimer si non utilisée
- [ ] `CreateSubCategory` — Catégorie enfant (ex: Liturgique → Messe, Vêpres)
- [ ] `MoveCategory` — Changer le parent d'une catégorie

### Queries (Read)

- [ ] `ListCategories` — Toutes les catégories (flat)
- [ ] `GetCategoryTree` — Arbre hiérarchique complet
- [ ] `GetCategoryById` — Détail d'une catégorie
- [ ] `ListSongsInCategory` — Chants appartenant à une catégorie

---

## Événements de domaine

- [ ] `CategoryCreated`
- [ ] `CategoryDeleted`
- [ ] `SongCategoryAssigned`
- [ ] `SongCategoryRemoved`
- [ ] `SongArchived` *(déjà prévu dans l'epic SongManagement)*
