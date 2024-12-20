# Standart && Google authentication

> Creating simple authentication and Google authentication



## Установка

### Требования

Перед установкой убедитесь, что у вас установлены следующие компоненты:

- [Docker && docker-compose](https://www.docker.com)

### Шаги для установки

1. Клонируйте репозиторий:

    ```bash
    https://github.com/counter-cowboy/Kefirium.git
    ```

2. Перейдите в папку проекта:

    ```bash
    cd Kefirium
    ```

3. Установите .env файл:

    ```bash
    make env
    ```

4. Запустите контейнеры:

    ```bash
    make up
    ```

5. Создайте тестовую базу данных:

    ```bash
   make testdb
    ```

6. Выполните миграции, сидирование баз данных:

    ```bash
    make db
    ```

7. Запуск тестов:

    ```bash
    make test 
    ```

8. PGadmin будет доступен по адресу [http://localhost:8080](http://localhost:8080).
    ```bash
     email: admin@admin.com  password: admin
      ```


