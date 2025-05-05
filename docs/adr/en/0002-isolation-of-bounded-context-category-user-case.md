# ADR 0002: Isolation of Bounded Contexts in the Project Directory Structure

## Status ✅
Accepted

## Date 📅
2025-05-05

## Context 🖼️

The "Chantres" project is based on a modular DDD architecture. Initially, the `Application`, `Domain`, and `Infrastructure` folders were organized by technical layers at the root of the overall `SongManagement` context.

This placed elements belonging to distinct Bounded Contexts (such as `Category`) under a shared, cross-cutting structure, which violated the business encapsulation of subdomains.

## Decision ✨

We decided to reorganize the directory structure by **placing each Bounded Context (e.g., `Category`, `Song`, `Rehearsal`) at the root level**, each containing its own DDD sub-layers (`Application`, `Domain`, `Infrastructure`, etc.).

This choice aligns more closely with DDD principles and improves the readability and scalability of the architecture.

### Chosen structure example 📂:
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
Each Bounded Context thus becomes a complete, coherent, and isolated business module, which respects DDD principles and facilitates testing, scalability, and readability.

## Consequences
- The PHP namespaces are updated to follow the new hierarchy.
- Each BC is autonomous and can evolve independently (addition of a bus, an EventStore, etc.).
- The architecture becomes compatible with potential future extraction (modularity, microservice, bundle).

## Considered Alternatives
- Keep a structure oriented by technical layers (`Application/`, `Domain/`, etc.) shared at the root of `SongManagement`.  
  ❌ Rejected as it is not scalable and violates the natural boundaries of Bounded Contexts.
