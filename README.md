Symfony Messenger-Demo: Registrierungsformular
==============================================

Beispiel-Anwendung zur Vorstellung der Symfony Messenger-Komponente und einiger möglicher Anwendungsgebiete.

Installation
------------

1. Repository klonen

    ```
    git clone https://github.com/sensiolabs-de/messenger-signup-demo
    ```

2. Abhängigkeiten installieren

    ```
    composer install
    ```

3. Entwicklungs-Server starten

    ```
    php bin/console server:run
    ```

4. Seite im Browser öffnen

    ```
    http://localhost:8000
    ```

Docker-Setup
------------

1. Repository klonen

    ```
    git clone https://github.com/sensiolabs-de/messenger-signup-demo
    ```

2. Abhängigkeiten installieren

    ```
    composer install
    ```

3. Docker-Umgebung starten

    ```
    docker-compose up
    ```

4. Seite im Browser öffnen

   ```
   http://localhost
   ```

5. RabbitMQ Admin-Interface im Browser öffnen

   ```
   http://localhost:8080
   ```
   
   Benutzer: `guest`, Passwort: `guest`

6. Gequeuete Messages abarbeiten

   ```
   docker-compose exec app bash
   bin/console messenger:consume-messages
   ```
