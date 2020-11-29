# Online duty API service

## Configuration

### Legacy online duty schedule file

- `config\services.yaml`
    - `parameters`
        - `api.schedule_file_path` - set the relative/absolute file path or URL (must be accessible for the service)

## Development

### Requirements

- PHP 7.4+
- Composer 2.0.0+

### Local configuration

After cloning the repository install packages:

```commandline
composer install
```

or for production build:

```commandline
./script/build
```

To run server locally:

```commandline
./script/server
```

To run tests:

```commandline
./script/test
```

To run code checks and dependencies security scan:

```commandline
./script/lint
```

## API

The API is documented in a form of [Swagger/OpenAPI specification](doc/swagger.yaml).

## Planned

- [ ] Add support for other data sources
- [ ] Implement JS client for the API (types, API calls)
- [ ] Introduce docker images for better local development and CI experience
- [ ] Add CI code (with running tests at minimum)

## License

The project is licensed on MIT license. For details check the [license file](LICENSE.md).
