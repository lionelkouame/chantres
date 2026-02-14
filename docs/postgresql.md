# PostgreSQL Service

This project uses PostgreSQL as the default database management system. The PostgreSQL service is configured via Docker Compose and is automatically available when you start the project.

## Configuration

### Docker Compose Services

The PostgreSQL service is defined in `compose.yaml`:

```yaml
database:
  image: postgres:15-alpine
  environment:
    POSTGRES_DB: app
    POSTGRES_USER: app
    POSTGRES_PASSWORD: !ChangeMe!
  volumes:
    - database_data:/var/lib/postgresql/data
```

In development mode (`compose.override.yaml`), the PostgreSQL port 5432 is exposed to your host machine, allowing you to connect with external tools.

### Environment Variables

The following environment variables can be configured in your `.env` files:

- `POSTGRES_DB`: Database name (default: `app`)
- `POSTGRES_USER`: Database user (default: `app`)
- `POSTGRES_PASSWORD`: Database password (default: `!ChangeMe!`)
- `POSTGRES_VERSION`: PostgreSQL version (default: `15`)

For development, these are defined in `.env.dev`:

```dotenv
POSTGRES_DB=app
POSTGRES_USER=app
POSTGRES_PASSWORD=!ChangeMe!
POSTGRES_VERSION=15
```

> [!WARNING]
> **Always change the default password in production!**

### Database Connection URL

The Symfony application connects to PostgreSQL using the `DATABASE_URL` environment variable, which is automatically configured in `compose.yaml`:

```
DATABASE_URL=postgresql://app:!ChangeMe!@database:5432/app?serverVersion=15&charset=utf8
```

## Getting Started

### Starting the Services

Start all services including PostgreSQL:

```bash
docker compose up -d
```

### Checking Database Status

Check if PostgreSQL is running and healthy:

```bash
docker compose ps database
```

View PostgreSQL logs:

```bash
docker compose logs database
```

### Connecting to PostgreSQL

#### From within the PHP container

Access the PostgreSQL database from the PHP container:

```bash
docker compose exec php bin/console dbal:run-sql "SELECT version();"
```

#### From your host machine

When running in development mode, you can connect from your host using any PostgreSQL client:

- **Host**: `localhost`
- **Port**: Check the exposed port with `docker compose port database 5432`
- **Database**: `app`
- **User**: `app`
- **Password**: `!ChangeMe!`

Example using `psql`:

```bash
# Find the exposed port
PORT=$(docker compose port database 5432 | cut -d: -f2)

# Connect with psql
psql -h localhost -p $PORT -U app -d app
```

#### Using Docker Compose exec

The simplest way to access the PostgreSQL CLI:

```bash
docker compose exec database psql -U app -d app
```

## Common Operations

### Installing Doctrine ORM

To use Doctrine ORM with PostgreSQL, install the ORM pack:

```bash
docker compose exec php composer require symfony/orm-pack
```

This will automatically configure Doctrine to use the PostgreSQL database.

### Creating the Database

If you're using Doctrine, create the database:

```bash
docker compose exec php bin/console doctrine:database:create
```

### Running Migrations

Create and run database migrations:

```bash
# Create a migration
docker compose exec php bin/console make:migration

# Run migrations
docker compose exec php bin/console doctrine:migrations:migrate
```

### Database Backup

Backup your PostgreSQL database:

```bash
docker compose exec database pg_dump -U app app > backup.sql
```

### Database Restore

Restore a PostgreSQL backup:

```bash
docker compose exec -T database psql -U app -d app < backup.sql
```

### Resetting the Database

Drop and recreate the database (⚠️ destroys all data):

```bash
docker compose exec php bin/console doctrine:database:drop --force
docker compose exec php bin/console doctrine:database:create
docker compose exec php bin/console doctrine:migrations:migrate --no-interaction
```

## Data Persistence

PostgreSQL data is persisted in a Docker volume named `database_data`. This ensures your data survives container restarts.

To view the volume:

```bash
docker volume ls | grep database_data
```

To remove the volume (⚠️ destroys all data):

```bash
docker compose down -v
```

## Troubleshooting

### Connection Issues

If you can't connect to PostgreSQL:

1. Ensure the database service is running:
   ```bash
   docker compose ps database
   ```

2. Check the database logs for errors:
   ```bash
   docker compose logs database
   ```

3. Verify the DATABASE_URL in your application:
   ```bash
   docker compose exec php printenv DATABASE_URL
   ```

4. Test the connection from the PHP container:
   ```bash
   docker compose exec database pg_isready -U app
   ```

### Permission Issues

If you encounter permission errors, ensure the PostgreSQL user has the correct privileges:

```sql
-- Connect as superuser
docker compose exec database psql -U app -d app

-- Grant privileges
GRANT ALL PRIVILEGES ON DATABASE app TO app;
```

### Performance Optimization

For better performance in development, you can adjust PostgreSQL settings by creating a custom configuration file.

## Using a Different PostgreSQL Version

To use a different PostgreSQL version, update the `POSTGRES_VERSION` in your `.env.dev` file:

```dotenv
POSTGRES_VERSION=16
```

Then rebuild and restart:

```bash
docker compose down
docker compose up -d --build
```

## Switching to MySQL

If you prefer MySQL over PostgreSQL, see the [MySQL documentation](mysql.md) for migration instructions.

## Additional Resources

- [PostgreSQL Official Documentation](https://www.postgresql.org/docs/)
- [Doctrine DBAL Documentation](https://www.doctrine-project.org/projects/doctrine-dbal/en/latest/)
- [Symfony Database Configuration](https://symfony.com/doc/current/doctrine.html)
