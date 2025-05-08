# ADR 0001: Intégration de l'architecture Docker dans le projet Symfony

## Status
Accepté

## Date
2025-05-03

## Contexte
Pour la partrie monotoring de notre application, nous avons décider de partir sur le duo **Prometheus** et **Grafana**.
Pour la mise en place nous avons deux approches en vue:

- **Approche 1 : Intégrer tous les services Docker (app, RabbitMQ, monitoring, etc.) dans le même projet Symfony.**
- **Approche 2 : Séparer le monitoring dans un projet distinct.**

## Décision

Nous avons choisi **l'approche 1** : conserver tous les services (Symfony, RabbitMQ, Prometheus, Grafana, PostgreSQL) dans **le même projet**.

Cette décision est motivée par les facteurs suivants :

- **Cohérence du développement local** : un seul `docker-compose up` permet de démarrer toute la stack.
- **Facilité d’onboarding** : les nouveaux développeurs n’ont besoin que du dépôt principal.
- **Pas de complexité réseau inter-projets** : les services sont tous sur le même réseau Docker.
- **Centralisation de la configuration** : un seul endroit pour versionner les fichiers `docker-compose`, `prometheus.yml`, `dashboards`, etc.

## Conséquences

- Le projet sera plus simple à gérer pour les développeurs dans le cas d'un environnement de dev.
- Voir le monitoring avec la configuration de production. Il y aura surement des ajustements à faire.

## Alternatives considérées

- **Approche 2 (projet monitoring séparé)** : plus adaptée à des infrastructures multi-projets, mais surdimensionnée à ce stade.

