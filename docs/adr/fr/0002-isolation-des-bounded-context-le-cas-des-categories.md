# ADR 0002: Isolation des Bounded Contexts dans l'arborescence du projet

## Statut ✅
Accepté

## Date 📅
2025-05-05

## Contexte 🖼️

Le projet "Chantres" s'appuie sur une architecture DDD modulaire. Initialement, les dossiers `Application`, `Domain`, et `Infrastructure` étaient organisés par type technique à la racine du contexte global `SongManagement`.

Cela plaçait des éléments appartenant à des Bounded Contexts distincts (comme `Category`) sous une structure partagée et transversale, ce qui violait l'encapsulation métier des sous-domaines.

## Décision ✨

Nous décidons de réorganiser l’arborescence en **plaçant chaque Bounded Context (ex: `Category`, `Song`, `Rehearsal`) comme racine de module**, contenant ses propres sous-couches DDD (`Application`, `Domain`, `Infrastructure`, etc.).
Par ce choix nous sommes plus conforme aux principes DDD et nous facilitons la lisibilité et la scalabilité de l'architecture.

### Exemple de structure retenue 📂 :

```
src/
└── SongManagement/
    ├── Category/
    │   ├── Application/
    │   ├── Domain/
    │   ├── Infrastructure/
    │   └── Category.php
    ├── Song/
    └── Rehearsal/
```

Chaque Bounded Context devient ainsi un module métier complet, cohérent et isolé, ce qui respecte les principes DDD, facilite les tests, la scalabilité et la lisibilité.

## Conséquences

- Les namespaces PHP sont mis à jour pour suivre la nouvelle hiérarchie.
- Chaque BC est autonome et peut évoluer indépendamment (ajout d’un bus, d’un EventStore, etc.).
- L’architecture devient compatible avec une éventuelle extraction future (modularité, microservice, bundle).

## Alternatives envisagées

- Garder une structure orientée technique (`Application/`, `Domain/`, etc.) partagée à la racine de `SongManagement`.  
  ❌ Rejetée car peu évolutive et violant les limites naturelles des Bounded Contexts.
