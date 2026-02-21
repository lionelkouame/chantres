# ADR 0001: Integration of Docker Architecture into the Symfony Project

## Status
Accepted

## Date
2025-05-03

## Context
For the monitoring part of our application, we decided to use the duo **Prometheus** and **Grafana**.
For the implementation, we considered two approaches:

- **Approach 1: Integrate all Docker services (app, RabbitMQ, monitoring, etc.) into the same Symfony project.**
- **Approach 2: Separate monitoring into a distinct project.**

## Decision

We chose **Approach 1**: to keep all services (Symfony, RabbitMQ, Prometheus, Grafana, PostgreSQL) in **the same project**.

This decision is motivated by the following factors:

- **Consistency in local development**: a single `docker-compose up` starts the entire stack.
- **Ease of onboarding**: new developers only need the main repository.
- **No inter-project network complexity**: all services are on the same Docker network.
- **Centralized configuration**: a single place to version `docker-compose`, `prometheus.yml`, `dashboards`, etc.

## Consequences

- The project will be easier to manage for developers in a development environment.
- Monitoring with the production configuration will be possible. Adjustments will likely be needed.

## Considered Alternatives

- **Approach 2 (separate monitoring project)**: more suitable for multi-project infrastructures but overkill at this stage.
